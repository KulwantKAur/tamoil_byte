/******/
(() => { // webpackBootstrap
    /******/
    var __webpack_modules__ = ({

        /***/
        "./resources/js/app.js":
            /*!*****************************!*\
              !*** ./resources/js/app.js ***!
              \*****************************/
            /***/
            ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

                // "use strict";
                __webpack_require__.r(__webpack_exports__);
                /* harmony import */
                var print_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__( /*! print-js */ "./node_modules/print-js/dist/print.js");
                /* harmony import */
                var print_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/ __webpack_require__.n(print_js__WEBPACK_IMPORTED_MODULE_0__);
                // var _arguments = arguments;

                function _createForOfIteratorHelper(o, allowArrayLike) {
                    var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"];
                    if (!it) {
                        if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") {
                            if (it) o = it;
                            var i = 0;
                            var F = function F() {};
                            return {
                                s: F,
                                n: function n() {
                                    if (i >= o.length) return {
                                        done: true
                                    };
                                    return {
                                        done: false,
                                        value: o[i++]
                                    };
                                },
                                e: function e(_e) {
                                    throw _e;
                                },
                                f: F
                            };
                        }
                        throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
                    }
                    var normalCompletion = true,
                        didErr = false,
                        err;
                    return {
                        s: function s() {
                            it = it.call(o);
                        },
                        n: function n() {
                            var step = it.next();
                            normalCompletion = step.done;
                            return step;
                        },
                        e: function e(_e2) {
                            didErr = true;
                            err = _e2;
                        },
                        f: function f() {
                            try {
                                if (!normalCompletion && it["return"] != null) it["return"]();
                            } finally {
                                if (didErr) throw err;
                            }
                        }
                    };
                }

                function _unsupportedIterableToArray(o, minLen) {
                    if (!o) return;
                    if (typeof o === "string") return _arrayLikeToArray(o, minLen);
                    var n = Object.prototype.toString.call(o).slice(8, -1);
                    if (n === "Object" && o.constructor) n = o.constructor.name;
                    if (n === "Map" || n === "Set") return Array.from(o);
                    if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);
                }

                function _arrayLikeToArray(arr, len) {
                    if (len == null || len > arr.length) len = arr.length;
                    for (var i = 0, arr2 = new Array(len); i < len; i++) {
                        arr2[i] = arr[i];
                    }
                    return arr2;
                }


                var doneOrder = false,
                    InvoiceNumber = "";
                var scannedProducts = [];
                var defaultProducts = ["4200000000001", "4200000000002", "4200000000003"];
                window.countbox = 1;
                window.countboxtext = 1;

                printOrders = function printOrders() {
                    var count = $('.checkbox').filter(':checked').length;

                    if (count > 0) {
                        window.print();
                    } else {
                        swal("You have to select atleast one order");
                    }
                }; // | printOrders


                printOrdersAll = function printOrdersAll() {
                    $('.print_main').removeClass('no-print');
                    window.print();
                    setTimeout(function () {
                        $('.print_main').addClass('no-print');
                        $('.checkbox').prop('checked', false);
                    }, 1000);
                }; // | printOrdersAll

                createRepairLabel = function createRepairLabel(e) {
                    showLoader();
                    value = e.target.value;
                    console.log(value);
                    sendAjax("/repairlabel/".concat(value), "GET", [], (res) => {
                        var result = JSON.parse(res.responseText);
                        console.log(result);
                        if (result.status == 'succsess') {
                            hideLoader();
                            print_js__WEBPACK_IMPORTED_MODULE_0___default()({
                                printable: result.shipping_label,
                                type: 'pdf',
                                base64: true,
                                onPrintDialogClose: function onPrintDialogClose() {
                                    setTimeout(function () {
                                        hideLoader();
                                        location.href = "/repair";
                                    }, 2000);
                                }
                            });
                        } else if (result.status == 'failed') {
                            hideLoader();
                            swal({
                                title: "",
                                text: "Die BillbeeId ist ungültig",
                                type: "warning"
                            }).then(function () {
                                location.reload();
                            });
                        } else if (result.status == 'wrong') {
                            hideLoader();
                            swal({
                                title: "",
                                text: "Leider haben zu viele Bestellungen dieselbe Ordernummer. Für diese Funktion wird noch eine Lösung gesucht!!",
                                type: "warning"
                            }).then(function () {
                                location.reload();
                            });
                        } else if (result.status == 'printed') {
                            hideLoader();
                            swal({
                                title: "",
                                text: "Label wurde gedruckt",
                                type: "info"
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
                    })
                } // | createRepairLabel


                handleChangeInvoiceNumber = function handleChangeInvoiceNumber(e) {
                    var value = e.target.value;

                    if (value.length >= 8) {
                        showLoader();
                        sendAjax("/quality/".concat(value), "GET", [], function (res) {
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
                }; // | handleChangeInvoiceNumber


                scanReturnHandler = function scanReturnHandler(e) {
                    var value = e.target.value;
                    console.log(value);
                    if (value.length >= 15) {
                        showLoader();
                        sendAjax("/receipt/".concat(value), "GET", [], function (res) {
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
                                console.log("Fehler !? ");
                                content_info.innerText = "";
                                content_info.appendChild(errorInfo);
                                hideLoader();
                            }
                        });
                    } else {
                        showLoader();
                        sendAjax("/receipt/return/".concat(value), "GET", [], function (res) {
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
                                console.log("Fehler !? ");
                                content_info.innerText = "";
                                content_info.appendChild(errorInfo);
                                hideLoader();
                            }
                        });
                    }
                }; // | scanReturnHandler


                handleChangeInvoiceNumberNew = function handleChangeInvoiceNumberNew(e) {
                    var value = e.target.value;
                    var content_info = document.getElementById("content_info");
                    content_info.classList.remove(['content_info']);
                    content_info.innerText = "";

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


                handleChangeMultibox = function handleChangeMultibox(e) {
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


                addBoxScanned = function addBoxScanned(event) {
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
                }; // | addBoxScanned


                handleChangeProductScannedQuantity = function handleChangeProductScannedQuantity(ean) {
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
                                    elScanned && elScanned.length ? elScanned[0].innerText = val.scanned_quantity : ""; //showMessageBox("success", query);

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


                activeBox = function activeBox(box) {
                    $('.t_box').removeClass("activeBox");
                    $('input:radio.t_box').prop("checked", false);
                    $('td.box_' + box + ', th.box_' + box).addClass("activeBox");
                    $('input:radio.box_' + box).prop("checked", true);
                };

                checkAllGreen = function checkAllGreen() {
                    var notDone = scannedProducts.find(function (item) {
                        return item.scanned_quantity < item.quantity && item.EAN != null;
                    });

                    if (!notDone) {
                        $("#createVersandLabel").prop('disabled', false);
                    }
                };

                createMultiShipping = function createMultiShipping(invoiceNumber) {
                    setOrderItemsInStorage();
                    $checkbox = document.getElementById("DeliveryNote").checked;
                    var matrix = [];

                    if ($checkbox) {
                        $('#box_table tbody>tr').each(function () {
                            $('td', this).each(function () {
                                if ($(this).children('.inq').length > 0) {
                                    var dd = {
                                        'billbee_id': invoiceNumber,
                                        'sku': $(this).parent('tr').data("ss"),
                                        'ean': $(this).parent('tr').data("ee"),
                                        'title': $(this).parent('tr').data("title"),
                                        'weight': $(this).parent('tr').data("weight"),
                                        'box_quantity': $(this).children('.box_' + $(this).parent('tr').data("ee")).val(),
                                        'box': $(this).children('.box_' + $(this).parent('tr').data("ee")).attr("data-boxean"),
                                        'bNum': $(this).children('.box_' + $(this).parent('tr').data("ee")).attr("data-bNum"),
                                        'deliverynote': true
                                    };
                                    matrix.push(dd);
                                }
                            });
                        });
                    } else {
                        $('#box_table tbody>tr').each(function () {
                            $('td', this).each(function () {
                                if ($(this).children('.inq').length > 0) {
                                    var dd = {
                                        'billbee_id': invoiceNumber,
                                        'sku': $(this).parent('tr').data("ss"),
                                        'ean': $(this).parent('tr').data("ee"),
                                        'title': $(this).parent('tr').data("title"),
                                        'weight': $(this).parent('tr').data("weight"),
                                        'box_quantity': $(this).children('.box_' + $(this).parent('tr').data("ee")).val(),
                                        'box': $(this).children('.box_' + $(this).parent('tr').data("ee")).attr("data-boxean"),
                                        'bNum': $(this).children('.box_' + $(this).parent('tr').data("ee")).attr("data-bNum"),
                                        'deliverynote': false
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
                                //print via Druckerwolke
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
                                    //print via print.js local spooler
                                    console.log('printjs');
                                    // console.log(result.shipping_label);
                                    console.log('before for shippinglabel');
                                    for (let i = 1; i <= result.box_count; i++) {
                                        console.log(i);
                                        printJS({
                                            printable: result.shipping_label,
                                            type: 'pdf',
                                            base64: true,
                                            onPrintDialogClose: function onPrintDialogClose() {
                                                setTimeout(function () {
                                                    hideLoader();
                                                }, 2000);
                                            }
                                        });
                                    }

                                    // console.log(i);
                                    // printJS({
                                    //     printable: result.shipping_label,
                                    //     type: 'pdf',
                                    //     base64: true,
                                    //     onPrintDialogClose: function onPrintDialogClose() {
                                    //         setTimeout(function () {
                                    if (result.delivery_pdf != 0) {
                                        console.log('deliverynote');
                                        printJS({
                                            printable: result.delivery_pdf,
                                            type: 'pdf',
                                            base64: true,
                                            onPrintDialogClose: function onPrintDialogClose() {
                                                setTimeout(function () {
                                                    //check if it is export order
                                                    if (result.export_pdf != 0) {
                                                        console.log('export after deliverynote');
                                                        printJS({
                                                            printable: result.export_pdf,
                                                            type: 'pdf',
                                                            base64: true,
                                                            onPrintDialogClose: function onPrintDialogClose() {
                                                                setTimeout(function () {
                                                                    //only in case of export order an invoice is required
                                                                    if (result.invoice_pdf != 0) {
                                                                        console.log('invoice');
                                                                        printJS({
                                                                            printable: result.invoice_pdf,
                                                                            type: 'pdf',
                                                                            base64: true,
                                                                            onPrintDialogClose: function onPrintDialogClose() {
                                                                                setTimeout(function () {
                                                                                    hideLoader();
                                                                                    console.log('after export and invoice with deliverynote');
                                                                                    location.href = "/multibox";
                                                                                }, 2000);
                                                                            }
                                                                        });
                                                                    } else {
                                                                        console.log('else case no invoice');
                                                                        location.href = "/multibox";
                                                                    }
                                                                }, 2000);
                                                            }
                                                        });
                                                    } else {
                                                        console.log('else case no export');
                                                        location.href = "/multibox";
                                                    }
                                                }, 2000);
                                            }
                                        });
                                    //no delivery document is required
                                    //check if it is an export order
                                    } else if (result.export_pdf != 0) {
                                        console.log('export without deliverynote')
                                        printJS({
                                            printable: result.export_pdf,
                                            type: 'pdf',
                                            base64: true,
                                            onPrintDialogClose: function onPrintDialogClose() {
                                                setTimeout(function () {
                                                    //only in case of export order an invoice is required
                                                    if (result.invoice_pdf != 0) {
                                                        console.log('invoice without deliverynote');
                                                        printJS({
                                                            printable: result.invoice_pdf,
                                                            type: 'pdf',
                                                            base64: true,
                                                            onPrintDialogClose: function onPrintDialogClose() {
                                                                setTimeout(function () {
                                                                    hideLoader();
                                                                    console.log('finished export');
                                                                    location.href = "/multibox";
                                                                }, 2000);
                                                            }
                                                        });
                                                    } else {
                                                        console.log('else no invoice for export');
                                                        location.href = "/multibox";
                                                    }
                                                }, 2000);
                                            }
                                        });
                                    } else {
                                        console.log('else case without deliverynote');
                                        location.href = "/multibox";
                                    }

                                    //         })
                                    //     }
                                    // })



                                }
                            }
                        });
                    }
                }; // | createMultiShipping


                handleChangeProductBarcodeMulti = function handleChangeProductBarcodeMulti(e) {
                    var value = e.target.value; //Get EAN numbers

                    console.log(value);
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
                        var falshTr = document.querySelector('tbody>tr:not(.active)'); //showMessageBox("fail", falshTr);

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


                handlegetEanProduct = function handlegetEanProduct(e) {
                    var value = e.target.value;

                    if (value.length >= 12) {
                        sendAjax("/inventory/".concat(value), "GET", [], function (res) {
                            var result = JSON.parse(res.responseText);
                            document.open();
                            document.write(result.view);
                            document.close();
                        });
                    }

                    ;
                }; // handlegetEanProduct


                checkInvoiceNumberAgainPrinting = function checkInvoiceNumberAgainPrinting(e) {
                    var value = e.target.value;

                    if (value.length >= 8) {
                        showLoader();
                        sendAjax("/printAgain/".concat(value), "GET", [], function (res) {
                            var result = JSON.parse(res.responseText);

                            if (result.success === 'false') {
                                hideLoader();
                                showErrorInfo();
                                document.getElementById('content_info').innerHTML = 'order not found';
                                return false;
                            } else {
                                document.open();
                                document.write(result.message);
                                document.close();
                            }
                        });
                    }
                }; // | checkInvoiceNumberAgainPrinting

                printOrderAgain = function printOrderAgain() {
                    showLoader();
                    let invoiceNumber = document.getElementById("invoice_number").innerText;
                    sendAjax(`/printAgainBase64/${invoiceNumber}`, "GET", [], (data) => {
                        let result = JSON.parse(data.responseText);

                        if (result.status == 'ok') {
                            document.open();
                            document.write(result.view);
                            document.close();
                        } else {
                            printJS({
                                printable: result.shippingLabel,
                                type: 'pdf',
                                base64: true,
                                onPrintDialogClose: function onPrintDialogClose() {
                                    setTimeout(function () {
                                        if (result.retourenlabel) {
                                            printJS({
                                                printable: result.retourenlabel,
                                                type: 'pdf',
                                                base64: true,
                                                onPrintDialogClose: function onPrintDialogClose() {
                                                    setTimeout(function () {
                                                        if (result.exportLabel) {
                                                            printJS({
                                                                printable: result.exportLabel,
                                                                type: 'pdf',
                                                                base64: true,
                                                                onPrintDialogClose: function onPrintDialogClose() {
                                                                    setTimeout(function () {
                                                                        if (result.invoice) {
                                                                            printJS({
                                                                                printable: result.invoice,
                                                                                type: 'pdf',
                                                                                base64: true,
                                                                                onPrintDialogClose: function onPrintDialogClose() {
                                                                                    setTimeout(function () {
                                                                                        hideLoader();
                                                                                        location.href = "/";
                                                                                    }, 2000);
                                                                                }
                                                                            });
                                                                        } else {
                                                                            location.href = "/";
                                                                        }
                                                                    }, 2000);
                                                                }
                                                            });
                                                        } else {
                                                            location.href = "/";
                                                        }
                                                    }, 2000);
                                                }
                                            });
                                        }
                                    }, 2000);
                                }
                            });
                        } //####################
                    });
                }; // | printOrderAgain


                handleChangeProductBarcode = function handleChangeProductBarcode(e) {
                    showLoader();
                    
                    var value = e.target.value; //Get EAN numbers
                    // console.log('scanned value: ' + value);
                    var eans = document.querySelectorAll("tr[data-EAN]");
                    // console.log(eans);
                    var eansArr = [];
                    var eanLength = 0;
                    eans.forEach(function (item) {
                        //gets the EANS from the data-EAN Class
                        eansArr.push(item.getAttribute('data-EAN'));
                        // console.log("EAN: " + item.getAttribute('data-EAN'));
                        //isActiveClassExist validates if the line is fully picked, if active is set - no more picking
                        var isActiveClassExist = item.classList.contains('active');
                        // console.log("item contains: " + item.classList.contains('active'));

                        if (!isActiveClassExist && eanLength < item.getAttribute('data-EAN').length) {
                            //gets the length of the EAN string
                            eanLength = item.getAttribute('data-EAN').length;
                            // console.log("ean length: " + eanLength);
                        }
                    });
                    console.log('eansArray: ' + eansArr);
                    var isFind = eansArr.indexOf(value);
                    // console.log('Index im Array, wo die gescannte EAN zu finden ist (zeile der Tabelle): ' + isFind + "value of scanned EAN " + value.length);

                    if (value.length < eanLength) {
                        console.log("BÄM: " + value.length +"  Bämbäm : " + eanLength + "Fehler im Barcode -> Produktstammdaten müssen angepasst werden");
                        hideLoader();
                        return false;
                    } //If doesn't finded or wrong show "FALSCHE"


                    if (value.length >= 12 && isFind == -1) {
                        console.log(isFind);
                        var falshTr = document.querySelector('tbody>tr:not(.active)');
                        showMessageBox("fail", falshTr);
                        setTimeout(function () {
                            return e.target.value = "";
                        }, 200);
                        hideLoader();
                        return false;
                    }
console.log('barcode change');
                    if (value.length >= 12 || value.length <= 15) {
                        var itemIndex = scannedProducts.findIndex(function (item) {
                            return item.EAN === value;
                        });
console.log('barcode change');
                        if (itemIndex !== -1) {
                            if (scannedProducts[itemIndex].scanned_quantity <= scannedProducts[itemIndex].quantity) {
                                var target = document.querySelector("tr[data-EAN=\"".concat(value, "\"]"));

                                if (scannedProducts[itemIndex].scanned_quantity < scannedProducts[itemIndex].quantity) {
                                    scannedProducts[itemIndex].scanned_quantity++;
                                    var elScanned = target.getElementsByClassName("scanned-quantity");
                                    var item = scannedProducts[itemIndex];
                                    elScanned && elScanned.length ? elScanned[0].innerText = item.scanned_quantity : "";
                                    showMessageBox("success", target);

                                    if (item.quantity === item.scanned_quantity) {
                                        target.classList.add("active"); //console.log(item.scanned_quantity);

                                        checkAllProductsDone();
                                    }
                                } else {
                                    showMessageBox("fail", target);
                                }
                            }
                        }

                        setTimeout(function () {
                            return e.target.value = "";
                        }, 200);
                        hideLoader();
                    } else {
                        setTimeout(function () {
                            return e.target.value = "";
                        }, 200);
                        hideLoader();
                        showMessageBox("fail", e.target.parentElement);
                    }

                    console.log('durch');
                }; // | handleChangeProductBarcode


                checkAllProductsDone = function checkAllProductsDone() {
                    var notDone = scannedProducts.find(function (item) {
                        return item.scanned_quantity < item.quantity && item.EAN != null;
                    });

                    if (!notDone) {
                        var el = document.getElementById("submit");
                        el ? el.classList.remove("disabled") : "";
                        doneOrder = true; // If url == '/quality' and
                        // if order is fully picked,
                        // create the label automatically
                        // and move to next order entry screen

                        console.log("auf zum drucken");
                        var deliverynotebox = document.getElementById("DeliveryNote").checked;
                        console.log(deliverynotebox);

                        if (location.pathname == '/quality' || location.pathname == '/qualitynew' || location.pathname.includes("qualitynew") != '') {
                            var _invoiceNumber2 = document.querySelector("div[data-invoice]").getAttribute('data-invoice');

                            console.log('jetzt wirds spannend');
                            setTimeout(function () {
                                    showLoader();
                                    sendAjax("/qualitynew/shipping/".concat(_invoiceNumber2), "POST", deliverynotebox, function (data) {
                                        var result = JSON.parse(data.responseText);
                                        console.log(result.success);
                                        console.log('rocking like a hurricane');
                                        if (result.success == "false") {
                                            hideLoader();
                                            showErrorInfo();
                                        } else if (result.success == "true") {
                                            setTimeout(2000);
                                            document.getElementById("submit").classList.remove("disabled");
                                            print_js__WEBPACK_IMPORTED_MODULE_0___default()({
                                                printable: result.shipping_label,
                                                type: 'pdf',
                                                base64: true,
                                                onPrintDialogClose: function onPrintDialogClose() {
                                                    setTimeout(function () {
                                                        if (result.delivery_pdf) {
                                                            console.log("delivery_pdf");
                                                            print_js__WEBPACK_IMPORTED_MODULE_0___default()({
                                                                printable: result.delivery_pdf,
                                                                type: 'pdf',
                                                                base64: true,
                                                                onPrintDialogClose: function onPrintDialogClose() {
                                                                    setTimeout(function () {
                                                                        if (result.return_label) {
                                                                            console.log("return_label mit deliverynote");
                                                                            print_js__WEBPACK_IMPORTED_MODULE_0___default()({
                                                                                printable: result.return_label,
                                                                                type: 'pdf',
                                                                                base64: true,
                                                                                onPrintDialogClose: function onPrintDialogClose() {
                                                                                    setTimeout(function () {
                                                                                        if (result.export_pdf) {
                                                                                            console.log("export_pdf mit deliverynote");
                                                                                            print_js__WEBPACK_IMPORTED_MODULE_0___default()({
                                                                                                printable: result.export_pdf,
                                                                                                type: 'pdf',
                                                                                                base64: true,
                                                                                                onPrintDialogClose: function onPrintDialogClose() {
                                                                                                    setTimeout(function () {
                                                                                                        if (result.invoice_pdf) {
                                                                                                            console.log("invoice_pdf mit deliverynote");
                                                                                                            print_js__WEBPACK_IMPORTED_MODULE_0___default()({
                                                                                                                printable: result.invoice_pdf,
                                                                                                                type: 'pdf',
                                                                                                                base64: true,
                                                                                                                onPrintDialogClose: function onPrintDialogClose() {
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
                                                                        } else if (result.export_pdf) {
                                                                            console.log("elseif export mit deliverynote");
                                                                            print_js__WEBPACK_IMPORTED_MODULE_0___default()({
                                                                                printable: result.export_pdf,
                                                                                type: 'pdf',
                                                                                base64: true,
                                                                                onPrintDialogClose: function onPrintDialogClose() {
                                                                                    setTimeout(function () {
                                                                                        if (result.invoice_pdf) {
                                                                                            print_js__WEBPACK_IMPORTED_MODULE_0___default()({
                                                                                                printable: result.invoice_pdf,
                                                                                                type: 'pdf',
                                                                                                base64: true,
                                                                                                onPrintDialogClose: function onPrintDialogClose() {
                                                                                                    setTimeout(function () {
                                                                                                        hideLoader();
                                                                                                        location.href = "/qualitynew";
                                                                                                    }, 2000);
                                                                                                }
                                                                                            });
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
                                                        } else if (result.export_pdf) {
                                                            console.log("elseif export ohne deliverynote");
                                                            print_js__WEBPACK_IMPORTED_MODULE_0___default()({
                                                                printable: result.export_pdf,
                                                                type: 'pdf',
                                                                base64: true,
                                                                onPrintDialogClose: function onPrintDialogClose() {
                                                                    setTimeout(function () {
                                                                        if (result.invoice_pdf) {
                                                                            print_js__WEBPACK_IMPORTED_MODULE_0___default()({
                                                                                printable: result.invoice_pdf,
                                                                                type: 'pdf',
                                                                                base64: true,
                                                                                onPrintDialogClose: function onPrintDialogClose() {
                                                                                    setTimeout(function () {
                                                                                        hideLoader();
                                                                                        location.href = "/qualitynew";
                                                                                    }, 2000);
                                                                                }
                                                                            });
                                                                        }
                                                                    })
                                                                }
                                                            })
                                                        } else if (result.return_label) {
                                                            console.log("elseif return_label ohne deliverynote");
                                                            print_js__WEBPACK_IMPORTED_MODULE_0___default()({
                                                                printable: result.return_label,
                                                                type: 'pdf',
                                                                base64: true,
                                                                onPrintDialogClose: function onPrintDialogClose() {
                                                                    setTimeout(function () {
                                                                        if (result.export_pdf) {
                                                                            print_js__WEBPACK_IMPORTED_MODULE_0___default()({
                                                                                printable: result.export_pdf,
                                                                                type: 'pdf',
                                                                                base64: true,
                                                                                onPrintDialogClose: function onPrintDialogClose() {
                                                                                    setTimeout(function () {
                                                                                        if (result.invoice_pdf) {
                                                                                            print_js__WEBPACK_IMPORTED_MODULE_0___default()({
                                                                                                printable: result.invoice_pdf,
                                                                                                type: 'pdf',
                                                                                                base64: true,
                                                                                                onPrintDialogClose: function onPrintDialogClose() {
                                                                                                    setTimeout(function () {
                                                                                                        hideLoader();
                                                                                                        location.href = "/qualitynew";
                                                                                                    }, 2000);
                                                                                                }
                                                                                            });
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
                                                        } else {
                                                            location.href = "/qualitynew";
                                                        }
                                                    }, 2000)
                                                }
                                            });
                                        } else {
                                            location.href = "/qualitynew";
                                        }
                                    }); //location.href = "/qualitynew/shipping/".concat(_invoiceNumber2);

                                    showLoader();
                                },
                                500);
                        }
                    }
                }; // | checkAllProductsDone


                saveScannedProducts = function saveScannedProducts(e) {
                    e.preventDefault();
                    setOrderItemsInStorage();
                    location.href = "/quality";
                };

                checkAllProductsDoneInStorage = function checkAllProductsDoneInStorage(invoiceNumber) {
                    var orderItems = getOrderItems();
                    var notDone = orderItems[invoiceNumber].find(function (item) {
                        return item.scanned_quantity < item.quantity && item.EAN != null;
                    });
                    return notDone ? false : true;
                }; // | checkAllProductsDoneInStorage
                // createShipping = (invoiceNumber) => {
                //     setOrderItemsInStorage();
                //     $checkbox = document.getElementById("DeliveryNote").checked;
                //     console.log($checkbox);
                //     if (checkAllProductsDoneInStorage(invoiceNumber)) {
                //         document.getElementById("submit").classList.add("disabled")
                //         showLoader();
                //         sendAjax(`/quality/shipping/${invoiceNumber}`, "POST", $checkbox, (data) => {
                //             let result = JSON.parse(data.responseText);
                //             if (result.success == "false") {
                //                 hideLoader();
                //                 showErrorInfo();
                //             } else {
                //                 document.getElementById("submit").classList.remove("disabled");
                //                 printJS({
                //                     printable: result.shipping_label,
                //                     type: 'pdf',
                //                     base64: true,
                //                     onPrintDialogClose() {
                //                         setTimeout(function () {
                //                             if (result.delivery_pdf) {
                //                                 printJS({
                //                                     printable: result.delivery_pdf,
                //                                     type: 'pdf',
                //                                     base64: true,
                //                                     onPrintDialogClose() {
                //                                         setTimeout(function () {
                //                                             if (result.export_pdf) {
                //                                                 printJS({
                //                                                     printable: result.export_pdf,
                //                                                     type: 'pdf',
                //                                                     base64: true,
                //                                                     onPrintDialogClose() {
                //                                                         setTimeout(function () {
                //                                                             if (result.invoice_pdf) {
                //                                                                 printJS({
                //                                                                     printable: result.invoice_pdf,
                //                                                                     type: 'pdf',
                //                                                                     base64: true,
                //                                                                     onPrintDialogClose() {
                //                                                                         setTimeout(function () {
                //                                                                             hideLoader();
                //                                                                             location.href = "/quality";
                //                                                                         }, 2000)
                //                                                                     }
                //                                                                 });
                //                                                             } else {
                //                                                                 location.href = "/quality";
                //                                                             }
                //                                                         }, 2000)
                //                                                     }
                //                                                 });
                //                                             } else {
                //                                                 location.href = "/quality";
                //                                             }
                //                                         }, 2000)
                //                                     }
                //                                 });
                //                             } else if (result.export_pdf) {
                //                                 printJS({
                //                                     printable: result.export_pdf,
                //                                     type: 'pdf',
                //                                     base64: true,
                //                                     onPrintDialogClose() {
                //                                         setTimeout(function () {
                //                                             if (result.invoice_pdf) {
                //                                                 printJS({
                //                                                     printable: result.invoice_pdf,
                //                                                     type: 'pdf',
                //                                                     base64: true,
                //                                                     onPrintDialogClose() {
                //                                                         setTimeout(function () {
                //                                                             hideLoader();
                //                                                             location.href = "/quality";
                //                                                         }, 2000);
                //                                                     }
                //                                                 });
                //                                             } else {
                //                                                 location.href = "/quality";
                //                                             }
                //                                         }, 2000);
                //                                     }
                //                                 });
                //                             } else {
                //                                 location.href = "/quality";
                //                             }
                //                         }, 2000);
                //                     }
                //                 });
                //             }
                //             hideLoader();
                //         });
                //     }
                // }; // | createShipping
                // createShippingNew = (invoiceNumber) => {
                //     setOrderItemsInStorage();
                //     $checkbox = document.getElementById("DeliveryNote").checked;
                //     console.log($checkbox);
                //     document.getElementById("submit").classList.add("disabled");
                //     showLoader();
                //     sendAjax("/qualitynew/shipping/".concat(invoiceNumber), "POST", $checkbox, (data) => {
                //         let result = JSON.parse(data.responseText);
                //         if (result.success == "false") {
                //             hideLoader();
                //             showErrorInfo();
                //         } else if (result.status == "ok") {
                //             alert('status ok');
                //             location.href = "/qualitynew";
                //         } else if (result.status == "true") {
                //             alert('Printjs???');
                //             setTimeout(2000);
                //             document.getElementById("submit").classList.remove("disabled");
                //             printJS({
                //                 printable: result.shipping_label,
                //                 type: 'pdf',
                //                 base64: true,
                //                 onPrintDialogClose() {
                //                     setTimeout(function () {
                //                         if (result.delivery_pdf) {
                //                             printJS({
                //                                 printable: result.delivery_pdf,
                //                                 type: 'pdf',
                //                                 base64: true,
                //                                 onPrintDialogClose() {
                //                                     setTimeout(function () {
                //                                         if (result.export_pdf) {
                //                                             printJS({
                //                                                 printable: result.export_pdf,
                //                                                 type: 'pdf',
                //                                                 base64: true,
                //                                                 onPrintDialogClose() {
                //                                                     setTimeout(function () {
                //                                                         if (result.invoice_pdf) {
                //                                                             printJS({
                //                                                                 printable: result.invoice_pdf,
                //                                                                 type: 'pdf',
                //                                                                 base64: true,
                //                                                                 onPrintDialogClose() {
                //                                                                     setTimeout(function () {
                //                                                                         hideLoader();
                //                                                                         location.href = "/qualitynew";
                //                                                                     }, 2000)
                //                                                                 }
                //                                                             });
                //                                                         } else {
                //                                                             location.href = "/qualitynew";
                //                                                         }
                //                                                     }, 2000)
                //                                                 }
                //                                             });
                //                                         } else {
                //                                             location.href = "/qualitynew";
                //                                         }
                //                                     }, 2000)
                //                                 }
                //                             });
                //                         } else if (result.export_pdf) {
                //                             printJS({
                //                                 printable: result.export_pdf,
                //                                 type: 'pdf',
                //                                 base64: true,
                //                                 onPrintDialogClose() {
                //                                     setTimeout(function () {
                //                                         if (result.invoice_pdf) {
                //                                             printJS({
                //                                                 printable: result.invoice_pdf,
                //                                                 type: 'pdf',
                //                                                 base64: true,
                //                                                 onPrintDialogClose() {
                //                                                     setTimeout(function () {
                //                                                         hideLoader();
                //                                                         location.href = "/qualitynew";
                //                                                     }, 2000);
                //                                                 }
                //                                             });
                //                                         } else {
                //                                             location.href = "/qualitynew";
                //                                         }
                //                                     }, 2000);
                //                                 }
                //                             });
                //                         } else {
                //                             location.href = "/qualitynew";
                //                         }
                //                     }, 2000);
                //                 }
                //             });
                //         } else {
                //             location.href = "/qualitynew";
                //         }
                //         hideLoader();
                //     });
                // } // | createShippingNew
                // createShippingByDate = (fromDate, toDate) => {
                //     document.getElementById("submit").classList.add("disabled");
                //     showLoader();
                //     sendAjax(`/shipment/shipping/${fromDate}/${toDate}`, "GET", [], (data) => {
                //         if (data.responseText) {
                //             printJS({
                //                 printable: data.responseText,
                //                 type: 'pdf',
                //                 base64: true,
                //                 onPrintDialogClose() {
                //                     hideLoader();
                //                     location.href = "/";
                //                 }
                //             });
                //         }
                //         document.getElementById("submit").classList.remove("disabled");
                //         document.getElementById("loader").classList.add("d-none");
                //     });
                // } // | createShippingByDate


                finishOrder = function finishOrder(invoiceNumber) {
                    setOrderItemsInStorage();

                    if (checkAllProductsDoneInStorage(invoiceNumber)) {
                        showLoader();
                        sendAjax("/quality/finish/".concat(invoiceNumber), "GET", [], function () {
                            location.href = "/";
                        });
                    }
                }; // | finishOrder


                setOrderItemsInStorage = function setOrderItemsInStorage() {
                    var existingOrderItems = getOrderItems();
                    existingOrderItems[InvoiceNumber] = scannedProducts;
                    localStorage.setItem("OrderItems", JSON.stringify(existingOrderItems));
                    InvoiceNumber = "";
                    scannedProducts = [];
                }; // | setOrderItemsInStorage


                setOrderItems = function setOrderItems(orderItems, invoiceNumber) {
                    var existingOrderItems = getOrderItems();

                    if (existingOrderItems[invoiceNumber] && existingOrderItems[invoiceNumber].length) {
                        scannedProducts = existingOrderItems[invoiceNumber].filter(function (item, key) {
                            var orderItem = orderItems.find(function (el) {
                                return el.EAN === item.EAN;
                            });

                            if (orderItem) {
                                return item;
                            }
                        });
                    } else {
                        scannedProducts = orderItems;
                    }

                    InvoiceNumber = invoiceNumber;

                    if (scannedProducts && scannedProducts.length) {
                        scannedProducts.forEach(function (orderItem, index) {
                            if (defaultProducts.includes(orderItem.EAN)) {
                                scannedProducts[index].scanned_quantity = scannedProducts[index].quantity;
                            } //Old version
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


                            var targets = document.querySelectorAll("tr[data-EAN=\"".concat(orderItem.EAN, "\"]"));
                            targets.forEach(function (target) {
                                if (target) {
                                    var targetInvoiceNumbertarget = target.closest('div[data-invoice]').getAttribute('data-invoice');
                                    var elScanned = target.getElementsByClassName("scanned-quantity");
                                    var item = scannedProducts[index];
                                    elScanned && elScanned.length ? elScanned[0].innerText = item.scanned_quantity : "";

                                    if (item.quantity === item.scanned_quantity && targetInvoiceNumbertarget == invoiceNumber) {
                                        target.classList.add("active");
                                        checkAllProductsDone();
                                    }
                                }
                            });
                        });
                        localStorage.setItem("OrderItems", JSON.stringify(existingOrderItems));
                    }
                }; // | setOrderItems


                getOrderItems = function getOrderItems() {
                    var orderItems = localStorage.getItem("OrderItems");
                    return orderItems ? JSON.parse(orderItems) : {};
                }; // | getOrderItems


                setScannedOrderItems = function setScannedOrderItems() {
                    var invoiceNumber = _arguments.length > 0 && _arguments[0] !== undefined ? _arguments[0] : "";

                    var _invoiceNumber = invoiceNumber ? invoiceNumber : InvoiceNumber;

                    var orderItems = getOrderItems();

                    if (orderItems[_invoiceNumber] && orderItems[_invoiceNumber].length) {
                        var invoiceTarget = document.querySelector("div[data-invoice=\"".concat(_invoiceNumber, "\"]"));

                        orderItems[_invoiceNumber].forEach(function (orderItem, index) {
                            var target = invoiceTarget.querySelector("tr[data-EAN=\"".concat(orderItem.EAN, "\"]"));

                            if (target) {
                                var elScanned = target.getElementsByClassName("scanned-quantity");
                                var item = orderItems[_invoiceNumber][index];
                                elScanned && elScanned.length ? elScanned[0].innerText = item.scanned_quantity : "";

                                if (item.quantity === item.scanned_quantity) {
                                    target.classList.add("active");
                                    invoiceNumber ? "" : checkAllProductsDone();
                                }
                            }
                        });
                    }
                }; // | setScannedOrderItems


                setScannedOrderItemsForDatePeriod = function setScannedOrderItemsForDatePeriod(invoiceNumbers) {
                    var _iterator = _createForOfIteratorHelper(invoiceNumbers),
                        _step;

                    try {
                        for (_iterator.s(); !(_step = _iterator.n()).done;) {
                            invoiceNumber = _step.value;
                            setScannedOrderItems(invoiceNumber);
                        }
                    } catch (err) {
                        _iterator.e(err);
                    } finally {
                        _iterator.f();
                    }
                }; // | setScannedOrderItemsForDatePeriod


                getShipment = function getShipment() {
                    var fromDate = document.getElementById("from").value;
                    var toDate = document.getElementById("to").value;
                    sendAjax("/shipment/".concat(fromDate, "/").concat(toDate), "GET", [], function (data) {
                        document.open();
                        document.write(data.responseText);
                        document.close();
                    });
                }; // | getShipment


                getProductByEan = function getProductByEan(e) {
                    var value = e.target.value;

                    if (value.length >= 12) {
                        sendAjax("/receipt/product/".concat(value), "GET", [], function (data) {
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
                  </tr>"); //   var producstTable = document.getElementById("products");
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

                                    console.log("bin hier " + value);

                                    if (focusedElements.length) {
                                        focusedElements[0].focus();
                                        focusedElements[0].select();
                                    }

                                    hideLoader();
                                } else {
                                    var val = parseInt(productEl[0].value); //  console.log(" stand " + productEl[0].value );
                                    //add one to the line

                                    val++;
                                    productEl[0].value = val; // console.log("bin da " + value +  "und eins dazu " + val);

                                    removeClass("selected");
                                    removeClass("focused");
                                    productEl[0].classList.add("focused"); //productEl[0].focus();

                                    productEl[0].closest("tr").classList.add("selected");
                                    hideLoader();
                                }

                                hideLoader();
                                e.target.value = '';
                            } else {
                                console.log("found EAN" + value);
                                hideLoader();
                                e.target.value = '';
                            }
                        });
                    }
                }; // | getProductByEan

                B2CReturebuchen = function B2CReturebuchen(e) {
                    showLoader();
                    var i = e.target.value;
                    var data = {}
                    var id = document.getElementById('back').value;
                    console.log(i);
                    // while (i !== 0) {
                    data = [];
                    for (; i > 0;) {
                        //Abfrage ob beim Wareneingang eine Zahl eingegeben wurde! Wenn nicht wird diese Bestellung übersprungen.
                        var menge = document.getElementById("wareneingang" + i).value;
                        if (menge == 0) {
                            i--
                        }
                        if (i > 0) {
                            //Holt den Wert der ausgewählten Radiobuttons
                            var elements = document.getElementsByName('exampleRadios' + i);
                            var checkedButton;
                            elements.forEach(e => {
                                if (e.checked) {
                                    checkedButton = e.value;
                                }
                            });

                            var aa = {
                                'wareneingang': document.getElementById("wareneingang" + i).value,
                                'reason_code': document.getElementById("reason" + i).value,
                                'product_grade': checkedButton,
                                'ean': document.getElementById('scan-ean' + i).innerText,
                                'billbee_id': id,
                                'comment': document.getElementById('bemerkung').value,

                            }
                            console.log(aa);
                            data.push(aa);
                            console.log(data);
                            i--;
                        }
                    }
                    // console.log(data[0]);
                    sendAjax("/receipt/stockcodeupdate", "POST", JSON.stringify(data), function (res) {
                        var response = JSON.parse(res.responseText);
                        console.log(response);
                        if (response.success) {
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
                } // | B2CRetureBuchen


                updateProductsStockCodes = function updateProductsStockCodes() {
                    var quantities = document.getElementsByClassName("delta-quantity");
                    showLoader();
                    if (quantities.length) {
                        var data = {
                            "quantities": {}
                        };

                        var _iterator2 = _createForOfIteratorHelper(quantities),
                            _step2;

                        try {
                            for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
                                var item = _step2.value;
                                data["quantities"][item.name] = item.value;
                            }
                        } catch (err) {
                            _iterator2.e(err);
                        } finally {
                            _iterator2.f();
                        }
                        var receipt_type = $("#reason option:selected").text();
                        var reference = "" + document.getElementById("reason_datas").value;
                        var my_pro = document.getElementById("reason_datas").value;
                        var my_comment = "" + document.getElementById("comment_datas").value;
                        data["safetystock"] = 0;
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
                            var stück = 0;
                            if (data["reason"] == '3') {
                                reason_code = 'Wareneingang';
                                var safetystock = document.getElementById("safetystock").checked;
                                console.log(safetystock);
                                if (safetystock == true) {

                                    data['safetystock'] = document.getElementById('safetystück').value;
                                    console.log(stück);
                                }

                            } else {
                                reason_code = $("#reason_code_" + this.innerText).val();
                            }

                            var aa = {
                                'billbe_id': $(".delta_" + this.innerText).data("billbee"),
                                'receipt_type': receipt_type,
                                'reference': my_pro,
                                'ean': this.innerText,
                                'reason_code': reason_code,
                                'delta_quantity': {
                                    "stockid": null,
                                    "quantity": $(".delta_" + this.innerText).val(),
                                    "stock_current": null
                                },
                                'product_grade': $("input[name='product_grade_" + this.innerText + "']:checked").val()
                            };
                            console.log(aa);
                            data['receipt_booking'].push(aa);
                        });
                        sendAjax("/receipt/stockcode/update", "POST", JSON.stringify(data), function (res) {
                            var response = JSON.parse(res.responseText);
                            console.log(response);
                            if (response.success) {
                                var element = document.getElementsByClassName("row-data");

                                for (index = element.length - 1; index >= 0; index--) {
                                    element[index].parentNode.removeChild(element[index]);
                                }

                                document.getElementById("submit").classList.add("disabled");
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


                selectRow = function selectRow(e) {
                    removeClass("selected");
                    e.target.closest("tr").classList.add("selected");
                    e.target.select();
                }; // | selectRow


                confirmRow = function confirmRow(e) {
                    if (e.keyCode === 13) {
                        removeClass("selected");
                        removeClass("focused");
                        document.getElementById("scan-ean").focus();
                        document.getElementById("scan-ean").value = "";
                    }
                }; // | confirmRow


                removeClass = function removeClass(className) {
                    var selectedElements = document.getElementsByClassName(className);

                    while (selectedElements.length > 0) {
                        selectedElements[0].classList.remove(className);
                    }
                };

                showMessageBox = function showMessageBox() {
                    var show = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : "success";
                    var target = arguments.length > 1 ? arguments[1] : undefined;
                    var hide = show === "success" ? "fail" : "success";
                    var message = show === "success" ? "OK" : "FALSCH";
                    var messageBoxes = document.getElementsByClassName('message');

                    for (var i = 0; i < messageBoxes.length; i++) {
                        messageBoxes[i].classList.add("d-none");
                    }

                    var showMessage = target.getElementsByClassName("message");

                    if (showMessage && showMessage.length) {
                        showMessage[0].classList.remove("d-none");
                        showMessage[0].classList.remove("message-".concat(hide));
                        showMessage[0].classList.add("message-".concat(show));
                        showMessage[0].innerText = message;
                    }
                }; // | showMessageBox


                sendAjax = function sendAjax() {
                    var url = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : "";
                    var type = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "GET";
                    var data = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : [];
                    var callback = arguments.length > 3 ? arguments[3] : undefined;
                    var xhttp = new XMLHttpRequest();

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
                }; // | sendAjax


                disableParentButton = function disableParentButton(e) {
                    showLoader();
                    e.target.parentNode.classList.add("disabled");
                };

                showLoader = function showLoader() {
                    document.getElementById("loader").classList.remove("d-none");
                };

                hideLoader = function hideLoader() {
                    document.getElementById("loader").classList.add("d-none");
                };

                showErrorInfo = function showErrorInfo() {
                    var content = document.getElementById("content_info");
                    content.classList.add(['content_info']);
                    var errorInfo = document.createTextNode("Incorrect data for order");
                    content.appendChild(errorInfo);
                };

                /***/
            }),

        /***/
        "./resources/sass/app.scss":
            /*!*********************************!*\
              !*** ./resources/sass/app.scss ***!
              \*********************************/
            /***/
            ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

                "use strict";
                __webpack_require__.r(__webpack_exports__);
                // extracted by mini-css-extract-plugin


                /***/
            }),

        /***/
        "./node_modules/print-js/dist/print.js":
            /*!*********************************************!*\
              !*** ./node_modules/print-js/dist/print.js ***!
              \*********************************************/
            /***/
            ((module) => {

                (function webpackUniversalModuleDefinition(root, factory) {
                    if (true)
                        module.exports = factory();
                    else {}
                })(window, function () {
                    return /******/ (function (modules) { // webpackBootstrap
                        /******/ // The module cache
                        /******/
                        var installedModules = {};
                        /******/
                        /******/ // The require function
                        /******/
                        function __nested_webpack_require_539__(moduleId) {
                            /******/
                            /******/ // Check if module is in cache
                            /******/
                            if (installedModules[moduleId]) {
                                /******/
                                return installedModules[moduleId].exports;
                                /******/
                            }
                            /******/ // Create a new module (and put it into the cache)
                            /******/
                            var module = installedModules[moduleId] = {
                                /******/
                                i: moduleId,
                                /******/
                                l: false,
                                /******/
                                exports: {}
                                /******/
                            };
                            /******/
                            /******/ // Execute the module function
                            /******/
                            modules[moduleId].call(module.exports, module, module.exports, __nested_webpack_require_539__);
                            /******/
                            /******/ // Flag the module as loaded
                            /******/
                            module.l = true;
                            /******/
                            /******/ // Return the exports of the module
                            /******/
                            return module.exports;
                            /******/
                        }
                        /******/
                        /******/
                        /******/ // expose the modules object (__webpack_modules__)
                        /******/
                        __nested_webpack_require_539__.m = modules;
                        /******/
                        /******/ // expose the module cache
                        /******/
                        __nested_webpack_require_539__.c = installedModules;
                        /******/
                        /******/ // define getter function for harmony exports
                        /******/
                        __nested_webpack_require_539__.d = function (exports, name, getter) {
                            /******/
                            if (!__nested_webpack_require_539__.o(exports, name)) {
                                /******/
                                Object.defineProperty(exports, name, {
                                    enumerable: true,
                                    get: getter
                                });
                                /******/
                            }
                            /******/
                        };
                        /******/
                        /******/ // define __esModule on exports
                        /******/
                        __nested_webpack_require_539__.r = function (exports) {
                            /******/
                            if (typeof Symbol !== 'undefined' && Symbol.toStringTag) {
                                /******/
                                Object.defineProperty(exports, Symbol.toStringTag, {
                                    value: 'Module'
                                });
                                /******/
                            }
                            /******/
                            Object.defineProperty(exports, '__esModule', {
                                value: true
                            });
                            /******/
                        };
                        /******/
                        /******/ // create a fake namespace object
                        /******/ // mode & 1: value is a module id, require it
                        /******/ // mode & 2: merge all properties of value into the ns
                        /******/ // mode & 4: return value when already ns object
                        /******/ // mode & 8|1: behave like require
                        /******/
                        __nested_webpack_require_539__.t = function (value, mode) {
                            /******/
                            if (mode & 1) value = __nested_webpack_require_539__(value);
                            /******/
                            if (mode & 8) return value;
                            /******/
                            if ((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
                            /******/
                            var ns = Object.create(null);
                            /******/
                            __nested_webpack_require_539__.r(ns);
                            /******/
                            Object.defineProperty(ns, 'default', {
                                enumerable: true,
                                value: value
                            });
                            /******/
                            if (mode & 2 && typeof value != 'string')
                                for (var key in value) __nested_webpack_require_539__.d(ns, key, function (key) {
                                    return value[key];
                                }.bind(null, key));
                            /******/
                            return ns;
                            /******/
                        };
                        /******/
                        /******/ // getDefaultExport function for compatibility with non-harmony modules
                        /******/
                        __nested_webpack_require_539__.n = function (module) {
                            /******/
                            var getter = module && module.__esModule ?
                                /******/
                                function getDefault() {
                                    return module['default'];
                                } :
                                /******/
                                function getModuleExports() {
                                    return module;
                                };
                            /******/
                            __nested_webpack_require_539__.d(getter, 'a', getter);
                            /******/
                            return getter;
                            /******/
                        };
                        /******/
                        /******/ // Object.prototype.hasOwnProperty.call
                        /******/
                        __nested_webpack_require_539__.o = function (object, property) {
                            return Object.prototype.hasOwnProperty.call(object, property);
                        };
                        /******/
                        /******/ // __webpack_public_path__
                        /******/
                        __nested_webpack_require_539__.p = "";
                        /******/
                        /******/
                        /******/ // Load entry module and return exports
                        /******/
                        return __nested_webpack_require_539__(__nested_webpack_require_539__.s = 0);
                        /******/
                    })
                    /************************************************************************/
                    /******/
                    ({

                        /***/
                        "./src/index.js":
                            /*!**********************!*\
                              !*** ./src/index.js ***!
                              \**********************/
                            /*! exports provided: default */
                            /***/
                            (function (module, __webpack_exports__, __nested_webpack_require_4148__) {

                                "use strict";
                                __nested_webpack_require_4148__.r(__webpack_exports__);
                                /* harmony import */
                                var _sass_index_scss__WEBPACK_IMPORTED_MODULE_0__ = __nested_webpack_require_4148__( /*! ./sass/index.scss */ "./src/sass/index.scss");
                                /* harmony import */
                                var _sass_index_scss__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/ __nested_webpack_require_4148__.n(_sass_index_scss__WEBPACK_IMPORTED_MODULE_0__);
                                /* harmony import */
                                var _js_init__WEBPACK_IMPORTED_MODULE_1__ = __nested_webpack_require_4148__( /*! ./js/init */ "./src/js/init.js");


                                var printJS = _js_init__WEBPACK_IMPORTED_MODULE_1__["default"].init;

                                if (typeof window !== 'undefined') {
                                    window.printJS = printJS;
                                }

                                /* harmony default export */
                                __webpack_exports__["default"] = (printJS);

                                /***/
                            }),

                        /***/
                        "./src/js/browser.js":
                            /*!***************************!*\
                              !*** ./src/js/browser.js ***!
                              \***************************/
                            /*! exports provided: default */
                            /***/
                            (function (module, __webpack_exports__, __nested_webpack_require_5091__) {

                                "use strict";
                                __nested_webpack_require_5091__.r(__webpack_exports__);
                                var Browser = {
                                    // Firefox 1.0+
                                    isFirefox: function isFirefox() {
                                        return typeof InstallTrigger !== 'undefined';
                                    },
                                    // Internet Explorer 6-11
                                    isIE: function isIE() {
                                        return navigator.userAgent.indexOf('MSIE') !== -1 || !!document.documentMode;
                                    },
                                    // Edge 20+
                                    isEdge: function isEdge() {
                                        return !Browser.isIE() && !!window.StyleMedia;
                                    },
                                    // Chrome 1+
                                    isChrome: function isChrome() {
                                        var context = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : window;
                                        return !!context.chrome;
                                    },
                                    // At least Safari 3+: "[object HTMLElementConstructor]"
                                    isSafari: function isSafari() {
                                        return Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0 || navigator.userAgent.toLowerCase().indexOf('safari') !== -1;
                                    },
                                    // IOS Chrome
                                    isIOSChrome: function isIOSChrome() {
                                        return navigator.userAgent.toLowerCase().indexOf('crios') !== -1;
                                    }
                                };
                                /* harmony default export */
                                __webpack_exports__["default"] = (Browser);

                                /***/
                            }),

                        /***/
                        "./src/js/functions.js":
                            /*!*****************************!*\
                              !*** ./src/js/functions.js ***!
                              \*****************************/
                            /*! exports provided: addWrapper, capitalizePrint, collectStyles, addHeader, cleanUp, isRawHTML */
                            /***/
                            (function (module, __webpack_exports__, __nested_webpack_require_6463__) {

                                "use strict";
                                __nested_webpack_require_6463__.r(__webpack_exports__);
                                /* harmony export (binding) */
                                __nested_webpack_require_6463__.d(__webpack_exports__, "addWrapper", function () {
                                    return addWrapper;
                                });
                                /* harmony export (binding) */
                                __nested_webpack_require_6463__.d(__webpack_exports__, "capitalizePrint", function () {
                                    return capitalizePrint;
                                });
                                /* harmony export (binding) */
                                __nested_webpack_require_6463__.d(__webpack_exports__, "collectStyles", function () {
                                    return collectStyles;
                                });
                                /* harmony export (binding) */
                                __nested_webpack_require_6463__.d(__webpack_exports__, "addHeader", function () {
                                    return addHeader;
                                });
                                /* harmony export (binding) */
                                __nested_webpack_require_6463__.d(__webpack_exports__, "cleanUp", function () {
                                    return cleanUp;
                                });
                                /* harmony export (binding) */
                                __nested_webpack_require_6463__.d(__webpack_exports__, "isRawHTML", function () {
                                    return isRawHTML;
                                });
                                /* harmony import */
                                var _modal__WEBPACK_IMPORTED_MODULE_0__ = __nested_webpack_require_6463__( /*! ./modal */ "./src/js/modal.js");
                                /* harmony import */
                                var _browser__WEBPACK_IMPORTED_MODULE_1__ = __nested_webpack_require_6463__( /*! ./browser */ "./src/js/browser.js");

                                function _typeof(obj) {
                                    "@babel/helpers - typeof";
                                    if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
                                        _typeof = function _typeof(obj) {
                                            return typeof obj;
                                        };
                                    } else {
                                        _typeof = function _typeof(obj) {
                                            return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
                                        };
                                    }
                                    return _typeof(obj);
                                }



                                function addWrapper(htmlData, params) {
                                    var bodyStyle = 'font-family:' + params.font + ' !important; font-size: ' + params.font_size + ' !important; width:100%;';
                                    return '<div style="' + bodyStyle + '">' + htmlData + '</div>';
                                }

                                function capitalizePrint(obj) {
                                    return obj.charAt(0).toUpperCase() + obj.slice(1);
                                }

                                function collectStyles(element, params) {
                                    var win = document.defaultView || window; // String variable to hold styling for each element

                                    var elementStyle = ''; // Loop over computed styles

                                    var styles = win.getComputedStyle(element, '');

                                    for (var key = 0; key < styles.length; key++) {
                                        // Check if style should be processed
                                        if (params.targetStyles.indexOf('*') !== -1 || params.targetStyle.indexOf(styles[key]) !== -1 || targetStylesMatch(params.targetStyles, styles[key])) {
                                            if (styles.getPropertyValue(styles[key])) elementStyle += styles[key] + ':' + styles.getPropertyValue(styles[key]) + ';';
                                        }
                                    } // Print friendly defaults (deprecated)


                                    elementStyle += 'max-width: ' + params.maxWidth + 'px !important; font-size: ' + params.font_size + ' !important;';
                                    return elementStyle;
                                }

                                function targetStylesMatch(styles, value) {
                                    for (var i = 0; i < styles.length; i++) {
                                        if (_typeof(value) === 'object' && value.indexOf(styles[i]) !== -1) return true;
                                    }

                                    return false;
                                }

                                function addHeader(printElement, params) {
                                    // Create the header container div
                                    var headerContainer = document.createElement('div'); // Check if the header is text or raw html

                                    if (isRawHTML(params.header)) {
                                        headerContainer.innerHTML = params.header;
                                    } else {
                                        // Create header element
                                        var headerElement = document.createElement('h1'); // Create header text node

                                        var headerNode = document.createTextNode(params.header); // Build and style

                                        headerElement.appendChild(headerNode);
                                        headerElement.setAttribute('style', params.headerStyle);
                                        headerContainer.appendChild(headerElement);
                                    }

                                    printElement.insertBefore(headerContainer, printElement.childNodes[0]);
                                }

                                function cleanUp(params) {
                                    // If we are showing a feedback message to user, remove it
                                    if (params.showModal) _modal__WEBPACK_IMPORTED_MODULE_0__["default"].close(); // Check for a finished loading hook function

                                    if (params.onLoadingEnd) params.onLoadingEnd(); // If preloading pdf files, clean blob url

                                    if (params.showModal || params.onLoadingStart) window.URL.revokeObjectURL(params.printable); // Run onPrintDialogClose callback

                                    var event = 'mouseover';

                                    if (_browser__WEBPACK_IMPORTED_MODULE_1__["default"].isChrome() || _browser__WEBPACK_IMPORTED_MODULE_1__["default"].isFirefox()) {
                                        // Ps.: Firefox will require an extra click in the document to fire the focus event.
                                        event = 'focus';
                                    }

                                    var handler = function handler() {
                                        // Make sure the event only happens once.
                                        window.removeEventListener(event, handler);
                                        params.onPrintDialogClose(); // Remove iframe from the DOM

                                        var iframe = document.getElementById(params.frameId);

                                        if (iframe) {
                                            iframe.remove();
                                        }
                                    };

                                    window.addEventListener(event, handler);
                                }

                                function isRawHTML(raw) {
                                    var regexHtml = new RegExp('<([A-Za-z][A-Za-z0-9]*)\\b[^>]*>(.*?)</\\1>');
                                    return regexHtml.test(raw);
                                }

                                /***/
                            }),

                        /***/
                        "./src/js/html.js":
                            /*!************************!*\
                              !*** ./src/js/html.js ***!
                              \************************/
                            /*! exports provided: default */
                            /***/
                            (function (module, __webpack_exports__, __nested_webpack_require_11361__) {

                                "use strict";
                                __nested_webpack_require_11361__.r(__webpack_exports__);
                                /* harmony import */
                                var _functions__WEBPACK_IMPORTED_MODULE_0__ = __nested_webpack_require_11361__( /*! ./functions */ "./src/js/functions.js");
                                /* harmony import */
                                var _print__WEBPACK_IMPORTED_MODULE_1__ = __nested_webpack_require_11361__( /*! ./print */ "./src/js/print.js");

                                function _typeof(obj) {
                                    "@babel/helpers - typeof";
                                    if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
                                        _typeof = function _typeof(obj) {
                                            return typeof obj;
                                        };
                                    } else {
                                        _typeof = function _typeof(obj) {
                                            return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
                                        };
                                    }
                                    return _typeof(obj);
                                }



                                /* harmony default export */
                                __webpack_exports__["default"] = ({
                                    print: function print(params, printFrame) {
                                        // Get the DOM printable element
                                        var printElement = isHtmlElement(params.printable) ? params.printable : document.getElementById(params.printable); // Check if the element exists

                                        if (!printElement) {
                                            window.console.error('Invalid HTML element id: ' + params.printable);
                                            return;
                                        } // Clone the target element including its children (if available)


                                        params.printableElement = cloneElement(printElement, params); // Add header

                                        if (params.header) {
                                            Object(_functions__WEBPACK_IMPORTED_MODULE_0__["addHeader"])(params.printableElement, params);
                                        } // Print html element contents


                                        _print__WEBPACK_IMPORTED_MODULE_1__["default"].send(params, printFrame);
                                    }
                                });

                                function cloneElement(element, params) {
                                    // Clone the main node (if not already inside the recursion process)
                                    var clone = element.cloneNode(); // Loop over and process the children elements / nodes (including text nodes)

                                    var childNodesArray = Array.prototype.slice.call(element.childNodes);

                                    for (var i = 0; i < childNodesArray.length; i++) {
                                        // Check if we are skipping the current element
                                        if (params.ignoreElements.indexOf(childNodesArray[i].id) !== -1) {
                                            continue;
                                        } // Clone the child element


                                        var clonedChild = cloneElement(childNodesArray[i], params); // Attach the cloned child to the cloned parent node

                                        clone.appendChild(clonedChild);
                                    } // Get all styling for print element (for nodes of type element only)


                                    if (params.scanStyles && element.nodeType === 1) {
                                        clone.setAttribute('style', Object(_functions__WEBPACK_IMPORTED_MODULE_0__["collectStyles"])(element, params));
                                    } // Check if the element needs any state processing (copy user input data)


                                    switch (element.tagName) {
                                        case 'SELECT':
                                            // Copy the current selection value to its clone
                                            clone.value = element.value;
                                            break;

                                        case 'CANVAS':
                                            // Copy the canvas content to its clone
                                            clone.getContext('2d').drawImage(element, 0, 0);
                                            break;
                                    }

                                    return clone;
                                }

                                function isHtmlElement(printable) {
                                    // Check if element is instance of HTMLElement or has nodeType === 1 (for elements in iframe)
                                    return _typeof(printable) === 'object' && printable && (printable instanceof HTMLElement || printable.nodeType === 1);
                                }

                                /***/
                            }),

                        /***/
                        "./src/js/image.js":
                            /*!*************************!*\
                              !*** ./src/js/image.js ***!
                              \*************************/
                            /*! exports provided: default */
                            /***/
                            (function (module, __webpack_exports__, __nested_webpack_require_14675__) {

                                "use strict";
                                __nested_webpack_require_14675__.r(__webpack_exports__);
                                /* harmony import */
                                var _functions__WEBPACK_IMPORTED_MODULE_0__ = __nested_webpack_require_14675__( /*! ./functions */ "./src/js/functions.js");
                                /* harmony import */
                                var _print__WEBPACK_IMPORTED_MODULE_1__ = __nested_webpack_require_14675__( /*! ./print */ "./src/js/print.js");
                                /* harmony import */
                                var _browser__WEBPACK_IMPORTED_MODULE_2__ = __nested_webpack_require_14675__( /*! ./browser */ "./src/js/browser.js");



                                /* harmony default export */
                                __webpack_exports__["default"] = ({
                                    print: function print(params, printFrame) {
                                        // Check if we are printing one image or multiple images
                                        if (params.printable.constructor !== Array) {
                                            // Create array with one image
                                            params.printable = [params.printable];
                                        } // Create printable element (container)


                                        params.printableElement = document.createElement('div'); // Create all image elements and append them to the printable container

                                        params.printable.forEach(function (src) {
                                            // Create the image element
                                            var img = document.createElement('img');
                                            img.setAttribute('style', params.imageStyle); // Set image src with the file url

                                            img.src = src; // The following block is for Firefox, which for some reason requires the image's src to be fully qualified in
                                            // order to print it

                                            if (_browser__WEBPACK_IMPORTED_MODULE_2__["default"].isFirefox()) {
                                                var fullyQualifiedSrc = img.src;
                                                img.src = fullyQualifiedSrc;
                                            } // Create the image wrapper


                                            var imageWrapper = document.createElement('div'); // Append image to the wrapper element

                                            imageWrapper.appendChild(img); // Append wrapper to the printable element

                                            params.printableElement.appendChild(imageWrapper);
                                        }); // Check if we are adding a print header

                                        if (params.header) Object(_functions__WEBPACK_IMPORTED_MODULE_0__["addHeader"])(params.printableElement, params); // Print image

                                        _print__WEBPACK_IMPORTED_MODULE_1__["default"].send(params, printFrame);
                                    }
                                });

                                /***/
                            }),

                        /***/
                        "./src/js/init.js":
                            /*!************************!*\
                              !*** ./src/js/init.js ***!
                              \************************/
                            /*! exports provided: default */
                            /***/
                            (function (module, __webpack_exports__, __nested_webpack_require_16897__) {

                                "use strict";
                                __nested_webpack_require_16897__.r(__webpack_exports__);
                                /* harmony import */
                                var _browser__WEBPACK_IMPORTED_MODULE_0__ = __nested_webpack_require_16897__( /*! ./browser */ "./src/js/browser.js");
                                /* harmony import */
                                var _modal__WEBPACK_IMPORTED_MODULE_1__ = __nested_webpack_require_16897__( /*! ./modal */ "./src/js/modal.js");
                                /* harmony import */
                                var _pdf__WEBPACK_IMPORTED_MODULE_2__ = __nested_webpack_require_16897__( /*! ./pdf */ "./src/js/pdf.js");
                                /* harmony import */
                                var _html__WEBPACK_IMPORTED_MODULE_3__ = __nested_webpack_require_16897__( /*! ./html */ "./src/js/html.js");
                                /* harmony import */
                                var _raw_html__WEBPACK_IMPORTED_MODULE_4__ = __nested_webpack_require_16897__( /*! ./raw-html */ "./src/js/raw-html.js");
                                /* harmony import */
                                var _image__WEBPACK_IMPORTED_MODULE_5__ = __nested_webpack_require_16897__( /*! ./image */ "./src/js/image.js");
                                /* harmony import */
                                var _json__WEBPACK_IMPORTED_MODULE_6__ = __nested_webpack_require_16897__( /*! ./json */ "./src/js/json.js");


                                function _typeof(obj) {
                                    "@babel/helpers - typeof";
                                    if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
                                        _typeof = function _typeof(obj) {
                                            return typeof obj;
                                        };
                                    } else {
                                        _typeof = function _typeof(obj) {
                                            return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
                                        };
                                    }
                                    return _typeof(obj);
                                }








                                var printTypes = ['pdf', 'html', 'image', 'json', 'raw-html'];
                                /* harmony default export */
                                __webpack_exports__["default"] = ({
                                    init: function init() {
                                        var params = {
                                            printable: null,
                                            fallbackPrintable: null,
                                            type: 'pdf',
                                            header: null,
                                            headerStyle: 'font-weight: 300;',
                                            maxWidth: 800,
                                            properties: null,
                                            gridHeaderStyle: 'font-weight: bold; padding: 5px; border: 1px solid #dddddd;',
                                            gridStyle: 'border: 1px solid lightgray; margin-bottom: -1px;',
                                            showModal: false,
                                            onError: function onError(error) {
                                                throw error;
                                            },
                                            onLoadingStart: null,
                                            onLoadingEnd: null,
                                            onPrintDialogClose: function onPrintDialogClose() {},
                                            onIncompatibleBrowser: function onIncompatibleBrowser() {},
                                            modalMessage: 'Retrieving Document...',
                                            frameId: 'printJS',
                                            printableElement: null,
                                            documentTitle: 'Document',
                                            targetStyle: ['clear', 'display', 'width', 'min-width', 'height', 'min-height', 'max-height'],
                                            targetStyles: ['border', 'box', 'break', 'text-decoration'],
                                            ignoreElements: [],
                                            repeatTableHeader: true,
                                            css: null,
                                            style: null,
                                            scanStyles: true,
                                            base64: false,
                                            // Deprecated
                                            onPdfOpen: null,
                                            font: 'TimesNewRoman',
                                            font_size: '12pt',
                                            honorMarginPadding: true,
                                            honorColor: false,
                                            imageStyle: 'max-width: 100%;'
                                        }; // Check if a printable document or object was supplied

                                        var args = arguments[0];

                                        if (args === undefined) {
                                            throw new Error('printJS expects at least 1 attribute.');
                                        } // Process parameters


                                        switch (_typeof(args)) {
                                            case 'string':
                                                params.printable = encodeURI(args);
                                                params.fallbackPrintable = params.printable;
                                                params.type = arguments[1] || params.type;
                                                break;

                                            case 'object':
                                                params.printable = args.printable;
                                                params.fallbackPrintable = typeof args.fallbackPrintable !== 'undefined' ? args.fallbackPrintable : params.printable;
                                                params.fallbackPrintable = params.base64 ? "data:application/pdf;base64,".concat(params.fallbackPrintable) : params.fallbackPrintable;

                                                for (var k in params) {
                                                    if (k === 'printable' || k === 'fallbackPrintable') continue;
                                                    params[k] = typeof args[k] !== 'undefined' ? args[k] : params[k];
                                                }

                                                break;

                                            default:
                                                throw new Error('Unexpected argument type! Expected "string" or "object", got ' + _typeof(args));
                                        } // Validate printable


                                        if (!params.printable) throw new Error('Missing printable information.'); // Validate type

                                        if (!params.type || typeof params.type !== 'string' || printTypes.indexOf(params.type.toLowerCase()) === -1) {
                                            throw new Error('Invalid print type. Available types are: pdf, html, image and json.');
                                        } // Check if we are showing a feedback message to the user (useful for large files)


                                        if (params.showModal) _modal__WEBPACK_IMPORTED_MODULE_1__["default"].show(params); // Check for a print start hook function

                                        if (params.onLoadingStart) params.onLoadingStart(); // To prevent duplication and issues, remove any used printFrame from the DOM

                                        var usedFrame = document.getElementById(params.frameId);
                                        if (usedFrame) usedFrame.parentNode.removeChild(usedFrame); // Create a new iframe for the print job

                                        var printFrame = document.createElement('iframe');

                                        if (_browser__WEBPACK_IMPORTED_MODULE_0__["default"].isFirefox()) {
                                            // Set the iframe to be is visible on the page (guaranteed by fixed position) but hidden using opacity 0, because
                                            // this works in Firefox. The height needs to be sufficient for some part of the document other than the PDF
                                            // viewer's toolbar to be visible in the page
                                            printFrame.setAttribute('style', 'width: 1px; height: 100px; position: fixed; left: 0; top: 0; opacity: 0; border-width: 0; margin: 0; padding: 0');
                                        } else {
                                            // Hide the iframe in other browsers
                                            printFrame.setAttribute('style', 'visibility: hidden; height: 0; width: 0; position: absolute; border: 0');
                                        } // Set iframe element id


                                        printFrame.setAttribute('id', params.frameId); // For non pdf printing, pass an html document string to srcdoc (force onload callback)

                                        if (params.type !== 'pdf') {
                                            printFrame.srcdoc = '<html><head><title>' + params.documentTitle + '</title>'; // Attach css files

                                            if (params.css) {
                                                // Add support for single file
                                                if (!Array.isArray(params.css)) params.css = [params.css]; // Create link tags for each css file

                                                params.css.forEach(function (file) {
                                                    printFrame.srcdoc += '<link rel="stylesheet" href="' + file + '">';
                                                });
                                            }

                                            printFrame.srcdoc += '</head><body></body></html>';
                                        } // Check printable type


                                        switch (params.type) {
                                            case 'pdf':
                                                // Check browser support for pdf and if not supported we will just open the pdf file instead
                                                if (_browser__WEBPACK_IMPORTED_MODULE_0__["default"].isIE()) {
                                                    try {
                                                        console.info('Print.js doesn\'t support PDF printing in Internet Explorer.');
                                                        var win = window.open(params.fallbackPrintable, '_blank');
                                                        win.focus();
                                                        params.onIncompatibleBrowser();
                                                    } catch (error) {
                                                        params.onError(error);
                                                    } finally {
                                                        // Make sure there is no loading modal opened
                                                        if (params.showModal) _modal__WEBPACK_IMPORTED_MODULE_1__["default"].close();
                                                        if (params.onLoadingEnd) params.onLoadingEnd();
                                                    }
                                                } else {
                                                    _pdf__WEBPACK_IMPORTED_MODULE_2__["default"].print(params, printFrame);
                                                }

                                                break;

                                            case 'image':
                                                _image__WEBPACK_IMPORTED_MODULE_5__["default"].print(params, printFrame);
                                                break;

                                            case 'html':
                                                _html__WEBPACK_IMPORTED_MODULE_3__["default"].print(params, printFrame);
                                                break;

                                            case 'raw-html':
                                                _raw_html__WEBPACK_IMPORTED_MODULE_4__["default"].print(params, printFrame);
                                                break;

                                            case 'json':
                                                _json__WEBPACK_IMPORTED_MODULE_6__["default"].print(params, printFrame);
                                                break;
                                        }
                                    }
                                });

                                /***/
                            }),

                        /***/
                        "./src/js/json.js":
                            /*!************************!*\
                              !*** ./src/js/json.js ***!
                              \************************/
                            /*! exports provided: default */
                            /***/
                            (function (module, __webpack_exports__, __nested_webpack_require_24617__) {

                                "use strict";
                                __nested_webpack_require_24617__.r(__webpack_exports__);
                                /* harmony import */
                                var _functions__WEBPACK_IMPORTED_MODULE_0__ = __nested_webpack_require_24617__( /*! ./functions */ "./src/js/functions.js");
                                /* harmony import */
                                var _print__WEBPACK_IMPORTED_MODULE_1__ = __nested_webpack_require_24617__( /*! ./print */ "./src/js/print.js");

                                function _typeof(obj) {
                                    "@babel/helpers - typeof";
                                    if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
                                        _typeof = function _typeof(obj) {
                                            return typeof obj;
                                        };
                                    } else {
                                        _typeof = function _typeof(obj) {
                                            return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
                                        };
                                    }
                                    return _typeof(obj);
                                }



                                /* harmony default export */
                                __webpack_exports__["default"] = ({
                                    print: function print(params, printFrame) {
                                        // Check if we received proper data
                                        if (_typeof(params.printable) !== 'object') {
                                            throw new Error('Invalid javascript data object (JSON).');
                                        } // Validate repeatTableHeader


                                        if (typeof params.repeatTableHeader !== 'boolean') {
                                            throw new Error('Invalid value for repeatTableHeader attribute (JSON).');
                                        } // Validate properties


                                        if (!params.properties || !Array.isArray(params.properties)) {
                                            throw new Error('Invalid properties array for your JSON data.');
                                        } // We will format the property objects to keep the JSON api compatible with older releases


                                        params.properties = params.properties.map(function (property) {
                                            return {
                                                field: _typeof(property) === 'object' ? property.field : property,
                                                displayName: _typeof(property) === 'object' ? property.displayName : property,
                                                columnSize: _typeof(property) === 'object' && property.columnSize ? property.columnSize + ';' : 100 / params.properties.length + '%;'
                                            };
                                        }); // Create a print container element

                                        params.printableElement = document.createElement('div'); // Check if we are adding a print header

                                        if (params.header) {
                                            Object(_functions__WEBPACK_IMPORTED_MODULE_0__["addHeader"])(params.printableElement, params);
                                        } // Build the printable html data


                                        params.printableElement.innerHTML += jsonToHTML(params); // Print the json data

                                        _print__WEBPACK_IMPORTED_MODULE_1__["default"].send(params, printFrame);
                                    }
                                });

                                function jsonToHTML(params) {
                                    // Get the row and column data
                                    var data = params.printable;
                                    var properties = params.properties; // Create a html table

                                    var htmlData = '<table style="border-collapse: collapse; width: 100%;">'; // Check if the header should be repeated

                                    if (params.repeatTableHeader) {
                                        htmlData += '<thead>';
                                    } // Add the table header row


                                    htmlData += '<tr>'; // Add the table header columns

                                    for (var a = 0; a < properties.length; a++) {
                                        htmlData += '<th style="width:' + properties[a].columnSize + ';' + params.gridHeaderStyle + '">' + Object(_functions__WEBPACK_IMPORTED_MODULE_0__["capitalizePrint"])(properties[a].displayName) + '</th>';
                                    } // Add the closing tag for the table header row


                                    htmlData += '</tr>'; // If the table header is marked as repeated, add the closing tag

                                    if (params.repeatTableHeader) {
                                        htmlData += '</thead>';
                                    } // Create the table body


                                    htmlData += '<tbody>'; // Add the table data rows

                                    for (var i = 0; i < data.length; i++) {
                                        // Add the row starting tag
                                        htmlData += '<tr>'; // Print selected properties only

                                        for (var n = 0; n < properties.length; n++) {
                                            var stringData = data[i]; // Support nested objects

                                            var property = properties[n].field.split('.');

                                            if (property.length > 1) {
                                                for (var p = 0; p < property.length; p++) {
                                                    stringData = stringData[property[p]];
                                                }
                                            } else {
                                                stringData = stringData[properties[n].field];
                                            } // Add the row contents and styles


                                            htmlData += '<td style="width:' + properties[n].columnSize + params.gridStyle + '">' + stringData + '</td>';
                                        } // Add the row closing tag


                                        htmlData += '</tr>';
                                    } // Add the table and body closing tags


                                    htmlData += '</tbody></table>';
                                    return htmlData;
                                }

                                /***/
                            }),

                        /***/
                        "./src/js/modal.js":
                            /*!*************************!*\
                              !*** ./src/js/modal.js ***!
                              \*************************/
                            /*! exports provided: default */
                            /***/
                            (function (module, __webpack_exports__, __nested_webpack_require_28932__) {

                                "use strict";
                                __nested_webpack_require_28932__.r(__webpack_exports__);
                                var Modal = {
                                    show: function show(params) {
                                        // Build modal
                                        var modalStyle = 'font-family:sans-serif; ' + 'display:table; ' + 'text-align:center; ' + 'font-weight:300; ' + 'font-size:30px; ' + 'left:0; top:0;' + 'position:fixed; ' + 'z-index: 9990;' + 'color: #0460B5; ' + 'width: 100%; ' + 'height: 100%; ' + 'background-color:rgba(255,255,255,.9);' + 'transition: opacity .3s ease;'; // Create wrapper

                                        var printModal = document.createElement('div');
                                        printModal.setAttribute('style', modalStyle);
                                        printModal.setAttribute('id', 'printJS-Modal'); // Create content div

                                        var contentDiv = document.createElement('div');
                                        contentDiv.setAttribute('style', 'display:table-cell; vertical-align:middle; padding-bottom:100px;'); // Add close button (requires print.css)

                                        var closeButton = document.createElement('div');
                                        closeButton.setAttribute('class', 'printClose');
                                        closeButton.setAttribute('id', 'printClose');
                                        contentDiv.appendChild(closeButton); // Add spinner (requires print.css)

                                        var spinner = document.createElement('span');
                                        spinner.setAttribute('class', 'printSpinner');
                                        contentDiv.appendChild(spinner); // Add message

                                        var messageNode = document.createTextNode(params.modalMessage);
                                        contentDiv.appendChild(messageNode); // Add contentDiv to printModal

                                        printModal.appendChild(contentDiv); // Append print modal element to document body

                                        document.getElementsByTagName('body')[0].appendChild(printModal); // Add event listener to close button

                                        document.getElementById('printClose').addEventListener('click', function () {
                                            Modal.close();
                                        });
                                    },
                                    close: function close() {
                                        var printModal = document.getElementById('printJS-Modal');

                                        if (printModal) {
                                            printModal.parentNode.removeChild(printModal);
                                        }
                                    }
                                };
                                /* harmony default export */
                                __webpack_exports__["default"] = (Modal);

                                /***/
                            }),

                        /***/
                        "./src/js/pdf.js":
                            /*!***********************!*\
                              !*** ./src/js/pdf.js ***!
                              \***********************/
                            /*! exports provided: default */
                            /***/
                            (function (module, __webpack_exports__, __nested_webpack_require_31100__) {

                                "use strict";
                                __nested_webpack_require_31100__.r(__webpack_exports__);
                                /* harmony import */
                                var _print__WEBPACK_IMPORTED_MODULE_0__ = __nested_webpack_require_31100__( /*! ./print */ "./src/js/print.js");
                                /* harmony import */
                                var _functions__WEBPACK_IMPORTED_MODULE_1__ = __nested_webpack_require_31100__( /*! ./functions */ "./src/js/functions.js");


                                /* harmony default export */
                                __webpack_exports__["default"] = ({
                                    print: function print(params, printFrame) {
                                        // Check if we have base64 data
                                        if (params.base64) {
                                            var bytesArray = Uint8Array.from(atob(params.printable), function (c) {
                                                return c.charCodeAt(0);
                                            });
                                            createBlobAndPrint(params, printFrame, bytesArray);
                                            return;
                                        } // Format pdf url


                                        params.printable = /^(blob|http|\/\/)/i.test(params.printable) ? params.printable : window.location.origin + (params.printable.charAt(0) !== '/' ? '/' + params.printable : params.printable); // Get the file through a http request (Preload)

                                        var req = new window.XMLHttpRequest();
                                        req.responseType = 'arraybuffer';
                                        req.addEventListener('error', function () {
                                            Object(_functions__WEBPACK_IMPORTED_MODULE_1__["cleanUp"])(params);
                                            params.onError(req.statusText, req); // Since we don't have a pdf document available, we will stop the print job
                                        });
                                        req.addEventListener('load', function () {
                                            // Check for errors
                                            if ([200, 201].indexOf(req.status) === -1) {
                                                Object(_functions__WEBPACK_IMPORTED_MODULE_1__["cleanUp"])(params);
                                                params.onError(req.statusText, req); // Since we don't have a pdf document available, we will stop the print job

                                                return;
                                            } // Print requested document


                                            createBlobAndPrint(params, printFrame, req.response);
                                        });
                                        req.open('GET', params.printable, true);
                                        req.send();
                                    }
                                });

                                function createBlobAndPrint(params, printFrame, data) {
                                    // Pass response or base64 data to a blob and create a local object url
                                    var localPdf = new window.Blob([data], {
                                        type: 'application/pdf'
                                    });
                                    localPdf = window.URL.createObjectURL(localPdf); // Set iframe src with pdf document url

                                    printFrame.setAttribute('src', localPdf);
                                    _print__WEBPACK_IMPORTED_MODULE_0__["default"].send(params, printFrame);
                                }

                                /***/
                            }),

                        /***/
                        "./src/js/print.js":
                            /*!*************************!*\
                              !*** ./src/js/print.js ***!
                              \*************************/
                            /*! exports provided: default */
                            /***/
                            (function (module, __webpack_exports__, __nested_webpack_require_33544__) {

                                "use strict";
                                __nested_webpack_require_33544__.r(__webpack_exports__);
                                /* harmony import */
                                var _browser__WEBPACK_IMPORTED_MODULE_0__ = __nested_webpack_require_33544__( /*! ./browser */ "./src/js/browser.js");
                                /* harmony import */
                                var _functions__WEBPACK_IMPORTED_MODULE_1__ = __nested_webpack_require_33544__( /*! ./functions */ "./src/js/functions.js");


                                var Print = {
                                    send: function send(params, printFrame) {
                                        // Append iframe element to document body
                                        document.getElementsByTagName('body')[0].appendChild(printFrame); // Get iframe element

                                        var iframeElement = document.getElementById(params.frameId); // Wait for iframe to load all content

                                        iframeElement.onload = function () {
                                            if (params.type === 'pdf') {
                                                // Add a delay for Firefox. In my tests, 1000ms was sufficient but 100ms was not
                                                if (_browser__WEBPACK_IMPORTED_MODULE_0__["default"].isFirefox()) {
                                                    setTimeout(function () {
                                                        return performPrint(iframeElement, params);
                                                    }, 1000);
                                                } else {
                                                    performPrint(iframeElement, params);
                                                }

                                                return;
                                            } // Get iframe element document


                                            var printDocument = iframeElement.contentWindow || iframeElement.contentDocument;
                                            if (printDocument.document) printDocument = printDocument.document; // Append printable element to the iframe body

                                            printDocument.body.appendChild(params.printableElement); // Add custom style

                                            if (params.type !== 'pdf' && params.style) {
                                                // Create style element
                                                var style = document.createElement('style');
                                                style.innerHTML = params.style; // Append style element to iframe's head

                                                printDocument.head.appendChild(style);
                                            } // If printing images, wait for them to load inside the iframe


                                            var images = printDocument.getElementsByTagName('img');

                                            if (images.length > 0) {
                                                loadIframeImages(Array.from(images)).then(function () {
                                                    return performPrint(iframeElement, params);
                                                });
                                            } else {
                                                performPrint(iframeElement, params);
                                            }
                                        };
                                    }
                                };

                                function performPrint(iframeElement, params) {
                                    try {
                                        iframeElement.focus(); // If Edge or IE, try catch with execCommand

                                        if (_browser__WEBPACK_IMPORTED_MODULE_0__["default"].isEdge() || _browser__WEBPACK_IMPORTED_MODULE_0__["default"].isIE()) {
                                            try {
                                                iframeElement.contentWindow.document.execCommand('print', false, null);
                                            } catch (e) {
                                                iframeElement.contentWindow.print();
                                            }
                                        } else {
                                            // Other browsers
                                            iframeElement.contentWindow.print();
                                        }
                                    } catch (error) {
                                        params.onError(error);
                                    } finally {
                                        if (_browser__WEBPACK_IMPORTED_MODULE_0__["default"].isFirefox()) {
                                            // Move the iframe element off-screen and make it invisible
                                            iframeElement.style.visibility = 'hidden';
                                            iframeElement.style.left = '-1px';
                                        }

                                        Object(_functions__WEBPACK_IMPORTED_MODULE_1__["cleanUp"])(params);
                                    }
                                }

                                function loadIframeImages(images) {
                                    var promises = images.map(function (image) {
                                        if (image.src && image.src !== window.location.href) {
                                            return loadIframeImage(image);
                                        }
                                    });
                                    return Promise.all(promises);
                                }

                                function loadIframeImage(image) {
                                    return new Promise(function (resolve) {
                                        var pollImage = function pollImage() {
                                            !image || typeof image.naturalWidth === 'undefined' || image.naturalWidth === 0 || !image.complete ? setTimeout(pollImage, 500) : resolve();
                                        };

                                        pollImage();
                                    });
                                }

                                /* harmony default export */
                                __webpack_exports__["default"] = (Print);

                                /***/
                            }),

                        /***/
                        "./src/js/raw-html.js":
                            /*!****************************!*\
                              !*** ./src/js/raw-html.js ***!
                              \****************************/
                            /*! exports provided: default */
                            /***/
                            (function (module, __webpack_exports__, __nested_webpack_require_37311__) {

                                "use strict";
                                __nested_webpack_require_37311__.r(__webpack_exports__);
                                /* harmony import */
                                var _print__WEBPACK_IMPORTED_MODULE_0__ = __nested_webpack_require_37311__( /*! ./print */ "./src/js/print.js");

                                /* harmony default export */
                                __webpack_exports__["default"] = ({
                                    print: function print(params, printFrame) {
                                        // Create printable element (container)
                                        params.printableElement = document.createElement('div');
                                        params.printableElement.setAttribute('style', 'width:100%'); // Set our raw html as the printable element inner html content

                                        params.printableElement.innerHTML = params.printable; // Print html contents

                                        _print__WEBPACK_IMPORTED_MODULE_0__["default"].send(params, printFrame);
                                    }
                                });

                                /***/
                            }),

                        /***/
                        "./src/sass/index.scss":
                            /*!*****************************!*\
                              !*** ./src/sass/index.scss ***!
                              \*****************************/
                            /*! no static exports found */
                            /***/
                            (function (module, exports, __webpack_require__) {

                                // extracted by mini-css-extract-plugin

                                /***/
                            }),

                        /***/
                        0:
                            /*!****************************!*\
                              !*** multi ./src/index.js ***!
                              \****************************/
                            /*! no static exports found */
                            /***/
                            (function (module, exports, __nested_webpack_require_38488__) {

                                module.exports = __nested_webpack_require_38488__( /*! ./src/index.js */ "./src/index.js");


                                /***/
                            })

                        /******/
                    })["default"];
                });


                /***/
            })

        /******/
    });
    /************************************************************************/
    /******/ // The module cache
    /******/
    var __webpack_module_cache__ = {};
    /******/
    /******/ // The require function
    /******/
    function __webpack_require__(moduleId) {
        /******/ // Check if module is in cache
        /******/
        var cachedModule = __webpack_module_cache__[moduleId];
        /******/
        if (cachedModule !== undefined) {
            /******/
            return cachedModule.exports;
            /******/
        }
        /******/ // Create a new module (and put it into the cache)
        /******/
        var module = __webpack_module_cache__[moduleId] = {
            /******/ // no module.id needed
            /******/ // no module.loaded needed
            /******/
            exports: {}
            /******/
        };
        /******/
        /******/ // Execute the module function
        /******/
        __webpack_modules__[moduleId](module, module.exports, __webpack_require__);
        /******/
        /******/ // Return the exports of the module
        /******/
        return module.exports;
        /******/
    }
    /******/
    /******/ // expose the modules object (__webpack_modules__)
    /******/
    __webpack_require__.m = __webpack_modules__;
    /******/
    /************************************************************************/
    /******/
    /* webpack/runtime/chunk loaded */
    /******/
    (() => {
        /******/
        var deferred = [];
        /******/
        __webpack_require__.O = (result, chunkIds, fn, priority) => {
            /******/
            if (chunkIds) {
                /******/
                priority = priority || 0;
                /******/
                for (var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
                /******/
                deferred[i] = [chunkIds, fn, priority];
                /******/
                return;
                /******/
            }
            /******/
            var notFulfilled = Infinity;
            /******/
            for (var i = 0; i < deferred.length; i++) {
                /******/
                var [chunkIds, fn, priority] = deferred[i];
                /******/
                var fulfilled = true;
                /******/
                for (var j = 0; j < chunkIds.length; j++) {
                    /******/
                    if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
                        /******/
                        chunkIds.splice(j--, 1);
                        /******/
                    } else {
                        /******/
                        fulfilled = false;
                        /******/
                        if (priority < notFulfilled) notFulfilled = priority;
                        /******/
                    }
                    /******/
                }
                /******/
                if (fulfilled) {
                    /******/
                    deferred.splice(i--, 1)
                    /******/
                    result = fn();
                    /******/
                }
                /******/
            }
            /******/
            return result;
            /******/
        };
        /******/
    })();
    /******/
    /******/
    /* webpack/runtime/compat get default export */
    /******/
    (() => {
        /******/ // getDefaultExport function for compatibility with non-harmony modules
        /******/
        __webpack_require__.n = (module) => {
            /******/
            var getter = module && module.__esModule ?
                /******/
                () => (module['default']) :
                /******/
                () => (module);
            /******/
            __webpack_require__.d(getter, {
                a: getter
            });
            /******/
            return getter;
            /******/
        };
        /******/
    })();
    /******/
    /******/
    /* webpack/runtime/define property getters */
    /******/
    (() => {
        /******/ // define getter functions for harmony exports
        /******/
        __webpack_require__.d = (exports, definition) => {
            /******/
            for (var key in definition) {
                /******/
                if (__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
                    /******/
                    Object.defineProperty(exports, key, {
                        enumerable: true,
                        get: definition[key]
                    });
                    /******/
                }
                /******/
            }
            /******/
        };
        /******/
    })();
    /******/
    /******/
    /* webpack/runtime/hasOwnProperty shorthand */
    /******/
    (() => {
        /******/
        __webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
        /******/
    })();
    /******/
    /******/
    /* webpack/runtime/make namespace object */
    /******/
    (() => {
        /******/ // define __esModule on exports
        /******/
        __webpack_require__.r = (exports) => {
            /******/
            if (typeof Symbol !== 'undefined' && Symbol.toStringTag) {
                /******/
                Object.defineProperty(exports, Symbol.toStringTag, {
                    value: 'Module'
                });
                /******/
            }
            /******/
            Object.defineProperty(exports, '__esModule', {
                value: true
            });
            /******/
        };
        /******/
    })();
    /******/
    /******/
    /* webpack/runtime/jsonp chunk loading */
    /******/
    (() => {
        /******/ // no baseURI
        /******/
        /******/ // object to store loaded and loading chunks
        /******/ // undefined = chunk not loaded, null = chunk preloaded/prefetched
        /******/ // [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
        /******/
        var installedChunks = {
            /******/
            "/js/app": 0,
            /******/
            "css/app": 0
            /******/
        };
        /******/
        /******/ // no chunk on demand loading
        /******/
        /******/ // no prefetching
        /******/
        /******/ // no preloaded
        /******/
        /******/ // no HMR
        /******/
        /******/ // no HMR manifest
        /******/
        /******/
        __webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
        /******/
        /******/ // install a JSONP callback for chunk loading
        /******/
        var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
            /******/
            var [chunkIds, moreModules, runtime] = data;
            /******/ // add "moreModules" to the modules object,
            /******/ // then flag all "chunkIds" as loaded and fire callback
            /******/
            var moduleId, chunkId, i = 0;
            /******/
            for (moduleId in moreModules) {
                /******/
                if (__webpack_require__.o(moreModules, moduleId)) {
                    /******/
                    __webpack_require__.m[moduleId] = moreModules[moduleId];
                    /******/
                }
                /******/
            }
            /******/
            if (runtime) var result = runtime(__webpack_require__);
            /******/
            if (parentChunkLoadingFunction) parentChunkLoadingFunction(data);
            /******/
            for (; i < chunkIds.length; i++) {
                /******/
                chunkId = chunkIds[i];
                /******/
                if (__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
                    /******/
                    installedChunks[chunkId][0]();
                    /******/
                }
                /******/
                installedChunks[chunkIds[i]] = 0;
                /******/
            }
            /******/
            return __webpack_require__.O(result);
            /******/
        }
        /******/
        /******/
        var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
        /******/
        chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
        /******/
        chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
        /******/
    })();
    /******/
    /************************************************************************/
    /******/
    /******/ // startup
    /******/ // Load entry module and return exports
    /******/ // This entry module depends on other loaded chunks and execution need to be delayed
    /******/
    __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/app.js")))
    /******/
    var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/sass/app.scss")))
    /******/
    __webpack_exports__ = __webpack_require__.O(__webpack_exports__);
    /******/
    /******/
})();
