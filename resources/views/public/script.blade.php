@extends('/layouts/public')

@section('content')
    <div class="header">
        <div class="text-center text-white p-4">Task 2</div>
    </div>
    <div class="content mt-5 mb-5">
        <div class="exports">
        @if (isset($exports) && !empty($exports))
            <div class="col-md-6 offset-md-3 products-container">
                <div class="row">
                    @foreach ($exports as $key => $export)
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="4" class="text-center"><b>Total for export {{ $key }}</b></td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">count</td>
                                <td class="text-center" colspan="2">sum</td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">{{ count($export)-1 }}</td>
                                <td class="text-center" colspan="2">{{ $export['sum'] }}</td>
                            </tr>

                            <tr><td colspan="4"></td></tr>

                            <tr>
                                <td>payment_id</td>
                                <td>count</td>
                                <td>export_id</td>
                                <td>total</td>
                            </tr>
                            @php unset($export['sum']); @endphp
                            @foreach($export as $one_pay)
                                <tr>
                                    <td>{{ $one_pay->payment_id }}</td>
                                    <td>{{ $one_pay->count }}</td>
                                    <td>{{ $one_pay->export_id }}</td>
                                    <td>{{ $one_pay->sum }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endforeach
                </div>
            </div>
        @else
            <div class="col-md-6 offset-md-3 alert alert-info text-center" role="alert">
                No exports yet.
            </div>
        @endif
    </div>
@endsection
