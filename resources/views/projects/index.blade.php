@extends('layouts.base')

@section('content')
<div class="row border shadow-lg p-2 ms-0 me-0">
    <table class="table table-light table-striped caption-top">
        <caption class="text-center fw-bold fs-5 p-3">
            <i class="bi bi-stack"></i> Projects you're working with
        </caption>
        <thead>
            <tr>
              <th scope="col">Title</th>
              <th scope="col">Description</th>
              <th scope="col">Progress</th>
              <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{$project->title}}</td>
                    <td>{{$project->description}}</td>
                    <td>{{$project->progress}}%</td>
                    <td>
                        <a class="btn btn-sm btn-primary" title="Edit project" href="/projects/edit/{{$project->id}}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form style="display: inline;" method="POST" action="{{route('project.delete')}}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="project_id" value="{{$project->id}}" />
                            <button type="submit" class="btn btn-sm btn-danger" title="Delete project">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach            
        </tbody>
    </table>
    @if (count($projects) == 0)
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle-fill text-warning"></i> You're not working with any projects at the moment
        </div>
    @endif
</div>
@endsection