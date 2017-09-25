<?php
$pageTitle="a-store | online shopping";
$section = "";
include('inc/header.php');
require ("inc/db_products.php");

function add(&$a)
{
    $a++;
}
function &position()
{
    $position=&$GLOBALS['pos'];
    return $position;
}
$numri1=1;
$numri23=array(1,2);
$numrat=array($numri1, &$numri23[0], &$numri23[1]);
$numrat[1]++;
$numrat[2]++;
?>

		<div class="section banner" style="height: 290px; background: #3d3d3d url('img/<?php 
            if(isset($_COOKIE['foto']))
            {
                echo $_COOKIE['foto'];
            }
            else
            {
                echo "Online-shopping.jpg";
            } ?>') center center no-repeat;">

            <form method="post" action="change_background.php" style="float: left;">
                <input type="radio" id="radio1" name="foto" value="Online-shopping.jpg" onclick="this.form.submit()" 
                <?php 
                    if($_COOKIE['foto']=="Online-shopping.jpg" || !isset($_COOKIE['foto'])) 
                        echo "checked";
                ?>>
                <label for="radio1"><?php echo $numri1; ?></label><br>
                <input type="radio" id="radio2" name="foto" value="online-stores-for-shopping.jpg" onclick="this.form.submit()"
                 <?php 
                    if($_COOKIE['foto']=="online-stores-for-shopping.jpg") 
                        echo "checked";
                ?>>
                <label for="radio2"><?php echo $numri23[0]; ?></label><br>
                <input type="radio" id="radio3" name="foto" value="Shopping.jpg" onclick="this.form.submit()"
                 <?php 
                    if($_COOKIE['foto']=="Shopping.jpg") 
                        echo "checked";
                ?>>
                <label for="radio3"><?php echo $numri23[1]; ?></label>
            </form>
		</div>

<div class="section products latest">

    <div class="wrapper">

        <h2>A-Store&rsquo;s Latest Products</h2>
        <p class="note-designer" align="center"><span style="color: red;">*NOTICE: Images may be subject to copyright.</span><br>We do not own these products, nor the product images. These are used for school project purspose only.</p>

        <ul class="products">
            <?php
            krsort($products);
            $total_products=count($products);
            
            $pos=0;
            unset($pos);

            foreach($products as $product) {
                add(position());
                $remaining=$total_products-position();
                if($remaining>$total_products-5) //shfaq 4 produktet e fundit
                echo get_product_list($product);
            } ?>
        </ul>

    </div>

</div>


<?php include ('inc/footer.php'); ?>
