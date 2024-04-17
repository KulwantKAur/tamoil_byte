<table>
    <tbody>
    <tr>
        <td>LI;50044B;{{ $countLimits }};{{ $sumLimits }};{{ $fileName }}</td>
    </tr>

    @foreach($limitExports as $limitExport)
        <tr>
            <td>50044B;{{ $limitExport->customer_number }};EUR;{{ $limitExport->limit }}</td>
        </tr>
    @endforeach

    </tbody>
</table>




