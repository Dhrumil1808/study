<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class My_Account extends CI_Controller {

	public function account()
	{
		if(isset($_COOKIE['student']))
		{
			$this->load->database();
			
			$username=$_COOKIE['student'];
			$sql= "SELECT * FROM users WHERE Username='$username'";
            $result=mysql_query($sql);
            $r=mysql_fetch_object($result);
            $data["profile"]=$r;
            $this->load->library('form_validation');
            $this->form_validation->set_rules('contact','Contact','trim|required|numeric|exact_length[10]');
            if($this->form_validation->run()==FALSE)
                {

                    $this->load->view("view_profile",$data);
                }
            else
                {
                        //echo "correct";
                    $contact=$this->input->post('contact');
                    $update="UPDATE users SET Contact='$contact' WHERE Username='$username'";
                    mysql_query($update);
                    echo "<script language=\"JavaScript\">\n";
                    echo "alert('Contact Number updated!');\n";
                    echo "window.location='/CodeIgniter_2.2.0/index.php/my_account/account'";
                    echo "</script>";   

                }
            
		}
		else
		{
			echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to view your account!');\n";
            echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/student_login'";
            echo "</script>";
		}
	}

	public function edit_profile()
	{
		if(isset($_COOKIE['student']))
		{
			$this->load->database();
			
			$username=$_COOKIE['student'];
			$sql= "SELECT * FROM users WHERE Username='$username'";
            $result=mysql_query($sql);
            $user_info=mysql_fetch_object($result);
            $data["user_info"]=$user_info;

            $sql= "SELECT * FROM student WHERE Email='$user_info->Email'";
            $result=mysql_query($sql);
            $student_info=mysql_fetch_object($result);
            $data["student_info"]=$student_info;

            $this->load->view('edit_profile',$data);
        }
        else
        {
        	echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to edit!');\n";
            echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/home/load_materials'";
            echo "</script>";
        }
	}

	public function edit_address()
	{
		if(isset($_COOKIE['student']))
		{
			$this->load->database();
			
			$username=$_COOKIE['student'];
			$sql= "SELECT Email FROM users WHERE Username='$username'";
			$result=mysql_query($sql);
			$email=mysql_fetch_object($result);
			$sql= "SELECT Address, City, State, Pincode FROM student WHERE Email='$email->Email'";
			$result=mysql_query($sql);
			$address=mysql_fetch_object($result);
			$data['address']=$address;
			$this->load->library('form_validation');
			$this->form_validation->set_rules('pincode','Pincode','trim|required|numeric|min_length[6]|max_length[6]');
			$this->form_validation->set_rules('address','Address','trim|required');
			$this->form_validation->set_rules('city','City','trim|required|alpha');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('change_address', $data);
			}
			else
			{
				$new_address=$this->input->post('address');
				$new_city=$new=$this->input->post('city');
				$new_state=$this->input->post('state');
				$new_pincode=$new=$this->input->post('pincode');
				$update="UPDATE student SET Address='$new_address',City='$new_city',State='$new_state',Pincode='$new_pincode' WHERE Email='$email->Email'";
				mysql_query($update);

				echo "<script language=\"JavaScript\">\n";
		        echo "alert('Profile updated!');\n";
		        echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/my_account/account'";
		        echo "</script>";
			}
		}
		else
    	{
	    	echo "<script language=\"JavaScript\">\n";
	        echo "alert('Kindly sign in to change address!');\n";
	        echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/student_login'";
	        echo "</script>";
    	}
	}

	public function edit_password()
    {
        if(isset($_COOKIE['student']))
        {
            $this->load->database();
            
            $this->load->library('form_validation');
            //$this->load->library('encrypt');
            //$this->form_validation->set_rules('old_password','Old Password','trim|matches[$pass]')
            $this->form_validation->set_rules('new_password','New password','trim|required|alpha_numeric');
            $this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|matches[new_password]');
            if ($this->form_validation->run() == FALSE)
            {

                $this->load->view('change_password');
            
            }       
            else
            {
                $user=$_COOKIE['student'];
                $new=sha1($this->input->post('new_password'));
                $update="UPDATE users SET Password='$new' WHERE Username='$user'";
                mysql_query($update);

                echo "<script language=\"JavaScript\">\n";
        
                echo "alert('paasword have been updated');\n";
                echo "window.location='/CodeIgniter_2.2.0/index.php/my_account/account'";
                echo "</script>";       
            }

        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
        
            echo "alert('Session has expired . Please Re-login');\n";
            echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/student_login'";
            echo "</script>";       
        }
    }

    public function edit_email()
    {
        if(isset($_COOKIE['student']))
        {
            $this->load->database();
            $this->load->library('form_validation');
            //$this->load->library('encrypt');
            $this->form_validation->set_rules('new_email','New Email','trim|required|valid_email|is_unique[users.Email]');
            //$this->form_validation->set_rules('state','State','trim|required');
            $student=$_COOKIE['student'];
            $sql="SELECT Email FROM users WHERE Username='$student'";
            $result=mysql_query($sql);
            $email = mysql_fetch_object($result);
            $data['email']=$email;

            if ($this->form_validation->run() == FALSE)
            {
                //echo "hello";
                $this->load->view('update_email',$data);
            
            }       
            else
            {
                
                //echo $student;
                
                $new_email=$this->input->post('new_email');
                      
                $update="UPDATE users SET Email='$new_email', verified='0' WHERE Username='$student'";
                mysql_query($update);
                $this->load->library('email');
                //$this->load->helper('email');
                //$this->email->initialize($config);
                //echo "mail";
                $this->email->from('dhrml.shah@gmail.com','studykart');
                $this->email->to($this->input->post('new_email'));
                $this->email->subject('Email changed');
                $this->email->message('Your email has been changed'."<br/>".
                                        
                                                        'so you need to verify Your email ID by clicking on link below'."<br/>".
                                        
                                        '<a href=http://localhost/CodeIgniter_2.2.0/index.php/signup/validate_user?User='.$student.'>Login Link</a>'
                                         );
                             
                $this->email->send();


                echo "<script language=\"JavaScript\">\n";
        
                echo "alert('Email has been updated. Sign into your new email account to verify it.');\n";
                //echo "window.location='/CodeIgniter_2.2.0/index.php/my_account/account'";
                echo "</script>";       
            }
        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
        
            echo "alert('Session has expired . Please Re-login');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/student_login'";
            echo "</script>";       
        }
            
    }


	public function reviews()
	{
		$this->load->database();
		if(isset($_COOKIE['student']))
		{
			$uname = $_COOKIE['student'];
			$sql="SELECT Email FROM users WHERE Username='$uname'";
			$result=mysql_query($sql);
			$email=mysql_fetch_object($result);
			$sql="SELECT * FROM material_review WHERE Student_Email='$email->Email'";
			$result=mysql_query($sql);
			$data['reviews']=$result;
			$this->load->view('reviews', $data);

		}
		else
		{
			echo "<script language=\"JavaScript\">\n";
        
            echo "alert('Session has expired . Please Re-login');\n";
            echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/student_login'";
            echo "</script>";
		}
		
	}

	public function review_remove()
	{
		$this->load->database();
		$id=$_GET['id'];
		$email=$_GET['email'];
		if(isset($_COOKIE['student']))
		{
			$sql="DELETE FROM material_review WHERE Material_ID='$id' AND Student_Email='$email'";
			mysql_query($sql);
			echo "<script language=\"JavaScript\">\n";
        
            echo "alert('Review Removed');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/my_account/reviews'";
            echo "</script>";
		}
		else
		{
			echo "<script language=\"JavaScript\">\n";
        
            echo "alert('Session has expired . Please Re-login');\n";
            echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/student_login'";
            echo "</script>";
		}
	}


    public function vendor_account()
    {
        if(isset($_COOKIE['vendor']))
        {
            $this->load->database();
            
            $username=$_COOKIE['vendor'];
            $sql= "SELECT * FROM users WHERE Username='$username'";
            $result=mysql_query($sql);
            $r=mysql_fetch_object($result);
            $data["profile"]=$r;
            $this->load->library('form_validation');
            $this->form_validation->set_rules('contact','Contact','trim|required|numeric|exact_length[10]');
            if($this->form_validation->run()==FALSE)
                {

                    $this->load->view("view_vendor_profile",$data);
                }
            else
                {
                        //echo "correct";
                    $contact=$this->input->post('contact');
                    $update="UPDATE users SET Contact='$contact' WHERE Username='$username'";
                    mysql_query($update);
                    echo "<script language=\"JavaScript\">\n";
                    echo "alert('Contact Number updated!');\n";
                    echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/my_account/vendor_account'";
                    echo "</script>";   

                }
            
        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to view your account!');\n";
            echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/vendor_login'";
            echo "</script>";
        }
    }

    public function update_business_info()
    {
        if(isset($_COOKIE['vendor']))
        {
            $this->load->database();
            $uname=$_COOKIE['vendor'];
            $sql="SELECT Email FROM users WHERE Username='$uname'";
            $result=mysql_query($sql);
            $email=mysql_fetch_object($result);
            $sql="SELECT BusinessName, AccountNumber FROM vendor WHERE Email='$email->Email'";
            $result=mysql_query($sql);
            $vendor_info=mysql_fetch_object($result);
            $data['vendor_info']=$vendor_info;
            $this->load->library('form_validation');
            $this->form_validation->set_rules('accnum','Account Number','trim|required|numeric|max_length[16]');
            if($this->form_validation->run()==FALSE)
            {
                $this->load->view('update_business_info', $data);
            }
            else
            {
                $bname=$this->input->post('bname');
                $accnum=$this->input->post('accnum');
                $update="UPDATE vendor SET BusinessName='$bname', AccountNumber=$accnum WHERE Email='$email->Email'";
                mysql_query($update);
                echo "<script language=\"JavaScript\">\n";
                echo "alert('Business Info updated!');\n";
                echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/my_account/vendor_account'";
                echo "</script>";

            }

        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to view your account!');\n";
            echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/vendor_login'";
            echo "</script>";
        }
    }

    public function edit_vendor_address()
    {
        if(isset($_COOKIE['vendor']))
        {
            $this->load->database();
            
            $username=$_COOKIE['vendor'];
            $sql= "SELECT Email FROM users WHERE Username='$username'";
            $result=mysql_query($sql);
            $email=mysql_fetch_object($result);
            $sql= "SELECT Address, City, State, Pincode FROM vendor WHERE Email='$email->Email'";
            $result=mysql_query($sql);
            $address=mysql_fetch_object($result);
            $data['address']=$address;
            $this->load->library('form_validation');
            $this->form_validation->set_rules('pincode','Pincode','trim|required|numeric|min_length[6]|max_length[6]');
            $this->form_validation->set_rules('address','Address','trim|required');
            $this->form_validation->set_rules('city','City','trim|required|alpha');
            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('change_vendor_address', $data);
            }
            else
            {
                $new_address=$this->input->post('address');
                $new_city=$new=$this->input->post('city');
                $new_state=$this->input->post('state');
                $new_pincode=$new=$this->input->post('pincode');
                $update="UPDATE vendor SET Address='$new_address',City='$new_city',State='$new_state',Pincode='$new_pincode' WHERE Email='$email->Email'";
                mysql_query($update);

                echo "<script language=\"JavaScript\">\n";
                echo "alert('Profile updated!');\n";
                echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/my_account/vendor_account'";
                echo "</script>";
            }
        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to change address!');\n";
            echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/vendor_login'";
            echo "</script>";
        }
    }

    public function edit_vendor_password()
    {
        if(isset($_COOKIE['vendor']))
        {
            $this->load->database();
            
            $this->load->library('form_validation');
            //$this->load->library('encrypt');
            //$this->form_validation->set_rules('old_password','Old Password','trim|matches[$pass]')
            $this->form_validation->set_rules('new_password','New password','trim|required|alpha_numeric');
            $this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|matches[new_password]');
            if ($this->form_validation->run() == FALSE)
            {

                $this->load->view('change_vendor_password');
            
            }       
            else
            {
                $user=$_COOKIE['vendor'];
                $new=sha1($this->input->post('new_password'));
                $update="UPDATE users SET Password='$new' WHERE Username='$user'";
                mysql_query($update);

                echo "<script language=\"JavaScript\">\n";
        
                echo "alert('paasword have been updated');\n";
                echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/my_account/vendor_account'";
                echo "</script>";       
            }

        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
        
            echo "alert('Session has expired . Please Re-login');\n";
            echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/vendor_login'";
            echo "</script>";       
        }
    }

    public function edit_vendor_email()
    {
        if(isset($_COOKIE['vendor']))
        {
            $this->load->database();
            $this->load->library('form_validation');
            //$this->load->library('encrypt');
            $this->form_validation->set_rules('new_email','New Email','trim|required|valid_email|is_unique[users.Email]');
            //$this->form_validation->set_rules('state','State','trim|required');
            $vendor=$_COOKIE['vendor'];
            $sql="SELECT Email FROM users WHERE Username='$vendor'";
            $result=mysql_query($sql);
            $email = mysql_fetch_object($result);
            $data['email']=$email;

            if ($this->form_validation->run() == FALSE)
            {
                //echo "hello";
                $this->load->view('update_vendor_email',$data);
            
            }       
            else
            {
                
                //echo $student;
                
                $new_email=$this->input->post('new_email');
                      
                $update="UPDATE users SET Email='$new_email', verified='0' WHERE Username='$vendor'";
                mysql_query($update);
                $this->load->library('email');
                //$this->load->helper('email');
                //$this->email->initialize($config);
                //echo "mail";
                $this->email->from('dhrml.shah@gmail.com','studykart');
                $this->email->to($this->input->post('new_email'));
                $this->email->subject('Email changed');
                $this->email->message('Your email has been changed'."<br/>".
                                        
                                                        'so you need to verify Your email ID by clicking on link below'."<br/>".
                                        
                                        '<a href=https://cryptic-citadel-3874.herokuapp.com/index.php/signup/validate_user?User='.$vendor.'>Login Link</a>'
                                         );
                             
                $this->email->send();


                echo "<script language=\"JavaScript\">\n";
        
                echo "alert('Email has been updated. Sign into your new email account to verify it.');\n";
                echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/vendor_login'";
                echo "</script>";       
            }
        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
        
            echo "alert('Session has expired . Please Re-login');\n";
            echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/vendor_login'";
            echo "</script>";       
        }
            
    }

    public function admin_account()
    {
        if(isset($_COOKIE['admin']))
        {
            $this->load->database();
            
            $username=$_COOKIE['admin'];
            $sql= "SELECT * FROM users WHERE Username='$username'";
            $result=mysql_query($sql);
            $r=mysql_fetch_object($result);
            $data["profile"]=$r;
            $this->load->library('form_validation');
            $this->form_validation->set_rules('contact','Contact','trim|required|numeric|exact_length[10]');
            if($this->form_validation->run()==FALSE)
                {

                    $this->load->view("view_admin_profile",$data);
                }
            else
                {
                        //echo "correct";
                    $contact=$this->input->post('contact');
                    $update="UPDATE users SET Contact='$contact' WHERE Username='$username'";
                    mysql_query($update);
                    echo "<script language=\"JavaScript\">\n";
                    echo "alert('Contact Number updated!');\n";
                    echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/my_account/admin_account'";
                    echo "</script>";   

                }
            
        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
            echo "alert('Kindly sign in to view your account!');\n";
            echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/admin_login'";
            echo "</script>";
        }
    }

    public function edit_admin_password()
    {
        if(isset($_COOKIE['admin']))
        {
            $this->load->database();
            
            $this->load->library('form_validation');
            //$this->load->library('encrypt');
            //$this->form_validation->set_rules('old_password','Old Password','trim|matches[$pass]')
            $this->form_validation->set_rules('new_password','New password','trim|required|alpha_numeric');
            $this->form_validation->set_rules('confirm_password','Confirm Password','trim|required|matches[new_password]');
            if ($this->form_validation->run() == FALSE)
            {

                $this->load->view('change_admin_password');
            
            }       
            else
            {
                $user=$_COOKIE['admin'];
                $new=sha1($this->input->post('new_password'));
                $update="UPDATE users SET Password='$new' WHERE Username='$user'";
                mysql_query($update);

                echo "<script language=\"JavaScript\">\n";
        
                echo "alert('paasword have been updated');\n";
                echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/my_account/admin_account'";
                echo "</script>";       
            }

        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
        
            echo "alert('Session has expired . Please Re-login');\n";
            echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/admin_login'";
            echo "</script>";       
        }
    }

    public function edit_admin_email()
    {
        if(isset($_COOKIE['admin']))
        {
            $this->load->database();
            $this->load->library('form_validation');
            //$this->load->library('encrypt');
            $this->form_validation->set_rules('new_email','New Email','trim|required|valid_email|is_unique[users.Email]');
            //$this->form_validation->set_rules('state','State','trim|required');
            $admin=$_COOKIE['admin'];
            $sql="SELECT Email FROM users WHERE Username='$admin'";
            $result=mysql_query($sql);
            $email = mysql_fetch_object($result);
            $data['email']=$email;

            if ($this->form_validation->run() == FALSE)
            {
                //echo "hello";
                $this->load->view('update_admin_email',$data);
            
            }       
            else
            {
                
                //echo $student;
                
                $new_email=$this->input->post('new_email');
                      
                $update="UPDATE users SET Email='$new_email', verified='0' WHERE Username='$admin'";
                mysql_query($update);
                $this->load->library('email');
                //$this->load->helper('email');
                //$this->email->initialize($config);
                //echo "mail";
                $this->email->from('dhrml.shah@gmail.com','studykart');
                $this->email->to($this->input->post('new_email'));
                $this->email->subject('Email changed');
                $this->email->message('Your email has been changed'."<br/>".
                                        
                                                        'so you need to verify Your email ID by clicking on link below'."<br/>".
                                        
                                        '<a href=https://cryptic-citadel-3874.herokuapp.com/index.php/signup/validate_user?User='.$admin.'>Login Link</a>'
                                         );
                             
                $this->email->send();


                echo "<script language=\"JavaScript\">\n";
        
                echo "alert('Email has been updated. Sign into your new email account to verify it.');\n";
                echo "window.location=https://cryptic-citadel-3874.herokuapp.com/index.php/login/admin_login'";
                echo "</script>";       
            }
        }
        else
        {
            echo "<script language=\"JavaScript\">\n";
        
            echo "alert('Session has expired . Please Re-login');\n";
            echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/admin_login'";
            echo "</script>";       
        }
            
    }

    public function edit_admin_accnum()
    {
        if(isset($_COOKIE['admin']))
        {
            $this->load->database();
            $username=$_COOKIE['admin'];
            $sql= "SELECT Email FROM users WHERE Username='$username'";
            $result=mysql_query($sql);
            $email=mysql_fetch_object($result);
            $sql="SELECT AccountNumber FROM admin WHERE Email='$email->Email'";
            $result=mysql_query($sql);
            $accnum=mysql_fetch_object($result);
            $data['accnum']=$accnum;
            $this->load->library('form_validation');
            $this->form_validation->set_rules('new_accnum','AccountNumber','trim|required|numeric|max_length[16]');

            if ($this->form_validation->run() == FALSE)
            {
                //echo "hello";
                $this->load->view('update_admin_accnum',$data);
            
            }
            else
            {
                $new_accnum=$this->input->post('new_accnum');
                $update="UPDATE admin SET AccountNumber='$new_accnum' WHERE Email='$email->Email'";
                if(mysql_query($update))
                {
                    echo "<script language=\"JavaScript\">\n";
        
                    echo "alert('Account Number has been updated.');\n";
                    echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/my_account/admin_account'";
                    echo "</script>";
                }
            }       
        }

        else
        {
            echo "<script language=\"JavaScript\">\n";
        
            echo "alert('Session has expired . Please Re-login');\n";
            echo "window.location='https://cryptic-citadel-3874.herokuapp.com/index.php/login/admin_login'";
            echo "</script>";
        }
    }
}
