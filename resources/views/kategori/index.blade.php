@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('kategori.create') }}" class="btn btn-sm btn-success">Tambah Kategori</a>
    </div>
    
    <div class="card card-default">
        <div class="card-header">
            Kategori
        </div>
        <div class="card-body">
            @if($data->count() > 0)
                <table class="table">
                    <thead>
                        <th>Nama Kategori</th>
                        <th>Jumlah Post</th>
                        <th>Pilihan</th>
                    </thead>
                    <tbody>
                        @foreach($data as $val)
                            <tr>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->posts->count() }}</td>
                                <td>
                                    <a href="{{ route('kategori.edit', $val->id) }}" class="btn btn-sm btn-info">Ubah</a>
                                    <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $val->id }})">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>     
            @else
                <h3 class="text-center">No Kategori Yet</h3>
            @endif   
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="hapus-data" tabindex="-1" role="dialog" aria-labelledby="labelHapusdata" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" method="POST" id="form-hapus">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="labelHapusdata">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda Yakin Akan Menghapus Data ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Ya, hapus data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            var form = document.getElementById('form-hapus');
            form.action = '/kategori/' + id;

            $('#hapus-data').modal('show')
        }
    </script>
@endsection