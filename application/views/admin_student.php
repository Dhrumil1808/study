<html>
<body>

<?php
if(isset($_COOKIE['student_name']))
{
	echo $student_email." ";
	echo $username." ";
	echo $block." ";
}
?>

<form method = "POST" action = "block_student" enctype="multipart/form-data">
<input type="hidden" name="student_email" value="<?php echo $student_email; ?>" />
<input type="submit" value="<?php if($block==0){echo "Block";}else{echo "Unblock";} ?>" />
</form>
</body>
</html>