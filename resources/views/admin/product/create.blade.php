@extends('layouts.app', ['title' => 'Tambah Produk'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-shopping-bag"></i> TAMBAH PRODUK</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>GAMBAR</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">

                            @error('image')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NAMA PRODUK</label>
                                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Masukkan Nama Produk"
                                        class="form-control @error('title') is-invalid @enderror">

                                    @error('title')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>BAHAN</label>
                                    <input type="text" name="bahan" value="{{ old('bahan') }}" placeholder="Masukkan Bahan Produk"
                                        class="form-control @error('bahan') is-invalid @enderror" data-role="tagsinput">
                            
                                    @error('bahan')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>KATEGORI</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">-- PILIH KATEGORI --</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>BERAT (gram)</label>
                                    <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror"
                                        value="{{ old('weight') }}" placeholder="Berat Produk (gram)">

                                    @error('weight')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>STATUS PRE-ORDER</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                                        <option value="tutup" {{ old('status') == 'tutup' ? 'selected' : '' }}>Tutup</option>
                                    </select>
        
                                    @error('status')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>STOK</label>
                                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                                        value="{{ old('stock') }}" placeholder="Jumlah Stok">
        
                                    @error('stock')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
        
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <label>DESKRIPSI</label>
                            <textarea class="form-control content @error('content') is-invalid @enderror" name="content" rows="6"
                                placeholder="Deskripsi Produk">{{ old('content') }}</textarea>

                            @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>HARGA</label>
                                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price') }}" placeholder="Harga Produk">

                                    @error('price')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>DISKON (%)</label>
                                    <input type="number" name="discount" class="form-control @error('discount') is-invalid @enderror"
                                        value="{{ old('discount') }}" placeholder="Diskon Produk (%)">

                                    @error('discount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.4/tinymce.min.js"></script>
<script>
    var editor_config = {
        selector: "textarea.content",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
    };

    tinymce.init(editor_config);

    $(document).ready(function() {
        $('input[name="bahan"]').tagsinput({
            trimValue: true,
            allowDuplicates: false,
            confirmKeys: [13, 32] // Enter dan Spasi untuk memisahkan kata menjadi tag
        });
    });
</script>

<style>
    .bootstrap-tagsinput {
        width: 100%;
        min-height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        background-color: #ffffff;
        border: 1px solid #ced4da;
        border-radius: .25rem;
    }
    
    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: white;
        background-color: #c69a41;; /* Ubah warna latar belakang */
        padding: .2rem .4rem;
        border-radius: .2rem;
    }

</style>
@endsection