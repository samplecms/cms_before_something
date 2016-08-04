<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php $title = trim($hook['title'])?:$title; echo $title.'-'.h(db_config('title'));?></title>
    <meta name="keywords" content="<?php echo trim($hook['keywords'])?:h(db_config('keywords'));?>">
    <meta name="description" content="<?php echo trim($hook['description'])?:h(db_config('description'));?>">	
    <meta property="qc:admins" content="64501374776734113016375" />
    <meta name="author" content="samplecms">
    	
	<?php
    widget('jquery');
    widget('bootstrap');
    html::link(base_url().'misc/jquery.lazyload.min.js');
    html::code("
      $('img.lazy').lazyload();
    ");
		html::link(theme_url().'/bootstrap.min.css'); 
		html::link(theme_url().'/default.css');
    widget_render_css();
    echo html::link()['css'];
	?>
</head>
<body>
<div class="container">

<?php hook::listen('top');?>


</div>
<nav class="navbar navbar-default ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">首页</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
             <?php 
			    $menu = app\comm\front::menu();
			    
			    $current = $_GET['tag'];
			    
			    foreach ($menu as $k=>$vo){
			    	$v = $vo['url'];

			    ?>
			    <li <?php if($vo['tag'] == $current ){echo "class='active'";} ?> 

			    > <a   href="<?php echo url($v);?>"><?php echo __($k);?></a></li>
			    
			    <?php }?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

        
		        
        <?php hook::listen('top1');?>

      
      	<?php echo $this->view['content'];?>


      <footer class="footer">
        <?php hook::listen('footer');?>
      	<?php echo db_config('footer');?>
        <p>&copy; Company 2016</p>
      </footer>

    </div> <!-- /container -->	






<?php

widget_render_js();
echo html::link()['js'];
echo implode("\n",html::code());
?>
<?php echo $this->view['footer'];?>	
<?php hook::listen('page.footer');?>
</body>

</html>
<?php hook::listen('page.end');?>