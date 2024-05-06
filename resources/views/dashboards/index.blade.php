@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card text-bg-light border-dark mb-3" style="border-radius: 0;">
                <div class="card-header text-center">
                    <i class="bi bi-kanban-fill"></i> Projects
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center fw-bold fs-1">{{count($projects)}}</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-bg-light border-dark mb-3" style="border-radius: 0;">
                <div class="card-header text-center">
                    <i class="bi bi-people-fill"></i> Users
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center fw-bold fs-1">{{$total_users}}</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-bg-light border-dark mb-3" style="border-radius: 0;">
                <div class="card-header text-center">
                    <i class="bi bi-infinity"></i> Finished Projecs
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center fw-bold fs-1">{{$finished}}</h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>       
    </div>
    <div class="row">
        <div class="col-8">            
            <div class="card text-bg-light border-dark mb-3" style="border-radius: 0;">
                <div class="card-header text-center">
                    <i class="bi bi-stopwatch-fill"></i> Latest Projects
                </div>
                <div class="card-body">
                    @foreach ($current as $p)
                        <div>
                            @php
                                $class = "";
                                switch ($p->progress) {
                                case '0':
                                    $class = "bg-danger";
                                    break;
                                case '25':
                                    $class = "bg-warning";
                                    break;
                                case '50':
                                    $class = "bg-info";
                                    break;
                                case '75':
                                    $class = "bg-primary";
                                    break;
                                case '100':
                                    $class = "bg-success";
                                    break;
                                }
                            @endphp                            
                            @if ($p->picture != null) <img src="{{ asset('storage/'.$p->picture) }}" class="img-sm" /> @else <i class="bi bi-gear-wide-connected" style="font-size: 2rem;"></i> @endif
                            <span>{{$p->title}}</span>
                            <div class="progress mt-1 mb-3" role="progressbar" aria-label="Example with label" aria-valuenow="{{$p->progress}}" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-striped progress-bar-animated {{$class}}"
                                    style="width: {{$p->progress == '0' ? '5' : $p->progress}}%">{{$p->progress}}%</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-4" style="min-height: 100%;">
            <div class="card text-bg-light border-dark mb-3" style="border-radius: 0; width: 100%;">
                <div class="card-header text-center">
                    <i class="bi bi-person-workspace"></i> Project Status
                </div>
                <div class="card-body">
                    <div class="progress mt-1 mb-3" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 40px;">
                        <div class="progress-bar bg-danger fw-bold fs-5" style="width: 5%;">{{$projects_0}}</div>
                    </div>
                    <div class="progress mt-1 mb-3" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 40px;">
                        <div class="progress-bar bg-warning fw-bold fs-5" style="width: 25%">{{$projects_25}}</div>
                    </div>
                    <div class="progress mt-1 mb-3" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 40px;">
                        <div class="progress-bar bg-info fw-bold fs-5" style="width: 50%">{{$projects_50}}</div>
                    </div>
                    <div class="progress mt-1 mb-3" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 40px;">
                        <div class="progress-bar bg-primary fw-bold fs-5" style="width: 75%">{{$projects_75}}</div>
                    </div>
                    <div class="progress mt-1 mb-3" role="progressbar" aria-label="Example with label" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 40px;">
                        <div class="progress-bar bg-success fw-bold fs-5" style="width: 100%">{{$projects_100}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <div class="card text-bg-light border-dark mb-3" style="border-radius: 0; width: 100%;">
                <div class="card-header text-center">
                    <i class="bi bi-calendar3-event"></i> New Users
                </div>
                <div class="card-body">
                    @foreach ($latest_users as $user)
                        <div class="mb-3">
                            @if ($user->photo != null) <img src="{{asset('storage/'.$user->photo)}}" class="rounded-circle p-0" alt="profile picture" width="35" height="35" /> @else <i class="bi bi-file-image" style="font-size: 1.5rem;"></i> @endif
                            <span>{{$user->name}}</span> <span class="small fst-italic">({{date_format($user->created_at, "d/m/Y H:i:s")}})</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-7">
            <div class="card text-bg-light border-dark mb-3" style="border-radius: 0; width: 100%;">
                <div class="card-header text-center">
                    <i class="bi bi-person-workspace"></i> Users' Metrics
                </div>
                <div class="card-body">
                    @foreach ($users_metrics as $user)
                        <div class="mb-3">
                            @if ($user->photo != null) <img class="rounded-circle p-0 mb-1" width="35" height="35" src="{{asset('storage/'.$user->photo)}}" /> @else <i class="bi bi-file-image mb-1" style="font-size: 1.5rem;"></i> @endif                            
                            <div class="progress-stacked" style="height: 30px;">
                                @foreach ($user->projects as $project)
                                    @if (in_array('0', $project))
                                        <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="{{$project['total']}}" aria-valuemin="0" aria-valuemax="100" style="height: 30px; width: {{$project['total']*100/count($user->projects)}}%;">
                                            <div class="progress-bar bg-danger fs-5 fw-bold">{{$project['total']}}</div>
                                        </div>                                                    
                                    @endif
                                    @if (in_array('25', $project))
                                        <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="{{$project['total']}}" aria-valuemin="0" aria-valuemax="100" style="height: 30px; width: {{$project['total']*100/count($user->projects)}}%;">
                                            <div class="progress-bar bg-warning fs-5 fw-bold">{{$project['total']}}</div>
                                        </div>                                                    
                                    @endif
                                    @if (in_array('50', $project))
                                        <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="{{$project['total']}}" aria-valuemin="0" aria-valuemax="100" style="height: 30px; width: {{$project['total']*100/count($user->projects)}}%;">
                                            <div class="progress-bar bg-info fs-5 fw-bold">{{$project['total']}}</div>
                                        </div>                                                    
                                    @endif
                                    @if (in_array('75', $project))
                                        <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="{{$project['total']}}" aria-valuemin="0" aria-valuemax="100" style="height: 30px; width: {{$project['total']*100/count($user->projects)}}%;">
                                            <div class="progress-bar bg-primary fs-5 fw-bold">{{$project['total']}}</div>
                                        </div>                                                    
                                    @endif
                                    @if (in_array('100', $project))
                                        <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="{{$project['total']}}" aria-valuemin="0" aria-valuemax="100" style="height: 30px; width: {{$project['total']*100/count($user->projects)}}%;">
                                            <div class="progress-bar bg-success fs-5 fw-bold">{{$project['total']}}</div>
                                        </div>                                                    
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-5">
            <div class="card text-bg-light border-dark mb-3" style="border-radius: 0; width: 100%;">
                <div class="card-header text-center">
                    <i class="bi bi-clipboard2-data-fill"></i> Your Metrics
                </div>
                <div class="card-body">                    
                    @foreach ($your_metrics as $singleUser)
                        <div class="mb-3">
                            @if ($singleUser->photo != null) <img class="rounded-circle p-0 mb-1" width="35" height="35" src="{{asset('storage/'.$singleUser->photo)}}" /> @else <i class="bi bi-file-image mb-1" style="font-size: 1.5rem;"></i> @endif
                            <div class="progress-stacked" style="height: 30px;">
                                @foreach ($singleUser->projects as $project)
                                    @if (in_array('0', $project))
                                        <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="{{$project['total']}}" aria-valuemin="0" aria-valuemax="100" style="height: 30px; width: {{$project['total']*100/count($singleUser->projects)}}%;">
                                            <div class="progress-bar bg-danger fs-5 fw-bold">{{$project['total']}}</div>
                                        </div>                                                    
                                    @endif
                                    @if (in_array('25', $project))
                                        <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="{{$project['total']}}" aria-valuemin="0" aria-valuemax="100" style="height: 30px; width: {{$project['total']*100/count($singleUser->projects)}}%;">
                                            <div class="progress-bar bg-warning fs-5 fw-bold">{{$project['total']}}</div>
                                        </div>                                                    
                                    @endif
                                    @if (in_array('50', $project))
                                        <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="{{$project['total']}}" aria-valuemin="0" aria-valuemax="100" style="height: 30px; width: {{$project['total']*100/count($singleUser->projects)}}%;">
                                            <div class="progress-bar bg-info fs-5 fw-bold">{{$project['total']}}</div>
                                        </div>                                                    
                                    @endif
                                    @if (in_array('75', $project))
                                        <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="{{$project['total']}}" aria-valuemin="0" aria-valuemax="100" style="height: 30px; width: {{$project['total']*100/count($singleUser->projects)}}%;">
                                            <div class="progress-bar bg-primary fs-5 fw-bold">{{$project['total']}}</div>
                                        </div>                                                    
                                    @endif
                                    @if (in_array('100', $project))
                                        <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="{{$project['total']}}" aria-valuemin="0" aria-valuemax="100" style="height: 30px; width: {{$project['total']*100/count($singleUser->projects)}}%;">
                                            <div class="progress-bar bg-success fs-5 fw-bold">{{$project['total']}}</div>
                                        </div>                                                    
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    @foreach($your_metrics as $u)
                        @if (count($u->projects) == 0)
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle-fill text-warning"></i> You're not working with any projects at the moment
                            </div>
                        @endif                        
                    @endforeach
                </div>
            </div>
        </div>
@endsection