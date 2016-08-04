<?php $this->layout('default');?>


<?php $this->start('content');?>


<form method="post">
<label>统计代码</label>
<textarea name='cnzz' class="form-control" rows=6 ><?php echo $value;?></textarea> 
 
<br>
<input type='submit' value="设置">

</form>
<?php $this->end();?>