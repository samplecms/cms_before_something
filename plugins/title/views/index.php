<?php $this->layout('default');?>


<?php $this->start('content');?>


<form method="post">


<div class="row">
  <div class="col-xs-12">

  		<label>请求的URLi(不包括域名,如首页为 / )</label>
		<input name='title[uri][]'  class="form-control" >
		<label>标题</label>
		<input name='title[title][]' class="form-control" > 
		<label>seo  keywords </label>
		<textarea name='title[keywords][]' class="form-control" row=3> </textarea> 
		<label>seo description</label>
		<textarea name='title[description][]' class="form-control" row=3 >  </textarea> 

  </div>
  <?php if($value){ foreach($value as $k=>$v){?>
  <div class="col-xs-12">
  	
  		<label class='box_label'>请求的URI[<?php echo $k;?>]</label>
  		<div class='box'>
		<input name='title[uri][]' class="form-control" value="<?php echo $k;?>">
		<label>标题</label>
		<input name='title[title][]' class="form-control" value="<?php echo $v['title'];?>">
		<label>seo  keywords </label>
		<textarea name='title[keywords][]' class="form-control" row=3  > <?php echo $v['keywords'];?> </textarea> 
		<label>seo description</label>
		<textarea name='title[description][]'  class="form-control" row=3 > <?php echo $v['description'];?> </textarea> 
		</div>
  </div>
  <?php }}?>
</div>

<?php

html::code("
$('.box').hide();
$('.box_label').click(function(){
	var box = $(this).parent('div').find('.box');
	box.toggle();
});
");

?>
 


<br>
<input type='submit' value="设置">


<?php $this->end();?>