<table>
    <tbody>
    <tr>
        <td>
		RE;50044B;{{ $invoices_count }};{{ str_replace('.', ',' ,round($totalGross, 2)) }};EUR;{{ $fileName }};{{ $fileName }};</td>
    </tr>
    @foreach($invoiceNumbers as $invoiceNumber)
        <tr>
            <td>
			50044B;{{ $invoiceNumber->cust_number }};EUR;{{ $invoiceNumber->invoice_number }};{{ str_replace('.', ',' ,round($invoiceNumber->total_gross, 2)) }};{{ date("d.m.Y",strtotime($invoiceNumber->invoice_date)) }};{{ ( $invoiceNumber->vat_mode == 0 )? "UV" : "U0" }};;;;;;{{ date("d.m.Y",strtotime($invoiceNumber->due_by_date)) }};
            </td>
        </tr>
    @endforeach
    </tbody>
</table>




