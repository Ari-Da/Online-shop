<?php
$pageTitle = "user info";
$section="info";
include ("inc/header.php");
require ("inc/connection.php");

$query=mysqli_query($connection, "SELECT * FROM users WHERE Priviledge='User'");
	$users = array();
	while($user=mysqli_fetch_array($query))
	{
	    $users[] = array(
	        "name" => $user['Name'],
	        "address" => $user['Address'],
	        "email" => $user['Email'],
	        "date" => $user['Reg_Date']);
	}

if(isset($_POST["refresh"])){

	
	    	$user_list = fopen("user_list.xml", "w") or die("Unable to open file!");
	    	$info="<USERS>";
	    	foreach ($users as $u) {
	    		
		        $info = $info."<USER><NAME>".$u["name"]."</NAME><ADDRESS>".$u["address"]."</ADDRESS><EMAIL>".$u["email"]."</EMAIL><DATE>".date("d M Y", strtotime($u["date"])).", ".date("g:i A",strtotime($u["date"]))."</DATE></USER>";
		        
		        
	    	}
	    	$info = $info."</USERS>";
	    	fwrite($user_list, $info);
	        fclose($user_list);
}
?>

<script>
function showUser(str) {
  if (str=="") {
    document.getElementById("user_info").innerHTML="<b>User info will be listed here...</b>";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("user_info").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","getuser.php?user="+str,true);
  xmlhttp.send();
}
</script>

<div class="section page">
		<form align="center" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			
			<table>
				<tr>
					<th>Select a user</th>
					<td>
						<select name="users" onchange="showUser(this.value)">
						<option value="">Select a user</option>
						<?php foreach ($users as $u) {?>
							<option value='<?php echo $u["name"]; ?>'><?php echo $u["name"]; ?></option>
						<?php } ?>
						</select>
					</td>
					<td><input type="submit" id="refresh" name="refresh" value="Refresh"></td>
				</tr>
			</table>
		</form>
</div>

<form id="user_info" method='post' action='contact.php'><b>User info will be listed here...</b></form>


<?php include ("inc/footer.php"); ?>