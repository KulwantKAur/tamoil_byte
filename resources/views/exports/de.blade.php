<!-- start Abhishek code 28-02-2020 Task: Change the format table to simple html -->
<html>
DE;50044B;{{ $customers_count }};{{ $fileName }};<br>
@foreach($customers as $customer)
50044B;{{ $customer->customer_number }};{{ $customer->company }};{{ $customer->first_name }} {{ $customer->last_name }};{{ $customer->street }};;{{ $customer->zip }};{{ $customer->city }};{{ $customer->country_code }};EUR;;;;;{{ $customer->email }};;<br>
@endforeach
</html>