@extends('layouts.mainapp')
@section('content')
<div class="pl-5 pr-5 mt-1 mb-5">
  <table class="table border border-right-15">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">Day</th>
        <th scope="col">Emp ID</th>
        <th scope="col">Full Names</th>
        <th scope="col">Dept</th>
        <th scope="col">Time In</th>
        <th scope="col">Time Out</th>
        <th scope="col">Duration</th>
        <th scope="col">Action</th>
        <!-- <th scope="col">Duration</th> -->
      </tr>
    </thead>
    <tbody>
      @forelse ($attendances as $attendance)
      <tr>
        <td> {{ $loop->iteration }} </td>
        <td> {{ \Carbon\Carbon::make($attendance->clocked_in_at)->format('d/m/Y')}} </td>
        <td> {{ \Carbon\Carbon::make($attendance->clocked_in_at)->format('D')}} </td>
        <td> {{ $attendance->employee->id }} </td>
        <td> {{ $attendance->employee->name }} </td>
        <td> </td>
        <td>{{\Carbon\Carbon::parse($attendance->clocked_in_at)->format('H:i:s')}}</td>
        <td>
          @if(isset($attendance->clocked_out_at))
          {{\Carbon\Carbon::parse($attendance->clocked_out_at)->format('H:i:s')}}
          @else
          <form method='post' action='{{route("mark_attendance")}}'>
            @csrf
            <input type="hidden" name="employee_id" value="{{$attendance->employee->id}}">
            <input type="hidden" name="status" value="clock out">
            <button type="submit" class="btn btn-secondary">Clock Out</button>
          </form>
          @endif
        </td>
        <td>{{\Carbon\Carbon::parse($attendance->clocked_out_at)->diffForHumans($attendance->clocked_in_at, true)}}
          </td>
        <td>

          <form action="{{ route('attendances.destroy',$attendance) }}" method="POST">
            <a class="btn btn-primary" href="{{ route('attendances.edit',$attendance) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </td>


      </tr>
      @empty
      <span> No Records! </span>
      @endforelse
    </tbody>
  </table>
</div>
@endsection