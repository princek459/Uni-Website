<!DOCTYPE html>
<html>
<head>
    <title>An Example Form</title>
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
        $forename = $surname = $username = $password = $age = $email = "";
        $gender = "";
        $profilePic = "";

        // declare variables to hold error messages for each field. 
        $forenameError = $surnameError = $usernameError = $passwordError = $ageError = $emailError = "";
        $genderError = "";
        $foundErrors = false;
        $profilePicError = "";

        // if the form has been submitted, AND the method is POST
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["forename"])){
                $forenameError = "Forename is required";
                $foundErrors = true;
            }
            else{
                if(!preg_match("/^[a-zA-Z ]*$/",$_POST["forename"])) {
                    $forenameError = "Only letters and white space allowed";
                    $foundErrors = true;
                }
                else{
                    $forename = clearUserInputs($_POST["forename"]);
                }
            }
            
            if(empty($_POST["surname"])) {
                $surnameError = "Surname is required";
                $foundErrors = true;
            }
            else {
                $surname = clearUserInputs($_POST["surname"]);
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
            
            if(empty($_POST["age"])){
                $ageError = "Age is required.";
                $foundErrors = true;
            }
            else{
                $age = clearUserInputs($_POST["age"]);
            }
            if(empty($_POST["gender"])){ 
                $genderError = "Gender must be selected";
                $foundErrors = true;
            }
            else {
                $gender = clearUserInputs($_POST["gender"]);
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


            if($foundErrors == false) {
                $servername = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $databasename = "cis4004";
                
                // PHP code to save form data to the MySQL database
                
            }
        }

        // function to clear userinputs
        function clearUserInputs($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

    <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
        <th colspan="2" align="center">Signup Form</th>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
            enctype="multipart/form-data">

            <tr>
                <td>Forename</td>
                <td><input type="text" maxlength="32"
                 name="forename" value="<?php echo $forename; ?>"></td>
                <td><span class="error"> * <?php echo $forenameError; ?> </span></td> 
            </tr>

            <tr>
                <td>Surname</td>
                <td><input type="text" maxlength="32"
                 name="surname" value="<?php echo $surname; ?>"></td>
                <td><span class="error"> * <?php echo $surnameError; ?> </span></td> 
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" maxlength="16"
                 name="username" value="<?php echo $username; ?>"></td>
                <td><span class="error"> * <?php echo $usernameError; ?> </span></td> 
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" maxlength="12" name="password"></td>
                <td><span class="error"> * <?php echo $passwordError; ?> </span></td> 
            </tr>
            <tr>
                <td>Age</td>
                <td><input type="text" maxlength="3"
                 name="age" value="<?php echo $age; ?>"></td>
                <td><span class="error"> * <?php echo $ageError; ?> </span></td> 
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <input type="radio" name="gender"
                     value="female"
                     <?php if(isset($gender) && $gender=="female") echo "checked"; ?>>Female

                    <input type="radio" name="gender"
                    value="male"
                    <?php if(isset($gender) && $gender=="male") echo "checked"; ?>>Male
                
                </td>
                <td><span class="error"> * <?php echo $genderError ?> </span></td> 
            </tr>

            <tr>
                <td>Email</td>
                <td><input type="text" maxlength="64"
                 name="email" value="<?php echo $email; ?>" ></td>
                <td><span class="error"> * <?php echo $emailError ?> </span></td> 
            </tr>
            <tr>
                <td>Profile picture</td>
                <td><input type="file" maxlength="64"
                 name="profilepic" id="profilepic" ></td>
                <td><span class="error"> * <?php echo $profilePicError ?> </span></td> 
            </tr>
            <tr>
                <td> Selected file : </td>
                <td> <?php echo $profilePic; ?> </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Signup">
                </td>
            </tr>
        </form> 
    </table>
    <hr>
    
    <h2> Your inputs </h2>
    <table border="0" cellpadding="2" cellspacing="5" bgcolor="#f1f1f1">
        <tr>
            <td> Forename entered: </td>
            <td> <?php echo $forename ?> </td>
        </tr>
        <tr>
            <td> Surname entered: </td>
            <td> <?php echo $surname ?> </td>
        </tr>
        <tr>
            <td> Username entered: </td>
            <td> <?php echo $username ?> </td>
        </tr>
        <tr>
            <td> Age entered: </td>
            <td> <?php echo $age ?> </td>
        </tr>
        <tr>
            <td> Gender selected: </td>
            <td> <?php echo $gender ?> </td>
        </tr>

        <tr>
            <td> Email entered: </td>
            <td> <?php echo $email ?> </td>
        </tr>

    </table>


</body>
</html>
        $sql = "UPDATE 'users' SET 'profil_pic' = ? WHERE 'users' . 'user_id' = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$target_dir, $last_user_id]);
        $stmt->execute([$fullname, $age, $address1, $address2, $address3, $username, $password, $email, $profilePic]);


        $stmt = $conn->prepare($sql);


        $stmt->execute([$fullname, $age, $address1, $address2, $address3, $username, $password, $email, $profilePic]);


        // setting variable and setting to empty values
$productname = $productdescription = $productcategory = $keywords = $price = "";
$videourl = "";
$imageurl = "";

// declare variables to hold error messages for each field.
$productnameError = $productdescriptionError = $productcategoryError = $keywordsError = $priceError = "";
$videourlError = "";
$imageurlError = "";

$stmt = $conn->prepare("SELECT * FROM products WHERE productname=? and productdescription=? and productcategory=? and keywords=? and price=? and imageurl=? and videourl=?");
    $stmt->bind_param("sssssss", $_GET["$productname, $productdescription, $productcategory, $keywords, $price, $imageurl, $videourl"]);
    $stmt->execute();
    $result = $stmt->get_result();



<form class="form" enctype="multipart/form-data" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>
                          <div class="alert alert-error"></div>
                          <input type="text" placeholder="Product Name" name="productname" required />
                          <input type="text" placeholder="Product description" name="productdescription" required />
                          <input type="text" placeholder="Product Category" name="productcategory" required />
                          <input type="text" placeholder="Key Words" name="keywords" required />
                          <input type="text" placeholder="Price" name="price" required />
                          <input type="text" placeholder="Video link" name="videourl" required />
                          <input type="text" placeholder="Image link" name="imageurl" required />
                          <input type="submit" value="upload" name="upload" class="btn btn-block btn-primary" />
                        </form>
                      </div>