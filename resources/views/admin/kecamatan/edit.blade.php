@extends('layouts.app', ['title' => 'Edit Kecamatan'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-map-marker-alt"></i> EDIT KECAMATAN</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.kecamatan.update', $kecamatan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>NAMA KECAMATAN</label>
                            <input type="text" name="title" value="{{ old('title', $kecamatan->title) }}" placeholder="Masukkan Nama Kecamatan" class="form-control @error('title') is-invalid @enderror">

                            @error('title')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>ONGKIR</label>
                            <input type="text" name="ongkir" value="{{ old('ongkir', $kecamatan->ongkir) }}" placeholder="Masukkan Ongkir" class="form-control @error('ongkir') is-invalid @enderror">

                            @error('ongkir')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>KABUPATEN</label>
                            <select name="kabupaten_id" class="form-control">
                                <option value="">-- PILIH KABUPATEN --</option>
                                @foreach ($kabupatens as $kabupaten)
                                    @if($kecamatan->kabupaten_id == $kabupaten->id)
                                        <option value="{{ $kabupaten->id }}" selected>{{ $kabupaten->name }}</option>
                                    @else
                                        <option value="{{ $kabupaten->id }}">{{ $kabupaten->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('kabupaten_id')
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
