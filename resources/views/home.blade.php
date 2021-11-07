@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12 m-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Search</h4>
                </div>

                <div class="card-body" style="background-color: #bfeef8">
                    {{-- <form action="{{ route('search') }}" method="GET" enctype="multipart/form-data"> --}}
                        {{-- @csrf --}}
                        <div class="row d-flex justify-content-center">
                            <div class="col-8">
                                <input type="text" placeholder="Search..." class="form-control" id="title">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary" style="background-color: #2165ec" onclick="search()">Search</button>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center mt-4">
                            <div class="col-9">
                                <p class="mb-0">Recent Search: </p>
                                <ul>
                                    @foreach ($searches as $search)
                                        <li>{{ $search['title'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">Results</div>

                <div class="card-body">

                    @if (!empty($error))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $error }}</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        </div>
                    @endif


                    
                    @if (!empty($data))
                        <div class="row">
                            @foreach ($data['data'] as $item)
                                @php
                                    $item = (object)$item;
                                @endphp
                                <div class="col-3 mb-4">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ $item->image }}" alt="Card image cap">
                                        <div class="card-body">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                        <a href="{{ route('search2', [ \Crypt::encryptString($item->title)]) }}" class="btn btn-primary" style="background-color: #2165ec">See Details</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        @if (empty($error))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>View nutrition info for the food you search.</strong>
                                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function search(){
        let title = document.getElementById("title").value;  
        window.location.replace("/find/" + title);
    }
</script>
@endsection