<div id="right-container">
  <div class="site-form form-inline">
    <div class="row"> 
    <div class="col-sm-6">
      <form method="post" id="searchLSConnect" novalidate="novalidate">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="form-group">                     
                     <input type="text" name="search_key" class="form-control" style="width: 200px;" placeholder="Enter at least 3 characters for searching">
                     <button type="submit" class="btn btn-primary custom-button">Search</button>
                </div>
            </form>
     </div>     
      <div class="col-sm-18"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <input type="checkbox" class="showLsComplete" checked>&nbsp;Show Complete <br><br>
        <?php if($this->session->flashdata('message_display')){?>
        	<div class="alert alert-success"><?php echo $this->session->flashdata('message_display');?></div>
        <?php } ?>
        <div class="site-form" method="post">
          <div class="tool_data">
            <table class="table table-data mar0">
              <thead>
                <tr> 
                  <th>ID</th>
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
                     $hide_row = 'complete ';
                      $on_check = 'checked';
                    }else{
                      $hide_row = '';
                      $on_check = '';
                    }?>
                	   <tr class="<?php echo $hide_row;?>">
                       <td><?php echo $value['AutoNum'];?></td>
                       <td>
                         <input type="checkbox" data-toggle="toggle" value="<?php echo $value['COMPLETE'];?>" <?php echo $on_check;?> class="ls_complete" data-id="<?php echo $value['AutoNum'];?>" >
                       </td>
                       <td style="width: 100px;white-space: initial;"><?php echo $value['Grid_Title'];?></td>
                       <td contenteditable="true">
                        <?php $vehicle = $value['Grid_Title'];
                         $get_vehicle = get_ls_vehicle($vehicle);
                         if($get_vehicle != 0){?>
                        <div class="notes-holder2" id="Grid_Title<?php echo $i;?>" contenteditable="true">
                         <?php 
                         
                            //print_r($get_vehicle);
                           asort( $get_vehicle );
                           //array_unique($get_vehicle);
                           $result = unique_multidim_array($get_vehicle,'vehicele_list');
                           foreach ($result as $key1 => $value1) {
                            echo $value1['vehicele_list'].'<br>';
                           }
                                                 
                         ?>
                       </div>
                         <button class="btn btn-info btn-xs previewVehicleData" data_id="#Grid_Title<?php echo $i;?>">Preview</button> 
                         <button class="btn btn-primary btn-xs copyVehicleContent" data_id="#Grid_Title<?php echo $i;?>">Copy</button> 
                        <?php } ?> 
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
            <nav class="site-pg">
                <ul class="pagination">        
                <!-- Show pagination links -->
                <?php foreach ($links as $link) {
                        echo '<li>'. $link.'</li>';
                } ?>  
              </ul>
           </nav>           
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->
<div class="modal fade" id="mycontentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Content Preview</h4>
      </div>
      <div class="modal-body">
        <textarea class="form-control" style="height: 450px;"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>