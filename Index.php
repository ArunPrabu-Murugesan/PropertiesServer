<?php
	ob_start();
	session_start();		
	
	require "Connect.php";
	include "Header.html";	
	
	if(isset($_REQUEST['sub_frm']))
	{
		$l_name = $_REQUEST['l_name'];
		$l_pass = base64_encode($_REQUEST['l_pass']);
						
		$sel_login = mysql_query("SELECT * FROM tbl_login WHERE l_name='".$l_name."' AND l_pass='".$l_pass."'");
		$fet_login = mysql_fetch_array($sel_login);		
		
		if(mysql_num_rows($sel_login)!=0)
		{
			$_SESSION['ses_nameid'] = $fet_login['l_name'].$fet_login['l_id'];
			header("Location:AddProject.php");
			exit;
		} else {
			echo '<script>alert("Only Administrator can Enter")</script>';
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>LOGIN</title>
		
		<script type="text/javascript" language="javascript">
			function frm_valid()
			{
				if(document.frm_login.l_name.value == '')
				{
					alert("Enter your Name")
					document.frm_login.l_name.focus()
					return false
				}
				if(document.frm_login.l_pass.value == '')
				{
					alert("Enter your Password")
					document.frm_login.l_pass.focus()
					return false
				}
			}
		</script>
	</head>
	
	<body>
		<form name="frm_login" action="" method="post" onsubmit="return frm_valid();">
			<table align="center">
					<tr>
						<td>User Name</td>
						<td>:</td>
						<td><input type="text" name="l_name" value="<?php echo $_REQUEST['l_name']; ?>" /></td>
					</tr>
					<tr>
						<td>Password</td>
						<td>:</td>
						<td><input type="password" name="l_pass" /></td>
					</tr>
					<tr>
						<td colspan="3" align="center"><input type="submit" name="sub_frm" value="Submit" /></td>
					</tr>
			</table>
		</form>
	</body>
</html>

<?php
	include "Footer.html";
?>	