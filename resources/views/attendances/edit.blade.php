@extends('layouts.mainapp')
@section ('content')
<div class="pl-5 pr-5 mt-10 mb-10">
<div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Edit Attendance</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('attendances.index') }}"> Back</a>

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

  

    <form action="{{ route('attendances.update',$attendance) }}" method="POST">

        @csrf

        @method('PUT')

   

         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Clocked In:</strong>

                    <input type="datetime" name="clocked_in_at" value="{{ $attendance->clocked_in_at }}" class="form-control" placeholder="Datetime">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">
                <strong>Cloocked Out:</strong>
                <input type="datetime" name="clocked_out_at" value="{{ $attendance->clocked_out_at }}" class="form-control" placeholder="Datetime">
            </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

              <button type="submit" class="btn btn-success">Update</button>

            </div>

        </div>
</div>
   

    </form>
    @endsection