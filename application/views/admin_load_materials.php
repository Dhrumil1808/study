

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>StudyKart</title>
    <meta name="Welcome" content="Hello User">
    

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">



    <style>
            

            .jumbotron .container
            {

                padding-top: 100px;
            }

            .list-group.panel > .list-group-item 
            {
                border-bottom-right-radius: 4px;
                border-bottom-left-radius: 4px;
            }
            .list-group-submenu 
            {
                margin-left:20px;
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
                            <li class ="xyz"><a href="/CodeIgniter_2.2.0/index.php/home/wish_list">Wish list</a></li>
                            <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/my_account/account">My account</a></li>
                            
                            <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/login/vendor_login">Sell</a></li>
                            <?php
							if(isset($_COOKIE['student']))
							{
                                //echo $_COOKIE['student'];
                                $users=$_COOKIE['student'];
							?>
								<li class="xyz"><a href="#"><?php echo "Hello "; echo $users; ?></a></li>
								<li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/logout/logout_student">Logout</a></li>
                <li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/home/cart">Shopping cart</a></li>
							<?php
							}
							else
							{
                            //echo $_COOKIE['student'];
							?>
							<li class="xyz"><a href="/CodeIgniter_2.2.0/index.php/login/student_login">Login</a></li>
							<li class="xyz"><a href="#">Create an account</a></li>
              <?php
							}
							?>
						 		
                            
                            
                        </ul>

                    </div>

                </div>
        </div>

    </header>



     <div class="jumbotron">
        <div class="container">
            <h1>Find the resources you need</h1>


            <form method="POST" action="/CodeIgniter_2.2.0/index.php/home/search" class="navbar-form navbar-center" role="search">
						<div class="form-group">
							<input type="text" name="searchbox" class="form-control" placeholder="Search this out">
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
			</form>
      <?php 
      if(isset($_COOKIE['student']))
      {
        ?>
      <form method = "POST" action = "block_student" enctype="multipart/form-data">
      <input type="hidden" name="student_email" value="<?php echo $student_email; ?>" />
      <input type="submit" value="<?php if($block==0){echo "Block";}else{echo "Unblock";} ?>" />
      </form>
      <?php } ?>

            <p> <em><br>Your exam + Our Material = Instant Swag!</br></em></p>
            <a href="#">Learn More</a>
        </div>
    </div> 

     <div class ="container">
        <div class="row">

            <div class="col-md-3">
                
      

            <?php
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
        
        
            ?>


             <div id="MainMenu">
                    <div class="list-group panel">
                      <?php
                        $i=1;
                        foreach($categories as $category){
                      ?>
                            <a href="#demo<?php echo $i; ?>" class="list-group-item list-group-item-success" data-toggle="collapse" data-parent="#MainMenu"><?php echo $category->Category; ?>  <i class="fa fa-caret-down"></i></a>
                            <div class="collapse" id="demo<?php echo $i; ?>">
                                <?php foreach($category->Subcategory as $subcategory){
                                ?>
                                    <a href="" class="list-group-item"><?php echo $subcategory; ?></a>
                                <?php
                                }
                                ?>
                                    <!--<a href="http://localhost/CodeIgniter_2.2.0/index.php/admin_home/view_category?category=<?php echo $category->Category; ?>&add=0" class="list-group-item">EDIT</a>-->
                             </div>   
                      <?php
                          $i=$i+1; 
                      }
                      ?>
                        <!--<a href="http://localhost/CodeIgniter_2.2.0/index.php/admin_home/add_category?add=0" class="list-group-item list-group-item-success" data-toggle="" data-parent="#MainMenu">ADD NEW  <i class="fa fa-caret-down"></i></a>-->
                    </div>


                 </div>
            </div>




            <div class="col-md-9 ">Engineering
                <div class="row"> 
                <?php $sql="SELECT * FROM materials WHERE Category='Engineering' ORDER BY Price desc LIMIT 3";  
                        $r=mysql_query($sql);

                        while($result=mysql_fetch_object($r))
                        {
                        ?>
                            <div class="col-md-4">
                            <a href="/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=<?php echo $result->Material_ID; ?>"> 
                            <div class="thumbnail">
                                <img src="http://localhost/CodeIgniter_2.2.0/<?php echo $result->Image;?>" > 
                            </div>
                            <?php echo $result->Material_Name; ?><br/>
                            Price: <?php echo $result->Price; ?></a><br/>
                            </div>
                        <?php
                        }
                        ?>
                </div>
            </div>

            <div class="col-md-9 ">Medical
                <div class="row"> 
                <?php $sql="SELECT * FROM materials WHERE Category='Medical' ORDER BY Price desc LIMIT 3";  
                        $r=mysql_query($sql);

                       while($result=mysql_fetch_object($r))
                        {
                        ?>
                            <div class="col-md-4">
                            <a href="/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=<?php echo $result->Material_ID; ?>"> 
                            <div class="thumbnail">
                                <img src="http://localhost/CodeIgniter_2.2.0/<?php echo $result->Image;?>" > 
                            </div>
                            <?php echo $result->Material_Name; ?><br/>
                            Price: <?php echo $result->Price; ?></a><br/>
                            </div>
                        <?php
                        }
                        ?>
                </div>
            </div>

            <div class="col-md-9 ">Commerce
                <div class="row"> 
                <?php $sql="SELECT * FROM materials WHERE Category='Commerce' ORDER BY Price desc LIMIT 3";  
                        $r=mysql_query($sql);

                        while($result=mysql_fetch_object($r))
                        {
                        ?>
                            <div class="col-md-4">
                            <a href="/CodeIgniter_2.2.0/index.php/materials/material_detail?ID=<?php echo $result->Material_ID; ?>"> 
                            <div class="thumbnail">
                                <img src="http://localhost/CodeIgniter_2.2.0/<?php echo $result->Image;?>" > 
                            </div>
                            <?php echo $result->Material_Name; ?><br/>
                            Price: <?php echo $result->Price; ?></a><br/>
                            </div>
                        <?php
                        }
                        ?>
                </div>
            </div>
            
         
                                    
        </div>
    </div>

     <div class="neighborhood-guides">
        <div class="container">
            <h2>Best Sellers</h2>
            <p>Not sure what to buy? Here are the top books appreciated highly by our users.</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="http://goo.gl/0sX3jq">
                    </div>
                    <div class="thumbnail">
                        <img src="http://goo.gl/an2HXY">
                    </div>
                     
                </div>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="http://goo.gl/Av1pac">
                    </div>
                    <div class="thumbnail">
                        <img src="http://goo.gl/vw43v1">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="http://goo.gl/0Kd7UO">
                    </div>
                </div>
            </div>
        </div>
    </div>  
    

        

    <footer>
        <div class="container">
        <hr>

            <div class="row">
                

                <div class="col-md-3"><p><small><a href="#">Terms</a> </small></p></div>
                <div class="col-md-3"><p>   <small><a href="#">About </a></small></p></div>
                <div class="col-md-3"><p>   <small><a href="#">Legal</a> </small></p></div>
                <div class="col-md-3"><p>   <small><a href="#">Contact</a> 888888888 </small></p></div>
                    
            </div>
        </div> <!-- end container -->
    </footer>   


<!-- Latest compiled and minified JavaScript -->
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body> 
</html>


