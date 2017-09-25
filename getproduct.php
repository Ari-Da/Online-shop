<?php
require ("inc/db_products.php");

$p=$products;

// get the q parameter from URL
$q = $_REQUEST["search_product"];

$output = "";

// lookup all products from array if $q is different from "" 
if ($q !== "") {

    $len=strlen($q);
    foreach($products as $key => $value) {

        if (stristr($products[$key]["name"], $q)) {

            $output = $output. "<li>";
            $output = $output. '<a href="details.php?id='.$products[$key]["id"].'" target="_blank">';
            $output = $output. $products[$key]["name"];
            $output = $output. '<img src="' .  $products[$key]["img"] . '" alt="' . $products[$key]["name"] . '">';
            $output = $output. "<p>Price $". $products[$key]["price"] ."</p>";
            $output = $output. "</a>";
            $output = $output. "</li>";
        }
    }
}

echo $output === "" ? "No suggestions" : $output;
?>