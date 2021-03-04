<?php
$info = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST["send"]))
    {
        $myFile = "messages.json";
        $data = array();

        $formdata = array(        
            'email'=>$_POST['email'],
            'text'=> $_POST['text']
        );

        $jsondata = file_get_contents($myFile);
        $data = json_decode($jsondata, true);
        array_push($data, $formdata);
        $jsondata = json_encode($data, JSON_PRETTY_PRINT);
        if(file_put_contents($myFile, $jsondata))
        {
            $info = "Sporočilo je bilo poslano!";
        }	    
    }    
}


?>



<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
    <link rel="stylesheet" href="css/bootstrap-4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    
    <title>Podjetje</title>
  </head>
  <body class="bg-dark">

<!-- start navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.html">Podjetje</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item-active">
                <a class="nav-link" href="#">Domov<span class="sr-only">(Current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">O nas</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Za zaposlene
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="account/login.php">Račun</a>
                    <a class="dropdown-item" href="#">Urnik</a>
                    <a class="dropdown-item" href="#">Obvestila</a>
                </div>
            </li>
        </ul>
        <span class="navbar-text">"Podjetje", kjer je udobje vse</span>
    </div>
</nav>
<!-- end navbar -->

    <div id="about-text" class="text-light">
        Naše podjetje se ukvarja z vsem, kar vam srce poželi.
    </div>

    <div id="send-q">
        <form id="question" class="w-75 text-light bg-dark" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">E-poštni naslov</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-pošta" name="email">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Sporočilo</label>
                <textarea class="form-control" id="text" placeholder="Sporočilo" name="text" rows="10"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="send">Pošlji</button>
        </form>
        <span class="text-success"> <?php echo $info; ?> </span>
    </div>



<div id="footer" class="text-light">
    <div class="container">
        <div class="row">
            <div class="col">
                Timotej Gregorič &trade; &copy;
            </div>
            <div id="footer-loc" class="col">
                <p>Ljubljana</p> <br>
                <p>Slovenia</p> <br>
                <p>13246785474</p>
            </div>
            <div class="col">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                <div id="social" class="wrapper">
                    <a href="http://www.instagram.com"><i class="fa fa-3x fa-instagram"></i></a>
                    <a href="http://www.facebook.com"><i class="fa fa-3x fa-facebook-square"></i></a>
                    <a href="http://www.twitter.com"><i class="fa fa-3x fa-twitter-square"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="css/bootstrap-4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>