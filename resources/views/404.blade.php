<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Laravel Projects | {{ $title }}</title>
</head>

<body class="bg-light">
    
    <div class="container mt-3 text-center">
        <div class="text-bg-primary p-2">
            <h1>Laravel Projects</h1>
        </div>
        <div style="font-size: 7rem;">
            <i class="bi bi-question-circle-fill text-danger"></i>
        </div>
        <div class="border mt-3 p-2 shadow">
            <h2>404 - Page Not Found</h2>
            <h5>The page you tried to access does not exist. Try another one</h5>
        </div>
        <div class="mt-5">
            <a class="btn btn-primary mt-5" href="/dashboards/index">
                <i class="bi bi-house-fill"></i> Return to homepage            
            </a>
        </div>
    </div>

</body>

</html>