<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <style>
            body {
                background: linear-gradient(#085a57, rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
            }
            .Login {
                height:100vh;
            }
            .login {
                width:40%;
                margin-left:30%;
                margin-right:30%;
                box-shadow: 3px 3px 5px gray;
                border-radius:10px;
                height:60%;
                margin-top:5%;
                margin-bottom:5%;
                background-color: white;
                opacity:0.5;
                padding:2%;
            }
            label {
                font-family:'Poppins','sans-serif';
                font-weight:300;
                font-size:1.5em;
                letter-spacing:0.2em;
                margin-bottom:10%;
            }
            input {
                width:45%;
                padding:2%;
                border-radius:5px;
                background-color:white;
                font-size:1em;
                font-family: 'Poppins','sans-serif';
                font-weight:100;
                color:black;
            }
            form {
                margin-top:10%;
                width:100%;
            }
            .input1 {
                width:100%;
                margin:5%;
                margin-left:25%;
            }
            #loginButton {
                border-radius:10px;
                border:none;
                width:50%;
                margin-left:25%;
                background-color: #085a57;
                color:white;
                padding:2%;
                font-size:1.5em;
                letter-spacing: 0.1em;
            }
            h1 {
                font-family: 'Poppins','sans-serif';
                font-weight:300;
                font-size:2.5em;
                color:black;
                letter-spacing: 0.1em;
                text-align: center;
                width:100%;
                margin-top:2%;
            }
            h4 {
                width:50%;
                font-family: 'Poppins','sans-serif';
                font-weight:300;
                font-size:1.5em;
                color:black;
                letter-spacing: 0.1em;
                text-align: center;
                margin-top:2%;
            }
            a {
                text-decoration: underline 1px black;
            }
        </style>
    </head>
    <body>
            <nav>
                <ul>
                    <a href="home.php"><li>Home</li></a>
                    <a href="summer.php"><li>Summer</li></a>
                    <a href="winter.php"><li>Winter</li></a>
                    <a href="spring.php"><li>Spring</li></a>
                    <a href="fall.php"><li>Fall</li></a>
                    <a href="login.php"><li>Login</li></a>
                </ul>
            </nav>
            <section class="Login">
                <div class="login">
                    <h1>Log in to your account</h1>
                    <form method="post">
                        <div class="input1">
                            <label for="username">USERNAME</label> <br>
                            <input type="email" name="username"> <br>
                        </div>
                        <div class="input1">
                            <label for="password">PASSWORD</label> <br>
                            <input type="password" name="password"> <br>
                        </div>
                        <input type="submit" value="LOGIN" id="loginButton">
                    </form>
                    <div class="input1">
                        <a href="register.php"><h4>Create your account</h4></a>
                    </div>
                </div>
            </section>
            <footer>
                <p>&copy 2024</p>
            </footer>
    </body>
</html>