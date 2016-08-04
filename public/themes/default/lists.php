<?php $this->layout('default');?>


<?php $this->start('content');?>


	  

      <div class="row marketing">
        
        <div class="col-lg-12">
        <?php foreach($datas as $v){?>
          <h4><a href="<?php echo url('home/page/view',['id'=>(string)$v['_id']]);?>"><?php echo $v['title'];?></a></h4>
        <?php }?>


        <?php echo $pager;?>
        </div>
      </div>


		<?php hook::listen('blog.lists');?>


<?php $this->end();?>