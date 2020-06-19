<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<h1>INSERT DATA TO DATABASE</h1>
<h2>Enter data into student table</h2>
<ul>
    <form name="InsertData" action="InsertData.php" method="POST" >
<li>Product ID:</li><li><input type="text" name="productid" /></li>
<li>PName:</li><li><input type="text" name="pname" /></li>
<li>PSize:</li><li><input type="text" name="psize" /></li>
<li>Price:</li><li><input type="text" name="price" /></li>
<li>Residual:</li><li><input type="text" name="residual" /></li>
<li><input type="submit" /></li>
</form>
</ul>

<?php

if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-3-222-150-253.compute-1.amazonaws.com;port=5432;user=olvwnuffhenyxw;password=16b36975f5f7d6acc4ea3334927ba4a49377abf28f9f79ec153a206e9a2ddbf2;dbname=dcl4jpgsk5139f",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

//Khởi tạo Prepared Statement
//$stmt = $pdo->prepare('INSERT INTO product (productid, pname, psize, price, residual) values (:id, :name, :size, :prize, :residual)');

//$stmt->bindParam(':id','ab05');
//$stmt->bindParam(':name','phone');
//$stmt->bindParam(':size', 'big');
//$stmt->bindParam(':prize', '30000');
//$stmt->bindParam(':residual', '5');
//$stmt->execute();
//$sql = "INSERT INTO product (productid, pname, psize, price, residual) VALUES('ab05', 'phone','big','30000','5')";
$sql = "INSERT INTO product (productid, pname, psize, price, residual)"
        . " VALUES('$_POST[productid]','$_POST[pname]','$_POST[psize]','$_POST[price]','$_POST[residual]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
 if (is_null($_POST[productid])) {
   echo "productid must be not null";
 }
 else
 {
    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }
 }
?>
</body>
</html>
