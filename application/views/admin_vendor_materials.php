<html>
<body>

<form method="POST" action="/CodeIgniter_2.2.0/index.php/materials/upload_material">
<input type='submit' value='Add More Material' />
</form>
<a href="/CodeIgniter_2.2.0/index.php/logout/logout_vendor">Logout</a>
<br/>

<?php
//echo $_COOKIE['vendor'];
if(isset($_COOKIE['vendor']))
{
	$this->load->database();
	$user=$_COOKIE['vendor'];
	$sql= "SELECT Material_ID,Material_Name FROM materials,users WHERE materials.Vendor_Email=users.Email AND users.Username='$user'";
	//echo $sql;
	$result=mysql_query($sql);
	$value=mysql_num_rows($result);
	while($a=mysql_fetch_object($result))
	{
		echo $a->Material_ID;
		echo $a->Material_Name;
		$m_id=$a->Material_ID;
?>
	<form method="POST" action="/CodeIgniter_2.2.0/index.php/materials/update_material?Material=<?php echo $m_id; ?>">
	<input type='submit' value='Update' />
	</form>

	<form method="POST" action="/CodeIgniter_2.2.0/index.php/materials/delete_material?Material=<?php echo $m_id; ?>">
	<input type='submit' value='Delete' />
	</form>


<?php		
	}
}
?>

<form method = "GET" action = "block_vendor" enctype="multipart/form-data">
<input type="hidden" name="vendor_email" value="<?php echo $vendor_email; ?>" />
<input type="submit" value="<?php if($block==0){echo "Block";}else{echo "Unblock";} ?>" />
</form>
<form method = "POST" action = "manage_orders" enctype="multipart/form-data">
<input type="hidden" name="vendor_emailid" value="<?php echo $vendor_email; ?>" />
<input type="submit" value="Manage Orders" />
</form>
</body>
</html>