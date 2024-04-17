@extends("layouts.app")
@section("title", "Auftragsliste")
@section("content")


<div class="main-container pt-2 pb-2">
   <div class="flex-between pt-2">
      <table class="info-table ml-2" style="width:100%">
         <thead class="border-btm">
            <td >Neu Bestellungen</td>
            <td >Bestelldatum</td>
            <td >Cat1</td>
            <td >Cat2</td>
            <td >verfügbarkeit</td>
            <td >Aktion</td>
         </thead>
   
@if($neworder && count($neworder))
@foreach($neworder as $order)

         <tbody>
         <tr>
           
            <td>{{$order->orderNumber}}</td>
            <td> <?php $date = json_decode(json_encode($order->createdAt),true); ?>{{date("d-m-Y", strtotime($date['date']))}}</td>
            <td>{{$order->countcat1}}</td>
            <td>{{$order->countcat2}}</td>
            <td>
            @if($order->color =="red")
            <span class="dot" style="background-color:red"></span>
            <span class="dot"></span>
            <span class="dot"></span>
       
            @endif
            @if($order->color =="yellow")
            <span class="dot"></span>
            <span class="dot" style="background-color:yellow"></span>
            <span class="dot"></span>
          
            @endif
            @if($order->color =="green")
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot" style="background-color:green"></span>
       
            @endif
            @if($order->color =="")
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
       
            @endif
              
            </td>
            </td>
            <td><button type="submit" class="btn btn-primary float-left">Pick</button></td>
         </tr>
      
         </tbody>


@endforeach
@else
<tbody>

                <td colspan="8" style="text-align:center">No New Order available</td>
                <!-- Use colspan with the number of columns in your table -->
         
                </tbody>
@endif
      </table>
   </div>
   <div class="flex-between pt-2 mt-2">
      <table class="info-table ml-2" style="width:100%">
         <thead class="border-btm">
            <td>Backlog</td>
            <td>Bestelldatum</td>
            <td>Cat1</td>
            <td>Cat2</td>
            <td>verfügbarkeit</td>
            <td>Aktion</td>
         </thead>
   @if($backlog && count($backlog[0]))
@foreach($backlog[0] as $order)

         <tbody>
            <td>{{$order->orderNumber}}</td>
            <td> <?php $date = json_decode(json_encode($order->createdAt),true); ?>{{date("d-m-Y", strtotime($date['date']))}}</td>
            <td><?php echo  count($order->orderItems);?></td>
            <td><?php echo  count($order->orderItems);?></td>
            <td>
            @if(!is_null($order->confirmedAt))
               <span class="dot"></span>
               <span class="dot"></span>
               <span class="dot" style="background-color:green"></span>
               @endif
               
               @if(is_null($order->shippedAt))
               <span class="dot"></span>
               <span class="dot" style="background-color:yellow"></span>
               <span class="dot" ></span>
               @endif

               @if($order->isCanceled !== false )
           
               <span class="dot" style="background-color:red"></span>
               <span class="dot"></span>
               <span class="dot" ></span>
               @endif
               @if( $order->isCanceled == false && $order->shippedAt != null && $order->confirmedAt == null)
               <span class="dot"></span>
               <span class="dot"></span>
               <span class="dot" ></span>
               @endif
            </td>
            <td>    <button type="submit" class="btn btn-primary float-left">Pick</button></td>
         </tbody>

@endforeach
@else
<tbody>

<td colspan="8" style="text-align:center">No Backlog Order available</td>
<!-- Use colspan with the number of columns in your table -->

</tbody>
@endif

      </table>
   </div>
   <div class="flex-between pt-2 mt-4" style="
      display: flex;
      justify-content: space-around !important;
      ">
      <form action="/action_page.php">
         <div class="form-container">
            <div class="radio-button">
               <input type="radio" id="fifo" name="filter" value="fifo" >
               <label for="fifo">FIFO</label>
            </div>
            <div class="radio-button">
               <input type="radio" id="lifo" name="filter" value="lifo" >
               <label for="lifo">LIFO</label>
            </div>
            <div class="radio-button">
               <input type="radio" id="Fillrate" name="filter" value="Fillrate">
               <label for="Fillrate">Fillrate</label>
            </div>
         </div>
      </form>
      <div class="button">
         <button type="button" class="btn btn-primary float-left">Neu kalkulieren</button>
      </div>
   </div>
 </div>

</div>

@endsection
@push('scripts')
<script>
        localStorage.setItem('selected', 'fifo');

// Check the radio button with the value "red" as active
const redRadioButton = document.querySelector('input[name="filter"][value="fifo"]');
if (redRadioButton) {
    redRadioButton.checked = true;
    console.log('Item "red" added to Local Storage, and radio button "red" checked.');
} else {
    console.error('Error: Radio button with value "red" not found.');
}

// To pre-select the radio button with the value "red" based on localStorage
document.addEventListener('DOMContentLoaded', function () {
    const selected = localStorage.getItem('selected');
    if (selected) {
        const radioBtn = document.querySelector(`input[name="filter"][value="${selected}"]`);
        if (radioBtn) {
            radioBtn.checked = true;
        }
    }
});
   // $("#date_to").on('change', function() {
   //     var date_from = $("#date_from").val();
   //     var date_to = $("#date_to").val();
   //     if (date_from == '' && date_to == '') {
   //         alert("Invalid date.");
   //     }
   
   //     showLoader();
   //     $.ajax({
   //         type: 'GET',
   //         url: '/orders',
   //         data: {
   //             'date_from': date_from,
   //             'date_to': date_to
   //         },
   //         success: function(data) {
   //             $('body').html(data);
   //             hideLoader();
   //         }
   //     });
   // });
   // $('.checkbox').click(function() {
   //     var ischecked= $(this).is(':checked');
   //     if(ischecked){
   //         $(this).parents('.print_main').removeClass('no-print');
   //     }else{
   //         $(this).parents('.print_main').addClass('no-print');
   //     }
   // });
   
   // $('#toggleAll').click(function(event) {
   // if(this.checked) {
   //     // Iterate each checkbox
   //     $(':checkbox').each(function() {
   //         this.checked = false;
   // 		$(this).parents('.print_main').addClass('no-print');
   //     });
   // } else {
   //     $(':checkbox').each(function() {
   //         this.checked = true;
   // 		$(this).parents('.print_main').removeClass('no-print');
   
   //     });
   // }
   // });
   
   
   
</script>
@endpush