@extends('layouts.app')
<!-- view für das Editieren der User-->
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit user {{$user->name}}</div>

                    <div class="card-body">

                       <form  method="POST" action="{{ route('admin.users.update',$user) }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-md-2 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         @csrf
                       {{ method_field('PUT') }}
                       <div class="form-group row">
                        <label for="roles" class="col-md-2 col-form-label text-md-right">Role</label>
                        <div class="col-md-6">
					   @foreach($roles as $role)
					    <div class="form-check">
                        <input type="checkbox" name="roles[]" value="{{$role->id}}"
                        @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
						<label>{{ $role->name}}</label>
						</div>
                        @endforeach
                        <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-outline-primary float-left">Update</button>
                            <a href ="/admin/users" >
                            <button type="button" class="btn btn-outline-primary float-right">Zurück</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
