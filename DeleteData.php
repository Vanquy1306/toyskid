<!DOCTYPE html>
<html>
<body>

<h1>DELETE DATA TO DATABASE</h1>

<?php
ini_set('display_errors', 1);
echo "Delete database!";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-34-224-229-81.compute-1.amazonaws.com;port=5432;user=zszzwbjwubdbyj;password=d3a83753897c4a77a63dc9a6be72f667ec0529244972c9c51f40c9f6b556f9d0;dbname=dsai6gfcc9ucm",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

$sql = "DELETE FROM product WHERE productid = 'ab02'";
$stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record deleted successfully.";
} else {
    echo "Error deleting record: ";
}

?>
</body>
</html>
