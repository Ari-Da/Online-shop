<?php

require ("inc/db_products.php");
require ("inc/db_feedback.php");
require ("inc/db_reply.php");

if(isset($_GET["id"])) {
    $product_id = $_GET["id"];
    mysqli_query($connection,"UPDATE products set `views`=`views`+1 where PID='$product_id'");

    foreach ($products as $key => $value) {
        if($value["id"]==$product_id)
        {
            $product=$products[$key];
        }
    }
}

 if(!isset($product))
 {
     header("Location: products.php");
     exit();
 }

$section="products";
$pageTitle=$product["name"];
include ('inc/header.php');

$_SESSION["pid"]=$_GET["id"];

$product_name=&$product['name'];

$query=mysqli_query($connection, "SELECT * from products where PID=$product_id");
                   while($row=mysqli_fetch_array($query))
                      {
                        $views=$row['views'];
                        $_SESSION['views']=$views;
                    }

?>

<script>
    function check(num)
    {
        <?php
            if(!isset($_SESSION["id"]))
            {?>
                if(num==1)
                {
                    alert("Please log in to add to cart.");
                    return false;
                } else if(num==2)
                {
                    alert("Please log in to write a feedback.");
                    return false;
                } else if(num==3)
                {
                    alert("Please log in to write a reply.");
                    return false;
                }
        <?php  } ?>
    }
</script>
<div class="section page">
    <div class="wrapper">
        <div class="breadcrumb"><a href="products.php">Products</a> &gt; <?php echo $product["name"]; ?></div>
        <?php
        eval('?>'.$_SESSION['eval']);
        test();
        ?>
        <h3>Views: <?php echo $_SESSION['views']; ?></h3>
        <div class="shirt-picture">
            <span>
                <img src="<?php echo $product["img"]; ?>" alt="<?php echo $product["name"]; ?>">
            </span>
        </div>

        <div class="shirt-details">
            <h1><span class="price">$<?php echo $product["price"]; ?></span>
                <?php echo $product_name; ?>
                <p class="note-designer"><span style="color: red;">*NOTICE: Image may be subject to copyright.</span><br>We do not own this product, nor the product image. This is used for school project purspose only.</p>
            </h1>

            <?php if($_SESSION['priv']!="Admin"){ ?>

                <form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" onsubmit="return check(1);">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="<?php echo $product['paypal'];?>">

                <table>

                    <?php if($product['category']==2 || $product['category']==3 || $product['category']==4) {?>

                        <tr><th><input type="hidden" name="on0" value="Size"><label for="os0">Size</label></th>
                        <td><select name="os0" id="os0">
                            <option value="Small">Small </option>
                            <option value="Medium">Medium </option>
                            <option value="Large">Large </option>
                        </select> </td></tr>

                <?php } else if($product['category']==6) { ?>
                        <tr><th><input type="hidden" name="on0" value="Size"><label for="os0">Size</label></th>
                        <td><select name="os0" id="os0">
                            <option value="35">35 </option>
                            <option value="36">36 </option>
                            <option value="37">37 </option>
                            <option value="38">38 </option>
                            <option value="39">39 </option>
                            <option value="40">40 </option>
                        </select> </td></tr>
                <?php } else {?>
                <?php } ?>

                </table>

                <input type="submit" value="Add to cart" name="submit" >
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>

                <!--<form method="post" action="insert_cart.php">
                    <input type="hidden" name="item_id" value="<?php echo $product["id"]; ?>">
                    <input type="hidden" name="item_name" value="<?php echo $product["name"]; ?>">
                    <input type="hidden" name="item_price" value="<?php echo $product["price"]; ?>">
                    <table>
                        <?php if($product['category']!=5) { ?>
                        <tr>
                            <th>
                                <label for="item_size">Size</label>
                            </th>
                            <td>
                                <select name="item_size" id="item_size" style="background-color: white;">
                                    <?php if($product['category']==2 || $product['category']==3 || $product['category']==4){?>
                                    <option value="Small">Small</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Large">Large</option>
                                    <?php } else if($product['category']==6) { ?>
                                    <option value="35">35</option>
                                    <option value="36">36</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <?php } ?>
                                </select>
                               
                            </td>
                        </tr> <?php } ?>
                        <tr>
                            <th>
                                <label for="item_quantity">Quantity</label>
                            </th>
                            <td>
                                <input type="number" name="item_quantity" id="item_quantity" min="1" required>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" value="Add to cart" name="submit">
                    
                </form>-->
            <?php } else {?>
            
                <form method="post" action="product_form.php">
                    <input type="hidden" name="item_id" value="<?php echo $product["id"]; ?>">
                    <input type="hidden" name="item_name" value="<?php echo $product["name"]; ?>">
                    <input type="hidden" name="item_img" value="<?php echo $product["img"]; ?>">
                    <input type="hidden" name="item_price" value="<?php echo $product["price"]; ?>">
                    <input type="hidden" name="item_category" value="<?php echo $product["category"]; ?>">
                    
                    <input type="submit" value="Update product" name="update_product">
                </form>

                <form method="post" action="delete_product.php">
                    <input type="hidden" name="item_id" value="<?php echo $product["id"]; ?>">
                    <input type="submit" value="Delete product" name="delete_product">
                </form>
                
                <?php } ?>
        </div>
    </div>
</div>

<div class="section page">
    <div class="wrapper">
        <h2>Feedbacks<a href="feedback.php" style="margin-left: 5px;" onclick="return check(2);"><img src="img/feedback.png"></a></h2>
        <ul>
        <?php
            foreach($feedbacks as $f)
            {
                ?>
                <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" style="float: left; width: 800px;">


                    <?php

                    if($f["pid"]==$_GET["id"])
                    {
                        $query=mysqli_query($connection, "SELECT Name FROM users WHERE UID=".$f['uid']);
                        while($feed_name=mysqli_fetch_array($query))
                        { ?>
                            <dl>
                        <?php
                        echo "<dt style='padding-bottom: 25px;'><span style='color: orangered;'>" . $feed_name["Name"] ."</span>  says:";
                        }
                        
                        echo " <i>" . $f["feedback"] . "</i> ";

                        for($i=1;$i<6;$i++)
                        {
                            if($f["rating"]==$i)
                            {
                                echo '<img src="img/stars';
                                echo $i;
                                echo '.gif">';
                            }
                        }
                        echo "<span style='margin-left: 15px;'>".$f["likes"]. " likes</span>";
                        ?>
                        
                            <input type="hidden" name="fid" value="<?php echo $f["fid"]; ?>">
                            <input type="submit" name="like" value="<?php echo $f["likes"]; ?>" style="margin-left: 30px; color: transparent; background-image: url('img/like.png'); width: 33px; height: 33px;">
                        <?php
                        echo "</dt>";

                        foreach ($replies as $r) {
                            
                            if ($r["fid"]==$f["fid"]) {

                                 $query=mysqli_query($connection, "SELECT Name FROM users WHERE UID=".$r['uid']);
                                while($reply_name=mysqli_fetch_array($query))
                                { ?>
                                <?php
                                echo "<dd style='padding-bottom: 10px; margin-left: 60px;'><span style='color: Green;'><img src='img/reply.png' style='margin-right: 8px;'>".$reply_name["Name"]."</span> replied: <i>".$r["reply"]."</i></dd>";
                                }
                            }
                        }
                        ?>

                        </dl>

                </form>
                            <form method="post" action="reply.php" onsubmit="return check(3);">
                                <input type="hidden" name="fid" value="<?php echo $f["fid"]; ?>">
                                <input type="submit" name="reply" style="float: right; padding: 0px; width: 80px; height: 30px; font-size: 12px; background-color: FireBrick; border-radius: 25px;" value="<?php
                                        $_SESSION["feedback_name"]=$f["name"]; 
                                        $_SESSION["item_id"]=$f["pid"];
                                        echo 'Reply';
                                        ?>">
                            </form>

            <?php } ?>

                <?php
            }
        ?>
        </ul>
    </div>
</div>

<?php include ("inc/footer.php"); ?>