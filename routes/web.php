<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Retourenformular;

Auth::routes();
Route::get('/', 'Home\HomeController@index')->name('home');
Route::get('/setShopId/{shopId}', 'Home\HomeController@setShopId');
Route::middleware('throttle:1,0.06')->group(function () {
    Route::get('/orders/{$shopId}', 'Orders\OrderController@index')->middleware('can:Orders');
    Route::resource('/orders', 'Orders\OrderController')->middleware('can:Orders');
    Route::get('/localpickup', 'Orders\OrderController@pickupindex')->middleware('can:Orders');
});

//new Menu
Route::get('/menu/{pickliste}', 'Orders\OrderController@indexMenu')->middleware('can:Orders');

//Bestellungen Syncronisieren 
Route::get('/sync', 'Orders\OrdersyncController@sync')->middleware('can:InventoryAdmin');
Route::get('/b2bsync', 'B2B\B2BOrdersyncController@sync')->middleware('can:B2BSync'); 
Route::get('/b2bsyncindex', 'B2B\B2BsyncController@index')->middleware('can:B2BSync');
// Alle Rollen
Route::get('/quality', 'Quality\QualityController@index')->middleware('can:Quality');
Route::get('/quality/{invoiceNumber}', 'Quality\QualityController@getOrderByInvoice')->middleware('can:Quality');
Route::get('/quality/finish/{invoiceNumber}', 'Quality\QualityController@finishOrder')->middleware('can:Quality');
Route::post('/quality/shipping/{invoiceNumber}', 'Quality\QualityController@createNewShipping')->middleware('can:Quality');
//Neues Quality
Route::get('/qualitynew', 'Quality\QualityNewController@index')->middleware('can:Quality');
Route::get('/qualitynew/{invoiceNumber}', 'Quality\QualityNewController@getOrderByInvoice')->middleware('can:Quality');
Route::get('/qualitynew/shipping/{invoiceNumber}', 'Quality\QualityNewController@createNewShipping')->name('newshippingget')->middleware('can:Quality');
Route::post('/qualitynew/shipping/{invoiceNumber}', 'Quality\QualityNewController@createNewShipping')->name('newshipping')->middleware('can:Quality');
Route::post('/qualitynew/print/{invoiceNumber}', 'Quality\QualityController@printOrder')->middleware('can:Quality');
// Mehrpacket (Alle Rollen)
Route::get('/multibox', 'Quality\MultiboxController@index')->middleware('can:Quality');
Route::get('/multibox/{invoiceNumber}', 'Quality\MultiboxController@getOrderByInvoice')->middleware('can:Quality');
Route::get('/multibox/boxes/{box_ean}', 'Quality\MultiboxController@getBox')->middleware('can:Quality');
Route::post('/multibox/shipping/{invoiceNumber}', 'Quality\MultiboxController@createNewShipping')->middleware('can:Quality');

//Deaktiviert
Route::get('/shipment', 'Shipping\ShipmentController@index');
Route::get('/shipment/{fromDate}/{toDate}', 'Shipping\ShipmentController@getByDate');
Route::get('/shipment/shipping/{fromDate}/{toDate}', 'Shipping\ShipmentController@createNewShipping');
//Wahreneingang (Service und Costumer Support)
Route::get('/receipt', 'Receipt\ReceiptController@index')->middleware('can:ReceiptB2X');
Route::get('/receipt/inbound', 'Receipt\ReceiptController@inbound')->middleware('can:ReceiptInbound');
Route::get('/receipt/b2creturn', 'Receipt\ReceiptController@b2creturn')->middleware('can:ReceiptB2X');
Route::get('/receipt/b2creturnjnj', 'Receipt\ReceiptController@b2creturnjnj')->middleware('can:ReceiptB2X');
Route::get('/receipt/b2breturn', 'Receipt\ReceiptController@b2breturn')->middleware('can:ReceiptB2X');
Route::get('/receipt/wareneingang', 'Receipt\ReceiptController@wareneingang')->middleware('can:ReceiptInbound');
Route::get('/receipt/recycle', 'Receipt\ReceiptController@recycle')->middleware('can:ReceiptInbound');
Route::get('/receipt/umbuchen', 'Receipt\ReceiptController@umbuchen')->middleware('can:ReceiptInbound');
Route::get('/receipt/product/{ean}', 'Receipt\ReceiptController@getProductByEan')->middleware('can:ReceiptB2X');
Route::post('/receipt/stockcode/update', 'Receipt\ReceiptController@updateProductStockCode')->middleware('can:InventoryChange');
Route::post('/receipt/stockcodeupdate', 'Receipt\ReturnController@updateProductStockCode')->middleware('can:InventoryChange');
Route::get('/receiptexport', 'Receiptexport\ReceiptExportController@index')->middleware('can:InventoryAdmin');
Route::post('/receiptexport', 'Receiptexport\ReceiptExportController@export')->middleware('can:InventoryAdmin');
Route::get('/receipt/return', 'Receipt\ReturnController@index')->middleware('can:ReceiptB2X');
Route::get('/receipt/{invoiceNumber}', 'Receipt\ReturnController@getOrderByInvoice')->middleware('can:ReceiptB2X');
Route::get('/receipt/return/{orderNumber}', 'Receipt\ReturnController@getOrderByorderNumber')->middleware('can:ReceiptB2X');
//Bestand(für jeden sichtbar)
// Route::get('/inventory', function () {
//     return view('inventory.details')->with('products');
// });
// Route::get('inventory','InventoryController@index')->middleware('can:Lager');
//Route::any('inventorys', 'InventoryController@index')->name('inventorys')->middleware('can:Lager');
Route::resource('/inventory', 'Inventory\InventoryController')->except(['destroy', 'create', 'store', 'show'])->middleware('can:Inventory');
Route::any('/inventory_csv', 'Inventory\InventoryController@inventory_csv')->name('inventory_csv')->middleware('can:Inventory');
//für Max
Route::any('/inventorysComplete', 'Inventory\InventoryController@indexComplete')->name('inventorysComplete')->middleware('can:Inventory');
Route::view('/inventoryComplete', 'inventory.detailsComplete')->name('inventoryComplete')->middleware('can:Inventory');
Route::any('/inventoryComplete/{ean}', 'Inventory\InventoryController@getCompleteProductAndEan')->middleware('can:Inventory');
//Überprüfen
Route::get('/inventory/{ean}', 'Inventory\InventoryController@getProductAndEan');
Route::post('/export', 'Inventory\InventoryController@export')->name('export');

//Route::get('importExportView', 'InventoryController@importExportView');
//ShippingLable print again (Für Alle)
Route::get('/shipment-print-again', 'Shipping\ShipmentController@shipmentPrintAgain')->middleware('can:Quality');
Route::get('/printAgain/{invoiceNumber}', 'Shipping\ShipmentController@printAgain')->middleware('can:Quality');
Route::get('/printAgainBase64/{invoiceNumber}', 'Shipping\ShipmentController@printAgainBase64')->middleware('can:Quality');
//Finance (Admin und Costumer Support)
Route::prefix('finance')->middleware('can:Finance')->group(function () {
    Route::get('/', 'Finance\FinanceController@index')->name('finance');
    Route::post('export-csv', 'Finance\FinanceController@exportCsv')->name('exportCsv');
    Route::match(['get', 'post'], '/set-payment-limit', 'Finance\FinanceController@setPaymentLimit')->name('setPaymentLimit');
    Route::match(['get', 'post'], '/manualExport', 'Finance\FinanceController@manualExport')->name('manualExport');
    Route::get('/download-csv/{type}', 'Finance\FinanceController@downloadCsv')->name('downloadCsv');
});
//Reklamation (Admin und Costumer Support)
Route::prefix('reklaportal')->middleware('can:Finance')->group(function () {
    Route::get('/', 'Reklaportal\ReklaportalController@index')->name('home_reklaportal');
    Route::get('/service', 'Reklaportal\ReklaportalController@service')->name('service');
    Route::post('/getOrderData', 'Reklaportal\ReklaportalController@getOrderData')->name('getOrderData');
    Route::post('/sendCustomerSupportMail', 'Reklaportal\ReklaportalController@sendCustomerSupportMail')->name('sendCustomerSupportMail');
    Route::post('/retoure', 'Reklaportal\ReklaportalController@retoure')->name('retoure');
});
//Route für das User Management
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:UserAdmin')->group(function () {
    Route::resource('/users', 'UsersController')->except(['create', 'store', 'show']);
});
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:User')->group(function () {
    Route::get('/druckereinstellungen', 'UsersController@drucker')->name('druckereinstellungen');
    Route::get('/druckerupdate/{user}', 'UsersController@druckerupdate')->name('druckerupdate');
});
//Retourenform
Route::get('/retourenform', 'RetourenformularController@index')->name('retourenform')->middleware('can:Quality');
//Giftcard
Route::get('/giftcardprint/{orderId}', 'Payout\giftcardController@card')->name('giftcardprint')->middleware('can:Quality');
Route::get('/giftcardprint/close/{orderId}', 'Payout\giftcardController@close')->name('giftcardprint/close')->middleware('can:Quality');
Route::get('/giftcard', 'Payout\giftcardController@index')->middleware('can:Admin');

//Repairlabel
Route::get('/repair', 'RepairlabelController@index')->name('repair')->middleware('can:Quality');
Route::get('/repairlabel/{orderId}', 'RepairlabelController@getOrderbyOrdernumber')->name('repairlabel')->middleware('can:Quality');
//B2B Form
Route::get('/b2borderform', function () {
    return view('b2b.b2borderform')->with('orderdata')->with('splitorderdata');
})->middleware('can:B2BUpload');
Route::get('b2borderform', 'B2B\B2bController@index')->middleware('can:B2BUpload');
Route::post('b2buploadorder', 'B2B\B2bController@upload')->middleware('can:B2BUpload');
Route::post('b2bconfirmorder', 'B2B\B2bController@confirm')->middleware('can:B2BUpload');
//upload Form
Route::get('uploadForm', 'ExcelController@index');
Route::post('uploadData', 'ExcelController@importFile2');
//Import Form
Route::get('/import', 'ExcelController@importFile')->middleware('can:Lager');
Route::post('/import', 'ExcelController@importExcel')->middleware('can:Lager');
//Payout
Route::get('/payout', 'Payout\payoutController@index')->middleware('can:Finance');
Route::post('/payout', 'Payout\payoutController@payout')->middleware('can:Finance');



Route::get('/stasi', 'StasiController@index')->middleware('can:UserAdmin');
Route::post('/stasi', 'StasiController@export')->middleware('can:UserAdmin');
Route::post('/stasiid', 'StasiController@idInput')->middleware('can:UserAdmin');
Route::get('/stasi/{orderId}', 'StasiController@resetId')->middleware('can:UserAdmin');


Route::get('/eanignorelist', 'eanIgnoreList\eanIgnoreListController@index')->middleware('can:UserAdmin');
Route::post('/eanignorelist/add', 'eanIgnoreList\eanIgnoreListController@add')->middleware('can:UserAdmin');
Route::get('/eanignorelist/{ean}', 'eanIgnoreList\eanIgnoreListController@remove')->middleware('can:UserAdmin');

Route::get('/configuration', 'Configuration\ConfigurationController@index')->middleware('can:UserAdmin');
Route::get('/configuration/shopid', 'Configuration\ConfigurationController@shopid')->middleware('can:UserAdmin');
Route::post('/configuration/shopid/add/', 'Configuration\ConfigurationController@shopidAdd')->middleware('can:UserAdmin');
Route::get('/configuration/shopid/remove/{shopid}', 'Configuration\ConfigurationController@shopidRemove')->middleware('can:UserAdmin');
Route::get('/configuration/shopid/change/{shopid}', 'Configuration\ConfigurationController@shopidChange')->middleware('can:UserAdmin');
Route::any('/configuration/shopid/change', 'Configuration\ConfigurationController@shopidChangeApply')->middleware('can:UserAdmin');

Route::get('/configuration/lagerid', 'Configuration\ConfigurationController@lagerid')->middleware('can:UserAdmin');
Route::post('/configuration/lagerid/discover', 'Configuration\ConfigurationController@lageridDiscover')->middleware('can:UserAdmin');
Route::post('/configuration/lagerid/add', 'Configuration\ConfigurationController@lageridAdd')->middleware('can:UserAdmin');
Route::get('/configuration/lagerid/remove/{lagerid}', 'Configuration\ConfigurationController@lageridRemove')->middleware('can:UserAdmin');
Route::get('/configuration/printer', 'Configuration\ConfigurationController@printer')->middleware('can:UserAdmin');
Route::get('/configuration/printer/addPrinter/{printerid}', 'Configuration\ConfigurationController@printerAddPrinter')->middleware('can:UserAdmin');
Route::get('/configuration/printer/addLabel/{printerid}', 'Configuration\ConfigurationController@printerAddLabel')->middleware('can:UserAdmin');
Route::get('/configuration/printer/removePrinter/{printerid}', 'Configuration\ConfigurationController@printerRemovePrinter')->middleware('can:UserAdmin');
Route::get('/configuration/printer/removeLabel/{printerid}', 'Configuration\ConfigurationController@printerRemoveLabel')->middleware('can:UserAdmin');
Route::get('/configuration/printer/renamePrinter/{printerid}', 'Configuration\ConfigurationController@printerRenamePrinter')->middleware('can:UserAdmin');
Route::get('/configuration/printer/renameLabel/{printerid}', 'Configuration\ConfigurationController@printerRenameLabel')->middleware('can:UserAdmin');
Route::any('/configuration/printer/renamePrinter', 'Configuration\ConfigurationController@printerRenameLabelApply')->middleware('can:UserAdmin');


Route::get('/configuration/general', 'Configuration\ConfigurationController@general')->middleware('can:UserAdmin');
Route::post('/configuration/general/update', 'Configuration\ConfigurationController@generalUpdate')->middleware('can:UserAdmin');

Route::get('/retourenformlimango', 'RetourenformularController@indexLimango')->middleware('can:Admin');


Route::get('/orderstatus', 'Orders\OrderStatusController@indexStatus')->middleware('can:Admin');
Route::get('/lifosort', 'Orders\OrderStatusController@LIFOSort')->middleware('can:Admin')->name('lifosort');
Route::get('/fifosort', 'Orders\OrderStatusController@FIFOSort')->middleware('can:Admin');
Route::get('/filltratesort', 'Orders\OrderStatusController@makeSort')->middleware('can:Admin');
Route::post('/orderstatus/{id}', 'Orders\OrderStatusController@backlogOrder')->middleware('can:Admin');