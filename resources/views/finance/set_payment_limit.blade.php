@extends("layouts.app")

@section("title", "Auftragsliste")

@section("content")

    <h2 class="finance_title">Export for Zahlungsziel & Limit  setzen</h2>
    <div class="payment_limit_table">
        <form action="{{route('setPaymentLimit')}}" method="POST">
            {{ csrf_field() }}
            <table>
                <tbody>
                    <tr>
                        <th>Kunden Nummer</th>
                        <th>Firma</th>
                        <th>Kunden Name</th>
                        <th>Limit</th>
                        <th>Limit Last changed</th>
                        <th>Zahlungsziel</th>
                        <th>Zahlungsziel last changed</th>
                        <th>Vat Mode</th>
                    </tr>
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->customer_number}}</td>
                        <td>{{ $customer->company }}</td>
                        <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                        <td>
                            <input type="hidden" name="customer_ids[]" value="{{ $customer->customer_id }}">
                            <input type="number" name="limit[]" value="{{ $customer->limit }}">
                        </td>
                        <td>{{ $customer->limit_updated_at }}</td>
                        <td>
                            <input type="number" name="payment_term[]" value="{{ $customer->payment_term }}">
                        </td>
                        <td>{{ $customer->payment_term_updated_at }}</td>
                        <td><input type="number" name="vat_mode[]" min="0" max="5" value="{{ $customer->vat_mode }}"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="payment_limit_buttons">
                <button type="submit">Speichern</button>
                <a href="{{ route('finance') }}">HOME</a>
            </div>
        </form>
    </div>

@endsection