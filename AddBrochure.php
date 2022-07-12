<?php
  require "Connect.php";

  include "Header.html";  
  
  $p_id = 3;
  
  $sel_pro = mysql_query("SELECT * FROM tbl_project WHERE p_status='Y' ORDER BY p_id");
  
  $sel_pos = mysql_query("SELECT * FROM tbl_brochure WHERE p_id='$p_id' ORDER BY b_pos");
  $num_pos = mysql_num_rows($sel_pos);

  if(isset($_REQUEST['sub_frm']))
  {
    $p_id = $_REQUEST['p_id'];
	
	$upload = "../Images/Brochure/";
	if(!is_dir($upload))
	{
	  mkdir($upload,0777);
	}
	$bro = $_FILES['b_img']['name'];
	$dot = strrpos($bro,'.');
	$ext = substr($bro,($dot+1));
	$sel_bid = mysql_query("SELECT MAX(b_id) AS bmaxid FROM tbl_brochure WHERE p_id='".$p_id."'");
	$fet_bid = mysql_fetch_array($sel_bid);
	$bid = $fet_bid['bmaxid']+1;
	$b_img = "Pro".$p_id.'_'."Bro".$bid.'.'.$ext;
	move_uploaded_file($_FILES['b_img']['tmp_name'],$upload.$b_img);
	
	$b_title = $_REQUEST['b_title'];
	
	$b_pos = $_REQUEST['b_pos'];
    $offset = $b_pos-1;
    $sel_bpos = mysql_query("SELECT * FROM tbl_brochure WHERE p_id='$p_id' ORDER BY b_pos");
    $count = mysql_num_rows($sel_bpos);
	if($b_pos <= $count)
	{
	  $sel_limit = mysql_query("SELECT * FROM tbl_brochure WHERE p_id='$p_id' ORDER BY b_pos LIMIT $offset, $count");
	  while($fet_limit = mysql_fetch_array($sel_limit))
	  {
		$update_pos = $fet_limit['b_pos']+1;
		$update_bid = $fet_limit['b_id'];
		mysql_query("UPDATE tbl_brochure SET b_pos=$update_pos WHERE b_id=$update_bid");
	  }
	}
	
	$b_status = $_REQUEST['b_status'];
	
	$ins_qry = mysql_query("INSERT INTO tbl_brochure (p_id, b_img, b_title, b_pos, b_dt, b_status) VALUES ('$p_id', '$b_img', '$b_title', '$b_pos', NOW(), '$b_status')");
	if(isset($ins_qry))
	{
	  echo '<script type="text/javascript" language="javascript">
	          alert("Record Insert Successfully")
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
    <form name="frm_bro" action="" method="post" enctype="multipart/form-data">
	  <table align="center">
	    <tr>
		  <td>Project:</td>
		  <td>
		    <select name="p_id">
			  <option value="">--Select the Project--</option>
			  <?php
			    while($fet_pro = mysql_fetch_array($sel_pro))
				{
		      ?>
			    <option value="<?php echo $fet_pro['p_id']; ?>"><?php echo $fet_pro['p_name']; ?></option>
			  <?php			  		
				}
			  ?>
			</select>
		  </td> 
		</tr>
	    <tr>
		  <td>Upload Brochure:</td>
		  <td><input type="file" name="b_img" />(Upload Image or PDF File)</td>
		</tr>
		<tr>
		  <td>Title:</td>
		  <td><input type="text" name="b_title" /></td>
		</tr>
		<tr>
		  <td>Position:</td>
		  <td>
		    <select name="b_pos">
			  <option value="">--Select the Position--</option>
			  <?php
			    if($num_pos==0)
				{
			  ?>
			      <option value="1">1</option>
			  <?php	
				} else {
			      while($fet_pos = mysql_fetch_array($sel_pos))
				  {
			  ?>
			        <option value="<?php echo $fet_pos['b_pos']; ?>"><?php echo $fet_pos['b_pos']; ?></option>
			  <?php	  
				  }	 
			  ?>
			      <option value="<?php echo $num_pos+1; ?>">LAST</option>
			  <?php	  
				}
			  ?>
			</select>
		  </td>
		</tr>
		<tr>
		  <td>Status:</td>
		  <td>
		    <select name="b_status">
			  <option value="Y" selected="selected">Active</option>
			  <option value="N">InActive</option>
			</select>
		  </td>
		</tr>
		<tr>
		  <td colspan="2" align="center"><input type="submit" name="sub_frm" value="Submit" /></td>
		</tr>
	  </table>
	</form>
  </body>
</html>

<?php
	include "Footer.html";
?></font>