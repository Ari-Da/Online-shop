<?php
$pageTitle = "Add product";
$section = "";
include('inc/header.php');
?>

    <div class="section page">
        <h1>Add product</h1>
        <form method="post" action="
                        <?php 
                            if(isset($_POST['update_product']))
                            {
                                echo "update_product.php";
                            }
                            else
                            {
                                echo "insert_products.php";
                            }
                        ?>">
                            
            <table>
                <tr>
                    <th>
                        <label for="product_name">Product name</label>
                    </th>

                    <td>
                        <input type="text" name="product_name" id="product_name" autofocus required 
                        <?php 
                            if(isset($_POST['update_product']))
                            {?>
                            value="<?php echo $_POST['item_name']; ?>"
                        <?php
                            }
                        ?>>
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="product_price">Price</label>
                    </th>

                    <td>
                        <input type="numeric" name="product_price" id="product_price" required
                        <?php 
                            if(isset($_POST['update_product']))
                            {?>
                            value="<?php echo $_POST['item_price']; ?>"
                        <?php
                            }
                        ?>>
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="product_category">Category</label>
                    </th>

                    <td>
                        <select name="product_category" id="product_category">
                            <option>Select category</option>
                            <option value="2" <?php if($_POST['item_category']==2) echo "selected"; ?>>Tops</option>
                            <option value="3" <?php if($_POST['item_category']==3) echo "selected"; ?>>Bottoms</option>
                            <option value="4" <?php if($_POST['item_category']==4) echo "selected"; ?>>Dresses</option>
                            <option value="5" <?php if($_POST['item_category']==5) echo "selected"; ?>>Accessories</option>
                            <option value="6" <?php if($_POST['item_category']==6) echo "selected"; ?>>Shoes</option>
                        </select>

                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="product_image">Choose a photo</label>
                    </th>

                    <td>
                        <input type="file" name="product_image" id="product_image" accept="image/*" 
                        <?php if(!isset($_POST['update_product']))
                                echo "required";
                                ?>>
                    </td>
                </tr>
            </table>
            <?php if(isset($_POST['update_product'])){ ?>
                            <input type="hidden" name="item_id" value="<?php echo $_POST['item_id']; ?>">
                            <input type="hidden" name="item_price" value="<?php echo $_POST['item_price']; ?>">
                            <input type="hidden" name="item_category" value="<?php echo $_POST['item_price']; ?>">
                            <input type="hidden" name="item_img" value="<?php echo $_POST['item_img']; ?>">
                        <?php
                            }
                            ?>
            <input type="submit" value="Submit" name="insert">
        </form>
    </div>

<?php include ('inc/footer.php'); ?>