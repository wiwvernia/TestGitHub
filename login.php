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
Login form
<hr>

<?PHP
	if(isset($_POST['submit'])){
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$cape = trim($_POST['cape']);
		if($cape == 1234){
		$query = "SELECT * FROM AA_LOGIN WHERE ID='$username' and PASSWORD='$password'";
		$parseRequest = oci_parse($conn, $query);
		oci_execute($parseRequest);
		// Fetch each row in an associative array
		$row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC);
		if($row){
			$_SESSION['ID'] = $row['ID'];
			$_SESSION['NAME'] = $row['NAME'];
			$_SESSION['SURNAME'] = $row['SURNAME'];
			echo '<script>window.location = "MemberPage.php";</script>';
		}else{
			echo "Login fail.";
		}
	}else{
			echo "Login fail.";
		}};
	oci_close($conn);
?>

<form action='login.php' method='post'>
	<p>Username <br>
	  <input name='username' type='input'>
	  <br>
	Password<br>
	<input name='password' type='password'>
<p>1234 
      <input name='cape' type='input'>
	  <br>
      <br>
      <input name='submit' type='submit' value='Login'>
        </p>
</form>
