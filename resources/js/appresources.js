// const { event } = require("jquery");

require("./print.min");

let doneOrder = false, InvoiceNumber = "";
let scannedProducts = [];
let defaultProducts = ["4200000000001", "4200000000002", "4200000000003"];

printOrders = () => {
        window.print();
} // | printOrders

handleUpdateShopId = (e) => {
    value = e.target.value;
    sendAjax(`/setShopId/${value}`, "GET", [], (res) => {
        document.open();
        document.write(res.responseText);
        document.close();
    })
} // | handleUpdateShopId

handleChangeInvoiceNumber = (e) => {
    const value = e.target.value;
    if(value.length >= 8) {
        showLoader();
        sendAjax( `/quality/${value}`, "GET", [], (res) => {
            let result =JSON.parse(res.responseText);
            if(result.status == "ok"){
                document.open();
                document.write(result.view);
                document.close();
                const barcodeEl = document.getElementById("barcode");
                barcodeEl ? barcodeEl.focus() : "";
            }else{
                let content_info = document.getElementById("content_info");
                content_info.classList.add(['content_info']);
                let errorInfo = document.createTextNode(result.message);
                content_info.innerText = "";
                content_info.appendChild(errorInfo);
                hideLoader();
            }
        })
    }
} // | handleChangeInvoiceNumber


checkInvoiceNumberAgainPrinting = (e) => {
    const value = e.target.value;
    if(value.length >= 8) {
        showLoader();
        sendAjax( `/printAgain/${value}`, "GET", [], (res) => {

            let result =JSON.parse(res.responseText);

            if(result.success === 'false'){
                hideLoader();
                showErrorInfo();
                document.getElementById('content_info').innerHTML = 'order not found';
                return false;
            }else {
                document.open();
                document.write(result.message);
                document.close()
            }
        })
    }
} // | checkInvoiceNumberAgainPrinting

printOrderAgain = () => {

    let invoiceNumber = document.getElementById("invoice_number").innerText;
    sendAjax(`/printAgainBase64/${invoiceNumber}`, "GET", [], (data) => {
        let result =JSON.parse(data.responseText);
        printJS({
            printable: result.bas_64_pdf,
            type: 'pdf',
            base64: true,
        });
    });

} // | printOrderAgain

handleChangeProductBarcode = (e) => {
    const value = e.target.value;

    //Get EAN numbers
    const eans = document.querySelectorAll(`tr[data-EAN]`);
    const eansArr = [];
    let eanLength = 0;
    eans.forEach(function (item) {
        eansArr.push(item.getAttribute('data-EAN'));
        let isActiveClassExist = item.classList.contains('active');
        if (!isActiveClassExist && eanLength < item.getAttribute('data-EAN').length) {
            eanLength = item.getAttribute('data-EAN').length;
        }
    });

    let isFind = eansArr.indexOf(value);
    if(value.length < eanLength){
        return false;
    }

    //If doesn't finded or wrong show "FALSCHE"
    if(value.length >= 12 && isFind == (-1)){
        let falshTr = document.querySelector('tbody>tr:not(.active)');
        showMessageBox("fail", falshTr);
        setTimeout(() => e.target.value = "", 200);
        return false
    }

    if(value.length >= 12 || value.length <= 15) {
        const itemIndex = scannedProducts.findIndex(item => item.EAN === value);
        if(itemIndex !== -1) {
            if(scannedProducts[itemIndex].scanned_quantity <= scannedProducts[itemIndex].quantity) {
                const target = document.querySelector(`tr[data-EAN="${value}"]`);
                if(scannedProducts[itemIndex].scanned_quantity < scannedProducts[itemIndex].quantity) {
                    scannedProducts[itemIndex].scanned_quantity++;
                    const elScanned = target.getElementsByClassName("scanned-quantity");
                    const item = scannedProducts[itemIndex];

                    elScanned && elScanned.length ? elScanned[0].innerText = item.scanned_quantity : "";
                    showMessageBox("success", target);
                    if (item.quantity === item.scanned_quantity) {
                        target.classList.add("active");
                        checkAllProductsDone();
                    }
                } else {
                    showMessageBox("fail", target)
                }
            }
        }
        setTimeout(() => e.target.value = "", 200);
    } else {
        setTimeout(() => e.target.value = "", 200);
        showMessageBox("fail", e.target.parentElement);
    }
} // | handleChangeProductBarcode

checkAllProductsDone = () => {

    const notDone = scannedProducts.find(function(item){
        return (item.scanned_quantity < item.quantity && item.EAN != null);
    });

    if(!notDone) {
        const el = document.getElementById("shipping");
        el ? el.classList.remove("d-none") : "";
        doneOrder = true;

        // If url == '/quality' and
        // if order is fully picked,
        // create the label automatically
        // and move to next order entry screen
        if(location.pathname == '/quality'){
            let invoiceNumber = document.querySelector(`div[data-invoice]`).getAttribute('data-invoice');
            setTimeout(function () {
                createShipping(invoiceNumber);
            },500)
        }
    }
} // | checkAllProductsDone

saveScannedProducts = (e) => {
    e.preventDefault();
    setOrderItemsInStorage();
    location.href = "/quality";
}
checkAllProductsDoneInStorage = (invoiceNumber) => {
    const orderItems = getOrderItems();
    const notDone = orderItems[invoiceNumber].find(item => (item.scanned_quantity < item.quantity && item.EAN != null));
    return notDone ? false : true;
} // | checkAllProductsDoneInStorage

createShipping = (invoiceNumber) => {
    setOrderItemsInStorage();
    if(checkAllProductsDoneInStorage(invoiceNumber)) {
        document.getElementById("createShipping").classList.add("disabled")
        showLoader();
        sendAjax(`/quality/shipping/${invoiceNumber}`, "GET", [], (data) => {

            let result =JSON.parse(data.responseText);

            if(result.success == "false"){
                hideLoader();
                showErrorInfo();
            }else{
                document.getElementById("createShipping").classList.remove("disabled");
                printJS({
                    printable: result.shipping_label,
                    type: 'pdf',
                    base64: true,
                    onPrintDialogClose(){
                        setTimeout(function () {
                            if(result.export_pdf){
                                printJS({
                                    printable: result.export_pdf,
                                    type: 'pdf',
                                    base64: true,
                                    onPrintDialogClose(){
                                        setTimeout(function () {
                                            if(result.invoice_pdf){
                                                printJS({
                                                    printable: result.invoice_pdf,
                                                    type: 'pdf',
                                                    base64: true,
                                                    onPrintDialogClose(){
                                                        setTimeout(function () {
                                                            hideLoader();
                                                            location.href = "/quality";
                                                        },2000)
                                                    }
                                                });
                                            }else{
                                                location.href = "/quality";
                                            }

                                        },2000)
                                    }
                                });
                            }else{
                                location.href = "/quality";
                            }
                        },2000)
                    }
                });
            }
        });
    }
} // | createShipping

createShippingByDate = (fromDate, toDate) => {
    document.getElementById("createShipping").classList.add("disabled");
    showLoader();
    sendAjax(`/shipment/shipping/${fromDate}/${toDate}`, "GET", [], (data) => {
        if(data.responseText) {
            printJS({
                printable: data.responseText,
                type: 'pdf',
                base64: true,
                onPrintDialogClose(){
                    hideLoader();
                    location.href = "/";
                }
            });
        }
        document.getElementById("createShipping").classList.remove("disabled");
        document.getElementById("loader").classList.add("d-none");
    });
} // | createShippingByDate

finishOrder = (invoiceNumber) => {
    setOrderItemsInStorage();
    if(checkAllProductsDoneInStorage(invoiceNumber)) {
        showLoader();
        sendAjax(`/quality/finish/${invoiceNumber}`, "GET", [], () => {
            location.href = "/";
        });
    }
} // | finishOrder

setOrderItemsInStorage = () => {
    const existingOrderItems = getOrderItems();
    existingOrderItems[InvoiceNumber] = scannedProducts;
    localStorage.setItem("OrderItems", JSON.stringify(existingOrderItems));
    InvoiceNumber = "";
    scannedProducts = [];
} // | setOrderItemsInStorage

setOrderItems = (orderItems, invoiceNumber) => {
    const existingOrderItems = getOrderItems();
    if(existingOrderItems[invoiceNumber] && existingOrderItems[invoiceNumber].length) {
        scannedProducts = existingOrderItems[invoiceNumber].filter((item, key) => {
            let orderItem = orderItems.find(el => el.EAN === item.EAN);
            if(orderItem) {
                return item;
            }
        });
    } else {
        scannedProducts = orderItems;
    }

    InvoiceNumber = invoiceNumber;

    if(scannedProducts && scannedProducts.length) {
        scannedProducts.forEach((orderItem, index) => {

            if(defaultProducts.includes(orderItem.EAN)) {
                scannedProducts[index].scanned_quantity = scannedProducts[index].quantity;
            }

            //Old version
            // const target = document.querySelector(`tr[data-EAN="${orderItem.EAN}"]`);
            //
            // if(target) {
            //     const elScanned = target.getElementsByClassName("scanned-quantity");
            //     const item = scannedProducts[index];
            //     elScanned && elScanned.length ? elScanned[0].innerText = item.scanned_quantity : "";
            //     if (item.quantity === item.scanned_quantity) {
            //         target.classList.add("active");
            //         checkAllProductsDone();
            //     }
            // }

            //New version
            const targets = document.querySelectorAll(`tr[data-EAN="${orderItem.EAN}"]`);
            targets.forEach(function(target){
                if(target) {
                    let targetInvoiceNumbertarget = target.closest('div[data-invoice]').getAttribute('data-invoice');
                    const elScanned = target.getElementsByClassName("scanned-quantity");
                    const item = scannedProducts[index];
                    elScanned && elScanned.length ? elScanned[0].innerText = item.scanned_quantity : "";
                    if (item.quantity === item.scanned_quantity && targetInvoiceNumbertarget == invoiceNumber) {
                        target.classList.add("active");
                        checkAllProductsDone();
                    }
                }
            });
        })

        localStorage.setItem("OrderItems", JSON.stringify(existingOrderItems));
    }
} // | setOrderItems

getOrderItems = () => {
    const orderItems = localStorage.getItem("OrderItems");
    return orderItems ? JSON.parse(orderItems) : {};
} // | getOrderItems

setScannedOrderItems = (invoiceNumber = "") => {
    const _invoiceNumber = invoiceNumber ? invoiceNumber : InvoiceNumber;
    const orderItems = getOrderItems();
    if(orderItems[_invoiceNumber] && orderItems[_invoiceNumber].length) {
        const invoiceTarget = document.querySelector(`div[data-invoice="${_invoiceNumber}"]`);
        orderItems[_invoiceNumber].forEach((orderItem, index) => {
            const target = invoiceTarget.querySelector(`tr[data-EAN="${orderItem.EAN}"]`);
            if(target) {
                const elScanned = target.getElementsByClassName("scanned-quantity");
                const item = orderItems[_invoiceNumber][index];
                elScanned && elScanned.length ? elScanned[0].innerText = item.scanned_quantity : "";
                if (item.quantity === item.scanned_quantity) {
                    target.classList.add("active");
                    invoiceNumber ? "" : checkAllProductsDone();
                }
            }
        })
    }

} // | setScannedOrderItems

setScannedOrderItemsForDatePeriod = (invoiceNumbers) => {
    for(invoiceNumber of invoiceNumbers) {
        setScannedOrderItems(invoiceNumber)
    }
} // | setScannedOrderItemsForDatePeriod

getShipment = () => {
    const fromDate = document.getElementById("from").value;
    const toDate = document.getElementById("to").value;
    sendAjax(`/shipment/${fromDate}/${toDate}`, "GET", [], (data) => {
        document.open();
        document.write(data.responseText);
        document.close();
    });

} // | getShipment

getProductByEan = (e) => {
    const value = e.target.value;
    if(value.length >= 12 ) {
        sendAjax( `/receipt/product/${value}`, "GET", [], (data) => {
            if(data.responseText && data.responseText.length) {
                const product = JSON.parse(data.responseText);
                const productEl = document.getElementsByName(product.billbee_id);
                if(!productEl.length && Object.keys(product).length) {
                    removeClass("selected");
                    removeClass("focused");
                    const trContent = `<tr class="row-data selected">
                        <td>${product.title}</td>
                        <td>${product.ean}</td>
                        <td><input type="number" class="delta-quantity focused" min="0" value="1" name="${product.billbee_id}" onfocus="selectRow(event)" onkeydown="confirmRow(event)"/></td>
                    </tr>`;

                    const producstTable = document.getElementById("products");
                    producstTable.insertAdjacentHTML("beforeend", trContent);
                    const focusedElements = document.getElementsByClassName("focused");
                    if(focusedElements.length){
                        focusedElements[0].focus();
                        focusedElements[0].select();
                    }
                    document.getElementById("submit").classList.remove("disabled")
                } else {
                    removeClass("selected");
                    removeClass("focused");
                    productEl[0].classList.add("focused")
                    productEl[0].focus();
                    productEl[0].closest("tr").classList.add("selected");
                }
            }
        })
    }
}// | getProductByEan

updateProductsStockCodes = () => {
    const quantities = document.getElementsByClassName("delta-quantity");
    if(quantities.length) {
        const data = {"quantities": {}};
        for (var item of quantities) {
            data["quantities"][item.name] = item.value;
        }
        data["reason"] = document.getElementById("reason").value;
        sendAjax("/receipt/stockcode/update", "POST", JSON.stringify(data), (res) => {
            const response = JSON.parse(res.responseText);
            if(response.success) {
                const element = document.getElementsByClassName("row-data");
                for (index = element.length - 1; index >= 0; index--) {
                    element[index].parentNode.removeChild(element[index]);
                }
                document.getElementById("submit").classList.add("disabled")
                document.getElementById("scan-ean").focus();
                document.getElementById("scan-ean").value = "";
            }
        })
    }
} // | updateProductsStockCodes

selectRow = (e) => {
    removeClass("selected");
    e.target.closest("tr").classList.add("selected")
    e.target.select();
} // | selectRow

confirmRow = (e) => {
    if(e.keyCode === 13) {
        removeClass("selected");
        removeClass("focused");
        document.getElementById("scan-ean").focus();
        document.getElementById("scan-ean").value = "";
    }
} // | confirmRow

removeClass = ( className) => {
    const selectedElements = document.getElementsByClassName(className);
    while (selectedElements.length > 0) {
        selectedElements[0].classList.remove(className);
    }
}
showMessageBox = (show="success",target) => {
    const hide = show === "success" ? "fail" : "success";
    const message = show === "success" ? "OK" : "FALSCH";
    var messageBoxes = document.getElementsByClassName('message');
    for (var i = 0; i < messageBoxes.length; i++) {
        messageBoxes[i].classList.add("d-none");
    }
    const showMessage = target.getElementsByClassName("message");
    if(showMessage && showMessage.length) {
        showMessage[0].classList.remove("d-none")
        showMessage[0].classList.remove(`message-${hide}`)
        showMessage[0].classList.add(`message-${show}`)
        showMessage[0].innerText = message;
    }
} // | showMessageBox

sendAjax = (url = "", type="GET", data = [], callback) => {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            callback.apply(this, [this]);
        }
    };
    xhttp.open(type, url, true);
    if(type.toUpperCase() === "POST") {
        xhttp.setRequestHeader("Content-Type", "application/json");
        xhttp.setRequestHeader("X-CSRF-TOKEN", document.getElementsByName('csrf-token')[0].getAttribute('content'));
        xhttp.send(data);
    } else {
        xhttp.send();
    }
} // | sendAjax

disableParentButton = (e) => {
    showLoader();
    e.target.parentNode.classList.add("disabled")
}
showLoader = () => {
    document.getElementById("loader").classList.remove("d-none");
}
hideLoader = () => {
    document.getElementById("loader").classList.add("d-none");
};

showErrorInfo = () => {
    let content = document.getElementById("content_info");
    content.classList.add(['content_info']);
    let errorInfo = document.createTextNode("Incorrect data for order");
    content.appendChild(errorInfo);
};
function newFunction() {
    event(new RefreshEvent($shopId));
}

