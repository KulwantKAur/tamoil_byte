@extends("layouts.app")

@section("title", "Umbuchen")

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
.umbuchungen_option{display:block;}
.main-btn{padding: 5px 6px;}
.delta{
    display:none;
}

.input-box-hide{
    display:none;
}
.delta-ware-reason{
    display:none;
}

</style>

    <div class="main-container pt-2 pb-2">
        <h5 class="page-title">
            <span class="bold-text">Umbuchen</span>
        </h5>
        <div class="input-wrapper">
            <div class="input-box mb-2">
                <input id="scan-ean" type="text" class="d-block" oninput="getProductByEan(event)" autofocus>
                <p class="black">Scanne eine oder mehrere EAN</p>
            </div>

            <div class="input-box-hide">
                <select id="reason" >
                    <option value="4" selected="selected">Umbuchen</option>
                </select>
            </div>
		</div>
        <div class="input-box mb-2" id="umbuchungen_option">
                <div class="radioWrapper">
                    <div class="radiocontainer radiocontainer_1">
                        <h4>Umbuchung von...</h4>
                        <div class="radio_field">
                            <input type="radio" id="test1" name="radio-group_1" value="131" checked>
                            <label for="test1">Lager Hamburg</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test2" name="radio-group_1" value="132">
                            <label for="test2">B-Ware Hamburg</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test3" name="radio-group_1" value="133">
                            <label for="test3">Lager Köln</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test4" name="radio-group_1" value="134">
                            <label for="test4">B-Ware Köln</label>
                        </div>
						<div class="radio_field">
                            <input type="radio" id="test5" name="radio-group_1" value="294">
                            <label for="test5">B2B Plattform</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test6" name="radio-group_1" value="100000000000309">
                            <label for="test6">Safetystock</label>
                        </div>						
                    </div>

                    <div class="radiocontainer radiocontainer_2">
                        <h4>nach...</h4>
                        <div class="radio_field">
                            <input type="radio" id="test7" name="radio-group_2" value="131" >
                            <label for="test7">Lager Hamburg</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test8" name="radio-group_2" value="132" checked>
                            <label for="test8">B-Ware Hamburg</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test9" name="radio-group_2" value="133">
                            <label for="test9">Lager Köln</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test10" name="radio-group_2" value="134">
                            <label for="test10">B-Ware Köln</label>
                        </div>
						<div class="radio_field">
                            <input type="radio" id="test11" name="radio-group_2" value="294">
                            <label for="test11">B2B Plattform</label>
                        </div>
                        <div class="radio_field">
                            <input type="radio" id="test12" name="radio-group_2" value="100000000000309">
                            <label for="test12">Safetystock</label>
                        </div>							
                    </div>
                </div>
            </div>
		<div class="input-wrapper">
            <div class="input-box mb-2">
            <input id="reason_datas" type="text" class="d-block" >
                <p class="black">Grund</p>
            </div>
			<div class="delta">
				<input id="comment_datas" type="text" class="delta" >
				<p class="black">Bemerkungen</p>
			</div>
        </div>

        <div class="pt-2 border-btm">
            <table class="info-table" id="products" >
                <thead>
                    <th>Produkt</th>
                    <th>Lokation</th>
                    <th>EAN</th>
                    <th>Anzahl</th>
                    <!-- <th class="delta-ware-reason">Reason Code</th>
                    <th class="delta-ware">LAGER</th>
                    <th class="delta-ware-b2b">B2B</th>
                    <th class="delta-ware">B-WARE</th>
					<th class="delta-ware">DEFEKT</th> -->
                </thead>
            </table>
        </div>

        <div class="d-flex receipt-buttons">

            <div>
                <button class="main-btn btn disabled no-print" id="submit" onclick="updateProductsStockCodes()">
                    Umlagern
                </button>
            </div>
            <div>
                <button class="main-btn mt-2 no-print" onclick="printOrdersAll()">DRUCKEN</button>
            </div>
            <div style="width:100%">
                <a href="/" style="float: right;">
                    <button class="main-btn mt-2 back no-print">Zurück</button>
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
