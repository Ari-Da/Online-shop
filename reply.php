<?php
//session_start();
$pageTitle = "Reply";
$section="";
include('inc/header.php');
include('inc/db_feedback.php');

$_SESSION["fid"]=$_POST["fid"]; 

?>

<div class="section page">
    <div class="wrapper">

            <p align="center"><b><?php echo $_SESSION["name"]; ?></b> please write your reply</p>
                <form method="post" id="reply" action="insert_reply.php">
                    <table>
                        <tr>
                            <th>
                                <label for="Reply">Reply</label>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <textarea name="reply" id="reply" style="height: 100px;" placeholder="Type your reply here"></textarea>
                            </td>
                        </tr>
                    </table>

                    <input type="submit" value="Submit" name="send_reply">

                </form>
    </div>
</div>
<?php include ('inc/footer.php'); ?>
