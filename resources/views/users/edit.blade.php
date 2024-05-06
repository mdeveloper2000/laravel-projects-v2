@extends('layouts.base')

@section('content')
    <div class="container w-75 mt-5">
        <form method="POST" action="{{route('user.update')}}" class="p-5 border shadow-lg" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <h4 class="text-center fw-bold">Edit Profile</h4>
            </div>            
            <div class="mb-3">              
                <input type="text" class="form-control" name="name" placeholder="Name" maxlength="30" value="{{$user->name}}" />
                @error('name')
                    <div class="alert alert-danger mt-3">
                        <i class="bi bi-exclamation-circle-fill"></i> {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <input class="form-control" type="file" name="photo" />
            </div>
                @error('photo')
                    <div class="alert alert-danger mt-3">
                        <i class="bi bi-exclamation-circle-fill"></i> {{$message}}
                    </div>
                @enderror                
            <div class="mb-3">                
                <button type="submit" class="btn btn-success float-end w-25">
                    <i class="bi bi-pencil-square"></i> Update
                </button>
            </div>
            <div class="mb-3">
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endif
            </div>
            <input type="hidden" name="user_id" value="{{$user->id}}" />
          </form>
    </div>
@endsection