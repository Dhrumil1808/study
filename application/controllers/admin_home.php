<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_home extends CI_Controller {
	public function index(){
		echo "Hello World";
	}
	public function admin_page(){
		if(isset($_COOKIE['admin']))
		{
			unset($_POST);
			$this->load->view('admin_page');
		}
		else
		{
			echo "<script language=\"JavaScript\">\n";
            echo "alert('Session expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/admin_login'";
            echo "</script>";
		}
		
	}
	public function search_vendor(){
		$this->load->database();
		$search = $this->input->get('vendor');
		echo $search;
		/*while($r = mysql_fetch_array($result)){
			echo $r['Name']." ".$r['Username']." ".$r['Email']." ".$r['Password']." ".$r['Contact']. " ".$r['Stream']." ".$r['Block_Status']." ".$r['AccountNumber']." ".$r['BusinessName']." ".$r['Address']." ".$r['City']." ". $r['State']." ". $r['Pincode']."\n";  
		}*/
	   	$data["search"] = $search;
		$this->load->view('vendor_list',$data);
		
	}
	public function search_student(){
		$this->load->database();
		$search = $this->input->get('student');
		
		/*while($r = mysql_fetch_array($result)){
			echo $r['Name']." ". $r['Username']." ". $r['Email']." ". $r['Password']." ". $r['Contact']. " ". $r['Stream']." ". $r['Block_Status']." ".$r['AccountNumber']." ". $r['BusinessName']." ". $r['Address']." ".$r['City']." ". $r['State']." ". $r['Pincode']."\n";  
		}*/
	   	$data["search"] = $search;
		$this->load->view('student_list',$data);
	}
	public function search_material(){
		echo "qwerty";
	}
	public function view_vendor(){
		if(isset($_COOKIE['admin']))
		{
			$username = $_GET['Username'];
			setcookie('vendor',trim($username),time()+900,'/');
			$_COOKIE['vendor'] = trim($username);
			$this->load->view('vendor_material');
		}
		else
		{
			echo "<script language=\"JavaScript\">\n";
            echo "alert('Session expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/admin_login'";
            echo "</script>";
		}
		
		//echo $vendor_email;
		//echo $username;
	}
	public function view_student(){
		if(isset($_COOKIE['admin']))
		{
			$username = $_GET['Username'];
			setcookie('student',trim($username),time()+900,'/');
			$_COOKIE['student'] = trim($username);
			$this->load->view('load_materials');
		}
		else
		{
			echo "<script language=\"JavaScript\">\n";
            echo "alert('Session expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/admin_login'";
            echo "</script>";
		}
		
		//echo $vendor_email;
		//echo $username;
	}
	public function block_vendor(){
		if(isset($_COOKIE['admin']))
		{
			$this->load->database();
			$vendor = $this->input->get('user');
			$sql = "UPDATE users SET Block_Status=-1*(users.Block_Status-1) WHERE Username='$vendor'";
			mysql_query($sql);
			echo "<script language=\"JavaScript\">\n";
            echo "alert('Block Status Changed');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/admin_home/view_vendor?Username=$vendor'";
            echo "</script>";
		}
		else
		{
			echo "<script language=\"JavaScript\">\n";
            echo "alert('Session expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/admin_login'";
            echo "</script>";
		}
		
		
	}
	public function block_student(){
		if(isset($_COOKIE['admin']))
		{
			$this->load->database();
			$student = $this->input->get('users');
			$sql = "UPDATE users SET Block_Status=-1*(users.Block_Status-1) WHERE Username='$student'";
			mysql_query($sql);
			echo "<script language=\"JavaScript\">\n";
            echo "alert('Block Status Changed');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/admin_home/view_student?Username=$student'";
            echo "</script>";
		}
		else
		{
			echo "<script language=\"JavaScript\">\n";
            echo "alert('Session expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/admin_login'";
            echo "</script>";
		}
	}
	public function edit_categories(){
		$this->load->database();
		$sql = "SELECT DISTINCT Category FROM categories";
		$result = mysql_query($sql);
		$categories = Array();
		$i=0;
		while($r=mysql_fetch_array($result)){
			$categories[$i]=(object)NULL;
			$categories[$i]->Category = $r['Category'];
			$cat = $r['Category'];
			$sql = "SELECT Subcategory FROM categories WHERE Category='$cat'";
			$res = mysql_query($sql);
			$categories[$i]->Subcategory = Array();
			$j=0;
			while($row=mysql_fetch_array($res)){
				$categories[$i]->Subcategory[$j]=(object)NULL;
				$categories[$i]->Subcategory[$j]=$row['Subcategory'];
				$j = $j+1;
			}
			$i=$i+1;
		}
		/*foreach ($categories as $category){
			echo $category->Category;
			foreach($category->Subcategory as $subcategory){
				echo $subcategory;
			}

		}*/
		
		$data['categories'] = $categories;
		$this->load->view('edit_categories', $data);
	}
	public function view_category(){
		$this->load->database();
		$category = $_GET['category'];
		$add = $_GET['add'];
		$sql = "SELECT Subcategory FROM categories WHERE Category='$category'";
		$data['category'] = $category;
		$data['subcategories'] = mysql_query($sql);
		$data['add'] = intval($add);
		$this->load->view('view_category', $data);
	}
	
	
	public function add_category(){
		$add = $_GET['add'];
		$data['add'] = intval($add);
		$this->load->view('add_category', $data);
	}
	
	public function edit_category(){
		$this->load->database();
		$category = $this->input->post('category');
		$category_name = $this->input->post('new_category_name');
		$category_op = $this->input->post('category_op');
		$subcategories = Array();
		$i = 0;
		while($subcategory = $this->input->post('subcategory_name'.strval($i))){
			$subcategories[$i] = (object)NULL;
			$subcategories[$i]->oldname = $subcategory;
			$subcategories[$i]->newname = $this->input->post('subcategory'.strval($i));
			$subcategories[$i]->op = $this->input->post('sub_category'.strval($i));
			$i = $i+1;
		}
		$i = 0;
		$new_subcategories = Array();
		while($subcategory = $this->input->post('new_subcategory'.strval($i))){
			$new_subcategories[$i] = (object)NULL;
			$new_subcategories[$i]->name = $subcategory;
			$i = $i+1;
		}
		
		
		if($category_op == 'Remove'){
			$sql = "DELETE FROM categories WHERE Category='$category'";
			mysql_query($sql);
		}
		if($category_op == 'None' || $category_op == 'Rename'){
			foreach($subcategories as $subcategory){
				if($subcategory->op == 'Rename' && $subcategory->newname != ''){
					$sql = "UPDATE categories SET Subcategory='$subcategory->newname' WHERE Category='$category' AND Subcategory='$subcategory->oldname'";
					mysql_query($sql);
				}
				if($subcategory->op == 'Remove'){
					$sql = "DELETE FROM categories WHERE Category='$category' AND Subcategory='$subcategory->oldname'";
					mysql_query($sql);
				}
			}
			foreach($new_subcategories as $subcategory){
				if($subcategory->name != ''){
					$sql = "INSERT INTO categories (Category, Subcategory) VALUES ('$category', '$subcategory->name')";
					mysql_query($sql);
				}
			}
		}
		if($category_op == 'Rename' && $category_name != ''){
			$sql = "UPDATE categories SET Category='$category_name' WHERE Category='$category'";
			mysql_query($sql);
		}
		if (count($_POST) > 0) {
     		$_POST = array();
		}
		echo "<script language=\"JavaScript\">\n";
        echo "window.location='/CodeIgniter_2.2.0/index.php/admin_home/admin_page'";
        echo "</script>";
	}
	
	public function insert_category(){
		$this->load->database();
		$category_name = $this->input->post('new_category_name');
		$i = 0;
		$new_subcategories = Array();
		while($subcategory = $this->input->post('new_subcategory'.strval($i))){
			$new_subcategories[$i] = (object)NULL;
			$new_subcategories[$i]->name = $subcategory;
			$i = $i+1;
		}
		if($category_name != ''){
			foreach($new_subcategories as $subcategory){
				if($subcategory->name != ''){
					$sql = "INSERT INTO categories (Category, Subcategory) VALUES ('$category_name', '$subcategory->name')";
					mysql_query($sql);
				}
			}
		}
		$this->load->view('admin_page');
	}
	
	public function manage_orders(){
		if(isset($_COOKIE['admin']))
		{
			$vendor= $_COOKIE['vendor'];
			$this->load->database();
			$sql="SELECT Email FROM users WHERE Username='$vendor'";
			$result=mysql_query($sql);
			$email=mysql_fetch_object($result)->Email;
			$data['email'] = $email;
			$this->load->view('manage_orders', $data);
		}
		else
		{
			echo "<script language=\"JavaScript\">\n";
            echo "alert('Session expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/admin_login'";
            echo "</script>";
		}
		
	}
	
	public function edit_orders(){
		$this->load->database();
		
			//$vendor=$_GET['user'];
		if(($_POST['options']==0))
		{
			echo "please select one of the options from the box";
		}
		if($_POST['options']==1)
		{
			$name=$_POST['select'];
			$vendor=$_COOKIE['vendor'];
			foreach($name as $select)
			{
				$sql="UPDATE `orders` SET Order_Approve_Status=1 WHERE Order_ID = '$select'";
				mysql_query($sql);
				$select="SELECT * FROM orders WHERE Order_ID='$select'";
				$fetch=mysql_query($select);
				$run=mysql_fetch_object($fetch);
				$select_material="SELECT * FROM materials WHERE Material_ID='$run->Material_ID'";
				$run1=mysql_query($select_material);
				$fetch2=mysql_fetch_object($run1);
				$text="your books named ".$fetch2->Material_Name." has been approved by admin";
				$email="SELECT * FROM users WHERE Username='$vendor'";
				$run_email=mysql_query($email);
				$r=mysql_fetch_object($run_email);

				$insert="INSERT INTO notifications(User_Email,Notification_Text,Status) VALUES('$r->Email','$text','0')";
				mysql_query($insert);
				$text_student="Your order for ".$fetch2->Material_Name." has been approved";
				//echo $run->Student_Email;
				$insert_student="INSERT INTO notifications(User_Email,Notification_Text,Status) VALUES('$run->Student_Email','$text_student','0')"; 
					mysql_query($insert_student);
				}
		}
		if($_POST['options']==2)
		{
			$name=$_POST['select'];
			foreach($name as $select)
			{
				$sql="DELETE FROM orders WHERE Order_ID='$select'";
				mysql_query($sql);
			}
		}

		/*$unapproved = Array();
		$i = 0;
		while($order = $this->input->post('unapproved_Order'.strval($i))){
			$unapproved[$i] = (object)NULL;
			$unapproved[$i]->op = $this->input->post('unapprovedOrder'.strval($i));
			$unapproved[$i]->id = $order;
			$i = $i+1;
		}
		$approved = Array();
		$i=0;
		while($order = $this->input->post('approved_Order'.strval($i))){
			$approved[$i] = (object)NULL;
			$approved[$i]->op = $this->input->post('approvedOrder'.strval($i));
			$approved[$i]->id = $order;
			$i = $i+1;
		}
		
		foreach($unapproved as $order){
			if($order->op=='Approve'){
				$sql="UPDATE `orders` SET Order_Approve_Status=1 WHERE Order_ID = '$order->id'";
				if(mysql_query($sql)){
				}
			}
			if($order->op=='Remove'){
				$sql="DELETE FROM `orders` WHERE Order_ID='$order->id'";
				echo $sql;
				if(mysql_query($sql)){
				}
				
				$sql="DELETE FROM `orders` WHERE Order_ID='$order->id'";
				if(mysql_query($sql)){
				}
			}
		}
		foreach($approved as $order){
			if($order->op=='Remove'){
				$sql="DELETE FROM `orders` WHERE Order_ID='$order->id'";
				mysql_query($sql);
				$sql="DELETE FROM `orders` WHERE Order_ID='$order->id'";
				mysql_query($sql);
			}
		}*/
		echo "<script language=\"JavaScript\">\n";
        echo "alert('Action completed');\n";
        echo "window.location='/CodeIgniter_2.2.0/index.php/admin_home/manage_orders'";
        echo "</script>";
		//header("location:manage_orders?user=$vendor");
	}

	public function edit_general_orders(){
		$this->load->database();
		
			//$vendor=$_GET['user'];
		if(($_POST['options']==0))
		{
			echo "please select one of the options from the box";
		}
		if($_POST['options']==1)
		{
			$name=$_POST['select'];
			foreach($name as $select)
			{
				$sql="UPDATE `orders` SET Order_Approve_Status=1 WHERE Order_ID = '$select'";
				mysql_query($sql);
				$select="SELECT * FROM orders WHERE Order_ID='$select'";
				$fetch=mysql_query($select);
				$run=mysql_fetch_object($fetch);
				$select_material="SELECT * FROM materials WHERE Material_ID='$run->Material_ID'";
				$run1=mysql_query($select_material);
				$fetch2=mysql_fetch_object($run1);
				$text="Order on your book named ".$fetch2->Material_Name." has been approved by admin";
				$vendor=$fetch2->Vendor_Email;
				

				$insert="INSERT INTO notifications(User_Email,Notification_Text,Status) VALUES('$vendor','$text','0')";
				mysql_query($insert);
				$text_student="Your order for ".$fetch2->Material_Name." has been approved";
				//echo $run->Student_Email;
				$insert_student="INSERT INTO notifications(User_Email,Notification_Text,Status) VALUES('$run->Student_Email','$text_student','0')"; 
					mysql_query($insert_student);
				}
		}
		if($_POST['options']==2)
		{
			$name=$_POST['select'];
			foreach($name as $select)
			{
				$sql="DELETE FROM orders WHERE Order_ID='$select'";
				mysql_query($sql);
			}
		}

		/*$unapproved = Array();
		$i = 0;
		while($order = $this->input->post('unapproved_Order'.strval($i))){
			$unapproved[$i] = (object)NULL;
			$unapproved[$i]->op = $this->input->post('unapprovedOrder'.strval($i));
			$unapproved[$i]->id = $order;
			$i = $i+1;
		}
		$approved = Array();
		$i=0;
		while($order = $this->input->post('approved_Order'.strval($i))){
			$approved[$i] = (object)NULL;
			$approved[$i]->op = $this->input->post('approvedOrder'.strval($i));
			$approved[$i]->id = $order;
			$i = $i+1;
		}
		
		foreach($unapproved as $order){
			if($order->op=='Approve'){
				$sql="UPDATE `orders` SET Order_Approve_Status=1 WHERE Order_ID = '$order->id'";
				if(mysql_query($sql)){
				}
			}
			if($order->op=='Remove'){
				$sql="DELETE FROM `orders` WHERE Order_ID='$order->id'";
				echo $sql;
				if(mysql_query($sql)){
				}
				
				$sql="DELETE FROM `orders` WHERE Order_ID='$order->id'";
				if(mysql_query($sql)){
				}
			}
		}
		foreach($approved as $order){
			if($order->op=='Remove'){
				$sql="DELETE FROM `orders` WHERE Order_ID='$order->id'";
				mysql_query($sql);
				$sql="DELETE FROM `orders` WHERE Order_ID='$order->id'";
				mysql_query($sql);
			}
		}*/
		echo "<script language=\"JavaScript\">\n";
        echo "alert('Action completed');\n";
        echo "window.location='/CodeIgniter_2.2.0/index.php/admin_home/getUnapprovedOrder'";
        echo "</script>";
		//header("location:manage_orders?user=$vendor");
	}



	public function order_vendors()
	{

		$this->load->view('order_vendors');
	}

	public function getUnapprovedOrder() {
		$this->load->database();
		$op = "0";

		$select = "SELECT orders.Material_ID, orders.Order_ID, users.Username, materials.Image, orders.Quantity, orders.Order_Cost, materials.Material_Name
		FROM orders
		INNER JOIN materials ON materials.Material_ID = orders.Material_ID
		INNER JOIN users ON users.Email = materials.Vendor_email
		WHERE Order_Approve_Status = '$op' ";

		$query = $this->db->query("$select");

		$data['results'] = $query->result();

		$select1 = "SELECT DISTINCT users.Username
		FROM orders
		INNER JOIN materials ON materials.Material_ID = orders.Material_ID
		INNER JOIN users ON users.Email = materials.Vendor_email
		WHERE Order_Approve_Status = '$op' ";

		$query1 = $this->db->query("$select1");

		$data['results1'] = $query1->result();

		$this->load->view("unapprovedView", $data);		

	}
	
	public function addAdmin(){
		$this->load->view('take_admin_entries');
	}
	
	public function insert_admin_data()
    {
       // $this->load->model('Sign_Upmodel');
        $this->load->database();
        $data = array( 
        'Name' => $this->input->post('name'),
        'Username' => $this->input->post('username'),
        'Password' => $this->input->post('pswd'),
        'Email' => $this->input->post('email'),
        'Contact' => intval($this->input->post('Contact number')),
        'type' => 'admin'
        );

        $data1 = array(
        'Email' => $this->input->post('email'),
        'AccountNumber'=> intval($this->input->post('accnum')),
        );

        $this->db->insert('users', $data); 
        $this->db->insert('admin', $data1); 

         $this->load->view('admin_page');
    }

    public function notifier(){
    	if(isset($_COOKIE['admin'])){
    		$uname = $_COOKIE['admin'];
    		$this->load->database();
    		$sql = "SELECT Email FROM users WHERE Username='$uname'";
    		$result = mysql_query($sql);
    		$email=mysql_fetch_object($result);
    		$sql = "SELECT Notification_Text FROM notifications WHERE User_Email = '$email->Email'";
    		$result = mysql_query($sql);
    		$sql = "SELECT * FROM notifications WHERE User_Email = '$email->Email' AND Status='0'";
    		$unread = mysql_query($sql);
    		$no_unread = mysql_num_rows($unread);
    		?>
    		<a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
            <span id="notifBadge" class="glyphicon glyphicon-bell"></span>
		  </a>
		  	<span class="badge badge-notify"><?php echo $no_unread; ?></span>
		  <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">

		    
		    <div class="notification-heading"><h4 class="menu-title">Notifications</h4>
		    <li class="divider"></li>
		   <div class="notifications-wrapper">
		     <a class="content" href="#">
		      	<?php while($notification = mysql_fetch_object($result)){ ?>
		       <div class="notification-item">
		        <h4 class="item-title"><?php echo $notification->Notification_Text; ?></h4>
		        
		      </div>
		      </a>  <?php  } ?>
		    

		   </div>
		    <li class="divider"></li>
		    <div class="notification-footer"></div>
		  </ul>
		  <?php
    	}
    	else{
    		echo "<script language=\"JavaScript\">\n";
            echo "alert('Session expired. Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/admin_login'";
            echo "</script>";
    	}
    	
    }

    public function read_notifs(){
    	if(isset($_COOKIE['admin']))
    	{
    		$this->load->database();
    		$uname = $_COOKIE['admin'];
    		$sql = "SELECT Email FROM users WHERE Username='$uname'";
    		$result = mysql_query($sql);
    		$email=mysql_fetch_object($result);
    		$sql = "UPDATE notifications SET Status='1' WHERE User_Email = '$email->Email'";
    		mysql_query($sql);
    		echo "<script language=\"JavaScript\">\n";
            echo "alert('read');\n";
            //echo "window.location='/CodeIgniter_2.2.0/index.php/login/admin_login'";
            echo "</script>";
    	}
    }

	
	
}

?>