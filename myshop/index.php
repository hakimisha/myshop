<?php

include_once("php/dbconnect.php");

?>
<!DOCTYPE html>
<html>

<head>
    <title>My Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
    <div class="header">
        <h1>My Shop</h1>
        <p>Welcome to My Shop</p>
    </div>
    <div class="topnavbar" id="myTopnav">
        <a href="index.php">My Shop</a>
        </a>
    </div>
    <div class="main">
        <div class="row-single">
            <div class="card-header" type="submit">
                <h3>Product List</h3>
            </div>
        </div>
    
    <div>
        <br><br>
    <?php
echo "<table style='border: solid 1px black;
    margin-left: auto;
    margin-right: auto;'>";
 echo "<tr><th>Product Id</th><th>Product Name</th><th>Product Type</th><th>Product Price(RM)</th><th>Product Quantity</th><th>Date Created</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

try {
    $stmt = $conn->prepare("SELECT * FROM tbl_products");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
<div>

</div>

    </div>
        <a href="php/newproduct.php" class="float">
            <i class="fa fa-plus my-float"></i>
        </a>
</body>

</html>