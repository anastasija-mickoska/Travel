<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <style>
            body {
                margin: 0;
                padding: 0;
                height: 100vh; /* Ensure the body covers the full viewport height */
                background: 
                    linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), 
                    url('landscape.jpg') no-repeat center center/cover;
            }
            #homepage_statement {
                width:100%;
                height:300px;
                margin-top:10%;
                color:white;
            }
            #home {
                text-align: center;
                position:relative;
                width:100%;
                font-size:4em;
                letter-spacing: 0.25em;
                font-family:'Poppins','sans-serif';
                font-weight: 500;
            }
            #home2 {
                text-align: center;
                position:relative;
                width:100%;
                font-size:2em;
                letter-spacing: 0.2em;
                font-family:'Poppins','sans-serif';
                font-weight: 300;
                padding-top:2%;
            }
            #search {
                width:70%;
                height:150px;
                margin-left:15%;
                margin-right:15%;
                margin-top:2%;
            }
            .search1 {
                float:left;
                width:25%;
                margin-left:2%;
            }
            label {
                font-family:'Poppins','sans-serif';
                font-weight: 300;
                font-size:1.5em;
                letter-spacing:0.1em;
                color:white;
            }
            input, select {
                padding:5%;
                border-radius:5px;
                border:none;
                width:70%;
                opacity:0.3;
                font-family: 'Poppins','sans-serif';
                font-size:1em;
            }
            option {
                font-family: 'Poppins','sans-serif';
                font-size:1em;
            }
            #searchButton {
                width:15%;
                border-radius: 5px;
                border:none;
                margin-top:2.5%;
                padding:1.4%;
                background-color: #085a57;
                opacity:1;
                color:white;
            }
        </style>
    </head>
    <body>
            <nav>
                <ul>
                    <a href="home.php"><li>Home</li></a>
                    <a href="summer.php"><li>Summer</li></a>
                    <a href="winter.php"><li>Winter</li></a>
                    <a href="spring_fall.php"><li>Spring and fall</li></a>
                    <a href="login.php"><li>Login</li></a>
                </ul>
            </nav>
            <form method="get" id="searchForm">
                <div id="search">
                    <div class="search1">
                        <label for="destination">DESTINATION</label> <br>
                        <input type="text" name="destination">
                    </div>
                    <div class="search1">
                        <label for="when">WHEN</label> <br>
                        <select name="when">
                            <option value=" "></option>
                            <option value="Jan">January</option>
                            <option value="Feb">February</option>
                            <option value="Mar">March</option>
                            <option value="Apr">April</option>
                            <option value="May">May</option>
                            <option value="Jun">June</option>
                            <option value="Jul">July</option>
                            <option value="Aug">August</option>
                            <option value="Sep">September</option>
                            <option value="Oct">October</option>
                            <option value="Nov">November</option>
                            <option value="Dec">December</option>
                        </select>
                    </div>
                    <div class="search1">
                        <label for="duration">HOW LONG</label> <br>
                        <select name="duration">
                            <option value=" "></option>
                            <option value="1-3">1-3 days</option>
                            <option value="3-5">3-5 days</option>
                            <option value="week">One week</option>
                            <option value="1-2weeks">1-2 weeks</option>
                            <option value="2+">More than two weeks</option>
                        </select>
                    </div>
                    <input type="submit" value="SEARCH" id="searchButton">
                </div>
            </form>
        <div id="homepage_statement">
            <p id="home"> LET'S TRAVEL THE WORLD!
            </p>
            <p id="home2">
                Travel. Explore. Experience. 
            </p>
        </div>
    </body>
</html>