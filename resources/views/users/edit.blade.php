@extends('layouts.app')
@section('content')
<div class="container">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{!! Form::model($user,['route' => ['users.update',$user], 'method' => 'PUT']) !!}

  <div class="mb-3">
  {!! Form::label('name', ' please enter your name', ['class' => 'form-label']) !!}
  {!! Form::text('name', null, ['class' => 'form-control']) !!}

    
  </div>
  <div class="mb-3">
    {!! Form::label('email', 'please enter your email', ['class' => 'form-label']) !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}

  </div>
  <div class="mb-3 ">
    {!! Form::label('password', 'please enter your password', ['class' => 'form-label']) !!}
    {!! Form::number('password', null, ['class' => 'form-control']) !!}

  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
  {!! Form::close() !!}
  </div>
@endsection

