<html>

<head>
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


    <style type="text/css">
        <!--
        @font-face {
            font-family: GothamNarrow-Light;
            src: url('file:///C:/xampp/htdocs/testWarehouse/public/fonts/GothamNarrow-Light.ttf');
        }

        .bg {
            background-image: url('file:///C:/xampp/htdocs/testWarehouse/public/images/background_retoure.png');
            background-repeat: no-repeat;
            background-size: cover;
        }

        span.cls_001 {
            font-family: GothamNarrow-Light;
            font-size: 16.1px;
            color: rgb(43, 42, 41);
            font-weight: bold;
            font-style: normal;
            text-decoration: none;
        }

        span.cls_002 {
            font-family: GothamNarrow-Light, serif;
            font-size: 12px;
            color: rgb(43, 42, 41);
            font-weight: normal;
            font-style: normal;
            word-spacing: 5px;

        }

        span.cls_003 {
            font-family: GothamNarrow-Light;
            font-size: 10px;
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
        font-family:GothamNarrow-Light;
        font-size:12px;
        color:rgb(43,42,41);
        font-weight:bold;
        font-style:normal;
        text-decoration:none;
        }
        table {
        width:90%!important;
        margin:auto !important;
        }

    </style>
</head>

<body class="bg">
    <div class="container">
        <br /> <br /><br /><br />
        <div class="mt-5 ml-5"><span class="cls_001"> RETOURENFORMULAR</span><br>
        <span class="cls_002">Zu Deiner Bestellung {{$ordernumber}}</span>
		</div>
        <div class="mt-3 ml-5">
            <span class="cls_002"> Hallo {{$customer}}!<br />
                Schade, dass Du mit dem bei uns erworbenen Produkt nicht zufrieden bist.<br>
                Hilf uns doch, dies in Zukunft zu verbessern - Deine Zufriedenheit liegt uns sehr am Herzen!<br>
                Du hast 30 Tage nach Zustellung Zeit, die Artikel zurückzusenden.</span>
        </div>
        <br />
        <!-- Produktliste - schleife-->
    <div>
<!-- 
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 ">
                    <span class="cls_004">Artikelnummer</span>
				</div>
                <div class="col-md-4 ">
                    <span class="cls_004">Artikel</span>
				</div>
                <div class="col-md-4 ">
                    <span class="cls_004">Grund</span>
				</div>
        </div>
         @foreach ($data as $product )
        <div class="row">
                    <div class="col-md-4">
                    <span class="cls_002">{{$product['order_number']}}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="cls_002">{{$product['title']}}</span>
                    </div>
                    <div class="col-md-4">
                        <span class="cls_002">{{$product['title']}}</span>
                    </div>
                </div>
        @endforeach
    </div> -->

           
    

        <div class="row">
            <div class="col-md-12">
            <table class="table-sm">
                <thead>
                    <tr class="cls_005">

                        <!-- <th scope="col"><span class="cls_004">POS</span></th> -->
                        <th scope="col" style="text-align:left"><span class="cls_004">ARTIKELNUMMER</span></th>
                        <th scope="col" style="text-align:left"><span class="cls_004">ARTIKEL</span></th>
                        <th scope="col" style="text-align:right"><span class="cls_004">GRUND</span></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $product )
                    <tr class="table-light cls_005">
                        <!-- <th scope="row"><span class="cls_002">{{$product['id']}}</span></th> -->
                        <td><span class="cls_002">{{$product['order_number']}}</span></td>
                        <td><span class="cls_002">{{$product['title']}}</span></td>
                        <td style="text-align:right"><img src="C:\xampp\htdocs\testWarehouse\public\images\box.png" height="30"> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
        <br />
        <br />
        {{-- Erklärung für das Retourenformular--}}
        <div>
            <table class="table">
                <thead>
                    <tr class="cls_005">
                        <th scope="col"><span class="cls_002 "><strong>ANLEITUNG</strong></span></th>
                        <th scope="col"><span class="cls_002"><strong>WICHTIG</strong></span></th>
                        <th scope="col"><span class="cls_002"><strong>INFO</strong></span></th>
                        <th scope="col"><span class="cls_002"><strong>RÜCKSENDEGRUND</strong></span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="cls_005">
                        <td  style="background-color: rgba(0,0,0,0.0);"><span class="cls_003">Wähle für
                                die Artikel, die Du<br /> zurücksenden möchtest einen <br />Rücksendegrund aus.<br /><br />Verpacke
                                die Artikel, die Du <br />zurücksenden möchtest sicher in<br /> unserer Originalverpackung und lege
                                <br />dieses Formular mit ins Paket.<br />Die Kosten für die Rücksendung<br /> können wir leider nicht übernehmen.<br /><br /> <strong>Sende Deine Retoure bitte <br />an folgende Adresse:</strong><br /><br /><strong>
                                    Avatar Merchandising GmbH <br /> c/o Kerbholz <br /> Meiendorfer Mühlenweg 119
                                    <br /> 22159 Hamburg </strong><br /></span></td>
                        <td class="align-top" style="background-color: rgba(0,0,0,0.0);"><span class="cls_003">Ein
                                Umtausch ist nur durch eine neue <br /> Online-Bestellung möglich. <br /><br /> Wir empfehlen Dir
                                den Beleg mit <br />der Sendungsnummer aufzuheben, bis Du <br /> die Rückerstattung von
                                uns erhalten hast<br /> und wir den Erhalt der Rücksendung bestätigt haben.<br /> </span></td>
                        <td class="align-top" style="background-color: rgba(0,0,0,0.0);"><span class="cls_003">Du
                                erhältst eine E-Mail von uns,<br /> sobald Deine Retoure bearbeitet wurde.<br /><br />Die
                                Rückzahlung erfolgt innerhalb von<br /> 7 Tagen nach Erhalt der Rücksendung <br />auf das bei der
                                Zahlung verwendete Konto. <br /><br /> Bei Fragen melde Dich gerne bei<br /> unserem
                                Kundensupport unter:<br /> fraguns@kerbholz.com</span></td>
                        <td class="align-top" style="background-color: rgba(0,0,0,0.0);"><span class="cls_003">1 =
                                Artikel weicht vom Foto ab <br /> 2 = Artikel gefällt mir nicht <br /> 3 = Artikel zu
                                groß<br /> 4 = Artikel zu klein <br /> 5 = Artikel hat einen Materialfehler <br /> 6 =
                                falscher Artikel geliefert <br /> 7 = Artikel ist zu spät eingetroffen <br /> 8 = Preis
                                / Leistung stimmt nicht <br /> 9 = Paket beschädigt</span></td>
                    </tr>

                </tbody>
            </table>
            <br />
            <div style="position:absolut; top:50px;" class="ml-5">
                <?=
                               '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($id, "C39", 1, 50) . '" alt="barcode" width="200"   />'
                        ?>
            </div>
        </div>
    </div>
</body>

</html>
