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
<?php
        


        $username = "username";
        $password = "password";
        $servername = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "cis4004";

        $conn = new mysqli($servername,$dbusername,$dbpassword,$dbname);
        if($conn->connect_error){
            $dbConnectionError = "Error in connecting to the database";
        }
        else{
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
            $stmt->bind_param("ss",$username,$password);
            $stmt->execute();
            $result = $stmt->get_result();


            if($result->num_rows === 0){
                $credentialError = "Invalid Username or password";
                
        }
        else{
            echo "Rows: " . $result->num_rows;
            $row = $result->fetch_assoc();
            $_SESSION["username"] = $row["username"];
            $_SESSION["userid"] = $row["user_id"];

            // redirection to a new page
            header('location: log.php');
        
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <title> eWorld </title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="author" content="Prince Kunzwa"/>
    <meta name="description" content="welcome page"/>
    <meta name="keywords" content="online, ecommerce, shopping, student"/>
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" media="screen" href="homepage.css" />
    <script src="main.js"></script>
</head>
<body>
    <!-- start of header-->
    <div class:"header" style="text-align: center">
        <h1> eWorld </h1>
        <a href="logout.php" class="btn btn-light mb-3"><< Logout </a>
    </div>
    
    <div class="topnav">
            <ul>
            <li><a href="products.php"> View My Products </a></li>
            
            </ul>
        </div>
 <?php
    
    $_SESSION['username'] = 'username';

    if($_SESSION['username']){
?>
        
    <div style="vertical-align: middle;">
        <h4> Welcome <?php echo $username ?>  <a href="logout.php"> Logout  </a> </h4>
    </div>
<?php
    }    
    ?>
    
    
    

   

        
            








        


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