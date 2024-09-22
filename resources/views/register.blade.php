<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    @if (isset($message))
    <div class="alert alert-danger">
        {{$message}}
    </div>
    @endif
    <div class="container">
        <div class="form-section">
            <h2>Sign up</h2>
            <form action="/registerPost" method="POST" id="signupForm" onsubmit="handleSignupSubmit(event)">
                @csrf
                <div class="input-group">
                    <input type="text" id="firstName" name="first_name" placeholder="First name" required>
                    <br/>
                    <input type="text" id="lastName" name="last_name" placeholder="Last name" required>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="Password Enter at 8+ characters" required>
                   
                </div>
                
               
                <input type="submit" value="Create an Account" class="sb-btn">
            </form>
            <br/>
            <p>Already have an account? <a href="/login">Log in</a></p>
        </div>
        <div class="image-section">
            <img src="images/cat2.jpg" alt="Background Image">
        </div>
    </div>
    <script src="js/loginsignup.js"></script>

</body>
</html>