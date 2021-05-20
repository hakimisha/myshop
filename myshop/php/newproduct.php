<?php
include_once("dbconnect.php");

if (isset($_GET['submit'])) {
        $prname = addslashes($_GET['prname']);
        $prprice = addslashes($_GET['prprice']);
        $prqty = addslashes($_GET['prqty']);
        $prtype = addslashes($_GET['prtype']);
        if ($prtype == "noselection") {
            echo "<script> alert('Please select product type')</script>";
        } else {
            $sqlinsert = "INSERT INTO tbl_products(prname,prprice,prqty,prtype) VALUES('$prname','$prprice','$prqty','$prtype')";
            try {
                $conn->exec($sqlinsert);
                echo "<script> alert('Success')</script>";
                echo "<script> window.location.replace('../index.php')</script>";
            } catch (PDOException $e) {
                echo "<script> alert('Failed')</script>";
        }
    }
} 
function uploadImage($email)
{
    $target_dir = "../images/";
    $target_file = $target_dir . $prname . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>New Product</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div class="header">
        <h1>My Shop</h1>
        <p>Welcome to My Shop</p>

    </div>
    <div class="topnavbar" id="myTopnav">
        <a href="../index.php">My Shop</a>
    
    </div>
    <div class="main">
        <div class="row-single">
            <div class="card-header" type="submit">
                <h3>Please Key In Product Info</h3>
            </div><br><br>

            <form name="questionForm" action="newproduct.php" onsubmit="return validateNewQForm()" method="get">
                <div class="row">
                    <div class="col-25">
                        <label for="topics">Product Type</label>
                    </div>
                    <div class="col-75">
                        <select name="prtype" id="idtopic" required>
                            <option value="">Please select product type</option>
                            <option value="Smartphone">Smartphone</option>
                            <option value="Smartwatch">Smartwatch</option>
                            <option value="Laptop">Laptop</option>
                            <option value="Accessori">Accessori</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lnamea">Product Name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="idanswera" name="prname" placeholder="Enter Product Name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lnameb">Product Price</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="idanswerb" name="prprice" placeholder="Enter Product Price" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="lnamec">Product Quantity</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="idanswerc" name="prqty" placeholder="Enter Product Quantity" required>
                    </div>
                </div>
                <div>
                <form name="updateprofileForm" action="newproduct.php" onsubmit="return validateUpdForm()" method="post" enctype="multipart/form-data">
                <img class="imgselection" class="circular--portrait" src="../images/profile/<?php echo $prproduct ?>.png ?" ><br>
                        <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload" accept="image/*"><br>
                </div>
                <div><input type="submit" name="submit" value="Submit"></div>
            </form>
        </div>
</body>

</html>