<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
 
$idKnjiga = $_GET['idKnjiga'];
$naziv =  $_GET['naziv'];
$kolicina = $_GET['kolicina'];

/*
 * check if the 'cart' session array was created
 * if it is NOT, create the 'cart' session array
 */
 
if($kolicina == ""){
	header('Location: knjiga.php?action=kolicina&idKnjiga=' . $idKnjiga . '&naziv=' . $naziv);
}

else{
	if(!isset($_SESSION['cart_items'])){
		$_SESSION['cart_items'] = array();
	}
	 
	// check if the item is in the array, if it is, do not add
	if(array_key_exists($idKnjiga, $_SESSION['cart_items'])){
		// redirect to product list and tell the user it was added to cart
		header('Location: knjiga.php?action=exists&idKnjiga=' . $idKnjiga . '&naziv=' . $naziv);
	}
	 
	// else, add the item to the array
	else{
		$_SESSION['cart_items'][$idKnjiga]=$kolicina;
		
		
	 
		// redirect to product list and tell the user it was added to cart
		header('Location: knjiga.php?action=added&idKnjiga=' . $idKnjiga . '&naziv=' . $naziv);
	}
	}
?>

