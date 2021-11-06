@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-sm btn-primary mr-2" href="{{ route('home') }}">Back</a>
                    Results
                </div>

                <div class="card-body">

                    @if (!empty($error))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $error }}</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                    @endif

                    <div class="row">

                        @php
                            $data = (object)$data;
                        @endphp

                        <div class="col-3 mb-6">
                            <img class="card-img-top" src="{{ $data->image }}" alt="Card image cap">
                        </div>

                        <div class="col-3 mb-6">
                            <h4 class="card-title">{{ $data->title }}</h4>
                            <ul>
                                <li>Calories : {{ $data->calories }}</li>
                                <li>Fat : {{ $data->fat . $data->unit }}</li>
                                <li>Protein : {{ $data->protein . $data->unit }}</li>
                                <li>Carbs : {{ $data->carbs . $data->unit }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection