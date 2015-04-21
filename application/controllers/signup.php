<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create an Account</title>
</head>

<?php

class Signup extends CI_Controller
{

public function take_entries()
	{
		//echo "HI";
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->form_validation->set_rules('name','Name','trim|required|xss_clean');
		$this->form_validation->set_rules('username','Username','trim|required|min_length[5]|max_length[12]|xss_clean|is_unique[users.Username]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.Email]');
		$this->form_validation->set_rules('contact','Contact Number','trim|required|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('password','password','trim|required|alpha_numeric');
		$this->form_validation->set_rules('password1','confirm','trim|required|matches[password]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('take_entries');
			
		}	
		else
		{
		
       // $this->load->model('Sign_Upmodel');
     	$this->load->database();  
        $data = array( 
        'Name' => $this->input->post('name'),
        'Username' => $this->input->post('username'),
        'Password' => sha1($this->input->post('password')),
        'Email' => $this->input->post('email'),
        'Contact' => $this->input->post('contact'),
        'type' => "Student"
        );

        $data1=array('Email'=>$this->input->post('email'));

        $this->db->insert('users', $data); 
        $this->db->insert('student', $data1); 

        	echo "<script language=\"JavaScript\">\n";
            echo "alert('Click on the confirmation link sent to your account to register your account!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials'";
            echo "</script>";
		
		$valid_user=$this->input->post('username');
		$this->load->library('email');
		//$this->load->helper('email');
		//$this->email->initialize($config);
		//echo "mail";
		$this->email->from('dhrml.shah@gmail.com','studykart');
		$this->email->to($this->input->post('email'));
		$this->email->subject('Signing up');
		$this->email->message('Thanks for signing up <br/>
					
					Your details are given below'."<br/>".
					'Username:'. $this->input->post('username').'<br/>'.
					'Password:'. $this->input->post('password').'<br/>'.
					'Clicking on following link will activate your acount:'.
					
					'http://localhost/CodeIgniter_2.2.0/index.php/signup/validate_user?User='.$valid_user
					 );
				 
		echo $this->email->send();	
		//echo $this->email->print_debugger();		
		//echo "mail sent"; 	
		//$this->load->view('success');
		}	
	}
	public function validate_user()
	{
		$this->load->database();
		echo "hello";
		$val=$_GET['User'];
		$sql="UPDATE users SET verified='1' WHERE Username='$val'";
		//echo $sql;
		$result=mysql_query($sql);

		echo "<script language=\"JavaScript\">\n";
            echo "alert('Congratulations! Your account has been activated');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/student_login'";
            echo "</script>";
		
		
	}
	
	

	public function take_vendor_entries()
	{
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->form_validation->set_rules('name','Name','trim|required|xss_clean');
		$this->form_validation->set_rules('username','Username','trim|required|min_length[5]|max_length[12]|xss_clean|is_unique[users.Username]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.Email]');
		$this->form_validation->set_rules('contact','Contact Number','trim|required|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('password','password','trim|required|alpha_numeric');
		$this->form_validation->set_rules('password1','confirm','trim|required|matches[password]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('take_vendor_entries');
			
		}	
		else
		{
		
       // $this->load->model('Sign_Upmodel');
     	$this->load->database();  
        $data = array( 
        'Name' => $this->input->post('name'),
        'Username' => $this->input->post('username'),
        'Password' => sha1($this->input->post('password')),
        'Email' => $this->input->post('email'),
        'Contact' => $this->input->post('contact'),
        'type'=>"Vendor"
        );

       $data1 = array(
        'Email' => $this->input->post('email'),
        'Stream' => $this->input->post('stream'),
        'AccountNumber'=> intval($this->input->post('accnum')),
        'BusinessName' => $this->input->post('bname'),
        'Address' => $this->input->post('address'),
        'City' => $this->input->post('city'),
        'State' => $this->input->post('state'),
        'Pincode' => intval($this->input->post('pincode'))
        );
        $this->db->insert('users', $data); 
        $this->db->insert('vendor', $data1);
        $sql = "SELECT Email FROM users WHERE type='Admin'";
        $result = mysql_query($sql);
        echo "New vendor(Username: ".$data['Username'].") has registered";
        while($admin = mysql_fetch_object($result)){
        	$notification = array(
        		'User_Email' => $admin->Email,
        		'Notification_Text' => "New vendor(Username: ".$data['Username'].") has registered"
        		);
        	$this->db->insert('notifications', $notification);
        } 
	
			echo "<script language=\"JavaScript\">\n";
            echo "alert('Click on the confirmation link sent to your account to register your account!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials'";
            echo "</script>";

		$valid_user=$this->input->post('username');
		$this->load->library('email');
		//$this->load->helper('email');
		//$this->email->initialize($config);
		//echo "mail";
		$this->email->from('dhrml.shah@gmail.com','studykart');
		$this->email->to('dhruvi9499@gmail.com');
		$this->email->subject('Signing up');
		$this->email->message('Vendor signing up request <br/>
					
					Details of vendor are given below'."<br/>".
					'Username:'. $this->input->post('username').'<br/>'.
					'Password:'. $this->input->post('password').'<br/>'.
					'Clicking on following link will activate vendor,s acount:'.
					
					'http://localhost/CodeIgniter_2.2.0/index.php/signup/validate_user?User='.$valid_user
					 );
				 
		echo $this->email->send();	
		echo $this->email->print_debugger();		
		echo "mail sent"; 	
		//$this->load->view('success');
		}	
	}

	public function add_admin()
	{
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->library('encrypt');
		$this->form_validation->set_rules('name','Name','trim|required|xss_clean');
		$this->form_validation->set_rules('username','Username','trim|required|min_length[5]|max_length[12]|xss_clean|is_unique[users.Username]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.Email]');
		$this->form_validation->set_rules('contact','Contact Number','trim|required|numeric|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('password','password','trim|required|alpha_numeric');
		$this->form_validation->set_rules('password1','confirm','trim|required|matches[password]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('take_admin_entries');
		}	
		else
		{
		
       // $this->load->model('Sign_Upmodel');
     	$this->load->database();  
        $data = array( 
        'Name' => $this->input->post('name'),
        'Username' => $this->input->post('username'),
        'Password' => sha1($this->input->post('password')),
        'Email' => $this->input->post('email'),
        'Contact' => $this->input->post('contact'),
        'type' => "Admin"
        );
        $data1 = array(
        'Email' => $this->input->post('email'),
        'AccountNumber'=> intval($this->input->post('accnum'))
        );

        $this->db->insert('users', $data);
        $this->db->insert('admin', $data1);
        $this->load->view('admin_page'); 
        
		}
	}
}

?>
<body>
</body>
</html>