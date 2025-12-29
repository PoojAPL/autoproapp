
<div id="right-container" >
  <div class="site-form form-inline">
    <div class="row">    	
    	<div class="col-sm-24">
        <div class="form-group addCodeSeries">          
         <a href="<?php echo adm_base_url();?>/users" class="btn btn-danger" >Back<<</a>        
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      <?php if($this->session->flashdata('message_display')){?>
    	<?php echo $this->session->flashdata('message_display');?>
     <?php } ?>       
     <div class="site-form">
					<div class="table-responsive chips_data vehiclesData" style="overflow:visible"> 
					<h4>Please do not refresh page untill data updated sucessfully.</h4>
						<?php 
						$get_Firebase_vehicles_year2 = get_aks_all_customers_count();
						$limit_end = $get_Firebase_vehicles_year2;				
						$limit = 500;       
						if (isset($part)) {  
							$pn  = $part;  
						}else {  
							$pn=1;  
						}; 
						$start_from = ($pn-1) * $limit;   
						$total_records = $limit_end; 
            $total_pages = ceil($total_records / $limit);   
            $pagLink = "";  
            echo '<ul data-total="'.$total_pages.'" class="vparts_updates" style="padding: 0;">';                       
            for ($i=1; $i<=$total_pages; $i++) { 
              if ($i==$pn || $i < $pn) { 
                  $pagLink .= "<li id='vid_".$i."'><a href='#'>Update Vehicle Info Part ".$i."</a></li>"; 
              }             
              else  { 
                  $pagLink .= "<li class='' id='vid_".$i."'><a href='".base_url()."admin/update_vehicle_info/".$i."'> Update Vehicle Info Part ".$i."</a></li>";   
              } 
            };   
            echo $pagLink;
            echo '</ul>'; 
            ?>
          <div class="v-succuess"></div> 
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->
