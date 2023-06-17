
@extends('layouts.app')

@section('content')

        <div class="container">
           <div class="row">
            <div class="col">
                <h1>this books</h1>
            </div>
            <div class="col">
                <a href="{{ route('AddBook') }}">Add Book</a>
            </div>
           </div>

            <div class="row">
                <form action="{{route('SearchBook')}}" method="POST" class=" d-flex  mx-auto form-group">
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
           <div class=" row">

            <table class=" table">
                <thead>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Creadted_At</th>
                    <th>Updated_At</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->id}}</td>
                           
                            <td><img src="{{ asset('storage/images/'.$book->image) }}" alt="{{$book->image}}" width="50"></td>

                            <td>{{ $book->name}}</td>
                            <td>{{ $book->Author->name}}</td>
                            <td>{{ $book->Category->name}}</td>
                            <td>{{ $book->description}}</td>
                            <td>{{ $book->created_at}}</td>
                            <td>{{ $book->updated_at}}</td>
                            <td>
                                <a class="btn btn-danger" href="{{ route('DeleteBook', ['id'=>$book->id]) }}">x</a>
                                <a class="btn btn-warning my-2 mx-auto" href="{{ route('EditBook', ['id'=>$book->id]) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        

           </div>
            
        </div>
@endsection