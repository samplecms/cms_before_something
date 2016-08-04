<?php $this->layout('default');?>


<?php $this->start('content');?>


<form method="post">
<label>设置CDN地址</label>
<input name='cdn[url]'  class="form-control" value="<?php echo $value['url'];?>">
<label>启用CSS</label>
<input type='checkbox' name='cdn[css]'   value=1 <?php if($value['css']){?>checked<?php }?> >

<label>启用JS</label>
<input type='checkbox' name='cdn[js]'   value=1 <?php if($value['js']){?>checked<?php }?> >
<br>
<input type='submit' value="设置">

</form>
<?php $this->end();?>