<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Laravel Projects | Login</title>
</head>

<body>
    
    <div class="container w-50 min-vh-100 d-flex flex-column justify-content-center">
        <h2 class="text-center mb-3">
            <i class="bi bi-stack"></i> Laravel Projects
        </h2>
        <form method="POST" action="{{route('user.authenticate')}}" class="p-5 border shadow-lg">
            @csrf
            <div class="mb-3">
                <h5 class="text-center fw-bold">Login</h5>
            </div>            
            <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="E-mail" maxlength="50" value="{{old('email')}}" />
                @error('email')
                    <div class="alert alert-danger mt-3">
                        <i class="bi bi-exclamation-circle-fill"></i> {{$message}}
                    </div>
                @enderror
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
                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <a class="btn bg-success" href="/users/create">
                    <i class="bi bi-person-plus-fill"></i> Register a new account
                </a>
                <button type="submit" class="btn btn-primary float-end w-25">
                    <i class="bi bi-check-circle-fill"></i> Login
                </button>
            </div>            
        </form>        
    </div>

</body>

</html>