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
<html>
<head>
    <title> Registration form </title>
    <link rel="stylesheet" type="text/css" media="screen" href="registry.css" />
        <style>
        .signup {
            border:1px solid #999999;
            font: normal 14px helvetica;
            color: #444444;
        }
        </style>
        <script>

        </script>
</head>
<body>
    
    <?php

        // define variables and set to empty values
        $fullname = $age = $address1 = $address2 = $address3 = $username = $password  = $email = "";
        $profilePic = "";

        // declare variables to hold error messages for each field. 
        $fullnameError = $ageError = $address1Error = $address2Error = $address3Error = $usernameError = $passwordError = $emailError = "";
        $foundErrors = false;
        $profilePicError = "";

        // function to clear userinputs
        function clearUserInputs($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // if the form has been submitted, AND the method is POST
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["fullname"])){
                $fullnameError = "Fullname is required";
                $foundErrors = true;
            }
            else{
            if(!preg_match("/^[a-zA-Z ]*$/",$_POST["fullname"])) {
                    $fullnameError = "Only letters and white space allowed";
                    $foundErrors = true;
                }
            else{
                $fullname = clearUserInputs($_POST["fullname"]);
                
            }
            if(empty($_POST["age"])){
                $ageError = "Age is required.";
                $foundErrors = true;
            }
            else{
                $age = clearUserInputs($_POST["age"]);
            }

            if(empty($_POST["address1"])) {
                $address1Error = "Address is required";
                $foundErrors = true;
            }
                else {
                $address1 = clearUserInputs($_POST["address1"]);
            }

            if(empty($_POST["address2"])) {
                $address2Error = "Address is required";
                $foundErrors = true;
            }
                else {
                $address2 = clearUserInputs($_POST["address2"]);
            }

            if(empty($_POST["address3"])) {
                $address3Error = "Address is required";
                $foundErrors = true;
            }
                else {
                $address3 = clearUserInputs($_POST["address3"]);
            }

            if(empty($_POST["username"])) {
                $usernameError = "Username is required";
                $foundErrors = true;
            }
                else {
                $username = clearUserInputs($_POST["username"]);
            }
            
            if(empty($_POST["password"])) {
                $passwordError = "Password is required";
                $foundErrors = true;
            }   
                else {
                $password = clearUserInputs($_POST["password"]);
            }

            if(empty($_POST["email"])) {
                $emailError = "Email is required";
                $foundErrors = true;
            }
                else {
                // validate email address
            if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    $email = clearUserInputs($_POST["email"]);
                }
                else {
                    $emailError = "Invalid email address";
                    $foundErrors = true;
                }
                
            }
            
             // input file details
             $file_name = $_FILES['profilePic']['name'];
             $file_size = $_FILES['profilePic']['size'];
             $file_tmp = $_FILES['profilePic']['tmp_name'];
             $file_type = $_FILES['profilePic']['type'];
             $basename_file = basename($_FILES['profilePic']['name']);
             $file_ext = strtolower(pathinfo($basename_file,PATHINFO_EXTENSION));
 
             $allowed_extensions = array("jpeg", "jpg","png");
 
             if ($file_size > 500000){
                 $profilePicError .= "Sorry, your file is too large <br>";
                 $imageok = false;
             }
             else if(in_array($file_ext, $allowed_extensions)=== false){
                $profilePicError .= "Only JPEG, PNG, JPG files are allowed <br>";
                 $imageok = false;
             }
             else {
                 $imageok = true;
             }
            

        if($foundErrors == false) {
                $servername = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $databasename = "cis4004";

                // PHP code to save form data to the MySQL database
                try{
                    $conn = new PDO("mysql:host=$servername;dbname=$databasename",
                                        $dbusername, $dbpassword);
                // setting the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    echo "Connected successfully <br>";
                
    
        // prepare SQL statements to insert data
        $sql = "INSERT INTO users 
        (fullname,
        age,
        address1,
        address2,
        address3,
        username,
        password,
        email,
        profil_pic)
        values(?,?,?,?,?,?,?,?,?)";


        $stmt = $conn->prepare($sql);


        $stmt->execute([$fullname, $age, $address1, $address2, $address3, $username, $password, $email, $profilePic]);
        echo "New user added to the database : ";
        }
        catch(PDOException $e)
        { //code to catch the error when same username is used
            $errorkey = "Intergrity constraint violation: 1062 Duplicate entry";
            if(strpos($e->getMessage(), $errorkey) > 0) {
            $usernameError = "username already exist";
            }
            else {
            echo "Connection failed: " . $e->getMessage();
            }
        }

            //code to handle the image upload
            //code to handle updating users table with image location
            $last_user_id = $conn->lastInsertId();
            echo "New user added with ID: " . $last_user_id;
            
            if (!$imageok){
                $profilePicError .= "selected image is valid <br>";
            }
            else {
                $target_dir = "images\\" . "\\profilePics\\" ;
                if(file_exists($target_dir)){
                    echo "<br>The folder $target_dir exists<br>";
                }else {
                    echo "<br>The folder $target_dir does not exist <br>";
                    if (!mkdir($target_dir,0755, true)) {
                        die('failed to create folders...');
                    }
                }
            }

            $unique_name = uniqid(). "-" . $basename_file;

            $target_file = $target_dir . $unique_name;
            if(move_uploaded_file($file_tmp, $target_file)){
                $fileuploadok = true;
                echo "The file ". $basename_file. " has been uploaded. ";
                $sql = "UPDATE 'users' SET 'profil_pic' = ? WHERE 'users' . 'user_id' = ?";
            $stmt = $conn->prepare($sql);
            } else {
                $fileuploadok = false;
                $profilePicError .= "Sorry there was an error uploading your file. <br>";
            }

            
            

        

        }
    
       
    }



    }



    
    

    ?>





    <!-- container for the main body of the page-->
    <div class="module">
            <h1 style="text-align:center">Create an account</h1>
            <form class="form" enctype="multipart/form-data" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
              <div class="alert alert-error"></div>
              <input type="text" placeholder="Full Name" name="fullname" required />

              <input type="text" placeholder="Age" name="age"  required />

              <input type="text" placeholder="Address 1" name="address1" required />

              <input type="text" placeholder="Address 2" name="address2" required />

              <input type="text" placeholder="Address 3" name="address3" required />

              <input type="text" placeholder="User Name" name="username" required />
              

              <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />

              <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />

              <input type="email" placeholder="Email" name="email" required />

              <div class="avatar"><label>Select your avatar: </label><input type="file" name="profilePic" id="profilePic" accept="image/*" required /></div>
            
              <input type="submit" value="Upload" name="welcome.php" class="btn btn-block btn-primary" <a href="welcome.php"> </a> 
              <p style="text-align: center" class="message">Already Registered? <a href="index.php"> login</a> </p>
            </form>
          </div>

    


</body>
</html>