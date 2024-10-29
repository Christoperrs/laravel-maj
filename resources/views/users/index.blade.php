@extends('layouts.app')

@section('content')

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Management Users Systems</h2>
                    <p class="pageheader-text">Manage users with the available permissions.</p>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">New Armada</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tooling Division</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Manage Users</div>
                    <div class="card-body">
                        @can('create-user')
                            <a href="{{ route('users.create') }}" class="btn btn-success btn-sm mb-2">
                                <i class="bi bi-plus-circle"></i> Add New User
                            </a>
                        @endcan
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <th scope="row"><span class="badge badge-info">{{ $loop->iteration }}</span></th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <ul>
                                                @forelse ($user->getRoleNames() as $role)
                                                    <li>{{ $role }}</li>
                                                @empty
                                                    <li>No Roles</li>
                                                @endforelse
                                            </ul>
                                        </td>
                                        <td>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                @if (in_array('Super Admin', $user->getRoleNames()->toArray()))
                                                    @if (Auth::user()->hasRole('Super Admin'))
                                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                                    @endif
                                                @else
                                                    @can('edit-user')
                                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                                    @endcan

                                                    @can('delete-user')
                                                        @if (Auth::user()->id != $user->id)
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this user?');"><i class="bi bi-trash"></i> Delete</button>
                                                        @endif
                                                    @endcan
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-danger">
                                            <strong>No User Found!</strong>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
  
          
@endsection
