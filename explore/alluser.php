<?php 
   

   if($_SERVER["REQUEST_METHOD"] == "POST") {
        $productname = trim($_POST['productname']);
        $productdescription = trim($_POST['productdescription']);
        $productcategory = trim($_POST['productcategory']);
        $keywords = trim($_POST['keywords']);
        $price = (float)$_POST['price'];
        $imageurl = trim($_POST['imageurl']);
        $videourl = trim($_POST['videourl']);

        try{
            $sql = 'INSERT INTO products(productname, productdescription, productcategory,
                                        keywords, price, imageurl, videourl) 
                    VALUES(:productname, :productdescription, :productcategory,
                                        :keywords, :price, :imageurl, :videourl)';

            $stmt = $conn->prepare($sql);
            $stmt->bindparam(":productname", $productname);
            $stmt->bindparam(":productdescription", $productdescription);
            $stmt->bindparam(":productcategory", $productcategory);
            $stmt->bindparam(":keywords", $keywords);
            $stmt->bindparam(":price", $price);
            $stmt->bindparam(":imageurl", $imageurl);
            $stmt->bindparam(":videourl", $videourl);
            $stmt->execute();
            if($stat->rowCount()){
                header("location: upload.php?status=fail_create");
                exit();
            }
            
            header("location: upload.php?status=fail_create");
            exit();
            } catch (Exception $e){
                echo "Error " . $e->getMessage();
                exit();
       }

    }else {
       header("location: upload.php?status=fail_create");
       exit();
   }
  
   
   
   
   ?>