<?php

return [
    'base_api_url' => env("BILLBEE_BASE_API_URL", null),
    'api_key' => env("BILLBEE_API_KEY", null),
    'username' => env("BILLBEE_API_USERNAME", null),
    'password' => env("BILLBEE_API_PASSWORD", null),
    'shop_ids' => [
        'b2c' => array(61275,67221,76201,100000000090735,100000000091557,100000000090282),  //ecom, avocado, selekkt, limango,cdiscount
        'b2b' => array(100000000089725,61950,85204), // b2B: 61950,TEST: 79993, API:81405
        'amazon' => array(61984),
        'reklamation' => array(62654,76305),
		'test' => array(79993)
    ],
    'eCom_pickup_Shopid' => 61275,
    'local_pickup_id' => 12, //status in Billbee to indicate pick-up instead of shipping -> Status Mahnung!
    'ProductId_international' => 161813,
    'order_state_id' => 16,
    'b2b_customer' => 61950,
    'b2b_customers_noExport' => array(23769),
    'sent_order_state_id' => 4,
    'credit_note_state_id' => 7,
    'vorkasseId' => 59,
    'stock_id' => 131,
	'stock_id_b-ware' => 132,
	'stock_id_a-ware_koeln' => 133,
	'stock_id_b-ware_koeln' => 134,
	'stock_id_B2B_plattform' => 294,
	'stock_id_safetystock' => 100000000000309,
	'fakeshopid' => 84191,
	'SellerPlatform' => "Manuell",
    'SellerShopName' => "APISHOP",
    'SellerShopId' => 84191,
    'SellerID' => "3c40a0eb-0463-4fc3-b1fd-f5f1df1a988d",
    'inventory' => "laura@kerbholz.com",
    'retourenSupport' => "retouren@kerbholz.com",
    'B2B_SellerID' => 61950,
	'B2B_acceptLossOfReturnRight' => true,
	'B2B_state' => 2, //old value for fixed order upload when variable not provided from front-end view
	'B2B_platform' => "Manuell",
	'B2B_shopName' => "Manual Order B2B",
	'B2B_id' => "3c40a0eb-0463-4fc3-b1fd-f5f1df1a988d",
    'B2B_default_stock_id' => 294,
	'B2B_dontAdjustStock' => false, 
    'RetourenLabel' => true,
    'B2B_orderUploadDefaultShopId' => 79993,
    'taxRateB2B' => 19, //in full %
    'B2BnettoUpload' => true,  //Excel PreisStück ist nettoPreis, dann true. ist bruttopreis dann false
    'stuecklisteReverseLogic' => true, //true means the stückliste and singe product SKU have the same EAN, and stückliste needs to be recursively traced back to the original product. False means logic as per billbee and stückliste is a separate EAM and reduces the original article (which is again separate SKU and EAN)
    'techSupport' => "maike@kerbholz.com",
    'sortOrdersBy' => "location"    // location, sku, ean
];
