@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-sm btn-success">Tambah Post</a>
    </div>

    <div class="card card-default">
        <div class="card-header">
            Post
        </div>

        <div class="card-body">
            @if($data->count() > 0)
                <table class="table">
                    <thead>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Kategori</th>
                        <th colspan="2"></th>
                    </thead>
                    <tbody>
                        @foreach($data as $val)
                            <tr>
                                <td><img src="{{ asset('storage/'.$val->image) }}" alt="" width="120px" height="60px" /></td>
                                <td>{{ $val->title }}</td>
                                <td>
                                    <a href="{{ route('kategori.edit', $val->kategori->id) }}">
                                        {{ $val->kategori->name }}
                                    </a>
                                </td>
                                @if($val->trashed())
                                    <td>
                                        <form action="{{ route('restore-post', $val->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-info btn-sm">Kembalikan</button>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <a href="{{ route('posts.edit', $val->id) }}" class="btn btn-info btn-sm">Ubah</a>
                                    </td>
                                @endif

                                <td>
                                    <form action="{{ route('posts.destroy', $val->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            {{ $val->trashed() ? 'Hapus' : 'Sampah' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No Posts Yet</h3>
            @endif
        </div>
    </div>
@endsection
