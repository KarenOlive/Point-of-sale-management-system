@extends('layouts.layout');
@section('styles')

@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="example" class="table table-striped mb-0 table-bordered">
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Email</th>

                        <th class="text-center">Role</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)

                    <tr>

                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      

                      <td class="text-center">
                        <div class="dropdown action-label">

                        @if ($user->role == '2')
                        <a class="custom-badge status-green dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                            Manager
                        </a>
                        @elseif($user->role == '3')
                        <a class="custom-badge status-purple dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                            Cashier
                        </a>
                        @elseif ($user->role == '1')
                        <a class="custom-badge status-blue dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        @else
                        <a class="custom-badge status-orange dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                            Role
                        </a>
                        @endif
                            <div class="dropdown-menu dropdown-menu-right">

                                <a class="dropdown-item" href="{{ route('role.admin', $user->id)}}" value="Admin">Admin</a>
                                <a class="dropdown-item" href="{{ route('role.manager', $user->id)}}" value="Manager">Manager</a>
                                <a class="dropdown-item" href="{{ route('role.cashier', $user->id)}}" value="Cashier">Cashier</a>

                            </div>
                        </div>
                    </td>


                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="edit-employee.html"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
