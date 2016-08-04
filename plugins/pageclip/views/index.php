<?php $this->layout('default');?>


<?php $this->start('content');?>


<form method="post">


<div class="row">
  <div class="col-xs-12">

  		<label>HOOK NAME</label>
		<input name='pageclip[key][]'  class="form-control" >
		<label>VALUE</label>
		 
		<textarea name='pageclip[value][]' class="form-control" row=3> </textarea> 
		 
  </div>
  <?php if($value){ foreach($value as $k=>$v){?>
  <div class="col-xs-12">
  		
  		<label class='box_label'>HOOK NAME</label>
  		<div class='box'>

		<input name='pageclip[key][]' value="<?php echo $v['key'];?>" class="form-control" >
		<label>VALUE</label>
		 
		<textarea name='pageclip[value][]' class="form-control" row=3><?php echo $v['value'];?></textarea> 
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