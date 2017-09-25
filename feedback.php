<?php
//session_start();
$pageTitle = "Feedback";
$section="";
include('inc/header.php');
include('inc/db_cart.php');
?>

<div class="section page">
    <div class="wrapper">

        <?php  if(isset($_GET["status"]) AND $_GET["status"] == "thanks") {?>
            <p>Thank you for the feedback! Keep shopping with us.</p>
        <?php  } else {?>

            <?php
                $item_name=$_POST["for_feedback"];
            ?>

            <p align="center"><b><?php echo $_SESSION["name"]; ?></b> please write your feedback</p>
            <form method="post" id="feedback" action="insert_feedback.php">
                <table>
                    <tr>
                        <th>
                            <label for="feedback">Feedback</label>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <textarea name="feedback" id="feedback" style="height: 100px;" placeholder="Type your feedback here"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="rating">Rating (between 1 and 5)</label>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <input type="number" name="rating" id="rating" min="1" max="5">
                        </td>
                    </tr>

                </table>

                <input type="submit" value="Submit" name="send_feedback">

            </form>
        <?php  } ?>
    </div>
</div>
<?php include ('inc/footer.php'); ?>
