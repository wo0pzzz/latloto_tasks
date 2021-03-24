@extends('/layouts/public')

@section('content')
    <div class="header">
        <div class="text-center text-white p-4">Please, choose a task</div>
    </div>
    <div class="content mt-5 mb-5">
        <div class="tasks">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 text-center mb-2">
                        <a href="{{ route('shop') }}">
                            <button class="btn btn-secondary btn-block">Task 1</button>
                        </a>
                    </div>
                    <div class="col-md-6 text-center mb-2">
                        <a href="{{ route('dbscript') }}">
                            <button class="btn btn-secondary btn-block">Task 2</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

