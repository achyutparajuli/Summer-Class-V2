@extends('admin.layouts.masters')

@section('content')
<!-- Main Content -->
<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Users Table</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus"></i> Create
        </a>
    </div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->age }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}"><i class="bi bi-pencil"></i></a>
                    <i class="bi bi-trash"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection