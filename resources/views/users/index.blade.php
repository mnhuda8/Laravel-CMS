@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Pengguna
        </div>

        <div class="card-body">
            @if($data->count() > 0)
                <table class="table">
                    <thead>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($data as $val)
                            <tr>
                                <td><img src="{{ Gravatar::src($val->email) }}" alt="Gambar Tidak Tersedia" width="40px" height="40px" style="border-radius: 50%;" /></td>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->email }}</td>
                                <td>
                                    @if(!$val->isAdmin())
                                        <form action="{{ route('users.make-admin', $val->id) }}" method="POST">
                                            @csrf

                                            <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No User Yet</h3>
            @endif
        </div>
    </div>
@endsection
