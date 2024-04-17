@extends('layouts.app')
 {{-- {{$shopId=NULL}} --}}
@section('content')
<div class="main-container mt-5">

<div class="text-center">
 <p>Einen wundersch&ouml;nen Tag und viel Spaß bei der Arbeit.</p>

<table class="table">
<tbody>
<tr>
                <th scope="row">Shop</th>
                <th>Anzahl Bestellungen</th>
            </tr>
@foreach($countOfOders as $countOfOrder)

      

            
            <tr>
                <td> {{$countOfOrder}}</td>
                <td></td>
            </tr>
            

   
@endforeach

</tbody>
        </table>
        
                
            
			
			
           
        </div>
   
@endsection
