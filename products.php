<?php
$pageTitle = "a-store products";
$section = "Products";
require ("inc/db_products.php");
include ('inc/header.php');
?>

<script>
function showProduct(name) {
    if (name.length == 0) { 
        reload();
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("products").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "getproduct.php?search_product=" + name, true);
        xmlhttp.send();
    }
}

function showCat(cat) {
    if (cat== "") {
        document.getElementById("products").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("products").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getcategory.php?category="+cat,true);
        xmlhttp.send();
        
        for (var i = 1; i <= 6; i++) {
            if(cat==i)
            {
                document.getElementById(i).style.color = "firebrick";
                document.getElementById(i).style.borderBottom = "3px solid #999";
                document.getElementById(i).style.fontWeight = "bold";
                document.getElementById(i).style.cursor = "default";
            }
            else
            {
                document.getElementById(i).style.color = "#555";
                document.getElementById(i).style.borderBottom = "0";
                document.getElementById(i).style.fontWeight = "normal";
                document.getElementById(i).style.cursor = "pointer";
            }
        };
    }
}
</script>

    <div id="navcontainer">
        <ul id="navlist">
            <li id="active"><a onclick="showCat(1)" id='1' style="color: firebrick; border-bottom: 3px solid #999; font-weight: bold; cursor: default;">All</a></li>
            <li><a onclick="showCat(2)" id='2'>Tops</a></li>
            <li><a onclick="showCat(3)" id='3'>Bottoms</a></li>
            <li><a onclick="showCat(4)" id='4'>Dresses</a></li>
            <li><a onclick="showCat(5)" id='5'>Accessories</a></li>
            <li><a onclick="showCat(6)" id='6'>Shoes</a></li>

            <span>
                <label for="search_product"><img src="img/search_icon.png"></label>
                <input type="text" id="search_product" name="search_product" onkeyup="showProduct(this.value)">
            </span>
        </ul>
    </div>


    <div class="section products latest">

        <div class="wrapper">

            <h2>A-Store&rsquo;s Full Catalog of Products
                <?php if($_SESSION["priv"]=="Admin")
                {
                ?>
                    <a href="product_form.php" style="margin-left: 12px;"><img src="img/plus.png"></a>
                <?php
                }
                ?>
            </h2>
             <p class="note-designer" align="center"><span style="color: red;">*NOTICE: Images may be subject to copyright.</span><br>We do not own these products, nor the product images. These are used for school project purspose only.</p>

            <form style="width: 80%;" method="post" action="products.php">
                <p>Sort products</p>

                <label for="sort_by_name" style="padding: 10px;">By name:</label>
                <select class="sort" name="sort_by_name" id="sort_by_name" onchange="this.form.submit()">
                    <option>Select</option>
                    <option value="0">None</option>
                    <option value="1">Ascending</option>
                    <option value="2">Descending</option>
                </select>

                <label for="sort_by_date"  style="padding: 10px;">By date:</label>
                <select class="sort" name="sort_by_date" id="sort_by_date" onchange="this.form.submit()">
                    <option>Select</option>
                    <option value="0">None</option>
                    <option value="1">Ascending</option>
                    <option value="2">Descending</option>
                </select>

                <label for="sort_by_price"  style="padding: 10px;">By price:</label>
                <select class="sort" name="sort_by_price" id="sort_by_price" onchange="this.form.submit()">
                    <option>Select</option>
                    <option value="0">None</option>
                    <option value="1">Ascending</option>
                    <option value="2">Descending</option>
                </select>
            </form>

            <ul class="products" id="products">
                <?php
                foreach($products as $product) {
                    echo get_product_list($product);
                } ?>
            </ul>

        </div>
    </div>
<?php include ('inc/footer.php'); ?>