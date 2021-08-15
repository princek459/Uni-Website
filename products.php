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
    <link rel="stylesheet" type="text/css" media="screen" href="products.css" />
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
          <li><a href="Upload.php"> Upload </a></li>
          <li><a href="About.html"> About </a></li>
          
        </ul>
    </div>
    <h1 style="text-align:center">My Products</h1>


            <table style="border-spacing: 5px; width: 90%; text-align: center; border: 1px black;">
            
                    <tr style="background-color: dark green;">
                        <th><label> Product Name </label></th>
                        <th> Product Description </th>
                        <th> Product Category </th>
                        <th> keywords </th>
                        <th> Price </th>
                        <th> image URL </th>
                        <th> Video URL </th>
                    </tr>
            </table>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cis4004";

    // using MySQLi connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    //checking connection
    if($conn->connect_error){
?>
    <div class="error" style="background-color: lightgreen; border: 2px hidden white; border-radius: 3px;">
            <h3> Error while connecting to the MySQL database! </h3>
        </div>
<?php
    }
    else{
        echo "Connection ok.";
    }
?>
<?php
    
    $sql_statement = "SELECT `productname`, `productdescription`, `productcategory`, `keywords`, `price`, `imageurl`, `videourl` FROM 'products'";
    $result = $conn->query($sql_statement);
    
    $stmt = $conn->prepare("SELECT `productname`, `productdescription`, `productcategory`, `keywords`, `price`, `imageurl`, `videourl` FROM products WHERE productname=? and productdescription=? and productcategory=? and keywords=? and price=? and imageurl=? and videourl=?");
    $stmt->bind_param("sssssss", $productname, $productdescription, $productcategory, $keywords, $price, $imageurl, $videourl);
    $stmt->execute();
    $result = $stmt->get_result();


    



    if($result->num_rows <= 0){
?>
        <div class="error" style="background-color: lightgreen; border: 2px hidden white; border-radius: 3px;">
            <h3> No user Data available </h3>
        </div>
<?php
    }
    else {
?>

    <table style="border: 2px solid green; width: 90%;">
        <tr style="background-color: green;">
            <th> Product Name </th>
            <th> Product Description </th>
            <th> Product Category </th>
            <th> keywords </th>
            <th> Price </th>
            <th> image URL </th>
            <th> Video URL </th>
        </tr>
<?php
   
    

    // outputting data to the rows
    while($row = $result->fetch_assoc()){
?>

        <tr>
            <th> <?php echo $row["productname"]; ?> </th>
            <th> <?php echo $row["productddescription"]; ?> </th>
            <th> <?php echo $row["productcategory"]; ?> </th>
            <th> <?php echo $row["keywords"]; ?> </th>
            <th> <?php echo $row["imageurl"]; ?> </th>
            <th> <?php echo $row["videourl"]; ?> </th>
            <th> <a href="editmodule.php?product_id=<?php echo $row['product_id'] ?>"> Edit </th>
            <th> <a href="deletemodule.php?product_id=<?php echo $row['product_id'] ?>"> Delete </th>
        <tr>
<?php
    
    }
    //end of while loop
}

    $conn->close();
?>
        </form>
    </table>


    
    
            




















    

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