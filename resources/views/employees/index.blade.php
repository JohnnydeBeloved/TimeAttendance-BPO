@extends('layouts.mainapp')
@section ('content')
<div class="pl-5 pr-5 mt-5 mb-5">
    <table class="table border border-right-15">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Emp ID</th>
                <th scope="col">Full Names</th>
                <th scope="col">Date</th>
                <th scope="col">Clock In</th>
                <th scope="col">Clock Out</th>
                <th scope="col">Actions</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
            <tr>
                <td> {{ $employee->id }} </td>
                <td> {{ $employee->name }} </td>
                <td> {{ \Carbon\Carbon::today()->timezone('EAT')->format('Y/m/d')}} </td>
                <td>
                    <form method='post' action='/mark_attendance'>
                        @csrf
                        <input type="hidden" name="employee_id" value="{{$employee->id}}">
                        <input type="hidden" name="status" value="clock in">
                        <button type="submit" class="btn btn-success">Clock In</button>
                    </form>
                </td>
                <td>
                    <form method='post' action='{{route("mark_attendance")}}'>
                        @csrf
                        <input type="hidden" name="employee_id" value="{{$employee->id}}">
                        <input type="hidden" name="status" value="clock out">
                        <button type="submit" class="btn btn-secondary">Clock Out</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('employees.destroy',$employee->id) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('employees.edit',$employee->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
            </tr>
            @empty
            <span> no records! </span>
            @endforelse
        </tbody>
    </table>
</div>
@endsection