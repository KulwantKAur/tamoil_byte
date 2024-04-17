<table>
    <tbody>
    <tr>
        <td>GS;50044B;{{ $invoiceNumbersCount }};{{ str_replace('.', ',' ,round($totalAmount, 2)) }};EUR;{{ $fileName }};{{ $fileName }}</td>
    </tr>

    @foreach($invoiceNumbers as $invoiceNumber)
        <tr>
            <td>50044B;{{ $invoiceNumber->customer_number }};EUR;{{ str_replace('.', ',' ,round(abs($invoiceNumber->total_gross) ,2)) }};{{ $invoiceNumber->invoice_number }};{{ date("d.m.Y",strtotime($invoiceNumber->invoice_date)) }};;;{{ $invoiceNumber->invoice_number }};DEF
            </td>
        </tr>
    @endforeach

    </tbody>
</table>





