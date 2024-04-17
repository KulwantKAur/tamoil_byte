@extends("layouts.app")

@section("title", "B2C Return")

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
    <div class="main-container pt-2 pb-2">
        <h5 class="page-title">
            <span class="bold-text">B2C Return</span>
        </h5>
        <div class="input-wrapper">
            <div class="input-box mb-2">
                <input id="scan-ean" type="text" class="d-block" oninput="getProductByEan(event)" autofocus>
                <p class="black">Scanne eine oder mehrere EAN</p>
            </div>

            <div class="input-box-hide">
                <select id="reason" onchange="myFunction(event)" >
                    <option value="1" selected="selected">B2C Retoure</option>
                </select>
            </div>
			<!--
            <div class="input-box mb-2" id="umbuchungen_option">
                <div class="radioWrapper">
                    <div class="radiocontainer radiocontainer_1">
                        <h4>Umbuchung von...</h4>
                        <div class="radio_field">
                            <input type="radio" id="test1" name="radio-group_1" value="171" checked>
                            <label for="test1">Lager</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test2" name="radio-group_1" value="172">
                            <label for="test2">Shop</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test3" name="radio-group_1" value="173">
                            <label for="test3">Markt</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test4" name="radio-group_1" value="226">
                            <label for="test4">B-ware</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test5" name="radio-group_1" value="265">
                            <label for="test5">B2B</label>
                        </div>
                    </div>

                    <div class="radiocontainer radiocontainer_2">
                        <h4>nach...</h4>
                        <div class="radio_field">
                            <input type="radio" id="test6" name="radio-group_2" value="171" checked>
                            <label for="test6">Lager</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test7" name="radio-group_2" value="172">
                            <label for="test7">Shop</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test8" name="radio-group_2" value="173">
                            <label for="test8">Markt</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test9" name="radio-group_2" value="226">
                            <label for="test9">B-ware</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test10" name="radio-group_2" value="265">
                            <label for="test10">B2B</label>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="input-box mb-2">
            <input id="reason_datas" type="text" class="d-block" >
                <p class="black">Bestellnummer / Referenz</p>
            </div>
			<div class="input-box mb-2">
				<input id="comment_datas" type="text" class="d-block" >
				<p class="black">Bemerkungen</p>
			</div>
        </div>
        {{-- <div class="pt-2 border-btm">
            <table class="info-table" id="products">
                <thead>
                    <th>Produkt</th>
                    <th>Lokation</th>
                    <th>EAN</th>
                    <th>Wareneingang</th>
                    <th>Reason Code</th>
                    <th>Product Grade</th>
                </thead>
            </table>
        </div> --}}

        <div class="pt-2 border-btm">
            <table class="info-table" id="products" >
                <thead>
                    <th>Produkt</th>
                    <th>Lokation</th>
                    <th>EAN</th>
                    <th>Wareneingang</th>
                    <th>Reason Code</th>
                    <th>Product Grade</th>
                    {{-- <th class="delta-ware">LAGER</th>
                    <th class="delta-ware-b2b">B2B</th>
                    <th class="delta-ware">B-WARE</th>
					<th class="delta-ware">DEFEKT</th> --}}
                </thead>
            </table>
        </div>

        <div class="d-flex receipt-buttons">

            <div>
                <button class="main-btn btn disabled no-print" id="submit" onclick="updateProductsStockCodes()">
                    B2C Return buchen
                </button>
            </div>
            <div>
                <button class="main-btn mt-2 no-print" onclick="printOrdersAll()">DRUCKEN</button>
            </div>
            <div style="width:100%">
                <a href="/" style="float: right;">
                    <button class="main-btn mt-2 back no-print"> Zurück</button>
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



        if(event.target.value == 4){
            $("#umbuchungen_option").css('display','block');
        }else{
            $("#umbuchungen_option").css('display','none');
        }
    }
    </script>

@endsection
