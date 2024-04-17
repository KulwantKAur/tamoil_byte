import printJS from 'print-js';

let doneOrder = false,
    InvoiceNumber = "";
let scannedProducts = [];
let defaultProducts = ["4200000000001", "4200000000002", "4200000000003"];
window.countbox = 1;
window.countboxtext = 1;


printOrders = () => {
    var count = $('.checkbox').filter(':checked').length;
    if (count > 0) {
        window.print();
    } else {
        swal("You have to select atleast one order");
    }
}; // | printOrders

printOrdersAll = () => {
    $('.print_main').removeClass('no-print');
    window.print();
    setTimeout(() => {
        $('.print_main').addClass('no-print');
        $('.checkbox').prop('checked', false);
    }, 1000);
}; // | printOrdersAll

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
    if (value.length >= 8) {
        showLoader();
        sendAjax(`/quality/${value}`, "GET", [], (res) => {
            let result = JSON.parse(res.responseText);
            if (result.status == "ok") {
                document.open();
                document.write(result.view);
                document.close();
                const barcodeEl = document.getElementById("barcode");
                barcodeEl ? barcodeEl.focus() : "";
            } else {
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
handleChangeInvoiceNumberNew = function handleChangeInvoiceNumberNew(e) {
    var value = e.target.value;

    if (value.length >= 15) {
        showLoader();
        sendAjax("/qualitynew/".concat(value), "GET", [], function (res) {
            var result = JSON.parse(res.responseText);

            if (result.status == "ok") {
                document.open();
                document.write(result.view);
                document.close();
                var barcodeEl = document.getElementById("barcode");
                barcodeEl ? barcodeEl.focus() : "";
            } else {
                var content_info = document.getElementById("content_info");
                content_info.classList.add(['content_info']);
                var errorInfo = document.createTextNode(result.message);
                content_info.innerText = "";
                content_info.appendChild(errorInfo);
                hideLoader();
            }
        });
    }
}; // | handleChangeInvoiceNumberNew
//###################################### M U L T I B O X ######################################
//Multibox Scanning
handleChangeMultibox = (e) => {
    var value = e.target.value;

    if (value.length >= 8) {
        showLoader();
        sendAjax("/multibox/".concat(value), "GET", [], function (res) {
            var result = JSON.parse(res.responseText);
            if (result.status == "ok") {
                document.open();
                document.write(result.view);
                document.close();
                var barcodeEl = document.getElementById("scanbox");
                barcodeEl ? barcodeEl.focus() : "";
            } else {
                var content_info = document.getElementById("content_info");
                content_info.classList.add(['content_info']);
                var errorInfo = document.createTextNode(result.message);
                content_info.innerText = "";
                content_info.appendChild(errorInfo);
                hideLoader();
            }
        });
    }
}; // | handleChangeMultibox

addBoxScanned = (event) => {
    var box_ean = event.target.value;
    sendAjax("/multibox/boxes/".concat(box_ean), "GET", [], function (data) {
        var result = JSON.parse(data.responseText);
        console.log(result);
        $("#box_table_thead tr").append("<th class='t_box box_" + window.countbox + " '><span class='cbt_" + window.countbox + "'>Box " + window.countboxtext + "</span> : " + result.BoxShortName + "</th>");
        $(scannedProducts).each(function (key, val) {
            box_col = 'box_' + val.EAN;
            $("#tr_" + val.EAN).append("<td class='t_box box_" + window.countbox + "'><a class='btn minus' href='javascript:void(0)' onclick='minus(\"" + val.EAN + "\", \"box_" + window.countbox + "\")'>-</a><input class='inq " + box_col + "' data-box='" + result.BoxShortName + "' data-boxean='" + result.EAN + "' data-bNum='box_" + window.countbox + "' oninput='handleChangeProductScannedQuantity(\"" + val.EAN + "\")' type='number' min='0' max='" + result.BoxSize + "' value='0' /><a href='javascript:void(0)' class='btn plus' onclick='plus(\"" + val.EAN + "\", \"box_" + window.countbox + "\")'>+</a></td>");
        });
        $("#box_table_tfoot tr").append("<td class='t_box box_" + window.countbox + " '><button class='btn btn-warning btn-sm' onclick='removeBox(\"box_" + window.countbox + "\")'>Box Löschen</button></td>");
        $("#box_list").append("<li class='box_" + window.countbox + "'><input type='radio' class='t_box box_" + window.countbox + "' onclick='activeBox(" + window.countbox + ")'><label><span class='cbt_" + window.countbox + "'>box " + window.countboxtext + "</span> : " + result.BoxShortName + "</label></li>");

        activeBox(window.countbox);
        console.log(window.countbox);
        window.countbox += 1;
        window.countboxtext += 1;
    });
    setTimeout(function () {
        return event.target.value = "";
    }, 200);

} // | addBoxScanned

handleChangeProductScannedQuantity = (ean) => {

    $(scannedProducts).each(function (key, val) {
        if (val.EAN == ean) {
            var query = document.querySelector("tr[data-EAN=\"".concat(val.EAN, "\"]"));
            var sum = 0;
            $('.box_' + ean).each(function () {
                sum += parseInt(this.value);
            });
            if (isNaN(sum)) {
                sum = 0;
            }
            if (sum > val.quantity) {
                alert("Scanned quantity greater then quantity not allowed");
                return false;
            } else if (sum < 0) {
                alert('Less then 0 not allowed');
                return false;
            } else {
                if (val.quantity > 0) {
                    val.scanned_quantity = sum;
                    var elScanned = query.getElementsByClassName("scanned-quantity");
                    elScanned && elScanned.length ? elScanned[0].innerText = val.scanned_quantity : "";
                    //showMessageBox("success", query);
                    if (val.quantity === val.scanned_quantity) {
                        query.classList.add("active");
                        checkAllGreen();
                    } else {
                        query.classList.remove("active");
                        $("#createVersandLabel").prop('disabled', true);
                    }
                } else {
                    showMessageBox("fail", query);
                }
            }

        }
    });

}; // | handleChangeProductScannedQuantity

activeBox = (box) => {
    $('.t_box').removeClass("activeBox");
    $('input:radio.t_box').prop("checked", false);
    $('td.box_' + box + ', th.box_' + box).addClass("activeBox");
    $('input:radio.box_' + box).prop("checked", true);
}

checkAllGreen = () => {
    var notDone = scannedProducts.find(function (item) {
        return item.scanned_quantity < item.quantity && item.EAN != null;
    });
    if (!notDone) {
        $("#createVersandLabel").prop('disabled', false);
    }
}


createMultiShipping = (invoiceNumber) => {
    setOrderItemsInStorage();
    $checkbox = document.getElementById("DeliveryNote").checked;
    var matrix = [];

    if ($checkbox) {
        $('#box_table tbody>tr').each(function () {
            $('td', this).each(function () {
                if ($(this).children('.inq').length > 0) {
                    const dd = {
                        'billbee_id': invoiceNumber,
                        'sku': $(this).parent('tr').data("ss"),
                        'ean': $(this).parent('tr').data("ee"),
                        'title': $(this).parent('tr').data("title"),
                        'weight': $(this).parent('tr').data("weight"),
                        'box_quantity': $(this).children('.box_' + $(this).parent('tr').data("ee")).val(),
                        'box': $(this).children('.box_' + $(this).parent('tr').data("ee")).attr("data-boxean"),
                        'bNum': $(this).children('.box_' + $(this).parent('tr').data("ee")).attr("data-bNum"),
                        'deliverynote': true,
                    };
                    matrix.push(dd);
                }
            });
        });
    } else {
        $('#box_table tbody>tr').each(function () {
            $('td', this).each(function () {
                if ($(this).children('.inq').length > 0) {
                    const dd = {
                        'billbee_id': invoiceNumber,
                        'sku': $(this).parent('tr').data("ss"),
                        'ean': $(this).parent('tr').data("ee"),
                        'title': $(this).parent('tr').data("title"),
                        'weight': $(this).parent('tr').data("weight"),
                        'box_quantity': $(this).children('.box_' + $(this).parent('tr').data("ee")).val(),
                        'box': $(this).children('.box_' + $(this).parent('tr').data("ee")).attr("data-boxean"),
                        'bNum': $(this).children('.box_' + $(this).parent('tr').data("ee")).attr("data-bNum"),
                        'deliverynote': false,
                    };
                    matrix.push(dd);
                }
            });
        });
    }


    if (checkAllProductsDoneInStorage(invoiceNumber)) {
        showLoader();
        sendAjax("/multibox/shipping/".concat(invoiceNumber), "POST", JSON.stringify(matrix), function (data) {

            var result = JSON.parse(data.responseText);

            if (result.success == "false") {
                hideLoader();
                showErrorInfo();
                return false;
            } else {
                if (result.msg == 'multi') {

                    // if(result.shipping_label.length === 0){
                    //   printJS({
                    //     printable: result.export_pdf,
                    //     type: 'pdf',
                    //     base64: true,
                    //     onPrintDialogClose: function onPrintDialogClose() {
                    //       setTimeout(function () {
                    //         hideLoader();
                    //         location.href = "/quality";
                    //       }, 2000);
                    //     }
                    //   });
                    //   return false;
                    // }

                    document.open();
                    document.write(result.link);
                    document.close();
                } else {
                    printJS({
                        printable: result.invoice_pdf,
                        type: 'pdf',
                        base64: true,
                        onPrintDialogClose: function onPrintDialogClose() {
                            setTimeout(function () {
                                if (result.shipping_label) {
                                    printJS({
                                        printable: result.shipping_label,
                                        type: 'pdf',
                                        base64: true,
                                        onPrintDialogClose: function onPrintDialogClose() {
                                            ;
                                            setTimeout(function () {
                                                if (result.export_pdf) {
                                                    printJS({
                                                        printable: result.export_pdf,
                                                        type: 'pdf',
                                                        base64: true,
                                                        onPrintDialogClose: function onPrintDialogClose() {
                                                            setTimeout(function () {
                                                                hideLoader();
                                                                location.href = "/multibox";
                                                            }, 2000);
                                                        }
                                                    });
                                                } else {
                                                    location.href = "/multibox";
                                                }
                                            }, 2000);
                                        }
                                    });
                                } else {
                                    location.href = "/multibox";
                                }
                            }, 2000);
                        }
                    });
                }
            }
        });
    }
}; // | createMultiShipping

handleChangeProductBarcodeMulti = (e) => {
    var value = e.target.value; //Get EAN numbers
    var eans = document.querySelectorAll("tr[data-EAN]");
    var eansArr = [];
    var eanLength = 0;
    eans.forEach(function (item) {
        eansArr.push(item.getAttribute('data-EAN'));
        var isActiveClassExist = item.classList.contains('active');

        if (!isActiveClassExist && eanLength < item.getAttribute('data-EAN').length) {
            eanLength = item.getAttribute('data-EAN').length;
        }
    });
    var isFind = eansArr.indexOf(value);

    if (value.length < eanLength) {
        return false;
    } //If doesn't finded or wrong show "FALSCHE"


    if (value.length >= 12 && isFind == -1) {
        var falshTr = document.querySelector('tbody>tr:not(.active)');
        //showMessageBox("fail", falshTr);
        setTimeout(function () {
            return e.target.value = "";
        }, 200);
        return false;
    }

    if (value.length >= 12 || value.length <= 15) {
        var itemIndex = scannedProducts.findIndex(function (item) {
            return item.EAN === value;
        });

        if (itemIndex !== -1) {
            if (scannedProducts[itemIndex].scanned_quantity <= scannedProducts[itemIndex].quantity) {
                var target = document.querySelector("tr[data-EAN=\"".concat(value, "\"]"));

                if (scannedProducts[itemIndex].scanned_quantity < scannedProducts[itemIndex].quantity) {
                    var item = scannedProducts[itemIndex];
                    showMessageBox("success", target);
                    $("#tr_" + item.EAN + " .activeBox .plus").trigger("click");
                    if (item.quantity === item.scanned_quantity) {
                        target.classList.add("active");
                    }
                }
            }
        } else {
            showMessageBox("fail", target);
        }

        setTimeout(function () {
            return e.target.value = "";
        }, 200);
    } else {
        setTimeout(function () {
            return e.target.value = "";
        }, 200);
        showMessageBox("fail", e.target.parentElement);
    }
}; // | handleChangeProductBarcodeMulti


handlegetEanProduct = (e) => {

    var value = e.target.value;
    if (value.length >= 12) {
        sendAjax("/inventory/".concat(value), "GET", [], function (res) {
            var result = JSON.parse(res.responseText);
            document.open();
            document.write(result.view);
            document.close();

        })
    };
}; // handlegetEanProduct

checkInvoiceNumberAgainPrinting = (e) => {
    const value = e.target.value;
    if (value.length >= 8) {
        showLoader();
        sendAjax(`/printAgain/${value}`, "GET", [], (res) => {

            let result = JSON.parse(res.responseText);

            if (result.success === 'false') {
                hideLoader();
                showErrorInfo();
                document.getElementById('content_info').innerHTML = 'order not found';
                return false;
            } else {
                document.open();
                document.write(result.message);
                document.close()
            }
        })
    }
} // | checkInvoiceNumberAgainPrinting
//doesn't get called is replaced with controller funktion in Shipment Controller
// printOrderAgain = () => {

//     let invoiceNumber = document.getElementById("invoice_number").innerText;
//     sendAjax(`/printAgainBase64/${invoiceNumber}`, "GET", [], (data) => {
//         let result = JSON.parse(data.responseText);
//         //###################################
//         printJS({
//             printable: result.shippingLabel,
//             type: 'pdf',
//             base64: true,
//             onPrintDialogClose: function onPrintDialogClose() {
//                 setTimeout(function () {
//                     if (result.exportLabel) {
//                         printJS({
//                             printable: result.exportLabel,
//                             type: 'pdf',
//                             base64: true,
//                             onPrintDialogClose: function onPrintDialogClose() {
//                                 setTimeout(function () {
//                                     if (result.invoice) {
//                                         printJS({
//                                             printable: result.invoice,
//                                             type: 'pdf',
//                                             base64: true,
//                                             onPrintDialogClose: function onPrintDialogClose() {
//                                                 setTimeout(function () {
//                                                     hideLoader();
//                                                     location.href = "/";
//                                                 }, 2000);
//                                             }
//                                         });
//                                     } else {
//                                         location.href = "/";
//                                     }
//                                 }, 2000);
//                             }
//                         });
//                     } else {
//                         location.href = "/";
//                     }
//                 }, 2000);
//             }
//         });

//         //####################

//     });
// }; // | printOrderAgain

handleChangeProductBarcode = (e) => {
    showLoader();
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
    if (value.length < eanLength) {
        hideLoader();
        return false;
    } //If doesn't finded or wrong show "FALSCHE"

    if (value.length >= 12 && isFind == (-1)) {
        let falshTr = document.querySelector('tbody>tr:not(.active)');
        showMessageBox("fail", falshTr);
        setTimeout(() => e.target.value = "", 200);
        hideLoader();
        return false
    }

    if (value.length >= 12 || value.length <= 15) {
        const itemIndex = scannedProducts.findIndex(item => item.EAN === value);
        if (itemIndex !== -1) {
            if (scannedProducts[itemIndex].scanned_quantity <= scannedProducts[itemIndex].quantity) {
                const target = document.querySelector(`tr[data-EAN="${value}"]`);
                if (scannedProducts[itemIndex].scanned_quantity < scannedProducts[itemIndex].quantity) {
                    scannedProducts[itemIndex].scanned_quantity++;
                    const elScanned = target.getElementsByClassName("scanned-quantity");
                    const item = scannedProducts[itemIndex];

                    elScanned && elScanned.length ? elScanned[0].innerText = item.scanned_quantity : "";
                    showMessageBox("success", target);
                    if (item.quantity === item.scanned_quantity) {
                        target.classList.add("active");
                        //console.log(item.scanned_quantity);
                        checkAllProductsDone();
                    }
                } else {
                    showMessageBox("fail", target)
                }
            }
        }
        setTimeout(() => e.target.value = "", 200);
        hideLoader();
    } else {
        setTimeout(() => e.target.value = "", 200);
        hideLoader();
        showMessageBox("fail", e.target.parentElement);
    }
} // | handleChangeProductBarcode

checkAllProductsDone = () => {

    const notDone = scannedProducts.find(function (item) {
        return (item.scanned_quantity < item.quantity && item.EAN != null);
    });

    if (!notDone) {
        const el = document.getElementById("shipping");
        el ? el.classList.remove("d-none") : "";
        doneOrder = true;

        // If url == '/quality' and
        // if order is fully picked,
        // create the label automatically
        // and move to next order entry screen
        if (location.pathname == '/quality') {
            let invoiceNumber = document.querySelector(`div[data-invoice]`).getAttribute('data-invoice');
            setTimeout(function () {
                createShipping(invoiceNumber);
            }, 500)
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
    $checkbox = document.getElementById("DeliveryNote").checked;
    console.log($checkbox);
    if (checkAllProductsDoneInStorage(invoiceNumber)) {
        document.getElementById("submit").classList.add("disabled")
        showLoader();
        sendAjax(`/quality/shipping/${invoiceNumber}`, "POST", $checkbox, (data) => {

            let result = JSON.parse(data.responseText);

            if (result.success == "false") {
                hideLoader();
                showErrorInfo();
            } else {
                document.getElementById("submit").classList.remove("disabled");
                printJS({
                    printable: result.shipping_label,
                    type: 'pdf',
                    base64: true,
                    onPrintDialogClose() {
                        setTimeout(function () {
                            if (result.delivery_pdf) {
                                printJS({
                                    printable: result.delivery_pdf,
                                    type: 'pdf',
                                    base64: true,
                                    onPrintDialogClose() {
                                        setTimeout(function () {
                                            if (result.export_pdf) {
                                                printJS({
                                                    printable: result.export_pdf,
                                                    type: 'pdf',
                                                    base64: true,
                                                    onPrintDialogClose() {
                                                        setTimeout(function () {
                                                            if (result.invoice_pdf) {
                                                                printJS({
                                                                    printable: result.invoice_pdf,
                                                                    type: 'pdf',
                                                                    base64: true,
                                                                    onPrintDialogClose() {
                                                                        setTimeout(function () {
                                                                            hideLoader();
                                                                            location.href = "/quality";
                                                                        }, 2000)
                                                                    }
                                                                });
                                                            } else {
                                                                location.href = "/quality";
                                                            }

                                                        }, 2000)
                                                    }
                                                });
                                            } else {
                                                location.href = "/quality";
                                            }
                                        }, 2000)
                                    }
                                });
                            } else if (result.export_pdf) {
                                printJS({
                                    printable: result.export_pdf,
                                    type: 'pdf',
                                    base64: true,
                                    onPrintDialogClose() {
                                        setTimeout(function () {
                                            if (result.invoice_pdf) {
                                                printJS({
                                                    printable: result.invoice_pdf,
                                                    type: 'pdf',
                                                    base64: true,
                                                    onPrintDialogClose() {
                                                        setTimeout(function () {
                                                            hideLoader();
                                                            location.href = "/quality";
                                                        }, 2000);
                                                    }
                                                });
                                            } else {
                                                location.href = "/quality";
                                            }
                                        }, 2000);
                                    }
                                });
                            } else {
                                location.href = "/quality";
                            }
                        }, 2000);

                    }
                });
            }
            hideLoader();
        });
    }
}; // | createShipping
createShippingNew = (invoiceNumber) => {
    setOrderItemsInStorage();
    $checkbox = document.getElementById("DeliveryNote").checked;
    console.log($checkbox);
    document.getElementById("submit").classList.add("disabled");
    showLoader();
    sendAjax("/qualitynew/shipping/".concat(invoiceNumber), "POST", $checkbox, (data) => {
        let result = JSON.parse(data.responseText);
        if (result.success == "false") {
            hideLoader();
            showErrorInfo();
        } else if (result.status == "ok") {
            location.href = "/qualitynew";
        } else {
            document.getElementById("submit").classList.remove("disabled");
            printJS({
                printable: result.shipping_label,
                type: 'pdf',
                base64: true,
                onPrintDialogClose() {
                    setTimeout(function () {
                        if (result.delivery_pdf) {
                            printJS({
                                printable: result.delivery_pdf,
                                type: 'pdf',
                                base64: true,
                                onPrintDialogClose() {
                                    setTimeout(function () {
                                        if (result.export_pdf) {
                                            printJS({
                                                printable: result.export_pdf,
                                                type: 'pdf',
                                                base64: true,
                                                onPrintDialogClose() {
                                                    setTimeout(function () {
                                                        if (result.invoice_pdf) {
                                                            printJS({
                                                                printable: result.invoice_pdf,
                                                                type: 'pdf',
                                                                base64: true,
                                                                onPrintDialogClose() {
                                                                    setTimeout(function () {
                                                                        hideLoader();
                                                                        location.href = "/qualitynew";
                                                                    }, 2000)
                                                                }
                                                            });
                                                        } else {
                                                            location.href = "/qualitynew";
                                                        }

                                                    }, 2000)
                                                }
                                            });
                                        } else {
                                            location.href = "/qualitynew";
                                        }
                                    }, 2000)
                                }
                            });
                        } else if (result.export_pdf) {
                            printJS({
                                printable: result.export_pdf,
                                type: 'pdf',
                                base64: true,
                                onPrintDialogClose() {
                                    setTimeout(function () {
                                        if (result.invoice_pdf) {
                                            printJS({
                                                printable: result.invoice_pdf,
                                                type: 'pdf',
                                                base64: true,
                                                onPrintDialogClose() {
                                                    setTimeout(function () {
                                                        hideLoader();
                                                        location.href = "/qualitynew";
                                                    }, 2000);
                                                }
                                            });
                                        } else {
                                            location.href = "/qualitynew";
                                        }
                                    }, 2000);
                                }
                            });
                        } else {
                            location.href = "/qualitynew";
                        }
                    }, 2000);

                }
            });
        }
        hideLoader();
    });


} // | createShippingNew

createShippingByDate = (fromDate, toDate) => {
    document.getElementById("submit").classList.add("disabled");
    showLoader();
    sendAjax(`/shipment/shipping/${fromDate}/${toDate}`, "GET", [], (data) => {
        if (data.responseText) {
            printJS({
                printable: data.responseText,
                type: 'pdf',
                base64: true,
                onPrintDialogClose() {
                    hideLoader();
                    location.href = "/";
                }
            });
        }
        document.getElementById("submit").classList.remove("disabled");
        document.getElementById("loader").classList.add("d-none");
    });
} // | createShippingByDate

finishOrder = (invoiceNumber) => {
    setOrderItemsInStorage();
    if (checkAllProductsDoneInStorage(invoiceNumber)) {
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
    if (existingOrderItems[invoiceNumber] && existingOrderItems[invoiceNumber].length) {
        scannedProducts = existingOrderItems[invoiceNumber].filter((item, key) => {
            let orderItem = orderItems.find(el => el.EAN === item.EAN);
            if (orderItem) {
                return item;
            }
        });
    } else {
        scannedProducts = orderItems;
    }

    InvoiceNumber = invoiceNumber;

    if (scannedProducts && scannedProducts.length) {
        scannedProducts.forEach((orderItem, index) => {

            if (defaultProducts.includes(orderItem.EAN)) {
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
            targets.forEach(function (target) {
                if (target) {
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

setScannedOrderItems = () => {
    const invoiceNumber = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : "";
    const _invoiceNumber = invoiceNumber ? invoiceNumber : InvoiceNumber;
    const orderItems = getOrderItems();
    if (orderItems[_invoiceNumber] && orderItems[_invoiceNumber].length) {
        const invoiceTarget = document.querySelector(`div[data-invoice="${_invoiceNumber}"]`);
        orderItems[_invoiceNumber].forEach((orderItem, index) => {
            const target = invoiceTarget.querySelector(`tr[data-EAN="${orderItem.EAN}"]`);
            if (target) {
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
    for (invoiceNumber of invoiceNumbers) {
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
    if (value.length >= 12) {
        sendAjax(`/receipt/product/${value}`, "GET", [], (data) => {
            if (data.responseText && data.responseText.length) {
                var product = JSON.parse(data.responseText);
                var productEl = document.getElementsByName(product.billbee_id);

                if (!productEl.length && Object.keys(product).length) {
                    removeClass("selected");
                    removeClass("focused");

                    var reason_code = "";
                    $(product.reason_code).each(function (k, v) {
                        reason_code += "<option value=" + v + ">" + v + "</option>";
                    });
                    $reason = document.getElementById("reason").value;
                    console.log($reason);
                    if ($reason == '1' || $reason == '2') {
                        var trContent = "<tr class=\"row-data selected mytest\">\n\
                  <td>".concat(product.title, "</td>\n\
                  <td>").concat(product.stock_code, "</td>\n\
                  <td class=\"pro_ean\">").concat(product.ean, "</td>\n\
                  <td><input type=\"number\" class=\"delta-quantity delta_" + product.ean + " focused\"  value=\"1\" name=\"").concat(product.billbee_id, "\" data-billbee=" + product.billbee_id + " onfocus=\"selectRow(event)\" onkeydown=\"confirmRow(event)\"/></td>\n\
                  <td><select id=\"reason_code_" + product.ean + "\">" + reason_code + "</select></td>\n\
                  <td><input name=\"product_grade_" + product.ean + "\" type=\"radio\" value=\"A-Ware\" checked>A-Ware<input name=\"product_grade_" + product.ean + "\" type=\"radio\" value=\"B-Ware\">B-Ware<input name=\"product_grade_" + product.ean + "\" type=\"radio\" value=\"Defekt\">Defekt</td>\n\
                  </tr>");
                        //   var producstTable = document.getElementById("products");
                        //   producstTable.insertAdjacentHTML("beforeend", trContent);
                        //   var focusedElements = document.getElementsByClassName("focused");
                        console.log('1 is done');
                    } else if ($reason == '3') {
                        var trContent = "<tr class=\"row-data selected mytest\">\n\
                        <td>".concat(product.title, "</td>\n\
                        <td>").concat(product.stock_code, "</td>\n\
                        <td class=\"pro_ean\">").concat(product.ean, "</td>\n\
                        <td><input type=\"number\" class=\"delta-quantity delta_" + product.ean + " focused\"  value=\"1\" name=\"").concat(product.billbee_id, "\" data-billbee=" + product.billbee_id + " onfocus=\"selectRow(event)\" onkeydown=\"confirmRow(event)\"/></td>\n\
                        <td><input name=\"product_grade_" + product.ean + "\" type=\"radio\" value=\"A-Ware\" checked>A-Ware<input name=\"product_grade_" + product.ean + "\" type=\"radio\" value=\"B-Ware\">B-Ware<input name=\"product_grade_" + product.ean + "\" type=\"radio\" value=\"Defekt\">Defekt</td>\n\
                    </tr>");
                        console.log('3 is done');
                    } else if ($reason == '4') {
                        var trContent = "<tr class=\"row-data selected mytest\">\n\
                        <td>".concat(product.title, "</td>\n\
                        <td>").concat(product.stock_code, "</td>\n\
                        <td class=\"pro_ean\">").concat(product.ean, "</td>\n\
                        <td class=\"delta\" style=\"display:block;\"><input type=\"number\" class=\"delta-quantity delta_" + product.ean + " focused\"  value=\"1\" name=\"").concat(product.billbee_id, "\" data-billbee=" + product.billbee_id + " onfocus=\"selectRow(event)\" onkeydown=\"confirmRow(event)\"/></td>\n\
                        <td class=\"delta-ware-reason\" style=\"display:none;\"><select class=\"delta-ware-reason\" id=\"reason_code_" + product.ean + "\">" + reason_code + "</select></td>\n\
                        <td class=\"delta-ware\" style=\"display:none;\"><input id=\"grade_1_" + product.ean + "\" type=\"number\" value=\"1\" data-stockid=" + product.a_ware + "></td>\n\
                        <td class=\"delta-ware\" style=\"display:none;\"><input id=\"grade_2_" + product.ean + "\" type=\"number\" value=\"0\" data-stockid=" + product.b_ware + "></td>\n\
                        <td class=\"delta-ware\" style=\"display:none;\"><input id=\"grade_3_" + product.ean + "\" type=\"number\" value=\"0\" data-stockid=" + product.defekt + "></td>\n\
                        <td class=\"delta-ware-b2b\" style=\"display:none;\"><input id=\"grade_4_" + product.ean + "\" type=\"number\" value=\"0\" data-stockid=" + product.b2b + "></td>\n\
                    </tr>");
                        console.log('4 is done');
                    } else {
                        var trContent = "<tr class=\"row-data selected mytest\">\n\
                    <td>".concat(product.title, "</td>\n\
                    <td>").concat(product.stock_code, "</td>\n\
                    <td class=\"pro_ean\">").concat(product.ean, "</td>\n\
                    <td class=\"delta\" style=\"display:block;\"><input type=\"number\" class=\"delta-quantity delta_" + product.ean + " focused\"  value=\"1\" name=\"").concat(product.billbee_id, "\" data-billbee=" + product.billbee_id + " onfocus=\"selectRow(event)\" onkeydown=\"confirmRow(event)\"/></td>\n\
                    </tr>");
                        console.log('this was the else case');
                    }
                    var producstTable = document.getElementById("products");
                    producstTable.insertAdjacentHTML("beforeend", trContent);
                    var focusedElements = document.getElementsByClassName("focused");
                    console.log(document.getElementById("submit"));
                    document.getElementById("submit").classList.remove("disabled"); //document.getElementbyId("submit")=null!!!


                    if (focusedElements.length) {
                        focusedElements[0].focus();
                        focusedElements[0].select();
                    }
                    hideLoader();


                } else {
                    removeClass("selected");
                    removeClass("focused");
                    productEl[0].classList.add("focused");
                    productEl[0].focus();
                    productEl[0].closest("tr").classList.add("selected");
                    hideLoader();
                }
                hideLoader();
                e.target.value = '';
            } else {
                hideLoader();
                e.target.value = '';
            }

        });
    }
}; // | getProductByEan

updateProductsStockCodes = () => {
    const quantities = document.getElementsByClassName("delta-quantity");
    if (quantities.length) {
        const data = {
            "quantities": {}
        };
        for (var item of quantities) {
            data["quantities"][item.name] = item.value;
        }
        const receipt_type = $("#reason option:selected").text();
        const reference = "" + document.getElementById("reason_datas").value;
        const my_pro = document.getElementById("reason_datas").value;
        const my_comment = "" + document.getElementById("comment_datas").value;
        data["refrence"] = reference;
        data["comment"] = my_comment;
        data["reason"] = document.getElementById("reason").value;
        data['pro_ean'] = [];
        $(".pro_ean").each(function () {
            data['pro_ean'].push(parseInt(this.innerText));
        });

        data['StockId_up'] = null;
        data['StockId_down'] = null;
        if (data["reason"] == '1' || data["reason"] == '2' || data["reason"] == '3') {
            data['StockId'] = 131;
        } else if (data['reason'] == '4') {
            data['StockId_up'] = $("input[name='radio-group_1']:checked").val();
            data['StockId_down'] = $("input[name='radio-group_2']:checked").val();
        }

        data['receipt_booking'] = [];
        $(".pro_ean").each(function () {
            if (data["reason"] == '3') {
                reason_code = 'Wareneingang';
            } else {
                reason_code = $("#reason_code_" + this.innerText).val();
            }
            const aa = {
                'billbe_id': $(".delta_" + this.innerText).data("billbee"),
                'receipt_type': receipt_type,
                'reference': my_pro,
                'ean': this.innerText,
                'reason_code': reason_code,
                'delta_quantity': {
                    "stockid": null,
                    "quantity": $(".delta_" + this.innerText).val(),
                    "stock_current": null,
                },
                'product_grade': $("input[name='product_grade_" + this.innerText + "']:checked").val(),
            }
            data['receipt_booking'].push(aa);
        });
        sendAjax("/receipt/stockcode/update", "POST", JSON.stringify(data), (res) => {
            const response = JSON.parse(res.responseText);
            if (response.success) {
                const element = document.getElementsByClassName("row-data");
                for (index = element.length - 1; index >= 0; index--) {
                    element[index].parentNode.removeChild(element[index]);
                }
                document.getElementById("submit").classList.add("disabled")
                document.getElementById("scan-ean").focus();
                document.getElementById("scan-ean").value = "";
                document.getElementById("reason_datas").value = "";
                hideLoader();
                swal({
                    title: "",
                    text: "Wareneingang erfolgreich gebucht.",
                    type: "success"
                }).then(function () {
                    location.reload();
                });
            } else {
                hideLoader();
                swal({
                    title: "",
                    text: "Oh No! Da ging was schief!",
                    type: "warning"
                }).then(function () {
                    location.reload();
                });
            }
        });
    }
}; // | updateProductsStockCodes

selectRow = (e) => {
    removeClass("selected");
    e.target.closest("tr").classList.add("selected")
    e.target.select();
} // | selectRow

confirmRow = (e) => {
    if (e.keyCode === 13) {
        removeClass("selected");
        removeClass("focused");
        document.getElementById("scan-ean").focus();
        document.getElementById("scan-ean").value = "";
    }
} // | confirmRow

removeClass = (className) => {
    const selectedElements = document.getElementsByClassName(className);
    while (selectedElements.length > 0) {
        selectedElements[0].classList.remove(className);
    }
}
showMessageBox = (show = "success", target) => {
    const hide = show === "success" ? "fail" : "success";
    const message = show === "success" ? "OK" : "FALSCH";
    var messageBoxes = document.getElementsByClassName('message');
    for (var i = 0; i < messageBoxes.length; i++) {
        messageBoxes[i].classList.add("d-none");
    }
    const showMessage = target.getElementsByClassName("message");
    if (showMessage && showMessage.length) {
        showMessage[0].classList.remove("d-none")
        showMessage[0].classList.remove(`message-${hide}`)
        showMessage[0].classList.add(`message-${show}`)
        showMessage[0].innerText = message;
    }
} // | showMessageBox

sendAjax = (url = "", type = "GET", data = [], callback) => {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            callback.apply(this, [this]);
        }
    };
    xhttp.open(type, url, true);
    if (type.toUpperCase() === "POST") {
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
