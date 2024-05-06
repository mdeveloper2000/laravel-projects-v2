@extends('layouts.base')

@section('content')
    <div class="container w-75 mt-5">
        <form method="POST" action="{{route('user.password')}}" class="p-5 border shadow-lg" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <h4 class="text-center fw-bold">Change Password</h4>
            </div>            
            <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" maxlength="60" />
                @error('password')
                    <div class="alert alert-danger mt-3">
                        <i class="bi bi-exclamation-circle-fill"></i> {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" maxlength="60" />
                @error('password_confirmation')
                    <div class="alert alert-danger mt-3">
                        <i class="bi bi-exclamation-circle-fill"></i> {{$message}}
                    </div>
                @enderror
            </div>
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
            <input type="hidden" name="user_id" value="{{null}}" />
          </form>
    </div>
@endsection