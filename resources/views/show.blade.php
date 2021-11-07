@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Nutrition Info</h4>
                    <div class="col-auto">
                        <a class="btn btn-sm btn-primary ml-1" style="background-color: #2165ec" href="{{ url()->previous() }}">Back</a>
                    </div>
                </div>

                <div class="card-body">

                    @if (!empty($error))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $error }}</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                    @endif

                    <div class="row">

                        @if (!empty($data))
                            @php
                                $data = (object)$data;
                            @endphp

                            <div class="col-4 mb-8">
                                <img class="card-img-top" src="{{ $data->image }}" alt="Card image cap">
                            </div>

                            <div class="col-4 mb-8">
                                <h2>{{ $data->title }}</h2>
                                <ul>
                                    <li class="font-weight-bold">Calories : {{ $data->calories }}</li>
                                    <li class="font-weight-bold">Fat : {{ $data->fat . $data->unit }}</li>
                                    <li class="font-weight-bold">Protein : {{ $data->protein . $data->unit }}</li>
                                    <li class="font-weight-bold">Carbs : {{ $data->carbs . $data->unit }}</li>
                                </ul>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection