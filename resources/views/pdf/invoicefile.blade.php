<!DOCTYPE html>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<title>onamo</title>
</head>
<body>
	<div class="container-fluid">
		<center><h1>ono<br>mao</h1></center>

        <div class="row">
            <div class="col">
                <address>
                {{$invoiceAddress['firstName']}} {{$invoiceAddress['lastName']}}<br>
                {{$invoiceAddress['street']}}, {{$invoiceAddress['houseNumber']}}<br>
                {{$invoiceAddress['zip']}}, {{$invoiceAddress['city']}}<br>
                {{$invoiceAddress['country']}}
                </address>
            </div>
        </div>	
        <div class="row">
			<div class="col-md-6">
			Handelsrechnung: {{$id}}<br>
			Bestellnummer: {{isset($invoiceNumber) ? $invoiceNumber : ''}} - {{$matrix[0]['Box']}}
			</div>
            <div class="col-md-6" style="text-align:right">
            Rechnungsdatum: {{substr($invoiceDate['date'], 0, 10)}}
            </div>
        </div>
		<!--div class="row">
			<div class="col-md-6">
				In Dieser Lieferung enthalten :
			</div>
		</div-->
		<table class="table table-bordered">
			<thead>
				<tr style="">
					<th>Box</th>
					<th>Nummer</th>
					<th>Artikel</th>
					<th>Anzahl</th>
					<th>Preis</th>
					<th>Summe</th>
				</tr>
			</thead>
			<tbody>
			@foreach($matrix as $key => $item)
				<tr>
					<td>{{$item['Box']}}</td>
					<td>{{$item['SKU']}}</td>
					<td>{{$item['title']}}</td>
					<td>{{$item['quantity']}}</td>
					<td>{{round($item['single_price'], 2)}} {{($currency == 'EUR') ? '€' : '$'}}</td>
					<td>{{round($item['total_Price'], 2)}} {{($currency == 'EUR') ? '€' : '$'}}</td>
				</tr>
			@endforeach
			</tbody>
		</table>

		<table class="table">
			<tr style="text-align: right;">
				<td style="text-align: right; float:right;">
					<label style="text-align: right; float:right;" for="1">Summe Net : <span id="1">{{round($Total_Amount, 2)}} {{($currency == 'EUR') ? '€' : '$'}}</span></label><br>
				</td>
			</tr>
			<tr style="text-align: right;">
				<td style="text-align: right; float:right;">
					<label style="text-align: right; float:right;" for="1">MwSt : <span id="1">{{round($Total_Tax, 2)}} {{($currency == 'EUR') ? '€' : '$'}}</span></label><br>
				</td>
			</tr>
			<tr style="text-align: right;">
				<td style="text-align: right; float:right;">
					<label style="text-align: right; float:right;" for="1">Gesamt Brutto : <span id="1">{{round(($Total_Amount + $Total_Tax), 2)}} {{($currency == 'EUR') ? '€' : '$'}}</span></label><br>
				</td>
			</tr>
		</table>
		



		<div class="row" style="text-align:center;float:left;width:100%">
			<p style="font-size: 14px;width:100%">
				Onamo <br>
				Wsytrychowski & Wsytrychowski Gbr | Marienster.3 | 508325 Koln <br>
				+49 221 42360320 | hello@onomao.com | www.onomao.com <br>
				USt-ID:DE815784418 | Geschafting: Felix & Arthur Wystrychowski <br>
				GLS Bank | IBAN : DE49430609670058552400 | BIC : GENODEM1GLS
			</p>
		</div>


	</div>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>