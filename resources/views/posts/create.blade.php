@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($data) ? 'Ubah Post' : 'Tambah Post' }}
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
        
        <form action="{{ isset($data) ? route('posts.update', $data->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if(isset($data))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ isset($data) ? $data->title : '' }}" />
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="description" class="form-control" id="deskripsi" cols="30" rows="5">{{ isset($data) ? $data->description : '' }}</textarea>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <input id="content" type="hidden" name="content" value="{{ isset($data) ? $data->content : '' }}">
                <trix-editor input="content"></trix-editor>
            </div>

            <div class="form-group">
                <label for="published_at">Published At</label>
                <input type="text" class="form-control" name="published_at" id="published_at" value="{{ isset($data) ? $data->published_at : '' }}" />
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select name="id_kategori" id="kategori" class="form-control select2">
                    @foreach($kategori as $val)
                        <option value="{{ $val->id }}"
                            @if(isset($data)) 
                                @if($val->id == $data->id_kategori)
                                    selected
                                @endif
                            @endif
                        >
                            {{ $val->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if($tags->count() > 0)
            <div class="form-group">
                <label for="tags">Tags</label>
                <select name="tags[]" id="tags" class="form-control select2" multiple>
                    @foreach($tags as $val)
                        <option value="{{ $val->id }}"
                            @if(isset($data))
                                @if($data->hasTag($val->id))
                                    selected
                                @endif
                            @endif
                        >
                            {{ $val->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif

            @if(isset($data))
                <div class="form-group">
                    <img src="{{ asset('storage/'.$data->image) }}" alt="Gambar Tidak Tersedia" style="width: 100%; max-height: 500px;" />
                </div>
            @endif

            <div class="form-group">
                <label for="image">Gambar</label>
                <input type="file" class="form-control" name="image" id="image" />
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-success btn-m">
                    Publikasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true
        });

        $('.select2').select2();
    </script>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection