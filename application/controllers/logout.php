<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Logout extends CI_Controller {
 
    public function logout_student()
    {
    	$this->load->helper('cookie');
    	
    	//$name=$_COOKIE['student'];
        //echo $name;
    	if(isset($_COOKIE['student']))
    	{
               // echo "HI";
                delete_cookie('student');
    	
    		echo "<script language=\"JavaScript\">\n";
            echo "alert('You are logged out!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials'";
            echo "</script>";
    	}
    	//header('location:load_materials?msg=You are logged out');
    }

     public function logout_vendor()
    {
        $this->load->helper('cookie');       
        if(isset($_COOKIE['vendor']))
        {
            delete_cookie('vendor');
        
            echo "<script language=\"JavaScript\">\n";
            echo "alert('You are logged out!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials'";
            echo "</script>";
        }
        //header('location:load_materials?msg=You are logged out');
    }

    public function logout_admin()
    {
        $this->load->helper('cookie');       
        if(isset($_COOKIE['admin']))
        {
            delete_cookie('admin');
        
            echo "<script language=\"JavaScript\">\n";
            echo "alert('You are logged out!');\n";
            echo "window.location='/CodeIgniter_2.2.0/index.php/login/admin_login'";
            echo "</script>";
        }
        //header('location:load_materials?msg=You are logged out');
    }

}