<?php 
$this->layout('default');
 
?>
<?php 
$this->start('content');
$par = ['s'=>$_GET['s']];
?>

 
 
     
      
   

      <div class="row">
      <?php foreach($datas as $data){ 

        $key   = $data['key'];
        if(strpos($key,'admin')!==false){
          $par['admin']=1;
        }else{
          $par['front']=1;
        }
        ?>
 <div class="col-xs-6 col-md-3">
        <a href="<?php echo url('admin/theme/status',['id'=>(string)$data['_id']]+$par);?>" class="thumbnail">
          <img  style="height: 180px; width: 100%; display: block;" src="<?php echo base_url().'themes/'.$key.'/preview.png';?>" >
          <span>
          <?php echo strip_tags($data['title']);?> (<?php echo $data['key'];?>)
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
          </span>
        </a>
      </div>


     
       <?php }?> 
   </div>
    <?php echo $page;?>
     
 
     

<?php 
$this->end();
?>
