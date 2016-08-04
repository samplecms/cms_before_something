<?php $this->layout('default');?>


<?php $this->start('content');


?>

 

<div class="row">
  <div class="col-xs-12">

  <table class="table">
      <caption>Optional table caption.</caption>
      <thead>
        <tr>
          <th><?php echo __('Table');?></th>
          <th><?php echo __('Query');?></th>
          <th><?php echo __('Op');?></th>
          <th><?php echo __('Client');?></th>
          <th><?php echo __('Ts');?></th>
          <th><?php echo __('Millisecond');?></th>
        </tr>
      </thead>
      <tbody>
        
        <?php foreach($datas as $v){
 			$out = \plugin\mongolog\module::plugin_mongolog_array($v);

 		?>
 				
 		
        <tr>
          <th scope="row"><?php  echo $out['ns'];?></th>
          <td><?php  echo json_encode($out['query']);?></td>
          <td><?php  echo $out['op'];?></td>
          <td><?php  echo $out['client'];?></td>
          <td><?php  echo date('Y-m-d H:i:s',$out['ts']->sec);?></td>
          <td><?php  echo $out['millis'];?></td>
        </tr>
        <?php }?>
      </tbody>
    </table>


 		
  </div>
  <?php echo $pager; ?>
</div>

 


<?php $this->end();?>