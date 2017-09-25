<?php
require("inc/connection.php");

$q = intval($_GET['category']);

if($q==1)
{
	$query=mysqli_query($connection, "SELECT * FROM products");
	$products = array();
	while($product=mysqli_fetch_array($query))
	{
	    $products[] = array(
	        "id" => $product['PID'],
	        "name" => $product['Name'],
	        "img" => $product['Img'],
	        "price" => $product['Price']);
	}
}
else if($q==2)
{
	$query=mysqli_query($connection, "SELECT * FROM products WHERE Category=$q");
	$products = array();
	while($product=mysqli_fetch_array($query))
	{
	    $products[] = array(
	        "id" => $product['PID'],
	        "name" => $product['Name'],
	        "img" => $product['Img'],
	        "price" => $product['Price']);
	}
}
else if($q==3)
{
	$query=mysqli_query($connection, "SELECT * FROM products WHERE Category=$q");
	$products = array();
	while($product=mysqli_fetch_array($query))
	{
	    $products[] = array(
	        "id" => $product['PID'],
	        "name" => $product['Name'],
	        "img" => $product['Img'],
	        "price" => $product['Price']);
	}
}
else if($q==4)
{
	$query=mysqli_query($connection, "SELECT * FROM products WHERE Category=$q");
	$products = array();
	while($product=mysqli_fetch_array($query))
	{
	    $products[] = array(
	        "id" => $product['PID'],
	        "name" => $product['Name'],
	        "img" => $product['Img'],
	        "price" => $product['Price']);
	}
}
else if($q==5)
{
	$query=mysqli_query($connection, "SELECT * FROM products WHERE Category=$q");
	$products = array();
	while($product=mysqli_fetch_array($query))
	{
	    $products[] = array(
	        "id" => $product['PID'],
	        "name" => $product['Name'],
	        "img" => $product['Img'],
	        "price" => $product['Price']);
	}
}
else if($q==6)
{
	$query=mysqli_query($connection, "SELECT * FROM products WHERE Category=$q");
	$products = array();
	while($product=mysqli_fetch_array($query))
	{
	    $products[] = array(
	        "id" => $product['PID'],
	        "name" => $product['Name'],
	        "img" => $product['Img'],
	        "price" => $product['Price']);
	}
}


if(count($products)!=0){
	foreach($products as $prod) {

	            $output = $output. "<li>";
	            $output = $output. '<a href="details.php?id='.$prod["id"].'" target="_blank">';
	            $output = $output. $prod["name"];
	            $output = $output. '<img src="' .  $prod["img"] . '" alt="' . $prod["name"] . '">';
	            $output = $output. "<p>Price $". $prod["price"] ."</p>";
	            $output = $output. "</a>";
	            $output = $output. "</li>";
	    }
}
else {
	$output="<p align='center'>No product in this category</p>";
}

  echo $output;
?>