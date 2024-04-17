@extends("layouts.app")

@section("title", "Auftragsliste")

@section("content")

    <h2 class="finance_title">Manueller Export</h2>
    <div class="manual_export_content">
        <form action="{{route('manualExport')}}" method="POST">
            {{ csrf_field() }}
            <div class="export_type">
                <label>Export Type<br>
                    <select name="export_type">
                        <option value="RE">RE</option>
                        <option value="GS">GS</option>
                        <option value="DE">DE</option>
                        <option value="LI">LI</option>
                    </select>
                </label>
            </div>
            <div class="from_to_submit_content">
                <div class="from_to_content">
                    <div class="from_content">
                        <label for="">From :<br>
                            <input type="date" name="fromDate" value="">
                        </label>
                    </div>
                    <div class="to_content">
                        <label for="">To :<br>
                            <input type="date" name="toDate" value="">
                        </label>
                    </div>
                </div>
                <div class="submit_content">
                   <div>
                       <input type="submit" value="Export">
                   </div>
                </div>
            </div>

        </form>
    </div>

@endsection