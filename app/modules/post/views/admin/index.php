<?php 
$this->layout('default');
?>
<?php 

$this->start('content');

$par = ['s'=>$_GET['s'],'page'=>$_GET['page']];

?>

<div class="container">
     
     <h1>文章</h1>
     <?php if($list==1){?>
     	<form class='ajax_form' method='post' action="<?php echo url('post/admin/sort');?>">
     <table class="table">
      <caption>管理文章(<?php echo $count;?>). 
      
      	
				
      	<span class='pull-right'>
      	
      		
			 <form class="form-inline" method='get' style="margin:0px;padding:0px;display:inline;margin-right:30px;">
				  <div class="form-group">
				    <input type="text" name='q' value="<?php echo $_GET['q']?>" class="form-control"  placeholder="">
				  </div>
				  
				  <button type="submit" class="btn btn-default">搜索</button>
		</form>	
				
      		<a href="<?php echo url('post/admin/view');?>" class="button">
	          添加
	        </a>
	        
	        <a href="<?php echo url('post/admin/index');?>" class="button">
	          所有
	        </a>
	        
	        <a href="<?php echo url('post/admin/index',['s'=>1]);?>" class="button">
	          通过
	        </a>
	        
	        <a href="<?php echo url('post/admin/index',['s'=>0]);?>" class="button">
	          禁用
	        </a>
	      </span>
	  </caption>
      <thead>
        <tr>
          <th>标题</th>
          <th>内容</th>
          <th>时间</th>
          <th></th>
        </tr>
      </thead>
      <tbody id='sortable'>
      <?php foreach($datas as $data){?>
        <tr>
          <th title="<?php echo $data['title'];?>">
		<input type="hidden" name="t[]" value="<?php echo (string)$data['_id'];?>">
          <?php echo str::cut(strip_tags($data['title']),20);?></th>
          <td>
          <?php if($data->file[0]){?>
          	<span class="glyphicon glyphicon-picture" ></span>
          <?php }?>
          <?php echo str::cut(strip_tags($data['body']),20);?></td>
          <td><?php echo date('Y-m-d H',$data['created']->sec);?></td>
          <td class='pull-right'>
          
          	<a href="<?php echo url('post/admin/top',['id'=>(string)$data['_id']]+$par);?>" class="button">
	         	<?php 
	         		switch ($data['top']){
	         			case 1:
	         				echo '<span class="fa fa-star" style="color:red;"></span>';
	         				break;
	         			default:
	         				echo '<span class="fa fa-star-o" style="color:#ccc;"></span>';
	         				break;
	         		}
	         	?> 
	        </a>

	        <a href="<?php echo url('post/admin/status',['id'=>(string)$data['_id']]+$par);?>" class="button">
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
	        
	        
          	<a href="<?php echo url('post/admin/view',['id'=>(string)$data['_id']]);?>" class="fa fa-pencil">
	          
	        </a>
	        
	        <a href="<?php echo url('post/admin/remove',['id'=>(string)$data['_id']]);?>" class="remove fa fa-remove">
	          
	        </a>
	        
	        
          </td>
        </tr>
       <?php }?> 
      </tbody>
    </table>
    <button type="submit" class="btn btn-success">保存</button>
    </form>
    <?php echo $pager;?>

    <?php hook::listen('post.admin.index');?>
    <?php }?>
    
   <?php if($view==1){?>
     <form method="POST" class='ajax_form'  enctype="multipart/form-data">
	  <div class="form-group">
	    <label >标题</label>
	    <input type="input" class="form-control"  value="<?php echo $data['title'];?>" name='title' >
	    <div class='alert alert-warning error' style="display:none;"></div>
	  </div>
	  <div class="form-group">
	    <label>分类</label>
		<p>
		    <select name='category' class=" select form-control" >
		    	<?php echo $category;?>
		    </select>
		    <div class='alert alert-warning error' style="display:none;"></div>
	    </p>
	  </div>
	  <div class="form-group">
	    <label >主体内容</label>
	    <textarea id='body'    class="form-control" name='body'  ><?php echo $data['body'];?> </textarea>
	    <div class='alert alert-warning error' id="body_error" style="display:none;"></div>
	  </div>
	 
	
	  <div class="form-group">
	    <label>附件</label>
	  	<?php 
	  	//widget('jui');
	  	widget('plupload',[
	  			'ele'=>'file',
	  			'option'=>[
		  		//	'CKEDITOR'=>'body',
					'maxSize'=>'30',
	  				'class'=>'upload',
	  				'count'=>100,
	  				'data'=>$data['file'],
		  		]			
		]);

	  	?>
		     
	  </div>
	  
	  <br style="clear:both;">
	  <div class="form-group">
	    <label>状态</label>
	    
	    <?php $status = [
	    	1=>'启用',
	    	0=>'禁用',
	    ];?>
	    <p>
	    <select name="status" class="select">
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

	<?php  hook::listen('post.admin.form');?>
<?php }?>



</div>


<?php 
html::code(" 
 
           
$('.file_upload_div').sortable();

 ");
$this->end();
?>
 
 

 
