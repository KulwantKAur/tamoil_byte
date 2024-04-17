<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="{{public_path('/bootstrap-5/css/bootstrap.css')}}" type="text/css"> 
    <link rel="stylesheet" href="{{public_path('/bootstrap-4/css/bootstrap.css')}}" type="text/css"> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


    <style type="text/css">
        <!--
        @font-face {
            font-family: FuturaStdLight;
            src: url('C:/xampp/htdocs/onomao/public/fonts/FuturaStdLight.otf');
        }

        /* .bg {
            background-image: url('file:///C:/xampp/htdocs/kerbholz/warehouse/public/images/background_retoure.png');
            background-repeat: no-repeat;
            background-size: cover;
        } */

        span.cls_001 {
            font-family: FuturaStdLight;
            font-size: 20px;
            color: rgb(43, 42, 41);
            font-weight: bold;
            font-style: normal;
            text-decoration: none;
        }

        span.cls_002 {
            font-family: FuturaStdLight, serif;
            font-size: 16px;
            color: rgb(43, 42, 41);
            font-weight: normal;
            font-style: normal;
            word-spacing: 5px;

        }

        span.cls_003 {
            font-family: FuturaStdLight;
            font-size: 16px;
            color: rgb(43, 42, 41);
            font-weight: normal;
            font-style: normal;
            text-decoration: none
        }

        tr.cls_005 {
            border-style: hidden !important;
            border-color: rgba(0, 0, 0, 0.0);
        }
        -->
        span.cls_004
        {
        font-family:FuturaStdLight;
        font-size:16px;
        color:rgb(43,42,41);
        font-weight:bold;
        font-style:normal;
        text-decoration:none;
        }
        table {
        width:90%!important;
        margin:auto !important;
        }
        .onomaologo{
            margin:100px 0 -10px 0;
        }
        /* .onomaologo img{
            display:block;
        } */
        .qnty_col{
            width:90px;
        }
        .reason_col{
            width:70px;
        }
        .artical_number_col {
            width:calc(50% - 90px);
        }
        .artical_return_col{
            width:calc(50% - 70px);
        }
		
    </style>
</head>

<body class="bg">
     <div class="row">
        <div class="col-md-12 mb-2 d-flex justify-content-center onomaologo">
                <img src="{{public_path('/images/onomaologo.jpg')}}" heigth="50" width="160">
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5 ml-5">
        
                    <span class="cls_001 mainHeading"> DELIVERY NOTE AND RETURN FORM</span><br>
                   
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3 ml-5">
          
                    <span class="cls_002"> Hallo @if(isset($customer)){{$customer}}@else{{'TEST'}}@endif!<br />
                    Thank you very much for your order. We hope you will enjoy your onomao products.<br>
                    If you are not satisfied for any reason, please fill out this form and attach it to your return shipment <br> 
					so that we can identify your returned products. Below you will find a small guide to make sure that everything works <br> and that your
your money can be refunded.</span>
                </div>
                </div>
        
      
           
    

        <div class="row">
            <div class="col-md-12 mt-5">
                <table class="table-sm">
                    <thead>
                        <tr class="cls_005">

                            <!-- <th scope="col"><span class="cls_004">POS</span></th> -->
                            <th scope="col" class="artical_number_col" style="text-align:left"><span class="cls_004">PRODUCT NUMBER</span></th>
                            <th scope="col" class="artical_return_col" style="text-align:left"><span class="cls_004">PRODUCT</span></th>
                            <th scope="col" class="qnty_col" style="text-align:center;padding-left:25px; padding-right:25px;"><span class="cls_004">AMOUNT</span></th>
                            <th scope="col" class="reason_col" style="text-align:center"><span class="cls_004">REASON</span></th>

                        </tr>
                    </thead>
                    <tbody>
						@if(isset($data))
                        @foreach ($data as $product )
                        <tr class="table-light cls_005">
                            <!-- <th scope="row"><span class="cls_002">{{$product['id']}}</span></th> -->
                            <td><span class="cls_002">{{$product['order_number']}}</span></td>
                            <td><span class="cls_002">{{$product['title']}}</span></td>
                            <td style="text-align:center">_____</td>
                            <td style="text-align:center">_____</td>
                        </tr>
                        @endforeach
						@endif
                    </tbody>
                </table>
            </div>
        </div>
   
        <br />
        <br />
        {{-- Erklärung für das Retourenformular--}}
        <div>
            <table class="table">
                <thead>
                    <tr class="cls_005">
                        <th scope="col" style="text-align:left" width="30%"><span class="cls_002"><strong>INSTRUCTIONS</strong></span></th>
                        <th scope="col" style="text-align:left" width="30%"><span class="cls_002"><strong>IMPORTANT</strong></span></th>
                        <th scope="col" style="text-align:left" width="30%"><span class="cls_002"><strong>RETURN REASONS</strong></span></th>
                 
                    </tr>
                </thead>
                <tbody>
                    <tr class="cls_005">
                        <td  style="background-color: rgba(0,0,0,0.0);" width="30%"><span class="cls_003">
                                <ol style="padding-left:22px;">
                                    <li>Enter the quantity of the items you wish to return and the reason in the table above.</li>
                                    <li>Pack the items you want to return securely in our original packaging and include this form in the box.</li>
                                    
                                    <li>Send your return to the following address:
                                        <br /><br />
                                        owl oneworldlogistics GmbH<br />
                                        c/o onomao<br />
                                        Ettore-Bugatti-Straße 39<br />
                                        51149 Köln<br />
                                        Germany<br />
                                    </li>
                                </ol>
                          
                                 </span></td>
                        <td class="align-top" style="background-color: rgba(0,0,0,0.0);" width="30%"><span class="cls_003">Please make sure that your return shipment is sufficiently stamped. Follow all the steps as outlined in the instructions to ensure that we can identify your shipment and that SHOPLIKEYOUGIVEADAMN can refund your money. We recommend that you keep the shipment receipt with the tracking number until you receive your refund from SHOPLIKEYOUGIVEADAMN. If you have any questions, please contact our customer service at: help@onomao.com
                                </span></td>
                        <td class="align-top" style="background-color: rgba(0,0,0,0.0);" width="30%">
                            <span class="cls_003">
                            <ol type="A"  style="padding-left:22px;">
                                <li>I don’t like the product.</li>
                                <li>Product is bigger/smaller than I expected.</li>
                                <li>Product does not correspond to the the images in the online store.</li>
                                <li>I don’t like the color.</li>
                                <li>I don’t like the material.</li>
                                <li>The product is damaged.</li>
                                <li>Wrong product delivered.</li>
                            </ol>
                 
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>
            <br />
            <div style="position:absolut; top:50px;" class="ml-5">
                <?='<img src="data:image/png;base64,' . DNS1D::getBarcodePNG((isset($id))?$id:'00000000', "C39", 1, 50) . '" alt="barcode" width="200"   />'?>
                
            </div>
            <div style="position:absolut; top:50px; font-family: FuturaStdLight;" class="ml-5">
            <span style="font-family: FuturaStdLight;">@if(isset($ordernumber)){{$ordernumber}}@else{{'#0123456'}}@endif</span>
            </div>
        </div>
    </div>
</body>

</html>
