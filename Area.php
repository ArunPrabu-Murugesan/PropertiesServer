<?php
  require "Connect.php";

  include_once "Header.html";

  if(isset($_REQUEST['sub_frm']))
  {
    $a_name = $_REQUEST['a_name'];
	$a_code = $_REQUEST['a_code'];
	$ins = mysql_query("INSERT INTO tbl_area(a_name, a_code, a_dt) VALUES('$a_name', '$a_code', NOW())");
	if(isset($ins))
	{
	  echo '<script type="text/javascript" language="javascript">
	          alert("Area Inserted Successfully")
	        </script>';
	}
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Untitled Document</title>
  </head>
  <body>
    <form action="" method="post" name="frm_area">
	  <table align="center">
	    <tr>
		  <td>Name:</td>
		  <td><input type="text" name="a_name" /></td>
		</tr>
		<tr>  
		  <td>Code:</td>
		  <td><input type="text" name="a_code" /></td>		  
		</tr>
		<tr>
		  <td colspan="2" align="center"><input type="submit" name="sub_frm" value="Submit" /></td>
		</tr>
	  </table>
	</form>
  </body>
</html>

<?php
	include_once "Footer.html";
?>