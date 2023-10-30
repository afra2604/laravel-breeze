@extends('layouts.layout')
@section('title', 'Edit Data Buku')

@section('content')
<div class="container">
@if(count($errors) > 0)
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li style="margin-left: 10px">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
    <div class="row justify-content-center">
        <div class="col-md-10">
        <h4>Edit Buku</h4>
            <div class="card card-shadow">
                <div class="card-body">

                    <form method="post" action="{{ route('buku.update', ['id' => $buku->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}">
                        </div>
                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga" value="{{ $buku->harga }}">
                        </div>
                        <div class="form-group">
                            <label for="tgl_terbit">Tgl. Terbit</label>
                            <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" value="{{ $buku->tgl_terbit }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="/buku" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
