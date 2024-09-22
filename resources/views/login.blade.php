<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    @if(isset($message))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="top-alert">
        
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">{{ $message }}</span>
        </button>
    </div>
    @endif
    <div class="container">
        <!-- Login Form -->
        <div id="login" class="form-container">
            <div class="form-left">
                <img src="images/cat1.jpg" alt="Login Image">
            </div>
            <div class="form-right">
                <h2>Log in</h2>
                <form action="/loginPost" method="POST">
                    @csrf
                    <div class="input-container">
                        <input type="email" id="login_email" name="email" placeholder="Email" required>
                    </div>
                    <div class="password-wrapper">
                        <input type="password" id="login_password" name="password" placeholder="Password Enter at 8+ characters" required>
                    </div>
                    <input type="submit" value="Login" class="sb-btn">
                </form>
                <p>Don’t Have an Account? <a href="/register">Create Account</a></p>
            </div>
        </div>
    </div>
    <script src="js/loginsignup.js"></script>
</body>


</html>