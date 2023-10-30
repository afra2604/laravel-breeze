@extends('layouts.layout')
@section('title', 'Daftar Buku')

@section('content')

@if(Session::has('pesan'))
            <div class="alert alert-success">{{Session::get('pesan')}}</div>
        @endif

    <h1 class="text-center">Daftar Buku</h1>
    <br>

    <p class="text-right">
        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Tambah Buku</a>
    </p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
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
                    <td>{{ $buku->tgl_terbit->format('d/m/Y')}}</td>
                    <td>
                        <a href="{{ route('buku.edit', ['id' => $buku->id]) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                        <form action="{{ route('buku.destroy', ['id' => $buku->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')"><i class="fa fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{$data_buku->links() }}
@endsection
