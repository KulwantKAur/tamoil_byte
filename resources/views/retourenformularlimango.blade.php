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
		

        .page {
            background-image: url('file:///C:/xampp/htdocs/testWarehouse/public/images/background_retoure_limango.png');
            background-repeat: no-repeat;
            background-size: cover;
        }

        span.cls_001 {
            font-family: GothamNarrow-Light;
            font-size: 30.1px;
            color: rgb(43, 42, 41);
            font-weight: bold;
            font-style: normal;
            text-decoration: none;
        }

        span.cls_002 {
            font-family: GothamNarrow-Light, serif;
            font-size: 20px;
            color: rgb(43, 42, 41);
            font-weight: normal;
            font-style: normal;
            word-spacing: 5px;

        }

        span.cls_003 {
            font-family: GothamNarrow-Light;
            font-size: 20px;
            color: rgb(43, 42, 41);
            font-weight: normal;
            font-style: normal;
            text-decoration: none
        }

        tr.cls_005 {
            border-style: hidden !important;
            border-color: rgba(0, 0, 0, 0.0);
        }
    
        span.cls_004
        {
        font-family:GothamNarrow-Light;
        font-size:20px;
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



<body class="page">
<div class="container-fluid">
    <div class="row mt-5 mr-4 ">
        <div class="col-md-12">
			
				<p> </p>
			
		</div>
    </div>
    <div class="row mt-5 mr-4 ">
        <div class="col-md-12">
			
				<p> </p>
			
		</div>
    </div>
	<div class="row mt-5 mr-4 ">
		<div class="col-md-4">
			
				
			
		</div>
		<div class="col-md-4 text-center">
			  
		</div>
		<div class="col-md-4 text-right">
			<img  src="file:///C:/xampp/htdocs/testWarehouse/public/images/limango.jpg" height="48">
		</div>
	</div>
    <div class="row mr-4 pt-10 pl-5">
		<div class="col-md-12 mt-1">
            <span class="cls_001">LIEFERSCHEIN</span><br>
            <span class="cls_002">Zu Deiner Bestellung {{$ordernumber}}</span>
        </div>
	</div>
	<div class="row mt-4 pl-5">
		<div class="col-md-12">
			<span class="cls_002"> Hallo {{$customer}}!<br />
                    Bei Retouren bitte diesen Lieferschein (oder eine Kopie) beilegen.<br>
                    Deine Bestellung wurde von dem limango Partner KERBHOLZ verschickt.<br>
                    Zahlungsdienstleister ist Limango. Bei Rückfragen zu Deiner Zahlung, wende dich bitte an Limango.<br>
                    </span>
		</div>
	</div>
	<div class="row mt-4 pl-5">
		<div class="col-md-12 text-right d-flex justify-content-center">
                <table class="table-sm">
                    <thead>
                        <tr class="cls_005">

                           
                            <th scope="col" style="text-align:left"><span class="cls_004">ARTIKELNUMMER</span></th>
                            <th scope="col" style="text-align:left"><span class="cls_004">ARTIKEL</span></th>
                            <th scope="col" style="text-align:right"><span class="cls_004">GRUND</span></th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $product )
                        <tr class="table-light cls_005">
                            
                            <td><span class="cls_002">{{$product['order_number']}}</span></td>
                            <td><span class="cls_002">{{$product['title']}}</span></td>
                            <td style="text-align:right"><img src="C:/xampp/htdocs/testWarehouse/public/images/box.png" height="30"> </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
		</div>
	</div>
	<div class="row mt-1 pl-5 pr-5">
		<div class="col-md-12 ">
			<span class="cls_003">Bitte wähle den Rücksendegrund aus:<br>
                        1 = Artikel gefällt nicht | 2 = Artikel zu groß (weit / lang)* | 3 = Artikel zu klein (eng / kurz)* | 4 = zu spät geliefert | 5 = falscher Artikel geliefert | 
                        6 = Artikel anders als beschrieben / abgebildet | 7 = Auswahlbestellung | 8 = Artikel beschädigt | 9 = sonstige </span">
		</div>
	</div>
	<div class="row  mt-5 pl-5 pr-5">
		<div class="col-md-12">
			 <span class="cls_003">
                        Du hast die Möglichkeit, Artikel ohne Angabe von Gründen, innerhalb von 14 Tagen kostenlos an unseren Partner KERBHOLZ zurückzusenden. Der Versand Deiner Bestellung erfolgte nicht durch limango, sondern durch unseren Partner KERBHOLZ. Aus diesem Grund kannst Du deine Rücksendung leider nicht über Dein Kundenkonto anmelden.
                        <br>Bitte sende den Partnerartikel nicht an limango, sondern immer direkt an KERBHOLZ zurück. Befolge dazu folgende Schritte:
                        <li>Lege den Partnerartikel in das Versandpaket.</li>
                        <li>Teile mit, welche(n) Artikel Du zurücksendest und trage die Menge(n) und die Nummer(n) des Rücksendegrundes ein.</li>
                        <li>Lege den Lieferschein (oder eine Kopie) der Rücksendung bei.</li>
                        <li>Verschließe das Paket sicher und drucke Dir ein Rücksendeetikett auf www.kerbholz.com/retoure aus. Klebe es auf das Paket und bring es zur nächsten DHL Station.</li>
                        <li>Lass dir die Einlieferung der Rücksendung quittieren und bewahre diesen Beleg für Rückfragen gut auf.</li>
                        <br>
                        Sobald die Rücksendung bei KERBHOLZ eingetroffen ist, werden wir Dir den entsprechenden Zahlungsbetrag auf das von Dir angegebene Zahlungsmittel zurückerstatten. Bei einer fälschlichen Rücksendung an limango kann es zu starken Verzögerungen bei der Erstattung des Kaufpreises kommen.
                        <br>Bei Verlust des Retouren-Etiketts kontaktiere bitte: marktplatz_service@limango.de
                </span>
		</div>
	</div>
    <div class="row mt-5 pl-5">
		<div class="col-md-12 ">

           <?=
                '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($id, "C39", 1, 50) . '" alt="barcode" width="200"   />'
                ?>
		</div>
	</div>

</div>

</body>



        
   
                           

           
    
                   
                </div>
            </div>
        <div>
    
    
</body> 

</html>
