<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $name=$_POST['name'];
    $sku=$_POST['sku'];
    $price=$_POST['price'];
    $size=$_POST['size'];
    $weight=$_POST['weight'];
    $dimension=$_POST['dimension'];
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
    } else {
        //updating the table
        $sql = "UPDATE products SET name=:name, sku=:sku, price=:price, size=:size, weight=:weight, dimension=:dimension WHERE id=:id";
        $query = $dbConn->prepare($sql);

        $query->bindparam(':id', $id);
        $query->bindparam(':name', $name);
        $query->bindparam(':sku', $sku);
        $query->bindparam(':price', $price);
        $query->bindparam(':size', $size);
        $query->bindparam(':weight', $weight);
        $query->bindparam(':dimension', $dimension);
        $query->execute();

        // Alternative to above bindparam and execute
        // $query->execute(array(':id' => $id, ':name' => $name, ':email' => $email, ':age' => $age));

        //redirectig to the display page. In our case, it is index.php
        header("Location: index.php");
    }
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM products WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
    $name = $row['name'];
    $sku = $row['sku'];
    $price = $row['price'];
    $size = $row['size'];
    $weight = $row['weight'];
    $dimension = $row['dimension'];
}
?>
<html>
<head>
    <title>Edit Data</title>
</head>

<body>
<a href="index.php">Home</a>
<br/><br/>

<form name="form1" method="post" action="edit.php">
    <table border="0">
        <tr>
            <td>SKU</td>
            <td><input type="text" name="name" value="<?php echo $name;?>"></td>
        </tr>
        <tr>
            <td>Name</td>
            <td><input type="text" name="sku" value="<?php echo $sku;?>"></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type="text" name="price" value="<?php echo $price;?>"></td>
        </tr>
        <tr>
            <td>Size</td>
            <td><input type="text" name="size" value="<?php echo $size;?>"></td>
        </tr>
        <tr>
            <td>Weight</td>
            <td><input type="text" name="weight" value="<?php echo $weight;?>"></td>
        </tr>
        <tr>
            <td>Dimension</td>
            <td><input type="text" name="dimension" value="<?php echo $dimension;?>"></td>
        </tr>
        <tr>
            <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
            <td><input type="submit" name="update" value="Update"></td>
        </tr>
    </table>
</form>
</body>
</html>
