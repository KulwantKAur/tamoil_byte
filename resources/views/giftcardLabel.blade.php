<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


    <style type="text/css">
        
       @font-face {
            font-family: GothamNarrow-Light;
            src: url('file:///C:/xampp/htdocs/testWarehouse/public/fonts/GothamNarrow-Light.ttf');
        }

         @font-face {
            font-family: GothamNarrow-Bold;
            src: url('file:///C:/xampp/htdocs/testWarehouse/public/fonts/GothamNarrow-Bold.otf');
        }
        
        @font-face {
         font-family: DINOT-Light;
            src: url('file:///C:/xampp/htdocs/testWarehouse/public/fonts/DINOT-Light.otf');
        }
        /* .bg {
            background-image: url('file:///C:/xampp/htdocs/kerbholz/warehouse/public/images/background_retoure.png');
            background-repeat: no-repeat;
            background-size: cover;
        } */

        span.cls_001 {
            font-family: GothamNarrow-Bold;
            font-size: 42pt;
            color: rgb(43, 42, 41);
            font-weight: bold;
            font-style: normal;
            text-decoration: none;
        }

        span.cls_002 {
            font-family: GothamNarrow-Bold;
            font-size: 16pt;
            color: rgb(43, 42, 41);
            font-weight: normal;
            font-style: normal;
        }

        span.cls_003 {
            font-family: DINOT-Light;
            font-size: 16pt;
            color: rgb(43, 42, 41);
            font-weight: normal;
            font-style: normal;
            text-decoration: none
        }

        
    
        span.cls_004
        {
        font-family:GothamNarrow-Light;
        font-size:12px;
        color:rgb(43,42,41);
        font-weight:bold;
        font-style:normal;
        text-decoration:none;
        }
        table {
        width:100%!important;
        margin:auto !important;
        }


        .page {
            width: 10.2cm;
            min-height: 15.5cm;
            padding: 0cm;
            margin: auto;
            page-break-after: always;
            page-break-inside: avoid;
        }


    </style>
</head>

<body class="page">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
        
                <div class="row">			
                    <div class="col-12">
                        <span class="cls_003">{{$shippingName}}<br /></span>
                    </div>
                </div>
                <div class="row">			
                    <div class="col-12">
                        <span class="cls_003">{{$shippingStreet}}<br /></span>
                    </div>
                </div>
                <div class="row">			
                    <div class="col-12">
                        <span class="cls_003">{{$shippingCity}}<br /></span>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
</body>

</html>
