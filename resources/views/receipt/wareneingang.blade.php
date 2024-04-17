@extends("layouts.app")

@section("title", "Wareneingang")

@section("content")
<style type="text/css">


	.radio_field [type="radio"]:checked,
.radio_field [type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
}
.radio_field [type="radio"]:checked + label,
.radio_field [type="radio"]:not(:checked) + label
{
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #666;
}
.radio_field [type="radio"]:checked + label:before,
.radio_field [type="radio"]:not(:checked) + label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 15px;
    height: 15px;
    border: 1px solid #ddd;
    border-radius: 100%;
    background: #fff;
}
.radio_field [type="radio"]:checked + label:after,
.radio_field [type="radio"]:not(:checked) + label:after {
    content: '';
    width: 11px;
    height: 11px;
    background: #333;
    position: absolute;
    top: 3px;
    left: 3px;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}
.radio_field [type="radio"]:not(:checked) + label:after {
    opacity: 0;
    -webkit-transform: scale(0);
    transform: scale(0);
}
.radio_field [type="radio"]:checked + label:after {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}

.radio_field{
	margin: 10px 0 0 0
}

.radioWrapper {
    display: flex;
}
.radiocontainer_1{margin-right: 30px;}
.radiocontainer  h4{margin: 0 0 20px 0;}
#umbuchungen_option{display:none;}
.main-btn{padding: 5px 6px;}
.delta{
    display:none;
}

.delta-ware-b2b{
    display:none;
}

.input-box-hide{
    display:none;
}


</style>
    {{-- <div class="main-container pt-2 pb-2"> --}}
    <div class="container-fluid">
        <h5 class="page-title">
            <span class="bold-text">Wareneingang</span>
        </h5>
        <div class="row">
    <div class="col-sm">
        <div class="input-wrapper">
            <div class="input-box mb-2">
                <input id="scan-ean" type="text" class="d-block" oninput="getProductByEan(event)" autofocus>
                <p class="black">Scanne eine oder mehrere EAN</p>
            </div>

            <div class="input-box-hide">
                <select id="reason" onchange="myFunction(event)" >
                    <option value="3" selected="selected">Wareneingang</option>
                </select>
            </div>
        </div>
         <div class="form-check">
  <input class="form-check-input" type="checkbox" id="safetystock" name="Safetystock">
  <label class="form-check-label" for="safetystock">
    Erstlieferung-Safetystock automatisch anlegen
  </label>
        </div>
       <div class="form-outline">
                <input type="number" id="safetystück" name="safetystück" value="{{10}}"  min="0" class="delta-quantity"/>  Stück
            </div><br></div>
            <div class="col-sm">
            <div class="input-wrapper">
            <div class="input-box mb-2">
            <input id="reason_datas" type="text" class="d-block" >
                <p class="black">PO Nummer / Referenz</p>
            </div>
			<div class="input-box mb-">
				<input id="comment_datas" type="text" class="d-block" >
				<p class="black">Bemerkungen</p>
			</div>
</div></div></div>


        <div class="pt-2 border-btm">
            <table class="info-table" id="products" >
                <thead>
                    <th>Produkt</th>
                    <th>Lokation</th>
                    <th>EAN</th>
                    <th>Wareneingang</th>
                    <th>Product Grade</th>
				</thead>
            </table>
        </div>


		<div class="d-flex receipt-buttons">

            <div>
                <button class="main-btn btn disabled no-print" id="submit" onclick="updateProductsStockCodes()">
                    Wareneingang <br> buchen
                </button>
            </div>
            <div>
                <button class="main-btn mt-2 no-print" onclick="printOrdersAll()">DRUCKEN</button>
            </div>
            <div style="width:100%">
                <a href="/" style="float: right;">
                    <button class="main-btn mt-2 back no-print" id="submit"> Zurück</button>
                </a>
            </div>
        </div>
    </div>

    <script>



    function myFunction(event){
        console.log(event.target.value);
        if (event.target.value == 1 || event.target.value == 2){
			$(".delta").hide();
			$(".delta-ware-b2b").hide();
            $(".delta-ware").show();
			$(".delta-ware-reason").show();
		}else if(event.target.value == 4){
            $(".delta").show();
            $(".delta-ware").hide();
			$(".delta-ware-b2b").hide();
			$(".delta-ware-reason").hide();
        }else if (event.target.value == 3){
			$(".delta").hide();
            $(".delta-ware").show();
			$(".delta-ware-b2b").show();
			$(".delta-ware-reason").hide();
		}//else{
			//$(".delta").hide();
            //$(".delta-ware").hide();
			//$(".delta-ware-b2b").hide();
			//$(".delta-ware-reason").hide();
		//}



        // if(event.target.value == 4){
        //     $("#umbuchungen_option").css('display','block');
        // }else{
        //     $("#umbuchungen_option").css('display','none');
        // }
    }
    </script>

@endsection
