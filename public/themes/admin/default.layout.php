<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo  h(db_config('web_title'));?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php 
		widget('jquery',['level'=>99]);
    widget('bootstrap');
    html::link(base_url().'misc/jquery.lazyload.min.js');
    html::code("
      $('img.lazy').lazyload();
    ");
    widget('font');
    widget('ajax_form');
    widget('jui');
		html::link(theme_url().'/home.js');
		html::link(theme_url().'/cosmo.css');
		html::link(theme_url().'/default.css');
   // html::link(base_url().'/misc/fbootstrapp/bootstrap.css');
    widget_render_css();
		echo html::link()['css'];
	?>
</head>
<body>
 
<nav class="navbar navbar-inverse ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/" target="_blank">首页</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
             <?php 
    $menu = [
    
    'Config'=>'admin/config/index', 
    'Content'=>'post/admin/index',
    'Category'=>'post/type/index',
    'Menu'=>'admin/menu/index',   
    'Admin User'=>'admin/user/index',   
    'Lang'=>'admin/lang/index',
    'Plugin'=>'admin/plugin/index',
    'Theme'=>'admin/theme/index',
    ];
    $arr = url_array();
    $current = $arr['module'].'/'.$arr['controller'];
    foreach ($menu as $k=>$v){
    ?>
    <li <?php if(strpos($v,$current)!==false){echo "class='active'";} ?> 

    > <a   href="<?php echo url($v);?>"><?php echo __($k);?></a></li>
    
    <?php }?>


    <?php 
    $ps = app\comm\plugin::admin_menu();

    if($ps){

    ?>
    <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">插件快捷菜单 <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <?php foreach($ps as $k=>$v){
                   
                ?>

                <li><a href="<?php echo $k;?>"><?php echo $v;?></a></li>
                 <?php }?>
              </ul>
            </li>
<?php }?>



          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    
	<div class="container" >
  <?php if(has_flash('success')){?>
<div class="alert alert-dismissible alert-info flash"><?php echo flash('success');?></div>
<?php }?>


 

      
      	<?php echo $this->view['content'];?>


      <footer class="footer">
        <p>&copy; Company 2016</p>
      </footer>

    </div> <!-- /container -->	


      

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="myModalRemove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">确认删除？</h4>
      </div>
      <div class="modal-body  alert-danger" id="myModalContent">
         删除数据将不可恢复,请慎重!!!
      </div>
      <div class="modal-footer">
      <a id='myModalRemoveLink' class="btn btn-default" >
      	 	 确认删除 
      </a>
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭窗口</button>
        
      </div>
    </div>
  </div>
</div>

 



<?php



widget_render_js();
echo html::link()['js'];
echo implode("\n",html::code());
?>
<?php echo $this->view['footer'];?>

 
</body>

</html>