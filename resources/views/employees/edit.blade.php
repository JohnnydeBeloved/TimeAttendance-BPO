@extends('layouts.mainapp')
@section ('content')
<div class="pl-5 pr-5 mt-10 mb-10">
<div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Edit Employee</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('employees.index') }}"> Back</a>

            </div>

        </div>

    </div>

   

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Whoops!</strong> Check your entries, there are some errors.<br><br>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

  

    <form action="{{ route('employees.update',$employee->id) }}" method="POST">

        @csrf

        @method('PUT')

   

         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Name:</strong>

                    <input type="text" name="name" value="{{ $employee->name }}" class="form-control" placeholder="Name">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">
                <strong>Email Address:</strong>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

              <button type="submit" class="btn btn-success">Edit</button>

            </div>

        </div>
</div>
   

    </form>
    @endsection