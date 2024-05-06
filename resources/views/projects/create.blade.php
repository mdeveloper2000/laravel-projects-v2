@extends('layouts.base')

@section('content')
<div class="container w-75 mt-5">        
    <form method="POST" action="{{route('project.store')}}" enctype="multipart/form-data" class="p-5 border shadow-lg">
        @csrf
        <div class="mb-3">
            <h4 class="text-center fw-bold">New Project</h4>
        </div>            
        <div class="mb-3">              
            <input type="text" class="form-control" name="title" placeholder="Title" maxlength="20" required value="{{old('title')}}" />
            @error('title')
                <div class="alert alert-danger mt-3">
                    <i class="bi bi-exclamation-circle-fill"></i> {{$message}}
                </div>
            @enderror              
        </div>
        <div class="mb-3">
            <textarea class="form-control" name="description" placeholder="Description" maxlength="150" required >{{old('description')}}</textarea>
            @error('description')
                <div class="alert alert-danger mt-3">
                    <i class="bi bi-exclamation-circle-fill"></i> {{$message}}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <input class="form-control" type="file" name="picture" value="{{old('picture')}}" />
        </div>
        @error('picture')
            <div class="alert alert-danger mt-3">
                <i class="bi bi-exclamation-circle-fill"></i> {{$message}}
            </div>
        @enderror
        <div class="mb-3">
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{$error}}
                </div>
            @endif
        </div>
        <div class="mb-3">
            <a class="btn btn-danger w-25" href="/projects/index">
                <i class="bi bi-x-circle-fill"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary float-end w-25">
                <i class="bi bi-check-circle-fill"></i> Save
            </button>
        </div>        
      </form>
</div>
@endsection