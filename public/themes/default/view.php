<?php $this->layout('default');?>


<?php $this->start('content');?>

 
      <div class="row marketing">
       
        <div class="col-lg-12">
          <h4><?php echo $post['title'];?></h4>
          <?php echo $post['body'];?>
        </div>
      </div>

      <?php 
      $f = $post['file'];
      if($f){
      	foreach($f as $v){
      ?>
      
       <img class="thumbnail" src="<?php echo app\comm\img::set($v,['w'=>400,'h'=>400]);?>" />

      <?php 		
      	}
      }
      ?>

      <?php hook::listen('blog.view');?>



<?php $this->end();?>