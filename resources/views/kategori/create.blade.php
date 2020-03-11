@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($data) ? 'Ubah Kategori' : 'Tambah Kategori' }}
        </div>

        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ isset($data) ? route('kategori.update', $data->id) : route('kategori.store') }}" method="POST">
                @csrf
                @if(isset($data))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{ isset($data) ? $data->name : '' }}" />
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-sm" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection