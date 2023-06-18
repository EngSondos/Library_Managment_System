@extends('layouts.app')
@section('content')
<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <!-- <th scope="col">password</th> -->
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>

    @foreach($users as $user )
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <!-- <td>{{$user->password}}</td> -->
      <td><a href="{{route('users.edit',$user->id)}}" class="btn btn-info"> Edit</a></td>
      <td>
                <!--      
               <form action="{{route('users.destroy',$user->id)}}" method="POST">
                    @method('delete')
                     @csrf
                    <td><button type="submit"  class="btn btn-danger">Delete</button></td>
                    </form> -->
        <form action="{{route('users.destroy',$user->id)}}" method="POST">
          @method('delete')
          @csrf
            <button class="btn btn-danger" type="submit">X</button>
        </form>
      </td>
    </tr>
    
   @endforeach
  </tbody>
</table>
</div>
@endsection