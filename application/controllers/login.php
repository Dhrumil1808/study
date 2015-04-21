<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 ob_start();
class Login extends CI_Controller {
 
    public function student_login()
    {
    	$this->load->database();
    	$this->load->view('student_login');
    }
	public function forgot_password()
	{
		$this->load->database();
		$this->load->view('forgot_password');
	}

    public function vendor_login()
    {
        $this->load->database();
        $this->load->view('vendor_login');
    }
		public function success1()
            {
            $this->load->database();
            $this->load->view('trans_success');
            }
			public function failure()
            {
            $this->load->database();
            $this->load->view('trans_failure');
            }
    public function admin_login()
    {
        $this->load->database();
        $this->load->view('admin_login');
    }
	public function request_password()
	{
		$this->load->database();
		$email=$this->input->post('email');
		$select="SELECT * FROM users WHERE email='$email'";
		$run=mysql_query($select);
		$value=mysql_num_rows($run);
		if($value==0)
		{
			echo "<script language=\"JavaScript\">\n";
            echo "alert('Email Id  not registered');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials'";
            echo "</script>";
		}
		else
		{		
			//echo "Hello";
		$this->load->database();
			echo "<script language=\"JavaScript\">\n";
            echo "alert('Forgot Password link has been sent to your email');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials'";
            echo "</script>";
		$this->load->library('email');
		//$this->load->helper('email');
		//$this->email->initialize($config);
		//echo "mail";
		$random=rand(0,9999999999);
		$this->email->from('dhrml.shah@gmail.com','studykart');
		$this->email->to($this->input->post('email'));
		$this->email->subject('Password Request');
		$this->email->message('It seems that you requested for a new password <br/>
					
					 Your Pasword is given below'."<br/>".
					'Password:'. $random.'<br/>'.
					'Clicking on following link will activate your acount:'.
					
					'<a href="http://localhost/CodeIgniter_2.2.0/index.php/login/student_login">. Login Link .</a>'
					 );
				 $update="UPDATE users SET Password=sha1($random) WHERE email='$email'";
				 echo $update;
				 mysql_query($update); 
				 
	    $this->email->send();	
		//echo $this->email->print_debugger();		
		//echo "mail sent"; 	
		//$this->load->view('success');
		
		
	}
	
	}
    public function match_student_data()
    {
    	$uname= $this->input->post('username');
    	$pass= $this->input->post('pswd');
        $pass1=sha1($pass);
    	$this->load->database();

    	$sql= "SELECT Username FROM users WHERE Username='$uname' AND type='Student' AND Password='$pass1' AND Block_Status='0' AND verified='1'";
    	$result=mysql_query($sql);
    	$value=mysql_num_rows($result);
    	$r= mysql_fetch_object($result);
        echo $value; 

    	if($value==1)
    	{
    		
            if(!isset($_COOKIE['student']))
            {
                $this->load->helper('cookie');

                setcookie('student',trim($r->Username),time()+7200,'/');
                $_COOKIE['student']=trim($r->Username);
                //setcookie('student',trim($r->Username),time()+900,'/');
            }
                
           $this->load->view('load_materials');
        }
    	else
    	{
           
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Invalid Username or Password or your account might not be registered!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/student_login'";
            echo "</script>";
    	}	

    }

    public function match_vendor_data()
    {
        $uname= trim($this->input->post('username'));
        $pass= trim($this->input->post('pswd'));
        $pass1 = sha1($pass);
        echo $uname;

        $this->load->database();

        $sql= "SELECT Username FROM users WHERE Username='$uname' AND type='Vendor' AND Block_Status='0' AND verified='1'"; //AND Password='$pass'";# AND type="Student"";
      //  echo $sql;
        $result=mysql_query($sql);
        $value=mysql_num_rows($result);
        $r = mysql_fetch_object($result);
        echo $r->Username;
        echo $value;
      //  echo $value;

        if($value==1)
        {
           
                setcookie('vendor',trim($r->Username),time()+900,'/');
                $_COOKIE['vendor']=trim($r->Username);
               
                    $data1["users"] = $r->Username;
           // $this->output->set_header('vendor_maerial?msg=$_COOKIE[student]',$data1);
            $this->load->view('vendor_material',$data1);

        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Invalid Username or Password!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/vendor_login'";
            echo "</script>";
        }   

    }

    public function match_admin_data()
    {
        $uname= $this->input->post('username');
        $pass= $this->input->post('pswd');
        $pass1=sha1($pass);
        $this->load->database();

        $sql= "SELECT Username FROM users WHERE Username='$uname' AND Password='$pass1' AND type='Admin' AND Block_Status='0'"; #AND Password=sha1('$pass')";# AND type="Student"";
        $result=mysql_query($sql);
        $value=mysql_num_rows($result);
        $r= mysql_fetch_object($result);
        if($value==1)
        {
            setcookie('admin',trim($r->Username),time()+900,'/');
            $_COOKIE['admin']=trim($r->Username);
            unset($_POST);
            $this->load->view('admin_page');
        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Invalid Username or Pasword!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/admin_login'";
            echo "</script>";
        }   

    }

}
ob_flush();
?>