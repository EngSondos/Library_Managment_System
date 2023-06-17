
@extends('layouts.app')

@section('content')

        <div class="container">
            
           <div class=" row">

                <form action="{{route('StoreBook')}}" method="POST" enctype="multipart/form-data" class=" form-group">
                    @csrf
                    <h1 class=" text-center">Add Book</h1>
                    <div class="elm my-3">
                        <label >Enter Name</label>
                            <input type="text" class=" form-control  @error('name') is-invalid @enderror " name="name" >
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="elm my-3">
                        <label >Enter Image</label>
                            <input type="file" class=" form-control @error('image') is-invalid @enderror" name="image" >
                            @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="elm my-3">
                        <label >Enter Description</label>
                            <textarea name="description" class=" form-control @error('description') is-invalid @enderror" ></textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="elm my-3">
                        <label >Select Author</label>
                            <select name="author" class=" form-control">
                                @foreach($authors as $author)
                                <option value="{{$author->id}}">{{$author->name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="elm my-3">
                        <label >Select Category</label>
                            <select name="category" class=" form-control">
                                @foreach($category as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="elm">
                        <input type="submit" value="Add" class=" btn btn-primary my-2">
                    </div>
                </form>

           </div>
            
        </div>
@endsection