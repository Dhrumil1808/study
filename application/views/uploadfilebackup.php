<h1> Hii...this is view </h1>
<html>
<body>
<a href="/CodeIgniter_2.2.0/index.php/logout/logout_vendor">Logout</a><br/>

<?php
	if($material==null)
	{
		echo "no default";
	}
	else
	{
		$this->load->database();
		$sql="SELECT * FROM materials WHERE Material_ID='$material'";
		$result=mysql_query($sql);
		$r=mysql_fetch_object($result);

		echo $material;
		echo "default";
	}
?>

<form method = "POST" action = <?php if($material==null) echo "add_material"; else echo "insert_update_values?ID=$material"; ?> enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
 Category: <select name='category' selected="Medical" >
 <?php

 	while($row = mysql_fetch_array($categories))
	{
	?>
	<option value = "<?php echo $row["Category"]; ?>" > <?php echo $row["Category"]; ?> </option>

 <?php
	}
 ?>

 </select><br />
 Sub Category: <select name = 'sub_category'>
 <?php
 	while($row1 = mysql_fetch_array($subcat))
	{
	?>
    <option value = "<?php echo $row1["Subcategory"]; ?>" > <?php echo $row1["Subcategory"]; ?> </option>
    <?php
	}
	?>
    </select><br />
 
 Material name: <input type='text' name='material_name' id='material_name' value=<?php if($material!=null)echo "$r->Material_Name";?> ></input><br />
 Price: <input type='text' name='price' id='price' value=<?php if($material!=null)echo "$r->Price";?> ></input><br />
 Discount: <input type='text' name='discount' id='discount' value=<?php if($material!=null)echo "$r->Discount";?> ></input><br />
 Quantity: <input type='text' name='quantity' id='quantity' value=<?php if($material!=null)echo "$r->Quantity";?> ></input><br />
 Description: <input type='text' name='description' id='description' value=<?php if($material!=null)echo "$r->Description";?> ></input><br />
 Image:<input type="file" name="pic" value=<?php if($material!=null)echo "$r->Image";?> ></input>
 <input type='submit' value='Submit' />
</form>

</body>
</html>
