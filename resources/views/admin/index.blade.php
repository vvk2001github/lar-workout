@extends('layouts.layout', ['title' => 'Admin Page'])
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-7"></div>
            <div class="col-1 text-end">
                <button type="button" class="btn btn-primary" role="button" id="createUser" data-bs-toggle="modal" data-bs-target="#createUserForm"><i class="bi bi-plus-square"></i></button></div>
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
                    <form id="createUserSubmitForm" method="post" th:action="@{/admin/storeuser}">
                        <div class="mb-3">
                            <label for="username" class="col-form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username">
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

@endsection
