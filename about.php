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
    <link rel="stylesheet" type="text/css" media="screen" href="about.css" />
    <script src="main.js"></script>
</head>
<body>
    <!-- start of header-->
    <div class:"header" style="text-align:center">
        <h1> eWorld </h1>
        <h4> About </h4>
    </div>

    
    
    <div class="topnav">
            <ul>
              <li><a href="products.php"> My Products </a></li>
              <li><a href="Upload.php"> Upload </a></li>
              <li><a href="About.html"> About </a></li>
            </ul>
        </div>
		
    <div class="container" style="overflow: auto;">
        <!-- defining the left collum-->
    <div class="left_col">
        
        <!-- start of first item -->
        <div class="image">

                <img src="images/51439023_10215459926309432_7874134625189101568_n.jpg" style="width: 30%; height: 30%; float: right;"
                    alt="My Profile Picture">
        <!-- end of first item -->
        </div>
        
    
        <!-- start of second item -->
        <div class="item">
                 <h2> Education</h1>
        <ul style="list-style-type: square">
             <li> <h4> Primary education </h2> </li>
                 <p> 
                 Warren Park 1 primary school
            <br>
                 The Pines Pre-school
            <br>
                 Our Lady's & St Swithens Primary School
                 </p>
             <li><h4> Secondary Education </h4> </li>
                 <p>    
                 The Academy of St Francis of Assisi 
            <br>
                 ArchBishop Blanch Sixth Form
                 </p>
             <li><h4> Undergraduate level </h4> </li>
                 <p> 
                 Cardiff Metropolitan University
                 </p>
        </ul>
        <!-- end of second item-->
        </div>

        <!-- start of third item-->
        <div class="item">
                 <h2> About Me </h2>
                 <p> I am a 22yr old software engineering first year student at Cardiff Metropolitan.<br> Welcome to my ecommerce website that is
                  is created for students to sell second hand and used items. </p>
        <!-- end of third item -->
        </div>
    </div>

    <div class="right_col">

        
    </div>
    






    </div>






    </div>


    









    <hr>
        <!--start of the footer -->
    <footer class="footer">
                <p>Copyright &copy; 2019, eWorld
    
                </p>
                
    </div>
            

            </footer>
</body>
</html>



