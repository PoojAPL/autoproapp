<table class="table table-data mar0">
  <thead>
    <tr> 
      <th>Complete</th>  
      <th>Grid Title</th>
      <th>Vehicle List</th> 
      <th>Code Location</th>               
      <th>Method 1</th>
      <th>Method 2</th>
      <th>Method 3</th>
      <th>Method 4</th>
      <th>Method 5</th>  
      <th>Warning 1</th>
      <th>Warning 2</th> 
      <th>Wafers</th>                                
      <th style="width:137px">Action</th>
    </tr>
  </thead>
 	<tbody>
    	<?php 
     // print_r($results);
      $i = 1;
      foreach( $results  as $value){
        if($value['COMPLETE'] == 'Yes'){
          $hide_row = 'hide';
          $on_check = 'checked';
        }else{
          $hide_row = '';
          $on_check = '';
        }?>
    	   <tr class="<?php echo $hide_row;?>">
           <td>
             <input type="checkbox" data-toggle="toggle" value="<?php echo $value['COMPLETE'];?>" <?php echo $on_check;?> class="ls_complete" data-id="<?php echo $value['AutoNum'];?>" >
           </td>
           <td style="width: 100px;white-space: initial;"><?php echo $value['Grid_Title'];?></td>
           <td contenteditable="true">
            <div class="notes-holder2" id="Grid_Title<?php echo $i;?>" contenteditable="true">
             <?php $vehicle = $value['Grid_Title'];
             $get_vehicle = get_ls_vehicle($vehicle);
             foreach ($get_vehicle as $key1 => $value1) {
              $ls_veh_make_name = ls_veh_make_name($value['Veh_Make']);
              $ls_veh_model_name = ls_veh_model_name($value1['Veh_Model']);
               echo $ls_veh_make_name[0]['Make_Name'].' '.$ls_veh_model_name[0]['Model_Name'].' '.$value['Veh_Year_Start'].'<br>';
             }
             ?>
           </div>
             <button class="btn btn-info btn-xs previewData" data_id="#Grid_Title<?php echo $i;?>">Preview</button> 
             <button class="btn btn-primary btn-xs copyContent" data_id="#Grid_Title<?php echo $i;?>">Copy</button> 
           </td>
           <td><div style="width: 100px;white-space: initial;"><?php echo $value['Code_Location'];?></div></td>
           <td>
            <?php if($value['Method1'] !=""){?>
            <div class="notes-holder2" id="Method1<?php echo $i;?>" contenteditable="true">
            <?php echo str_replace('contentEditable','',$value['Method1']);?></div>
            <button class="btn btn-info btn-xs previewData" data_id="#Method1<?php echo $i;?>">Preview</button> 
             <button class="btn btn-primary btn-xs copyContent" data_id="#Method1<?php echo $i;?>">Copy</button> 
            <?php } ?> 
           </td> 
           <td>
            <?php if($value['Method2'] !=""){?>
            <div class="notes-holder2" id="Method2<?php echo $i;?>" contenteditable="true"><?php echo str_replace('contentEditable','',$value['Method2']);?></div>
             <button class="btn btn-info btn-xs previewData" data_id="#Method2<?php echo $i;?>">Preview</button> 
             <button class="btn btn-primary btn-xs copyContent" data_id="#Method2<?php echo $i;?>">Copy</button> 
             <?php } ?>
           </td>
           <td>
            <?php if($value['Method3'] !=""){?>
            <div class="notes-holder2" id="Method3<?php echo $i;?>" contenteditable="true"><?php echo str_replace('contentEditable','',$value['Method3']);?></div>
             <button class="btn btn-info btn-xs previewData" data_id="#Method3<?php echo $i;?>">Preview</button> 
             <button class="btn btn-primary btn-xs copyContent" data_id="#Method3<?php echo $i;?>">Copy</button> 
             <?php } ?>
           </td>
           <td>
            <?php if($value['Method4'] !=""){?>
            <div class="notes-holder2" id="Method4<?php echo $i;?>" contenteditable="true"><?php echo str_replace('contentEditable','',$value['Method4']);?></div>
            <button class="btn btn-info btn-xs previewData" data_id="#Method4<?php echo $i;?>">Preview</button> 
             <button class="btn btn-primary btn-xs copyContent" data_id="#Method4<?php echo $i;?>">Copy</button>
            <?php } ?>  
           </td>
           <td>
            <?php if($value['Method5'] !=""){?>
            <div class="notes-holder2" id="Method5<?php echo $i;?>" contenteditable="true"><?php echo str_replace('contentEditable','',$value['Method5']);?></div>
            <button class="btn btn-info btn-xs previewData" data_id="#Method5<?php echo $i;?>">Preview</button> 
             <button class="btn btn-primary btn-xs copyContent" data_id="#Method5<?php echo $i;?>">Copy</button> 
             <?php } ?>
           </td>
           <td>
            <?php if($value['Alert_Warning1'] !=""){?>
            <div class="notes-holder2" id="Alert_Warning1<?php echo $i;?>" contenteditable="true"><?php echo $value['Alert_Warning1'];?></div>
            <button class="btn btn-info previewData" data_id="#Alert_Warning1<?php echo $i;?>">Preview</button> 
             <button class="btn btn-primary btn-xs copyContent" data_id="#Alert_Warning1<?php echo $i;?>">Copy</button> 
             <?php } ?>
           </td>
           <td>
            <?php if($value['Alert_Warning2'] !=""){?>
            <div class="notes-holder2" id="Alert_Warning2<?php echo $i;?>" contenteditable="true"><?php echo $value['Alert_Warning2'];?></div>
            <button class="btn btn-info btn-xs previewData" data_id="#Alert_Warning2<?php echo $i;?>">Preview</button> 
             <button class="btn btn-primary btn-xs copyContent" data_id="#Alert_Warning2<?php echo $i;?>">Copy</button> 
             <?php } ?>
           </td>
           <td>
            <?php if($value['Wafer_Positions'] !=""){?>
            <div class="notes-holder2" id="Wafer_Positions<?php echo $i;?>" contenteditable="true"><?php echo $value['Wafer_Positions'];?></div>
            <button class="btn btn-info btn-xs previewData" data_id="#Wafer_Positions<?php echo $i;?>">Preview</button> 
             <button class="btn btn-primary btn-xs copyContent" data_id="#Wafer_Positions<?php echo $i;?>">Copy</button>
             <?php } ?> 
           </td>
         </tr>
      <?php $i++;
    } ?>
    </tbody>
</table>  
<script>
  $(function() {
    $('.ls_complete').bootstrapToggle();
  })
</script>          