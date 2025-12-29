<table class="table table-striped table-data mar0">
  <thead>
    <tr> 
      <th>Range</th>      
      <th>Code Series Name</th>
      <th>AutoProAPP Code Series</th>
      <th>Cuts</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach( $results  as $value){
        // $get_range = keyCodeCutsRange($value['Auto_Num']);
        // $code_range = "";
        // foreach ($get_range as $code_value) {
        //   $code_range .= $code_value['The_Code'].'|';
        // }
        // $numbers_range = rtrim($code_range,"|");
        // $numbers_range_data = explode('|',$numbers_range);
        // if( in_array($search_key, $numbers_range_data)){  ?>
          <tr>
                <td> <?php echo $value['Code_Range__Start'];?> 
                  <?php if($value['Code_Range__End'] !=""){ ?>
                      - <?php echo $value['Code_Range__End'];?>
                   <?php } ?>                  
                </td>
                
                <td>
                  <?php echo $value['Title'];?>
                                    
                </td> 
                <td><?php $code_series_id = $value['Code_Series_UUID'];
                  $get_Code_Series_name = get_Code_Series_name($code_series_id);?>
                    <?php echo $get_Code_Series_name[0]['Code_Series_Name'];?>
                </td>
                <td><?php echo $value['The_Cut'];?></td>            
            </tr>
          <?php //} 
        }?>
    </tbody>
</table>         