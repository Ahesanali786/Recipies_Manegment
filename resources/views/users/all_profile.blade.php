@extends('layouts.app')

@section('content')

<div class="container mt-5">
    {{-- <h2 class="mb-4 text-center">User Profiles</h2> --}}
    <div class="col-sm-6">
        <h3 class="mb-5">All Users Profiles</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Id</th>
                    <th>Profile Picture</th>
                    <th>Name</th>
                    <th>Roll</th>
                    <th>Email</th>
                    <th>Bio</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profiles as $profile)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td scope="row">{{ $profile->id }}</td>
                        <td>
                            @if ($profile->profile_picture)
                                <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture"
                                    width="50" height="50" class="rounded-circle">
                            @else
                                <img src="https://via.placeholder.com/50" alt="No Profile Picture"
                                    class="rounded-circle">
                            @endif
                        </td>
                        <td>{{ $profile->name }}
                        </td>
                        <td>{{ $profile->user->role }}</td>
                        <td>{{ $profile->email }}</td>
                        <td>{{ $profile->bio ?? 'N/A' }}</td>
                        <td>{{ $profile->created_at->format('d M, Y') }}</td>
                        <td>
                            <a href="{{ url('profile/' . $profile->user->id) }}" class="btn btn-primary btn-sm">View
                                Profile</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Optional Bootstrap CSS link for basic styling -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@endsection
