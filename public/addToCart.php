<?php 
session_start();
$id = $_GET['id'];
$_SESSION['cart'][$id] = 1;

ob_start(); 
header('Location: booksList.php');
ob_end_flush();