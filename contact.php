<?php
$pageTitle = "Contact a-store.com";
$section="contact";
include('inc/header.php'); 
session_start();

if(isset($_POST["submit"])) {

    if($_SESSION['priv']=="Admin")
    {
        $admin = "ariana.daka@gmail.com";
        $name = $_POST["name"];
        $email = $_POST["email"];
        $header="From: ariana.daka@gmail.com";

        $tedhenat=preg_split("/ /", $name);
        $name_split=current($tedhenat);
        $surname_split=end($tedhenat);

        $message = $_POST["message"];
        $message = wordwrap($message, 70);
        $email_body="";
        $email_body=$email_body."Admin: ".$name_split." ".$surname_split."\n\n";
        $email_body=$email_body."Message: ".$message."\n";

        mail($email, "a-store.com admin message", $email_body, $header);
        header("Location: contact.php?status=thanks1");
    }
    else
    {
        $admin = "ariana.daka@gmail.com";
        $name = $_POST["name"];
        $email = $_POST["email"];
        $header="From:".$email;

        $message = $_POST["message"];
        $message = wordwrap($message, 70);
        $email_body="";
        $email_body=$email_body."Name: ".$name."\n\n";
        $email_body=$email_body."Message: ".$message."\n";

        class customException extends Exception {
          public function errorMessage() {
            //error message
            $errorMsg = '<p align="center"><b>'.$this->getMessage().'</b> is not a valid e-mail address</p>';
            return $errorMsg;
          }
        }

        try {
          //check if
          if(filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
            //throw exception if email is not valid
            throw new customException($email);
          }
          else {
            mail($admin, "a-store.com client message", $email_body, $header);

            header("Location: contact.php?status=thanks2");
          }
        }

        catch (customException $e) 
      {
        echo $e->errorMessage();
      }
    }

}

?>


<div class="section page">
    <div class="wrapper">
        <h1>Contact</h1>

        <?php  if(isset($_GET["status"]) AND $_GET["status"] == "thanks2") {?>
        <p align="center">Thanks for the email! We&rsquo;ll be in touch shortly.</p>
        <?php } else if(isset($_GET["status"]) AND $_GET["status"] == "thanks1") {?>
        <p align="center">Email has been sent to the client.</p>
        <?php  } else {?>

            <p align="center"><?php if($_SESSION['priv']=="Admin")
                        echo "Send email to costumers";
                        else echo "We&rsquo;d love to hear from you! Complete the form to send an email to <i style='color: firebrick;'>ariana.daka@gmail.com</i>" ?></p>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contact_form">
                <table>
                    <tr>
                        <th>
                            <label for="name">Your name</label>
                        </th>

                        <td>
                            <input type="text" name="name" id="name" autofocus
                            <?php if(isset($_SESSION['id']))
                            {
                            ?>
                                 value='<?php echo $_SESSION["name"]; ?>'
                            <?php
                            }
                            ?>
                            >
                        </td>
                    </tr>

                    <tr>
                        <th>
                            <label for="email">
                                <?php 
                                if($_SESSION['priv']=="Admin")
                                        echo "Costumer ";
                                    else
                                        echo "Your ";
                                ?>
                                 email</label>
                        </th>

                        <td>
                            <input type="text" name="email" id="email"
                             <?php if(isset($_SESSION['id']))
                            {
                                if($_SESSION['priv']!="Admin")
                                {
                            ?>
                                 value='<?php echo $_SESSION["email"]; ?>'
                            <?php
                                } else if(isset($_POST['email'])) {
                            ?>
                                value='<?php echo $_POST["email"]; ?>'
                            <?php          
                            }}
                            ?>
                            >
                        </td>
                    </tr>

                    <tr>
                        <th>
                            <label for="message">Message</label>
                        </th>

                        <td>
                            <textarea name="message" id="message" style="height: 100px;" placeholder="Type your message here"></textarea>
                        </td>
                    </tr>
                </table>
                <input type="submit" value="Send" name="submit">
            </form>

        <?php  } ?>
    </div>
</div>
<?php include ('inc/footer.php'); ?>