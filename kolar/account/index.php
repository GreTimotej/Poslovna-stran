<?php
session_start();
error_reporting(E_ALL);
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "../config.php";
$id = $_SESSION["id"];
$sql = "SELECT * FROM ZAPOSLENI WHERE id = $id";

$result = $link->query($sql);
if ($result->num_rows > 0)
{
    // output data of each row
    
    while($row = $result->fetch_assoc())
    {
        $id = $row["id"];
        $name = $row["ime"];
        $lastName = $row["priimek"];
        $birth = $row["rojstvo"];
        $davcna = $row["davcna"];
        $address= $row["hisnaSt"];
        $ZIP = $row["postnaSt"];
    }
} else
{
    echo "0 results";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Profil -  <?php echo $name . " " . $lastName ?></title>
    <link rel="stylesheet" href="../css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">        
    <link rel="stylesheet" href="../css/bootstrap-4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    
</head>
<body>

    


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="css/bootstrap-4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>

<a href="logout.php"> Odjava </a>
