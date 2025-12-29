<?php error_reporting(0);
$Locations = array('Locksmith References','Tool References','Articles & Tutorials','Pin Codes');
$ezpages_location_val = "";
if(isset($this->session->userdata['ezpages_location_session'])){
 $value_key1 = $this->session->userdata['ezpages_location_session'];
 $ezpages_location_val =  $value_key1['ezpages_location_val'];
}?>
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row"> 
      <div class="col-sm-6">
          <div class="form-group">
              <label>Location: </label>
                <select class="form-control select-field filter_keysby_types" style="width: 180px;">
                  <option value="all">All</option>                    
                 <?php foreach($Locations as $locations){
                  $selected = '';
                  if( $ezpages_location_val == $locations){
                    $selected = 'selected';
                  }?>
                  <option <?php echo $selected;?>><?php echo $locations;?></option>
                  <?php }?>
                </select>
            </div>
      </div>
      <div class="col-sm-8">
         <?php if( $ezpages_location_val == 'Tool References'){ 
            $hide = '';
         }else{
            $hide = 'hide';
         }?>                   
          <div class="form-group ezpages_Manufacturer <?php echo $hide;?>">
              <label>Manufacturer: </label>
                <select type="text" class="form-control filter_ezpages_Manufacturer" style="width: 180px;">
                  <?php $getAllManufacturer = get_ezpages_Manufacturer();
                  foreach($getAllManufacturer as $manufacturer){
                          $manufacturer_UUID = $manufacturer['Manufacturer_UUID'];
                          $get_manufacturer = get_manufacturer($manufacturer_UUID);
                          if( $manufacturer_UUID !=""){?>
                            <option value="<?php echo $manufacturer['Manufacturer_UUID'];?>"><?php echo $get_manufacturer[0]['Manufacturer_Name'];?></option>
                        <?php }
                  }?>
               </select>
            </div>
            
      </div>      
      <div class="col-sm-10">
        <div class="form-group addCodeSeries">          
          <a href="<?php echo adm_base_url();?>/update_ez_pages_content" class="btn btn-success">Firebase Update</a> 
          &nbsp;&nbsp;&nbsp; <a href="<?php echo adm_base_url();?>/add_ez_pages" class="btn btn-danger" >Add New Page</a>    
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      <?php if($this->session->flashdata('message_display')){?>
    	<div class="alert alert-success"><?php echo $this->session->flashdata('message_display');?></div>
     <?php } ?>       
     <div class="site-form">
          <div class="table-responsive chips_data vehiclesData" style="overflow:visible"> 
           <form class="site-form" method="post">
           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <div class="table-responsive make_users chips_data">
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
                    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom ezpages_sorting" data_id="DESC" data-col="Sort_Order"></a>
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
            </table>
          </div>
        </form>
           <!-- <div class="alert alert-danger">Data not found!</div>-->
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->