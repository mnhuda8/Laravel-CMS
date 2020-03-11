@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">My Profile</div>

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
           <form action="{{ route('users.update-profile') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $data->name }}" />
                </div>

                <div class="form-group">
                    <label for="about"></label>
                    <textarea name="about" id="about" cols="5" rows="10" class="form-control">{{ $data->about }}</textarea>
                </div>

                <button class="btn btn-success btn-m">Update Profile</button>
           </form>
        </div>
    </div>
</div>
@endsection
