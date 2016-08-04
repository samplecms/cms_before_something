<?php 
$this->layout('default');
 
?>
<?php 
$this->start('content');
$par = ['s'=>$_GET['s']];
?>

 
 
    <form class='ajaxform' method='post' action="<?php echo url('admin/plugin/sort');?>"> 
     <table  class="table table-bordered">
      <caption>管理(<?php echo $count;?>). 
      	 
	  </caption>
      <thead>
        <tr>
          <th>插件名</th>
          
          <th></th>
        </tr>
      </thead>
      <tbody id='sortable'>
      <?php foreach($datas as $data){

        $k = $data['key'];
        if(!in_array($k, $ps)){
             obj('app\models\plugin')->remove(['_id'=>$data['_id']]);
             continue;
        }
       ?>
        <tr>
          <th scope="row">
            <input type="hidden" name="t[]" value="<?php echo (string)$data['_id'];?>">
          <?php echo strip_tags($data['title']);?> (<?php echo $data['key'];?>)</th>
          
          <td >
          
          	<a href="<?php echo url('admin/plugin/status',['id'=>(string)$data['_id']]+$par);?>" class="button">
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

            <?php 

            $plg = 'plugin\\'.$data['key'].'\module';
            
            if($data['status'] ==1 && class_exists($plg)){
            $obj = obj($plg);
            if(method_exists($obj, 'admin')){  
            ?>
            <a href="<?php echo plugin_url($data['key'],'admin');?>"  class="fa fa-list">
              
            </a>
            <?php }} ?>





	        </a>
	        
	        
          
	        
          </td>
        </tr>
       <?php }?> 
      </tbody>
    </table>
    <button type="submit"  class="btn btn-success">保存</button>
    </form>
    <?php echo $page;?>
     
 
     

<?php 
$this->end();
?>
