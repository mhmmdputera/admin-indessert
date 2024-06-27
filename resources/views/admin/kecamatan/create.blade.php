@extends('layouts.app', ['title' => 'Tambah Kecamatan'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-map-marker-alt"></i> TAMBAH KECAMATAN</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.kecamatan.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>KABUPATEN</label>
                            <select name="kabupaten_id" class="form-control">
                                <option value="">-- PILIH KABUPATEN --</option>
                                @foreach ($kabupatens as $kab)
                                <option value="{{ $kab->id }}">{{ $kab->name }}</option>
                                @endforeach
                            </select>

                            @error('kabupaten_id')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>NAMA KECAMATAN</label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Masukkan Nama Kecamatan" class="form-control @error('title') is-invalid @enderror">

                            @error('title')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>ONGKIR</label>
                            <input type="number" name="ongkir" value="{{ old('ongkir') }}" placeholder="Masukkan Ongkir" class="form-control @error('ongkir') is-invalid @enderror">

                            @error('ongkir')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
