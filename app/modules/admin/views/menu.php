<?php 


$this->layout('default');
use app\models\menu;
if($datas){
	foreach($datas as $v){
		$new[] = $v;
	}
	$datas = menu::tableTree($new);
}
?>
<?php 
$this->start('content');
$par = ['s'=>$_GET['s']];
?>

 <a href="<?php echo url('admin/menu/index'); ?>" class='fa fa-list' ></a>

<small> <a  class='fa fa-plus' href="<?php echo url('admin/menu/view'); ?>"></a></small>

<span class="label label-default">
<?php   if(!$data['_id']){ echo __('Add');} else{echo __('Edit');}?>
</span>
     <?php if($list==1){?>
     <form class='ajaxform' method='post' action="<?php echo url('admin/menu/sort');?>">
     <table class="table table-bordered">
      <caption>管理菜单(<?php echo $count;?>). 
      	 
	  </caption>
      <thead>
        <tr>
          <th>菜单名</th>
          <th>时间</th>
          <th></th>
        </tr>
      </thead>
      <tbody id='sortable'>
      <?php if($datas){foreach($datas as $data){ ?>
        <tr>
          <th scope="row">
          <input type="hidden" name="t[]" value="<?php echo (string)$data['_id'];?>">
          <?php echo strip_tags($data['title']);?> [<?php echo strip_tags($data['slug']);?>]</th>
          <td><?php echo date('Y-m-d H',$data['created']->sec);?></td>
          <td >
          
          	<a href="<?php echo url('admin/menu/status',['id'=>(string)$data['_id']]+$par);?>" class="button">
	         	<?php 
	         		switch ($data['status']){
	         			case 1:
	         				echo '<span class="fa fa-check"></span>';
	         				break;
	         			default:
	         				echo '<span class="fa fa-close" style="color:red;"></span>';
	         				break;
	         		}
	         	?> 
	        </a>
	        
	        
          	<a href="<?php echo url('admin/menu/view',['id'=>(string)$data['_id']]);?>" class="fa fa-pencil">
	          
	        </a>
	        
	        <a href="<?php echo url('admin/menu/remove',['id'=>(string)$data['_id']]);?>" class="remove fa fa-remove">
	          
	        </a>
	        
	        
          </td>
        </tr>
       <?php }}?> 
      </tbody>
    </table>
    <button type="submit"  class="btn btn-success">保存</button>
    </form>
    <?php echo $page;?>
    <?php }?>
    
   <?php if($view==1){?>
   	<?php if($error){
		    		 
		    			echo '<div class="alert alert-dismissible alert-danger">'.$error.'</div>';
		    		
		    } ?>
     <form method="POST"    enctype="multipart/form-data">
	  <div class="form-group">
	    <label >菜单名</label>
	    <input type="input" class="form-control"  value="<?php echo $data['title'];?>" name='title' >
	  </div>
	  <div class="form-group">
	    <label >唯一标识</label>
	    <input type="input" class="form-control"  value="<?php echo $data['slug'];?>" name='slug' >
	  </div>

	  <div class="form-group">
	    <label >文章或分类</label>
	    <input type="input" class="form-control"  value="<?php 


	    $vid =  $data['value'];
	    if($vid){

			$post  = obj('app\models\post')->one(['_id'=>new \MongoId($vid)]);
			if($post){
				$value = $post['title'];
			}else{
					$post  = obj('app\models\category')->one(['_id'=>new \MongoId($vid)]);
					if($post){
						$value = $post['title'];
					}

			}
	    }
	    echo $value;

	    ?>" name='value' id='post' >
	    
	  </div>


	  <div class="form-group">
	    <label>分类</label>
		<p>
		    <select name='pid' class="form-control select">
		    	<?php echo $category;?>
		    </select>
	    </p>
	  </div>
	 	  <div class="form-group">
	    <label>状态</label>
	    
	    <?php $status = [
	    	1=>'启用',
	    	0=>'禁用',
	    ];?>
	    <p>
	    <select name="status" class="select" style='width:100px;'>
	    <?php 
	    $true = false;
	    foreach($status as $k=>$v){?>
	    	<option value=<?php echo $k;?> <?php if($true===false && ($data['status']==$k || !$_GET['id']) ) { $true = true;?>selected<?php }?> >
	    		<?php echo $v;?>
	    	</option>
	    <?php }?>
	    </select>
	    </p>
	  </div>
	   
	  <button type="submit" id='submit' class="btn btn-success">保存</button>
	</form>
<?php }?>


 
     

<?php 
$this->end();
?>


<?php

$this->start('footer');
?>


<script type="text/javascript">
 
$(function(){

$("#post").autocomplete({
    source: function(request,response) {

		$.ajax({
	        url: "<?php echo url('admin/menu/ajax');?>",
	        dataType: "json",
	        data: {
	            top: 10,
	            key: request.term
	        },
	        success: function(data) {
	            response($.map(data, function(item) {
	            	//$('#post').val(item.id);
	            	//$('#post2').val(item.title);
	                return { label: item.title, value: item.title+'|'+item.id }
	            }));
	        }
	    });
	    
		 
    }
});
});
</script>
<?php $this->end();?>
