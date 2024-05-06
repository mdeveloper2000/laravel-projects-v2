<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Laravel Projects | Register</title>
</head>

<body>

    <div class="container w-50 min-vh-100 d-flex flex-column justify-content-center">
        <h2 class="text-center mb-3">
            <i class="bi bi-stack"></i> Laravel Projects
        </h2>
        <form method="POST" action="{{route('user.store')}}" class="p-5 border shadow-lg" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <h5 class="text-center fw-bold">Register</h5>
            </div>            
            <div class="mb-3">              
                <input type="text" class="form-control" name="name" placeholder="Name" maxlength="30" value="{{old('name')}}" />
                @error('name')
                    <div class="alert alert-danger mt-3">
                        <i class="bi bi-exclamation-circle-fill"></i> {{$message}}
                    </div>
                @enderror
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
                <input class="form-control" type="file" name="photo" />
            </div>
                @error('photo')
                    <div class="alert alert-danger mt-3">
                        <i class="bi bi-exclamation-circle-fill"></i> {{$message}}
                    </div>
                @enderror
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
                <a class="btn text-bg-primary" href="/users/login">
                    <i class="bi bi-person-plus-fill"></i> Have an account? Log in
                </a>                
                <button type="submit" class="btn btn-success float-end w-25">
                    <i class="bi bi-check-circle-fill"></i> Save
                </button>
            </div>
            <div class="mb-3">
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{$error}}
                    </div>
                @endif
            </div>
          </form>
    </div>

</body>

</html>