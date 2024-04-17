<div class="reklaportal_order_data_content container">
    <div class="input-box scanEan">
        <label class="grey" for="scan">EAN:</span>
        </label>
        <input id="scanEan" type="text" class="d-block">
    </div>

    <div>
        <p><b>Bestellung : <span id="orderRef">{{ $order->orderNumber }}</span>
                Rechnung : <span id="invoiceNumber">{{ $order->invoiceNumberPrefix }}{{ $order->invoiceNumber }}</span></b></p>
    </div>
    <table>

        <tr>
            <th style="width: 35%">Produkt</th>
            <th style="width: 15%">EAN</th>
            <th style="width: 10%">Status</th>
            <th style="width: 45%">Aktion</th>
        </tr>

        @foreach($order->orderItems as $orderItem)
        <tr class="orderItem" data-ean= "{{ $orderItem->product->ean }}">
            <td>{{ $orderItem->product->title }}</td>
            <td>{{ $orderItem->product->ean }}</td>
            <td>Open</td>
            <td>
                <button class="reklamation" {{ ($dateInterval->days > 730)? "disabled" : "" }}>Reklamation</button>
                <button class="retoure" {{ ($dateInterval->days > 32)? "disabled" : "" }}>30t Retoure</button>
                <button class="reparatur">Reparatur</button>
            </td>
        </tr>
        @endforeach

    </table>

    <div class="orderData-modal-popup">

        <div class="orderData-modal">
            <div class="orderData-modal-content">
                <div class="orderData-modal-content-container">
                    <div class="orderData-modal-content-container-title">
                        <span></span>
                    </div>
                    <div class="orderData-modal-content-container-main">
                        <span>Ware OK für Lager Bestand?</span>
                    </div>
                    <div class="orderData-modal-content-footer">
                        <button class="orderData-modal-btn-yes">Yes</button>
                        <button class="orderData-modal-btn-no">No</button>
                    </div>
                    <button class="orderData-modal-close">X</button>
                </div>
            </div>
        </div>

        <div class="orderData-modal-email">
            <div class="orderData-modal-email-content">
                <div class="orderData-modal-email-content-container">
                     <span class="toEmail">To address: Maren@kerbholz.com</span>{{--Fraguns@kerbholz.com --}}
                    <span class="subject">subject: {{ $order->orderNumber }} Retoure nicht akzeptiert</span>
                    <textarea placeholder="Write Text..." class="orderData-modal-email-textarea mailBody"></textarea>
                    <button class="send-email-btn">Send Email</button>
                </div>
                <button class="orderData-modal-email-close">X</button>
            </div>
        </div>
    </div>


    <div class="orderdata-garantie-service">
        <div class="orderdata-garantie-service-header">
            <div class="radio-btn-form">
                <input checked type="radio" id="garantie" name="garantie-or-service-type">
                <label for="garantie">Garantie</label>
            </div>
            <div class="radio-btn-form">
                <input type="radio" id="service" name="garantie-or-service-type">
                <label for="service">Service</label>
            </div>
        </div>

        <ul class="orderdata-garantie-service-wrapper">
            <li class="orderdata-garantie-service-wrapper-item typeA">
                <input checked type="radio" id="category1" name="categories-type">
                <label for="category1">Kategorie A – Austausch Glied, Aufbereitung</label>
            </li>
            <li class="orderdata-garantie-service-wrapper-item typeB">
                <input type="radio" id="category2" name="categories-type">
                <label for="category2">Kategorie B – Austausch Glied, Aufbereitung</label>
            </li>
            <li class="orderdata-garantie-service-wrapper-item typeC">
                <input type="radio" id="category3" name="categories-type">
                <label for="category3">Kategorie C – Austausch Glied, Aufbereitung</label>
            </li>
            <li class="orderdata-garantie-service-wrapper-item typeD">
                <input type="radio" id="category4" name="categories-type">
                <label for="kategory4">Kategorie D – Austausch Glied, Aufbereitung</label>
            </li>
        </ul>

        <div class="orderdata-garantie-service-buttons">
            <div id="orderdata-garantie-service-buttons-item">
                <button id="inReparatur"> In Reparatur</button>
            </div>

            <div id="orderdata-garantie-service-buttons-item">
                <button id="abgeschlossen">Abgeschlossen</button>
            </div>

            <div id="orderdata-garantie-service-buttons-item">
                <button id="zuruck">Zurück</button>
            </div>

            <div id="orderdata-garantie-service-buttons-item" class="d-none">
                <button id="kundensupport">Kundensupport</button>
            </div>
        </div>
    </div>

</div>
