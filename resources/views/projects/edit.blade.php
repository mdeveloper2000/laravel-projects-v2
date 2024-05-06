@extends('layouts.base')

@section('content')
<div class="container w-75 mt-5">        
    <form method="POST" action="{{route('project.update')}}" enctype="multipart/form-data" class="p-5 border shadow-lg">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <h4 class="text-center fw-bold">Edit Project</h4>
        </div>            
        <div class="mb-3">              
            <input type="text" class="form-control" name="title" placeholder="Title" maxlength="20" required value="{{$project->title}}" />
            @error('title')
                <div class="alert alert-danger mt-3">
                    <i class="bi bi-exclamation-circle-fill"></i> {{$message}}
                </div>
            @enderror              
        </div>
        <div class="mb-3">
            <textarea class="form-control" name="description" placeholder="Description" maxlength="150" required >{{$project->description}}</textarea>
            @error('description')
                <div class="alert alert-danger mt-3">
                    <i class="bi bi-exclamation-circle-fill"></i> {{$message}}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <select class="form-select" name="progress" required>
                <option value="0" {{$project->progress=="0"?"selected":""}}>0</option>
                <option value="25" {{$project->progress=="25"?"selected":""}}>25</option>
                <option value="50" {{$project->progress=="50"?"selected":""}}>50</option>
                <option value="75" {{$project->progress=="75"?"selected":""}}>75</option>
                <option value="100" {{$project->progress=="100"?"selected":""}}>100</option>
            </select>
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
                <i class="bi bi-pencil-square"></i> Update
            </button>
        </div>
        <input type="hidden" name="project_id" value="{{$project->id}}" />
      </form>
</div>
@endsection