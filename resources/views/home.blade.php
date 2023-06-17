@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div> --}}

            <div class="row bg-white p-2 shadow">
                <form action="{{route('SearchBookHome')}}" method="POST" class=" d-flex  mx-auto form-group">
                    @csrf
                    <select name="select" class=" form-control mx-2 h-75 mt-2 text-center w-50 ">
                        
                      
                        <option value="book">Book Name</option>
                        <option value="author">Author Name</option>
                        <option value="category">Category Name</option>
                      
                      
                    </select>
                    <input type="text" class=" form-control mx-2  my-2" placeholder=" Enter Data" name="name">
                    <input type="submit" value=" Search" class=" btn btn-primary mx-2  my-2">
                </form>
            </div>
       
            <div class="row my-3">
                @foreach($books as $book)
                <div class="col mx-2 my-2">
                    <div class=" card">
                        <h2 class="card-header text-center">{{$book->name}}</h2>
                        <img src="{{ asset('storage/images/'.$book->image) }}" alt="" class=" card-img-top " >
                    <div class="card-body">
                        <h3 class=" card-title">Author:{{$book->Author->name}}</h3>
                        <h5 class=" card-title">Category:{{$book->Category->name}}</h5>
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
