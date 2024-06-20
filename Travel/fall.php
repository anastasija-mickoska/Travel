<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <style>
            body {
                background: linear-gradient(#085a57, rgba(8, 90, 87, 0.4)) no-repeat center center/cover;
            }
            h1 {
                font-family: 'Poppins','sans-serif';
                font-weight:300;
                font-size:2.5em;
                color:white;
                letter-spacing: 0.25em;
                width:80%;
                margin-left: 5%;
                margin-top:2%;
                text-decoration: underline 1px white;
                text-underline-offset: 5px;
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
            <h1>FALL</h1>
            <div class="filter">
                <form method="get">
                    <div class="Forms">
                        <label class="form1" for="priceRange">Price range</label> <br>
                        <select class="form1" for="priceRange">
                            <option value=""></option>
                            <option value="1">0-100</option>
                            <option value="2">101-200</option>
                            <option value="3">201-300</option>
                            <option value="4">301-400</option>
                            <option value="5">401-500</option>
                            <option value="6">500+</option>
                        </select>
                    </div>
                    <div class="Forms">
                        <label class="form1" for="date">Date</label> <br>
                        <input class="form1" type="date" name="date">
                    </div>
                    <div class="Forms">
                        <label class="form1" for="location">Location</label> <br>
                        <input class="form1" type="text" name="location">
                    </div>
                    <div class="Forms">
                        <input class="form1" type="submit" value="SEARCH">
                    </div>
                </form> 
            </div>
            <section class="arr">
                <a href="">
                    <div class="arr1">
                        <div class="desc">
                            <h3>Destination</h3>
                            <h4><i>From - to </i></h4>
                            <h4 class="price">Price</h4>
                        </div>
                    </div>
                </a>
            </section>
            <footer>
                <p>&copy 2024</p>
            </footer>
    </body>
</html>