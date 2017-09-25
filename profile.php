<?php
$pageTitle = "profile";
$section="";
include ("inc/header.php");
?>

<?php
if(!isset($_GET["uid"]) || $_GET["uid"]!=$_SESSION["id"])
{
    header("Location: index.php");
}
?>

    <div class="section page">
        <h1>Your profile <a href="sleep.php"><img src="img/Sleep.png"></a></h1>

        <?php if($_SESSION['priv']!="Admin")?>
                <p align="center"><?php echo $_SESSION["time"]; ?></p>
        
        <form id="profile" method="post" action="update_user.php">
            <table>
                <tr>
                    <th>
                        <label for="full">Full name</label>
                    </th>

                    <td>
                        <input type="text" name="full" id="full" required = "Please fill out this field" value='<?php echo $_SESSION["name"]; ?>'>
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="address">Street address</label>
                    </th>

                    <td>
                        <input type="text" name="address" id="address" required = "Please fill out this field" pattern="[a-zA-Z0-9\s\]+" value='<?php echo $_SESSION["address"];?>'>
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="email">Email</label>
                    </th>

                    <td>
                        <input type="text" name="email" id="email" required = "Please fill out this field" pattern="^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$" title="Is NOT a valid email" placeholder="someone@example.com" value='<?php echo $_SESSION["email"];?>'>
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="pass">Password</label>
                    </th>

                    <td>
                        <input type="password" name="pass" id="pass" required = "Please fill out this field" placeholder="Password" value='<?php echo $_SESSION["pass"];?>'>
                    </td>
                </tr>
            </table>
            <input type="submit" value="Save" name="save">
        </form>
    </div>
<?php include ("inc/footer.php"); ?>