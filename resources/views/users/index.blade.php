@extends('layouts.master')

@section('title')
    Users
@endsection

@section('page')
    Users
@endsection

@section('addbtn')
    <div>
        <a class="add" href="">Add a User</a>
    </div>
@endsection

@section('table')
    <div class="table">
        <table style="width:100%">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <a href="/users/{{ $user->id }}">{{ $user->first_name }}</a>
                        </td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->contact_number }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{-- Show delete button only if the current user is authorized to delete this user --}}
                            @can('delete', $user)
                                <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this user?')">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
