<?php $this->layout('default');?>


<?php $this->start('content');?>

<?php
widget('plupload');
?>
<br>

<?php foreach($datas as $v){ ?>

	<img class="lazy img-rounded" width="200px" height="200px" data-original="<?php echo app\comm\img::set($v['path'],['w'=>200,'h'=>200]);?>" />

<?php }?>

<br>
<?php echo $pager;?>

<?php $this->end();?>