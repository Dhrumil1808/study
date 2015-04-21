<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Bootsrtap For Beginners</title>
	<meta name="description" content="Hello World">
	<!-- Latest compiled and minified CSS -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<style>
    .container1 .row
    {
        margin-top: 100px;
    }

</style>	

</head>

<body>
    <header>
    
           <div class="navbar navbar-default navbar-fixed-top navbar-inverse">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="" class="navbar-brand">StudyKart</a>
                        </div>
                    <div class="collpase navbar-collapse" id="example">
                        <ul class="nav navbar-nav">
                            <li class ="xyz"><a href="#">Help</a></li>
                        </ul>

                    </div>

            </div>
        
    </header>

<div class="container1">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title"> Forgot Password</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                <form method="post" class="form-signin" action="request_password">
                <input type="text" class="form-control" name="email" placeholder="Email" required autofocus>
                
                <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Send Email"/>
                    
   
                </form>
                <?php
				/*if(isset($_POST['submit']))
				{
					$email=$_POST['email'];
					$check="SELECT * FROM users WHERE email='$email'";
					//echo $check;
					$run=mysql_query($check);
					$rows=mysql_num_rows($run);
					$r=mysql_fetch_object($run);
					//echo $r->Username;
					if($rows==1)
					{
						$this->load->database();
						header("location:request_password");
						
						
					}
					else
					{
						echo "<script language=\"JavaScript\">\n";
            			echo "alert('Your account is not registered');\n";
            			//echo "window.location='/CodeIgniter_2.2.0/index.php/home/load_materials'";
            			echo "</script>";
						
					}
					
					
				}*/
				
				?>
                
            </div>
            
        </div>
    </div>
</div>

   <!-- <footer>
        <div class="container">
        <hr>

            <div class="row">
                

                <div class="col-md-3"><p><small><a href="#">Terms</a> </small></p></div>
                <div class="col-md-3"><p><small><a href="#">About </a></small></p></div>
                <div class="col-md-3"><p><small><a href="#">Legal</a> </small></p></div>
                <div class="col-md-3"><p><small><a href="#">Contact</a> 888888888 </small></p></div>
                    
            </div>
        </div> 
    </footer>  -->		

	<!-- Latest compiled and minified JavaScript -->
	<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>	
</html>

