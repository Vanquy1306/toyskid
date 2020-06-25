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

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

//Khởi tạo Prepared Statement
//$stmt = $pdo->prepare('INSERT INTO addresskh (fullname, mobilenumber, landmark, city) values (:fullname, :mobilenumber, :landmark, :city)');

//$stmt->bindParam(':fullname','van quy');
//$stmt->bindParam(':mobilenumber','0906564482');
//$stmt->bindParam(':landmark', '86 le tan trung');
//$stmt->bindParam(':city', 'Da Nang');
//$stmt->execute();
//$sql = "INSERT INTO addresskh (fullname, mobilenumber, landmark, city) VALUES('van quy', '0906564482','86 le tan trung','Da Nang')";
$sql = "INSERT INTO addresskh (fullname, mobilenumber, landmark, city)"
        . " VALUES('$_POST[fullname]','$_POST[mobilenumber]','$_POST[landmark]','$_POST[city]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
 if (is_null($_POST[productid])) {
   echo "Error";
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
