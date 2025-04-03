<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocuTracker | Login</title>
    @vite('resources/css/c.css')
    @vite('resources/js/script.js')
</head>
<body>
    <div class="logo-container">
        <img src="{{ URL('images/bulsuLogo.png') }}" class="logo" alt="BulSuLogo">
    </div>
    
    <div class="container" id="container">
        <div class="inner-container" id="inner-container">
            <div class="form-container sign-in">
                <form>
                    <h1>Sign In</h1>
                    <input type="text" name="usernameSignIn" id="usernameSignIn" placeholder="Username/Email">
                    <input type="password" name="passwordSignIn" id="passwordSignIn" placeholder="Password">
                </form>
                    <p>Don't have an account? 
                        <button type="button"  class="toggle" onclick="toggleBtn()">Sign Up</button></p>
                    <button>Sign In</button>
            </div>

            <div class="center-panel bulsu-banner">
                <img src="{{ URL('images/bulsuLogo.png') }}">
                <h1 class="banner-heading">Bulacan State<br>University</h1>
                <p class="banner-text">Document Tracker</p>
              </div>

            <div class="form-container sign-up">
                <form action="registration.php" method="POST">
                    <h1>Sign Up</h1>
                    <input type="text" name="firstName" id="firstName" placeholder="First Name">
                    <input type="text" name="lastName" id="lastName" placeholder="Last Name">
                    <input type="text" name="username-sign-up" id="username-sign-up" placeholder="Username">
                    <input type="email" name="email" id="email" placeholder="Email">
                    <select name="department" id="department" placeholder="Department">
                        <option value="" disabled selected>Department</option>
                        <option value="College of Engineering">College of Engineering</option>
                        <option value="Office of The President">Office of the President</option>
                        <option value="Accounting Office">Accounting Office</option>
                        <option value="Office of The Chancellor">Office of The Chancellor</option>
                    </select>
                    <input type="password" name="passwordSignUp" id="passwordSignUp" placeholder="Password">
                    <button type="submit">Register</button>
                </form>
                    <p>Already't have an account?
                        <button type="button"  class="toggle" onclick="toggleBtn()">Sign In</button> </p>
            </div>
        </div>
    </div>
    <script src="/public/resources/js/script.js"></script>
</body>
</html>