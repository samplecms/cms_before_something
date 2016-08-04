<?php 
$this->layout('default');
$url = 'admin/user';
?>
<?php 

$this->start('content');

$par = ['s'=>$_GET['s']];

?>

<div class="container">
     <h1>用户</h1>
     
      
     <table class="table">
      <caption>管理用户(<?php echo $count;?>). 
      	 
	  </caption>
      <thead>
        <tr>
          <th>用户名</th>
          <th>时间</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($datas as $data){?>
        <tr>
          <td><?php echo $data['name'];?></td>
          <td><?php echo date('Y-m-d H',$data['created']->sec);?></td>
          <td><?php if($data['is_admin']==1){ echo __('Is Admin');}?></td>
        </tr>
       <?php }?> 
      </tbody>
    </table>
    <?php echo $page;?>
    
    
   


</div>
     

<?php 

$this->end();
?>



 
