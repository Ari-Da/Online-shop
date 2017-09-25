<?php
//session_destroy();
$pageTitle = "Sign in";
$section = "sign in";
include('inc/header.php');
?>

    <div class="section page">
        <h1>Sign in</h1>
        <?php if(isset($_GET['login_attempt']) && $_GET['login_attempt']==0)
        {
        ?>
            <h4 align="center" style="color: red;">Invalid username or password</h4>
        <?php } ?>
        <form id="sign_in" method="post">
            <table>
                <tr>
                    <th>
                        <label for="user">Username</label>
                    </th>

                    <td>
                        <input type="text" name="user" id="user" placeholder="Type your username" value="<?php echo $_COOKIE['name']; ?>" autofocus>
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="pass">Password</label>
                    </th>

                    <td>
                        <input type="password" name="pass" id="pass" placeholder="Type your password" value="<?php echo $_COOKIE['pass']; ?>">
                    </td>
                </tr>

            </table>
            <input type="submit" value="Sign in" name="button" onkeypress="onmouseenter()">
        </form>
        <br><br>

        <form action="register.php"><p>Not registered yet?</p>
            <input type="submit" value="Sign up"></form>
    </div>
<?php include ('inc/footer.php'); ?>