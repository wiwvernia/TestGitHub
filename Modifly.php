<?PHP
	session_start();
	// Create connection to Oracle
	$conn = oci_connect("system", "wiwvernia01WIWVERNIA", "//localhost/XE");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 
?>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<style type="text/css">
<!--
#apDiv1 {
	position:absolute;
	left:168px;
	top:244px;
	width:71px;
	height:20px;
	z-index:1;
}
.style1 {font-size: 12px}
-->
</style>
Modifly page
<hr>
<?PHP

	if(isset($_POST['save'])){
		$oldpassword = trim($_POST['oldpassword']);
		$newpassword = trim($_POST['newpassword']);
		$newpassword2 = trim($_POST['newpassword2']);
		if($newpassword == $newpassword2){
		$query = "SELECT * FROM AA_LOGIN WHERE PASSWORD='$oldpassword'";
		$parseRequest = oci_parse($conn, $query);
		oci_execute($parseRequest);
		$row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC);
		if($row){
			$query1 = "UPDATE AA_LOGIN SET PASSWORD='$newpassword' WHERE PASSWORD='$oldpassword'";
			$parseRequest1 = oci_parse($conn, $query1);
			oci_execute($parseRequest1);	
			echo '<script>window.location = "MemberPage.php";</script>';}
		else{
			echo "Change fail.";
		}}
		else{
			echo "Change fail.";
		}
		}
			
	oci_close($conn);
?>
<?PHP

	if(isset($_POST['back'])){
		echo '<script>window.location = "MemberPage.php";</script>';}
			
	
?>
<form action='Modifly.php' method='post'>
	<p>Old Password<br>
	  <input name='oldpassword' type='input' id="old password">
	  <br>
	New Password<br>
  <input name='newpassword' type='input' id="newpassword">    
	<p>Confirm Password<br>
      <input name='newpassword2' type='input' id="newpassword2">
      <br>
      <br>
      <input name='save' type='submit' value='Save' id="save">
      <input name='back' type='submit' value='Back' id="back">
    </form>
