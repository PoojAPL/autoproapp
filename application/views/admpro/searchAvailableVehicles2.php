<select   id="search" class="form-control" size="15" multiple="multiple" >
<?php 
foreach($get_all_vehicles as $vehicles){
	$years = explode(',',$vehicles['Years']);
  $get_make_name = $vehicles['Make_Name'];
  $get_models_name = $vehicles['Model_Name'];  
    $Code_Series_Name = '';                 
                    $got_series_data = explode(',',$vehicles['Code_Series_UUID']);
                    if( count($got_series_data) > 1){
                        for( $cs = 0; $cs <= count($got_series_data); $cs++ ){
                          $got_series_val = explode('|',$got_series_data[$cs]);
                          $code_series_id = $got_series_val[0];
                          $code_series_note = $got_series_val[1];
                          $get_Code_Series_name = get_Code_Series_name($code_series_id);
                          if($get_Code_Series_name[0]['Code_Series_Name'] !=""){
                            $Code_Series_Name .= $get_Code_Series_name[0]['Code_Series_Name'].',';
                          }
                        } 
                        $Code_Series_Name = rtrim($Code_Series_Name,',');
                      }else{
                        $got_series_val = explode('|',$got_series_data[0]);
                        $code_series_id = $got_series_val[0];
                        $code_series_note = $got_series_val[1];
                        $get_Code_Series_name = get_Code_Series_name($code_series_id);
                        $Code_Series_Name = $get_Code_Series_name[0]['Code_Series_Name'];
                       }
                       if($Code_Series_Name !=""){
                        $option_name = $get_make_name.' '.$get_models_name.' ('.$years[0].'-'.$years[count($years)-1].') ('.$Code_Series_Name.')';
                       }else{
                        $option_name = $get_make_name.' '.$get_models_name.' ('.$years[0].'-'.$years[count($years)-1].')';
                      }
                            ?>
		<option value="<?php echo $vehicles['UUID'];?>"> <?php echo $option_name;?></option>
<?php } ?>
</select>
<script type="text/javascript">
$(document).ready(function($) {
    $('#search').multiselect({
        search: {
            left: '',
            right: '',
        },
        fireSearch: function(value) {
            return value.length > 3;
        }
    });
});
</script>
                 