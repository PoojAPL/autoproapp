<?php $angle = ""; 
$sorting_id = "";
if($sorting == 'DESC'){
  $sorting_id = 'ASC';
  $angle = 'top';
}else if($sorting == 'ASC'){
  $sorting_id = 'DESC';
  $angle = 'bottom';
}

?>
<table class="table table-striped table-data mar0">
<thead>
<tr>   
  <th>ID</th>
  <th>Location</th>
  <th>Page Type</th>               
  <th width="20%"> Page Name </th>
  <th width="50%">Contents</th>  
  <th style="width: 137px;">Action</th>
  <th>Sort
    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> ezpages_sorting" data_id="<?php echo $sorting_id;?>" data-col="Sort_Order"></a>
  </th>
</tr>
</thead>
<tbody>
<?php
foreach ($all_ez_pages as $value) { ?>
     <tr> 
      <td class="ez_data"><?php echo $value['id'];?></td> 
      <td class="ez_data"><?php echo $value['Location'];
      if($value['Location']=='Tool References'){?>
      <br><?php $manufacturer_UUID = $value['Manufacturer_UUID'];
          $get_manufacturer = get_manufacturer($manufacturer_UUID);
          echo '('.$get_manufacturer[0]['Manufacturer_Name'].')';
        }?>
      </td> 
      <td class="ez_data"><?php echo $value['Page_Type'];?></td>                   
      <td class="ez_data"><?php echo $value['Page_Name'];?></td>
      <td style="white-space: normal;"  class="ez_data"><div class="data-holder"><?php echo $value['Content'];?></div></td>      
      <td><a href="<?php echo adm_base_url();?>/edit_ez_pages/<?php echo $value['id'];?>" class="btn btn-success">Edit</a> 
      <a href="javascript:void(0)" onclick="DeleteEZPages(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/DeleteEZPages/')" type="button" class="btn btn-danger">Delete</a> </td>
      <td class="ez_data">
        <input type="number" class="form-control data_sort_order" value="<?php echo $value['Sort_Order'];?>" id="<?php echo $value['id'];?>" style="width: 70px;">
      </td>
    </tr>   
<?php } ?>

</tbody>