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
    <link rel="stylesheet" type="text/css" media="screen" href="upload.css" />
    <script src="main.js"></script>
</head>
<body>
    <!-- start of header-->
    <div class:"header" style="text-align: center">
        <h1> eWorld </h1>
    </div>
    
    <div class="topnav">
        <ul>
          <li><a href="My Products.html"> My Prodcts </a></li>
          <li><a href="Upload.html"> Upload </a></li>
          <li><a href="Edit.html"> Edit </a></li>
          <li><a href="About.html"> About </a></li>
        </ul>


   </div>
   <h1 style="text-align:center">Upload Product</h1>

   <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
        <th colspan="2" align="center">Signup Form</th>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
            enctype="multipart/form-data">

            <tr>
                <td>product name</td>
                <td><input type="text" maxlength="32"
                 name="productname" value="<?php echo $productname; ?>"></td>
                <td><span class="error"> * <?php echo $productnameError; ?> </span></td> 
            </tr>

            <tr>
                <td>Surname</td>
                <td><input type="text" maxlength="32"
                 name="surname" value="<?php echo $surname; ?>"></td>
                <td><span class="error"> * <?php echo $surnameError; ?> </span></td> 
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
      
<?php 
// setting variable and setting to empty values
$productname = $productdescription = $productcategory = $keywords = $price = "";
$videourl = "";
$imageurl = "";

// declare variables to hold error messages for each field.
$productnameError = $productdescriptionError = $productcategoryError = $keywordsError = $priceError = "";
$videourlError = "";
$imageurlError = "";
















?>
        

    
    

        
            








        


    <div style="margin-bottom: 450px;"></div>
        <hr>
        <!--start of the footer -->
    <footer class="footer">
                <p>Copyright &copy; 2019, eWorld
                    
                <button> <a href="About.html"> Contact </a> </button> 
                </p>
            </footer>
</body>
</html>