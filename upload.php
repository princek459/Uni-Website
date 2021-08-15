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



// setting variable and setting to empty values
$productname = $productdescription = $productcategory = $keywords = $price = $videourl = $imageurl = "";

// declare variables to hold error messages for each field.
$productnameError = $productdescriptionError = $productcategoryError = $keywordsError = $priceError = $videourlError = $imageurlError = "";
$foundErrors = false;

// function to clear userinputs
function clearUserInputs($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if(empty($_POST["productname"])){
        $productnameError = "Product Name is required";
        $foundErrors = true;
    }
    else{
        if(!preg_match("/^[a-zA-Z0-9 ]*$/",$_POST["productname"])) {
                $productnameError = "Only letters, numbers and white space allowed";
                $foundErrors = true;
            }
    else{
        $productname = clearUserInputs($_POST["productname"]);
    }

    if(empty($_POST["productdescription"])){
        $productdescriptionError = "Product Description is required";
        $foundErrors = true;
    }
    else{
        $productdescription = clearUserInputs($_POST["productdescription"]);
    }

    if(empty($_POST["productcategory"])){
        $productcategoryError = "Product Category is required";
        $foundErrors = true;
    }
    else{
        $productcategory = clearUserInputs($_POST["productcategory"]);
    }

    if(empty($_POST["keywords"])){
        $keywordsError = "Keywords are required";
        $foundErrors = true;
    }
    else{
        $keywords = clearUserInputs($_POST["keywords"]);
    }

    if(empty($_POST["price"])){
        $priceError = "price is required";
        $foundErrors = true;
    }
    else{
        $price = clearUserInputs($_POST["price"]);
    }

    if(empty($_POST["imageurl"])){
        $imageurlError = "imageurl is required";
        $foundErrors = true;
    }
    else{
        $imageurl = clearUserInputs($_POST["imageurl"]);
    }

    if(empty($_POST["videourl"])){
        $videourlError = "videourl is required";
        $foundErrors = true;
    }
    else{
        $videourl = clearUserInputs($_POST["videourl"]);
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


        //preparing the sql statements
            $sql = "INSERT INTO products
            (productname,
            productdescription,
            productcategory,
            keywords,
            price,
            imageurl,
            videourl) 
            VALUES(?,?,?,?,?,?,?)";

            $stmt = $conn->prepare($sql);


            $stmt->execute([$productname, $productdescription, $productcategory, $keywords, $price, $videourl, $imageurl]);
            echo "Product added.";
            }
            catch(PDOException $e)
        { //code to catch the error when same username is used
            $errorkey = "Intergrity constraint violation: no value given";
            if(strpos($e->getMessage(), $errorkey) > 0) {
            $priceError = "Item must have a price";
            }
            else {
            echo "Connection failed: " . $e->getMessage();
            }
        }
    }
   
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
        <a href="logout.php" class="btn btn-light mb-3"><< Logout </a>
    </div>
    
    <div class="topnav">
        <ul>
          <li><a href="products.php"> My Products </a></li>
          <li><a href="About.html"> About </a></li>
          <li><a href="welcome.php"> Logout </a></li>
        </ul>
    </div>
   <h1 style="text-align:center">Upload Product</h1>
    <div class="card border-danger">
        <div class="card-header big-danger text-white">
            <strong><i class="fa fa-plus"></i> Add New Product </strong>
        </div>

        <div class="card-body">
        <form enctype="multipart/form-data" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
            <div class="form-row">
               <div class="form-group col-and-6">
                   <label for="productname" class="col-form-label"> Product Name </label>
                   <input  type="text" class="form-control" id="productname" name="productname"
                   placeholder="Product Name" required >
                </div>
               <div class="form-group col-and-6">
                   <label for="productdescription" class="col-form-label"> Product Description </label>
                   <textarea class="form-control" id="" name="productdescription" rows="5"
                   placeholder="Product Description"> </textarea>
                </div>
                <div class="form-group col-and-6">
                   <label for="productcategory" class="col-form-label"> Product Category </label>
                   <input  type="text" class="form-control" id="productcategory" name="productcategory"
                   placeholder="Product Category" required >
                </div>
                <div class="form-group col-and-6">
                   <label for="keywords" class="col-form-label"> Keywords </label>
                   <input  type="text" class="form-control" id="Keywords" name="keywords"
                   placeholder="Keywords" >
                </div>
                <div class="form-group col-and-6">
                   
                   <input  type="number" class="form-control" id="price" name="price"
                   placeholder="Price" required >
                </div>
                <div class="form-group col-and-6">
                   <label for="imageurl" class="col-form-label"> Image </label>
                   <input  type="text" class="form-control" id="imageurl" name="imageurl"
                   placeholder="Image URL" >
                </div>
                <div class="form-group col-and-6">
                   <label for="videourl" class="col-form-label"> Video </label>
                   <input  type="text" class="form-control" id="videourl" name="videourl"
                   placeholder="Video URL" >
                </div>
                <input type="submit" value="Upload" name="products.php" class="btn btn-block btn-primary" />
            </div>
        </form>
        </div>
    </div>

   
  
   



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