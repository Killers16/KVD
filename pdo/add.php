<html>
<head>
    <title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {
    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $weight = $_POST['weight'];
    $dimension = $_POST['dimension'];

    // checking empty fields
    if(empty($name) || empty($sku) || empty($price)) {

        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }

        if(empty($sku)) {
            echo "<font color='red'>SKU field is empty.</font><br/>";
        }

        if(empty($price)) {
            echo "<font color='red'>Price field is empty.</font><br/>";
        }

        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
        // if all the fields are filled (not empty)

        //insert data to database
        $sql = "INSERT INTO products(name, sku, price ,size , weight ,dimension) VALUES(:name, :sku, :price , :size ,:weight ,:dimension)";
        $query = $dbConn->prepare($sql);

        $query->bindparam(':name', $name);
        $query->bindparam(':sku', $sku);
        $query->bindparam(':price', $price);
        $query->bindparam(':size', $size);
        $query->bindparam(':weight', $weight);
        $query->bindparam(':dimension', $dimension);
        $query->execute();

        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='index.php'>View Result</a>";
    }
}
?>
</body>
</html>