<?php 
session_start();
$id = $_GET['id'];
unset($_SESSION['cart'][$id]);

ob_start(); 
header('Location: cart.php');
ob_end_flush();