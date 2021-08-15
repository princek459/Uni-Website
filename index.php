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


//setting variables
$username = $password = "";
$usernameError = $passwordError = $dbConnectionError = $credentialError = "";

//code to check credentials put into log in fields
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $msg = '';
    if(isset($_POST['Login']) && !empty($_POST['username']) && !empty($_POST['password'])){

        if($_POST['username'] == 'tutorialspoint' && $_POST['password'] == '1234'){
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = 'tutorialspoint';

            echo 'You have entered the wrong password';
        }else {
            $msg = 'Wrong Usernme or Password!';
        }
    }

        if(empty($_POST['username'])){
            $usernameError = 'Username is required!';
        }else if(!preg_match("/^[<a-zA-Z0-9 ] *$/ ",$_POST['username'])){
            $usernameError = "Only Numbers, Letters and whitespace allowed.";
        }
        else{
            $username = clearUserInputs($_POST['username']);
        }
        
        if(empty($_POST['password'])){
            $passwordError = 'Password is required!';
        }else if(!preg_match("/^[a-zA-Z0-9 ] *$/ ",$_POST['password'])){
            $usernameError = "Only Numbers, Letters and whitespace allowed.";
        }
        else{
            $password = clearUserInputs($_POST['password']);
        }

        // connecting to MysqLi connection
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
                $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
                $stmt->bind_param("s",$username);
                $stmt->execute();
                $result = $stmt->get_result();
            if($result->num_rows === 0){
                $credentialError = "Invalid Username";
                echo 'Invalid Username';
            }
            else {
                $credentialError = "Invalid Password";
                echo 'Invalid Password';
            }
        }
        else{
            echo "Rows: " . $result->num_rows;
            $row = $result->fetch_assoc();
            $_SESSION["username"] = $row["username"];
            $_SESSION["userid"] = $row["user_id"];

            // redirection to a new page
            header('location: welcome.php');
            echo ', Valid Username and Password!';
        }
    }
}
// function to clear user inputs
function clearUserInputs($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
    <script src="homepage.js"></script>
</head>
<body>
    <!-- start of header-->
    <div class:"header" style="text-align: center">
        <h1> eWorld </h1>
        <h4> homepage </h4>
    </div>
    <!-- start of the navigation bar -->
    <div class="topnav">
         <ul>
            <li><a href="index.html"> Homepage </a></li>
         </ul>
   
   
    </div>

    
    
    
<!-- start of the login box class -->
    <div class="loginbox">
        <!-- inserting the avatar -->
         <img src="images/avatar.png" class="avatar">
        
         <form enctype="multipart/form-data" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
             <label> Username </label>
             <input type="text" name="" placeholder="Enter Username">
             <label> Password </label>
             <input type="password" name="" placeholder="Enter Password">
             <button> <a href="welcome.php"> Login </a> </button>
             <br>
             <br>
             <!-- link to the registry -->
             <a href="registry.php"> New user register here! </a>

         </form>
    

    </div>

        
            
    







        


    <div style="margin-bottom: 450px;"></div>
        <hr>
        <!--start of the footer -->
    <footer id="main-footer">
                <p>Copyright &copy; 2019, eWorld
                    
                </p>
            </footer>
</body>
</html>