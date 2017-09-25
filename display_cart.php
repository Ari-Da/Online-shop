<?php
$pageTitle="shopping cart";
$section = "";
include ("inc/header.php");
?>

    <div class="section page">
        <div class="wrapper">
            <?php
            if(!isset($_SESSION["id"]))
            {?>
                <h1>
               <?php
                    echo "Please log in to add items to cart";
               ?>
                </h1>
            <?php } else {header("Location: products.php");}?>

        </div>
    </div>
<?php include ("inc/footer.php"); ?>