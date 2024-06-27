@extends('layouts.app', ['title' => 'Edit Telegram Notification'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-bell"></i> EDIT TELEGRAM NOTIFICATION</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.telegram.update', $notification->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="token">Token</label>
                            <input type="text" name="token" value="{{ old('token', $notification->token) }}" placeholder="Enter Telegram Bot Token" class="form-control @error('token') is-invalid @enderror">

                            @error('token')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="user">User</label>
                            <input type="text" name="user" value="{{ old('user', $notification->user) }}" placeholder="Enter Username" class="form-control @error('user') is-invalid @enderror">

                            @error('user')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="chat_id">Chat ID</label>
                            <input type="text" name="chat_id" value="{{ old('id_chat', $notification->id_chat) }}" placeholder="Enter Chat ID" class="form-control @error('chat_id') is-invalid @enderror">

                            @error('chat_id')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> UPDATE</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
