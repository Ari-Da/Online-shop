<?php
$pageTitle = "Sign up";
$section = "sign up";
include('inc/header.php');
?>

<script>
    function file()
    {
        <?php 
        $file = fopen("help.txt", "r") or die("Unable to open file!"); 
        $myFile = fread($file, filesize("help.txt"));
        ?>

            alert("<?php echo $myFile ?>");

        <?php fclose($file); ?>
    }
        function validate(){

        var a = document.getElementById("pass").value;
        var b = document.getElementById("pass1").value;
        if (a!=b) {
            alert("Passwords do no match");
            return false;
        }
    }
   </script>

    <div class="section page">
        <h1>Sign up <a href="" onclick="file()"><img src="img/question.gif"></a></h1>

        <?php if(isset($_GET['status']) && $_GET['status']==0)
        {
        ?>
            <h4 align="center" style="color: red;">That username or email is already used!<br>Try another username or email.</h4>
        <?php } ?>

        <form id="sign_up" method="post" action="insert_user.php" onsubmit="return validate();">
            <table>
                <tr>
                    <th>
                        <label for="name">First name</label>
                    </th>

                    <td>
                        <input type="text" name="first" id="first" required = "Please fill out this field" autofocus placeholder="Your first name (required)">
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="text">Last name</label>
                    </th>

                    <td>
                        <input type="text" name="last" id="last" placeholder="Your last name">
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="address">Street address</label>
                    </th>

                    <td>
                        <input type="text" name="address" id="address" required = "Please fill out this field" pattern="[a-zA-Z0-9\s\]+" placeholder="Your address">
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="email">Email</label>
                    </th>

                    <td>
                        <input type="text" name="email" id="email" required = "Please fill out this field" pattern="^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$" title="Is NOT a valid email" placeholder="someone@example.com" >
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="pass">Password</label>
                    </th>

                    <td>
                        <input type="password" name="pass" id="pass" required = "Please fill out this field" placeholder="Type your password">
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="pass1">Confirm password</label>
                    </th>

                    <td>
                        <input type="password" name="pass1" id="pass1" required = "Please fill out this field" placeholder="Confirm your password" >
                    </td>
                </tr>
            </table>

            <input type="submit" value="Submit" name="insert">
        </form>
    </div>

<?php include ('inc/footer.php'); ?>