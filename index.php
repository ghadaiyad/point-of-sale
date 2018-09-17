<?php
//index.php

if(!isset($_COOKIE["type"]))
{
 header("location:Pages/Sales.php");
 //header("location:Pages/login.php");
}else {

 header("location:Pages/Sales.php");
}

?>
