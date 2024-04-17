@extends("layouts.app")

@section("title", "Auftragsliste")

@section("content")
<style>
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

.main-btn{padding: 5px 6px;}
</style>
<div class="main-container pt-2 pb-2">
    <h5 class="page-title">Neuer
        <span class="bold-text">Wareneingang</span>
    </h5>
    <div class="input-wrapper">
        <div class="input-box mb-2">
            <input id="scan-ean" type="text" class="d-block" oninput="getProductByEan(event)" autofocus>
            <p class="grey">Scanne eine oder mehrere EAN</p>
        </div>

        <div class="input-box mb-2">
            <select id="reason" onchange="myFunction(event)">
                <option value="1">B2C Retoure</option>
                <option value="2">B2B Rücksendung</option>
                <option value="3">Kerbholz Warensendung</option>
                <option value="4">Zulieferer NEU Warensendung (Einkauf)</option>
                <option value="5">Reparatur</option>
                <option value="6">Umbuchungen</option>
            </select>
            <p class="grey">Wähle einen Wareneingang aus</p>
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
                </div>

                <div class="radiocontainer radiocontainer_2">
                    <h4>nach...</h4>
                    <div class="radio_field">
                        <input type="radio" id="test5" name="radio-group_2" value="131" >
                        <label for="test5">Lager Hamburg</label>
                    </div>
                    <div class="radio_field">
                        <input type="radio" id="test6" name="radio-group_2" value="132" checked>
                        <label for="test6">B-Ware Hamburg</label>
                    </div>
                    <div class="radio_field">
                        <input type="radio" id="test7" name="radio-group_2" value="133">
                        <label for="test7">Lager Köln</label>
                    </div>
                    <div class="radio_field">
                        <input type="radio" id="test8" name="radio-group_2" value="134">
                        <label for="test8">B-Ware Köln</label>
                    </div>
                </div>
            </div>
        </div>



        <div class="input-box mb-2">
        <input id="reason_datas" type="text" class="d-block" >
            <p class="grey">Bestellnummer</p>
        </div>
        <div class="input-box mb-2">
        <input id="comment_datas" type="text" class="d-block" >
            <p class="grey">Bemerkungen</p>
        </div>
    </div>

    <div class="pt-2 border-btm">
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
    </div>
    <div class="d-flex receipt-buttons">
        <div>
            <button class="main-btn btn disabled no-print" id="submit" onclick="updateProductsStockCodes()" style="width: max-content;">
                Wareneingang buchen
            </button>
        </div>
        <div>
            <button class="btn btn-warning mt-2 btn-lg  text-dark no-print" onclick="printOrdersAll()">DRUCKEN</button>
        </div>
        <div style="width:100%">
            <a href="/" style="float: right;">
                <button class="btn btn-warning btn-lg text-dark mt-2"> Zurück</button>
            </a>
        </div>
    </div>

</div>

<script>
    function myFunction(event){

        if(event.target.value == 6){
            $("#umbuchungen_option").show();
        }else{
            $("#umbuchungen_option").hide();
        }
    }
    </script>
@endsection
