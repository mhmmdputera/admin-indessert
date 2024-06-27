@extends('layouts.app', ['title' => 'Detail Telegram Notification'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-bell"></i> DETAIL TELEGRAM NOTIFICATION</h6>
                </div>
                <div class="card-body">
                    @foreach($telegrams as $notification)
                        <div class="form-group">
                            <label for="token">Token</label>
                            <input type="text" class="form-control" name="token" value="{{ $notification->token }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="user">User</label>
                            <input type="text" class="form-control" name="user" value="{{ $notification->user }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="chat_id">Chat ID</label>
                            <input type="text" class="form-control" name="id_chat" value="{{ $notification->id_chat }}" readonly>
                        </div>
                        <a href="{{ route('admin.telegram.edit', $notification->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit Data</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
