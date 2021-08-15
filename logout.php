<?php
        function my_session_start()
        {
            if (ini_get('session.use_cookies') && isset($_COOKIE['PHPSESSID'])) {
                $sessid = $_COOKIE['PHPSESSID'];
            } elseif (!ini_get('session.use_only_cookies') && isset($_GET['PHPSESSID'])) {
                $sessid = $_GET['PHPSESSID'];
            } else {
                session_start();
                return false;
            }

           if (!preg_match('/^[a-z0-9]{32}$/', $sessid)) {
                return false;
            }
            session_start();

           return true;
        }
    ?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <title> eWorld </title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="author" content="Prince Kunzwa"/>
    <meta name="description" content="online second hand store"/>
    <meta name="keywords" content="online, ecommerce, shopping, student"/>
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" media="screen" href="homepage.css" />
    <script src="main.js"></script>
</head>
<body>
    <!-- start of header-->
    <div class:"header" style="text-align: center;">
        <h1> eWorld </h1>
        <h4> Contact </h4>
    </div>
    <div class="topnav">
            <ul>
            <li><a href="index.html"> Homepage </a></li>
            </ul>
        </div>
    
    <div class="header" stlye="text-align: center;">
        <h5> Logged Out </h5>
    </div>

    
    
    

   

        
            








        


    <div style="margin-bottom: 450px;"></div>
        <hr>
        <!--start of the footer -->
    <footer id="main-footer">
                <p>Copyright &copy; 2019, eWorld
                    
                <button> <a href="contact.html"> Contact </a> </button> 
                </p>
            </footer>
</body>
</html>