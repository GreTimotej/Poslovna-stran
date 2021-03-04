<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
{
    header("location:index.php");
}

require_once "../config.php";

$username = $password = "";
$username_err = $password_err = $robot_err= "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST["robot_check"]))
    {
        if(empty(trim($_POST["username"])))
        {
            $username_err = "Prosim vnesite svoj E-poštni naslov";
        }
        else
        {
            $username = trim($_POST["username"]);
        }
    
        if(empty(trim($_POST["password"])))
        {
            $password_err = "Prosim vnesite svoje geslo";
        }
        else
        {
            $password = trim($_POST["password"]);
        }
    
        if(empty($username_err) && empty($password_err))
        {
            $sql = "SELECT id, eMail, geslo FROM zaposleni WHERE eMail = ?";
    
    
    
            if($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                            
                $param_username = $username;
                            
                if(mysqli_stmt_execute($stmt))
                {
    
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1)
                    {
                        mysqli_stmt_bind_result($stmt, $id, $username, $pass_hash);
                        if(mysqli_stmt_fetch($stmt))
                        {
                            if(password_verify($password, $pass_hash))
                            {
                                session_start();
                                                            
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;                            
                                                            
                                header("location: index.php");
                            } 
                            else
                            {
                                
                                $password_err = "Vneseno geslo ni pravilno.";
                            }
                        }
                        else
                        {                    
                            $username_err = "To uporabiško ime ne obstaja.";
                        }
                    }
                    else
                    {
                        echo "Oops! Nekaj je šlo narobe. Poskusite kasneje.";
                    }
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }
    }
    else
    {
        $robot_err = "Ali ste morda robot?";
    }
}



?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Podjetje - prijava</title>
    <link rel="stylesheet" href="../css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">        
    <link rel="stylesheet" href="../css/bootstrap-4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    
</head>
<body class="text-light bg-dark">

    <center id="loginform">
        <div class="w-100">    
            <form class="w-75 text-light bg-dark" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">E-poštni naslov</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-pošta" name="username">   
                    <span class="text-danger bg-warning"> <?php echo $username_err; ?> </span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Geslo</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Geslo" name="password">
                    <span class="text-danger bg-warning"> <?php echo $password_err; ?> </span>
                </div> 
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="robot_check">
                    <label class="form-check-label" for="exampleCheck1">Nisem robot</label> <br>
                    <span class="text-danger bg-warning"> <?php echo $robot_err; ?> </span>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Prijava</button>
            </form>
        </div>
    </center>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="css/bootstrap-4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>