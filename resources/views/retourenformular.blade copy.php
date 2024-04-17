<html>
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600&display=swap">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">

<style type="text/css">
    <!--
    span.cls_002 {
        font-family: Arial, serif;
        font-size: 16.1px;
        color: rgb(43, 42, 41);
        font-weight: bold;
        font-style: normal;
        text-decoration: none
    }

    div.cls_002 {
        font-family: Arial, serif;
        font-size: 16.1px;
        color: rgb(43, 42, 41);
        font-weight: bold;
        font-style: normal;
        text-decoration: none
    }

    span.cls_003 {
        font-family: Arial, serif;
        font-size: 12px;
        color: rgb(43, 42, 41);
        font-weight: normal;
        font-style: normal;
        text-decoration: none
    }

    div.cls_003 {
        font-family: Arial, serif;
        font-size: 12px;
        color: rgb(43, 42, 41);
        font-weight: normal;
        font-style: normal;
        text-decoration: none
    }

    span.cls_004 {
        font-family: Arial, serif;
        font-size: 11px;
        color: rgb(43, 42, 41);
        font-weight: bold;
        font-style: normal;
        text-decoration: none
    }

    div.cls_004 {
        font-family: Arial, serif;
        font-size: 11px;
        color: rgb(43, 42, 41);
        font-weight: bold;
        font-style: normal;
        text-decoration: none
    }

    span.cls_005 {
        font-family: Arial, serif;
        font-size: 8.1px;
        color: rgb(43, 42, 41);
        font-weight: normal;
        font-style: normal;
        text-decoration: none
    }

    div.cls_005 {
        font-family: Arial, serif;
        font-size: 8.1px;
        color: rgb(43, 42, 41);
        font-weight: normal;
        font-style: normal;
        text-decoration: none
    }

    span.cls_006 {
        font-family: Arial, serif;
        font-size: 8.1px;
        color: rgb(43, 42, 41);
        font-weight: bold;
        font-style: normal;
        text-decoration: none
    }
    -->
    div.cls_006
    {
    font-family:Arial,
    serif;
    font-size:8.1px;
    color:
    rgb(43, 42, 41);
    font-weight:bold;
    font-style:normal;
    text-decoration:none
    }
    body {
    /*
    position:
    fixed;
    */
    
    width:
    100%;
    height:
    100%;
    background-image:
    url("{{public_path('images\background_retoure.png')}}");
    background-repeat:
    no-repeat;
    background-size:
    cover;
    }

</style>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 offset-md-4"><span class="cls_002">RETOURENFORMULAR</span></div>
   </div>
   <div class="row">
        <div class="mt-5"> 
        <span class="cls_003"> Hallo {{$customer}}!<br/>
        Schade, dass Du mit dem bei uns erworbenen Produkt nicht zufrieden bist.
        Hilf uns doch, dies in Zukunft zu verbessern - deine Zufriedenheit liegt uns sehr am Herzen!
        Du hast 30 Tage nach Zustellung Zeit, die Artikel zurückzusenden.</span>
        </div>
    
    </div>
    <!-- Produktliste - schleife-->
    <div class="row">
  
        <div class="table-responsive">
            <table class=" table-borderless table">
                <thead>
                    <tr>
                        <th scope="col"><span class="cls_003">POS</span></th>
                        <th scope="col"><span class="cls_003">Artikelnummer</span></th>
                        <th scope="col"><span class="cls_003">Artikel</span></th>
                        <th scope="col"><span class="cls_003">Grund</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $product )
                    <tr class="table-light">
                        <th scope="row"><span class="cls_003">{{$product['id']}}</span></th>
                        <td><span class="cls_003">{{$product['order_number']}}</span></td>
                        <td><span class="cls_003">{{$product['title']}}</span></td>
                        <td><span class="cls_003"><img src="{{public_path('images\app.jpg')}}" width=25 height=25> </span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       
        </div>
        <div class="row">
       
        {{-- Erklärung für das Retourenformular --}}
                <div class="table-responsive">
                        <table class=" table-borderless">
                                <thead>
                                <tr>
                                        <th scope="col"><span class="cls_003">ANLEITUNG</span></th>
                                        <th scope="col"><span class="cls_003">BEACHTEN</span></th>
                                        <th scope="col"><span class="cls_003">INFO</span></th>
                                        <th scope="col"><span class="cls_003">RÜCKSENDEGRUND</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                <tr class="table-light">
                                        <td class="align-top"><span class="cls_005">Wähle für die Artikel, die Du zurücksenden möchtest einen Rücksendegrund aus.<br/>Verpacke die Artikel, die Du zurücksenden möchtest sicher in unserer Originalverpackung und lege dieses Formular mit ins Paket.</span></td>
                                        <td class="align-top"><span class="cls_005">Ein Umtausch ist nur durch eine neue Online-Bestellung möglich. <br/> Die Kosten für Rücksendungen können wir leider nicht übernehmen. <br/> Sende Deine Retoure bitte an folgende Adresse:<br/>  Avatar Merchandising GmbH <br/> c/o Kerbholz <br/> Meiendorfer Mühlenweg 119 <br/> 22159 Hamburg <br/> Für den Rückversand empfehlen wir das Paket versichert zu versenden und den Beleg mit der Sendungsnummer aufzuheben.</span></td>                        
                                        <td class="align-top"><span class="cls_005">Du erhältst eine E-Mail vonuns, sobald Deine Retoure bearbeitet wurde. <br/> Die Rückzahlung erfolgt innerhalb von 7 Tagen nach Erhalt der Rücksendung auf das bei der Zahlung verwendete Konto. <br/> Bei Fragen melde Dich gerne bei unserem Customer Happiness Team unter: fraguns@kerbholz.com</span></td>                       
                                        <td class="align-top"><span class="cls_005">1 = Artikel weicht vom Foto ab <br/> 2 = Artikel gefällt mir nicht <br/> 3 = Artikel zu groß<br/>  4 = Artikel zu klein <br/> 5 = Artikel hat einen Materialfehler <br/> 6 = falscher Artikel geliefert <br/> 7 = Artikel ist zu spät eingetroffen <br/> 8 = Preis / Leistung stimmt nicht <br/> 9 = Paket beschädigt</span></td>                    </tr>
                                
                                </tbody>
                        </table>
                </div>
     
        </div>
</div>
<!--
        <div style="position:absolute;left:48.90px;top:335.14px" class="cls_004"><span class="cls_004">ANLEITUNG</span>
        </div>
        <div style="position:absolute;left:173.91px;top:335.14px" class="cls_004"><span class="cls_004">BEACHTEN</span>
        </div>
        <div style="position:absolute;left:300.48px;top:335.14px" class="cls_004"><span class="cls_004">INFO</span>
        </div>
        <div style="position:absolute;left:424.50px;top:335.14px" class="cls_004"><span
                class="cls_004">RÜCKSENDEGRUND</span></div>
        <div style="position:absolute;left:47.48px;top:357.22px" class="cls_005"><span class="cls_005">Wähle für die
                Artikel, die Du</span></div>
        <div style="position:absolute;left:173.34px;top:357.22px" class="cls_005"><span class="cls_005">Ein Umtausch ist
                nur durch</span></div>
        <div style="position:absolute;left:300.47px;top:357.22px" class="cls_005"><span class="cls_005">Du erhältst eine
                E-Mail von</span></div>
        <div style="position:absolute;left:424.49px;top:357.22px" class="cls_005"><span class="cls_005">1 = Artikel
                weicht vom Foto ab</span></div>
        <div style="position:absolute;left:47.48px;top:366.82px" class="cls_005"><span class="cls_005">zurücksenden
                möchtest einen</span></div>
        <div style="position:absolute;left:173.34px;top:366.82px" class="cls_005"><span class="cls_005">eine neue
                Online-Bestellung</span></div>
        <div style="position:absolute;left:300.47px;top:366.82px" class="cls_005"><span class="cls_005">uns, sobald
                Deine Retoure</span></div>
        <div style="position:absolute;left:424.49px;top:366.82px" class="cls_005"><span class="cls_005">2 = Artikel
                gefällt mir nicht</span></div>
        <div style="position:absolute;left:47.48px;top:376.42px" class="cls_005"><span class="cls_005">Rücksendegrund
                aus.</span></div>
        <div style="position:absolute;left:173.34px;top:376.42px" class="cls_005"><span class="cls_005">möglich.</span>
        </div>
        <div style="position:absolute;left:300.47px;top:376.42px" class="cls_005"><span class="cls_005">bearbeitet
                wurde.</span></div>
        <div style="position:absolute;left:424.49px;top:376.42px" class="cls_005"><span class="cls_005">3 = Artikel zu
                groß</span></div>
        <div style="position:absolute;left:424.49px;top:386.02px" class="cls_005"><span class="cls_005">4 = Artikel zu
                klein</span></div>
        <div style="position:absolute;left:47.48px;top:395.62px" class="cls_005"><span class="cls_005">Verpacke die
                Artikel, die</span></div>
        <div style="position:absolute;left:173.34px;top:395.62px" class="cls_005"><span class="cls_005">Die Kosten für
                Rücksendun-</span></div>
        <div style="position:absolute;left:300.47px;top:395.62px" class="cls_005"><span class="cls_005">Die Rückzahlung
                erfolgt</span></div>
        <div style="position:absolute;left:424.49px;top:395.62px" class="cls_005"><span class="cls_005">5 = Artikel hat
                einen Materialfehler</span></div>
        <div style="position:absolute;left:47.48px;top:405.22px" class="cls_005"><span class="cls_005">Du zurücksenden
                möchtest</span></div>
        <div style="position:absolute;left:173.34px;top:405.22px" class="cls_005"><span class="cls_005">gen können wir
                leider nicht</span></div>
        <div style="position:absolute;left:300.47px;top:405.22px" class="cls_005"><span class="cls_005">innerhalb von 7
                Tagen nach</span></div>
        <div style="position:absolute;left:424.49px;top:405.22px" class="cls_005"><span class="cls_005">6 = falscher
                Artikel geliefert</span></div>
        <div style="position:absolute;left:47.48px;top:414.82px" class="cls_005"><span class="cls_005">sicher in unserer
                Original-</span></div>
        <div style="position:absolute;left:173.34px;top:414.82px" class="cls_005"><span
                class="cls_005">übernehmen.</span></div>
        <div style="position:absolute;left:300.47px;top:414.82px" class="cls_005"><span class="cls_005">Erhalt der
                Rücksendung auf</span></div>
        <div style="position:absolute;left:424.49px;top:414.82px" class="cls_005"><span class="cls_005">7 = Artikel ist
                zu spät eingetroffen</span></div>
        <div style="position:absolute;left:47.48px;top:424.42px" class="cls_005"><span class="cls_005">verpackung und
                lege dieses</span></div>
        <div style="position:absolute;left:173.34px;top:424.42px" class="cls_006"><span class="cls_006">Sende Deine
                Retoure bitte</span></div>
        <div style="position:absolute;left:300.47px;top:424.42px" class="cls_005"><span class="cls_005">das bei der
                Zahlung</span></div>
        <div style="position:absolute;left:424.49px;top:424.42px" class="cls_005"><span class="cls_005">8 = Preis /
                Leistung stimmt nicht</span></div>
        <div style="position:absolute;left:47.48px;top:434.02px" class="cls_005"><span class="cls_005">Formular mit ins
                Paket.</span></div>
        <div style="position:absolute;left:173.34px;top:434.02px" class="cls_006"><span class="cls_006">an folgende
                Adresse:</span></div>
        <div style="position:absolute;left:300.47px;top:434.02px" class="cls_005"><span class="cls_005">verwendete
                Konto.</span></div>
        <div style="position:absolute;left:424.49px;top:434.02px" class="cls_005"><span class="cls_005">9 = Paket
                beschädigt</span></div>
        <div style="position:absolute;left:173.34px;top:453.22px" class="cls_006"><span class="cls_006">Avatar
                Merchandising GmbH</span></div>
        <div style="position:absolute;left:300.47px;top:453.22px" class="cls_005"><span class="cls_005">Bei Fragen melde
                Dich</span></div>
        <div style="position:absolute;left:173.34px;top:462.82px" class="cls_006"><span class="cls_006">c/o
                Kerbholz</span></div>
        <div style="position:absolute;left:300.47px;top:462.82px" class="cls_005"><span class="cls_005">gerne bei
                unserem Customer</span></div>
        <div style="position:absolute;left:173.34px;top:472.42px" class="cls_006"><span class="cls_006">Meiendorfer
                Mühlenweg 119</span></div>
        <div style="position:absolute;left:300.47px;top:472.42px" class="cls_005"><span class="cls_005">Happiness Team
                unter:</span></div>
        <div style="position:absolute;left:173.34px;top:482.02px" class="cls_006"><span class="cls_006">22159
                Hamburg</span></div>
        <div style="position:absolute;left:300.47px;top:482.02px" class="cls_005"><span
                class="cls_005">fraguns@kerbholz.com</span></div>
        <div style="position:absolute;left:173.34px;top:501.22px" class="cls_005"><span class="cls_005">Für den
                Rückversand empfeh-</span></div>
        <div style="position:absolute;left:173.34px;top:510.82px" class="cls_005"><span class="cls_005">len wir das
                Paket versichert</span></div>
        <div style="position:absolute;left:173.34px;top:520.42px" class="cls_005"><span class="cls_005">zu versenden und
                den Beleg</span></div>
        <div style="position:absolute;left:173.34px;top:530.02px" class="cls_005"><span class="cls_005">mit der
                Sendungsnummer</span></div>
        <div style="position:absolute;left:173.34px;top:539.62px" class="cls_005"><span
                class="cls_005">aufzuheben.</span></div>
        {{-- </div>
    </div>  --}}

-->
</body>

</html>
