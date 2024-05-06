@extends('layouts.base')

@section('content')
    <div class="row border shadow-lg p-2 ms-0 me-0">
        <table class="table table-light table-striped caption-top">
            <caption class="text-center fw-bold fs-5 p-3">
                <i class="bi bi-stack"></i> Other projects
            </caption>
            <thead>
                <tr>
                  <th scope="col">Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Progress</th>
                  <th scope="col">User</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{$project->title}}</td>
                        <td>{{$project->description}}</td>
                        <td>{{$project->progress}}%</td>
                        <td>{{$project->name}}</td>
                    </tr>
                @endforeach            
            </tbody>
        </table>
    </div>
@endsection