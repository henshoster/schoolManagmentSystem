<?php
session_start();
require_once 'mvc/frontcontroller/frontcontroller.php';
require_once 'mvc/frontcontroller/router.php';
require_once 'mvc/frontcontroller/route.php';
$frontController = new FrontController(new Router, isset($_GET['route']) ? $_GET['route'] : null, isset($_GET['action']) ? $_GET['action'] : null);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- my custom css -->
    <link rel="stylesheet" type="text/css" href="css/mystyle.css">
    <title>The school</title>
</head>
<body>
<header>
    <?=$frontController->printHeader();?>
</header>
<section>
    <?=$frontController->printSection();?>
</section>
 <!-- Bootstrap CDN:: jQuery first, then Popper.js, then Bootstrap JS -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <!-- my custoom javascript -->
    <script src="js/myscript.js"></script>
</body>
</html>
