<?php $this->layout('default');?>


<?php $this->start('content');?>

 

      <div class=" grid row marketing">

 

        <?php foreach ($posts as $key => $v) {
        ?>
         <div class="grid-item">
            <h4>
                    <a href="/view/<?php echo (string)$v['_id'];?>">
                       <?php echo str::cut(strip_tags($v['title']),20);?></h4>
                    </a>
                  <p>
                  <a href="/view/<?php echo (string)$v['_id'];?>">
                      <img class="lazyajax img-rounded" data-original="<?php echo app\comm\img::set($v['file'][0],['w'=>200,'h'=>200]);?>" />
                  </a>
                  <br>
                  <?php echo str::cut(strip_tags($v['body']),20);?>
                  </p>
          </div>
        <?php } ?>
        
      </div>

		<?php hook::listen('blog.index');?>



<?php $this->end();
html::link(base_url().'misc/masonry.pkgd.min.js');
html::code("

 
    $('img.lazyajax').lazyload({
        effect:'fadeIn',
        failurelimit:40,
        load:f_masonry,
    });


   f_masonry();

   function f_masonry() {

    $('.grid').masonry({
      
      itemSelector: '.grid-item',
      columnWidth: 220 
    });
      
  }


");
html::code("
.grid-item hover{
  background:#eee;

}
  .col-lg-3 {
    height: auto;
    overflow: hidden;
}


.grid-item { width: 220px; }


");
?>