<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Laravel Projects</title>
</head>

    <body class="text-bg-light">
        <div class="container mt-1">        
            <div class="row">
                <div class="col-2">
                    <nav class="navbar text-bg-primary" style="height: 100%;">
                        <div class="container">
                            <a href="/dashboards/index">
                                <i class="bi bi-stack"></i> Laravel Projects
                            </a>
                        </div>
                    </nav>
                </div>
                <div class="col-10">
                    <nav class="navbar text-bg-primary">
                        <div class="container-fluid">
                            <a class="navbar-brand">
                                @if (auth()->user()->photo != null) <img src="{{ asset('storage/'.auth()->user()->photo) }}" class="rounded-circle" width="40" height="40" /> @else <i class="bi bi-file-image" style="font-size: 2rem;"></i> @endif
                                <span class="text-light fw-bold fs-6"><i>Welcome, </i>{{ auth()->user()->name }}</span>
                                <span class="float-start">
                                    <a href="/users/edit/{{auth()->user()->id}}">
                                        <i class="bi bi-pencil-square text-bg-warning p-2 rounded"> Edit Profile</i>
                                    </a>
                                </span>                                
                            </a>
                            <form class="d-flex" role="search" method="post" action="{{route('dashboard.search')}}">
                                @csrf                                
                                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search" />
                                <button class="btn btn-info" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-2 mt-1">
                    <nav class="nav flex-column text-bg-light border">
                        <a class="nav-link text-dark active" aria-current="page" href="/dashboards/index">
                            <i class="bi bi-house-fill"></i> Home
                        </a>
                        <a class="nav-link text-dark" href="/projects/index">
                            <i class="bi bi-kanban"></i> Projects
                        </a>                        
                        <a class="nav-link text-dark" href="/users/settings">
                            <i class="bi bi-gear"></i> Settings
                        </a>
                        <form method="POST" action="{{ route('users.logout') }}">
                            @csrf
                            <button type="submit" class="btn text-start">
                                <i class="bi bi-door-open text-danger"></i> Exit
                            </button>
                        </form>                        
                    </nav>                    
                    <div class="mt-3">
                        <a class="btn btn-success w-100" href="/projects/create">
                            <i class="bi bi-node-plus-fill"></i> New Project
                        </a>                        
                    </div>
                </div>                
                <div class="col-10 mt-1">                    
                    @yield('content')
                </div>
            </div>            
        </div>    
    
    </body>

</html>