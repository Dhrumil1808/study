

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
 

     <div class ="container">
        <div class="row">

            <div class="col-md-3">
                
                <!-- menu -->
      <!-- menu -->
      			
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
                                	<a href="http://localhost/CodeIgniter_2.2.0/index.php/admin_home/view_category?category=<?php echo $category->Category; ?>&add=0" class="list-group-item">EDIT</a>
                             </div>   
                      <?php
					  	  $i=$i+1; 
					  }
					  ?>
                      	<a href="http://localhost/CodeIgniter_2.2.0/index.php/admin_home/add_category?add=0" class="list-group-item list-group-item-success" data-toggle="" data-parent="#MainMenu">ADD NEW  <i class="fa fa-caret-down"></i></a>
                    </div>


                 </div>
            </div>


            
                                    
        </div>
    </div>

     
    </footer>   


<!-- Latest compiled and minified JavaScript -->
    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

</body> 
</html>


