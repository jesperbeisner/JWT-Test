<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JWT-Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row mt-4 d-none" id="info-alert">
        <div class="col">
            <div class="alert alert-primary text-center" role="alert">
                <span id="info-alert-text">Info alert placeholder</span>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="card" style="border-top: 2px solid green; box-shadow: 2px 2px 5px grey;">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" value="root">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" value="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-primary" id="login-button">Login</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-danger float-end" id="logout-button">Logout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <div class="card" style="border-top: 2px solid green; box-shadow: 2px 2px 5px grey;">
                <div class="card-body text-center">
                    <button class="btn btn-success btn-block" id="users-button" style="min-width: 250px">
                        Get Users
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/main.js"></script>
</body>
</html>