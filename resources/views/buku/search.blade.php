@extends('layouts.layout')
@section('title', 'Cari Buku')

@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<div class="container" style="margin-top: 10px">
    <div class="col-md-12">

        @if(count($data_buku))
            <div class="alert alert-success">Ditemukan <strong>{{ count($data_buku) }}</strong>
            data dengan kata: <strong>{{ $cari }}</strong></div>

        <div class="card">
            <div class="card-header text-center" style="background-color: #FFFFE0; color: black"><h3>Daftar Buku</h3></div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                <p class="text-right">
        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Buku</a>
    </p>

    <form action="{{ route('buku.search') }}" method="get">
                        @csrf
                        <input type="text" name="kata" class="form form-control" placeholder="Cari ..." style="float:left;">
                    </form>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Judul Buku</th>
                            <th>Penulis</th>
                            <th>Harga</th>
                            <th>Tgl. Terbit</th>
                            <th>Aksi</th>   
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data_buku as $buku)
                            <tr>
                            <td>{{ $buku->id }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
                            <td>{{ Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y')}}</td>
                                <td>
                                    <div class="btn-group" role="group" style="overflow-x: auto; margin: right 10px;">
                                    <a href="{{ route('buku.edit', ['id' => $buku->id]) }}" class="btn btn-primary mr-2"><i class="fa fa-edit"></i> Edit</a>
                        <form action="{{ route('buku.destroy', ['id' => $buku->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')"><i class="fa fa-trash"></i> Hapus</button>
                        </form>
                                    </div>
                                </td>
                                
                            </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>{{ $data_buku->links() }}</div>
            </div>
        </div>
        @else
            <div class="alert alert-warning">
                <h4>Data {{ $cari }} tidak ditemukan</h4>
                <a href="/buku" class="btn btn-warning">Kembali</a>
            </div>
        @endif
    
    </div>
</body>
</html>