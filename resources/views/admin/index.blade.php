@extends('layouts.layout', ['title' => 'Admin Page'])
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-7"></div>
            <div class="col-1 text-end">
                <button type="button" class="btn btn-primary" role="button" id="createUser" data-bs-toggle="modal" data-bs-target="#createUserForm"><i class="bi bi-plus-square"></i></button></div>
        </div>

        <div class="row">
            <div class="col-8 mx-auto">
                <table class="table table-hover table-sm">
                    <thead>
                        <th scope="col" class="col-2">Username</th>
                        <th scope="col" class="col-2">Email</th>
                        <th scope="col" class="col-2">Actions</th>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr class="align-middle">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="{{ 'dropdownMenuButton1'.$user->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-list"></i>&nbsp;Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="{{ 'dropdownMenuButton1'.$user->id }}">
                                    <li><a id="{{ 'editUser'.$user->id }}" data-id="{{ $user->id }}" data-user="{{ $user->name }}" class="dropdown-item" href="#"><i class="bi bi-gear"></i>&nbsp;Edit</a></li>
                                    <li><a id="{{ 'setPassUser'.$user->id }}" data-id="{{ $user->id }}" data-user="{{ $user->name }}" class="dropdown-item" href="#"><i class="bi bi-gear"></i>&nbsp;Reset pass</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a id="{{ 'deleteUser'.$user->id }}" data-id="{{ $user->id }}" data-user="{{ $user->name }}" class="dropdown-item" href="#"><i class="bi bi-x-square"></i>&nbsp;Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modal window Create User-->
    <div class="modal fade" id="createUserForm" tabindex="-1" aria-labelledby="createUserFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserFormLabel">New user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createUserSubmitForm" method="post" action="{{  route('admin.storeuser') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="user" class="col-form-label">Username:</label>
                            <input type="text" class="form-control" id="user" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="storeUser">Save user</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal window Delete User-->
    <div class="modal fade" id="deleteUserForm" tabindex="-1" aria-labelledby="deleteUserFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteUserFormLabel">Delete user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="deleteUserFormText">Modal body text goes here.</p>
                </div>
                <form id="deleteUserSubmitForm" method="post" action="{{ route('admin.deleteuser') }}">
                    @csrf
                    <input type="hidden" name="userid" id="userid">
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmDeleteUser">Delete user</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal window set password-->
    <div class="modal fade" id="setPassForm" tabindex="-1" aria-labelledby="setPassFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="setPassFormLabel">Set password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="setPassFormText">Modal body text goes here.</p>
                    <form id="setPassSubmitForm" method="post" action="{{ route('admin.setpassuser') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="col-form-label">Confirm password:</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                        </div>
                        <input type="hidden" name="setpassuserid" id="setpassuserid">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmSetPass">Set password</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('head-script')
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}" ></script>
@endpush

@push('foot-script')
    <script>

        $('#storeUser').click(function () {
            $('#createUserSubmitForm').submit();
        })

        $('a[id^="deleteUser"]').click(function (e) {
            e.preventDefault();
            msg = "Are you sure you want to delete the user: <b>" + $(this).data("user") + "</b>?";
            $('#deleteUserFormText').html(msg);
            let deleteUserModal = new bootstrap.Modal(document.getElementById('deleteUserForm'), {});
            $('#userid').val($(this).data("id"));
            deleteUserModal.toggle();
        });

        $('#confirmDeleteUser').click(function () {
            $('#deleteUserSubmitForm').submit();
        });


        $('a[id^="setPassUser"]').click(function (e) {
            e.preventDefault();
            msg = "Set password for user: <b>" + $(this).data("user") + "</b>?";
            $('#setPassFormText').html(msg);
            let setPassForm = new bootstrap.Modal(document.getElementById('setPassForm'), {});
            $('#setpassuserid').val($(this).data("id"));
            setPassForm.toggle();
        });

        $('#confirmSetPass').click(function () {
            $('#setPassSubmitForm').submit();
        });
    </script>
@endpush
