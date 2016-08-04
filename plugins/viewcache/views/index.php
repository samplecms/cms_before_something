<?php $this->layout('default');?>


<?php $this->start('content');?>


<form method="post">
<label>设置前端视图缓存时间(秒)</label>
<input name='viewcache[time]' class="form-control" value="<?php echo $value['time'];?>">
 
<br><br>
<input type='submit' value="设置">
</form>

<p>
<a href="<?php echo plugin_url('viewcache','admin',['cache'=>1]);?>">清除缓存</a>
</p>
<?php $this->end();?>