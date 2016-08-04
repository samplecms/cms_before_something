<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo h(db_config('web_title'));?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php 
		
		html::link(theme_url().'/home.js');
		html::link(theme_url().'/bootstrap.min.css');
		html::link(theme_url().'/default.css');
		
	?>
</head>
<body>



    
	<div class="container" style="margin-top:200px;">
  	

      <a href="<?php echo url('oauth2/qq/index');?>" class='fa fa-qq fa-4x'>
        
      </a>


  		<a href="<?php echo url('oauth2/git/index');?>" class='fa fa-github fa-4x'>
  			
  		</a>
  	
      


      <footer class="footer" style="margin-top:200px;">
        <p>&copy; Company 2016</p>
      </footer>

    </div> <!-- /container -->	


  
 

 
<?php
  
html::code("
.fa{margin-right:20px;}
  "); 

widget('font');
 

widget_render();
echo implode("\n",html::link());
echo implode("\n",html::code());
?>
 
</body>

</html>