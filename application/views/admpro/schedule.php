<div id="right-container">  
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      <div class="message_display"></div>
        <div class="site-form">
          <div class="table-responsive make_users chips_data">
            <table class="table table-striped table-data mar0 scheduleForm">
              <thead>
                <tr>                 
                 <th> Make </th>
                 <th> Available </th>
                 <th> Years  </th>                
                 <th> Available Afterhours</th>
                 <th> Normal Price  </th>
                 <th> Afterhours Price  </th>
                 <th> Wait Time  </th> 
                 <th> Refunds Available </th>                
                 <th style="width: 137px;">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  $i =1;
			  foreach($results as $value){				  
						  if($value['Codes_Available'] == 1){
							   $on_check = 'checked';
							   $off_check = '';	
							   $disabled = '';
						   }else{
							   $off_check = 'checked';
							   $on_check = '';	
							   $disabled = 'disabled';
						   }
					   ?>				                                   
                      <tr class="<?php echo $disabled;?>">
                       <td>
                          <span class="td_data"><?php echo $value['Make_Name'];?></span>                    	
                       </td>
                       <td>
                          
                          <!--<input type="radio" value="1" name="Codes_Available_<?php echo $value['id'];?>" <?php echo $on_check;?> />Yes &nbsp;&nbsp;
                          <input type="radio" value="0" name="Codes_Available_<?php echo $value['id'];?>" <?php echo $off_check;?> />No-->
                          <input type="checkbox" data-toggle="toggle" name="Codes_Available_<?php echo $value['id'];?>" <?php echo $on_check;?>>
                       </td>
                       <td><input type="text" value="<?php echo $value['Codes_Years'];?>" name="Codes_Years_<?php echo $value['id'];?>" class="form-control Codes_Years" /></td>                       <td>						
                         <?php 
                              if($value['Codes_Afterhours'] == 1){
                                   $on_check = 'checked';
                                   $off_check = '';	
                              }else{
                                   $off_check = 'checked';
                                   $on_check = '';	
                              }
                          ?>                          
                          <input type="checkbox" data-toggle="toggle" name="Codes_Afterhours_<?php echo $value['id'];?>" <?php echo $on_check;?>>
                       </td>
                      <td>
                      	  <input type="text" value="<?php echo $value['Codes_Price_Normal'];?>" name="Codes_Price_Normal_<?php echo $value['id'];?>" class="scheduleInputs" />
                          <div class="input-group"><span class="custom-addon">$</span></div>
                      </td>   
                       <td>
                      <input type="text" value="<?php echo $value['Codes_Price_Afterhours'];?>" name="Codes_Price_Afterhours_<?php echo $value['id'];?>" class="scheduleInputs" />
                      <div class="input-group"><span class="custom-addon">$</span></div>
                       </td>
                       <td>
					   <input type="text" value="<?php echo $value['Codes_Wait_Time'];?>" name="Codes_Wait_Time_<?php echo $value['id'];?>" class="form-control" />
					  </td>
                       <td>					   
                       	<?php 
                              if($value['Codes_Refunds'] == 1){
                                   $on_check = 'checked';
                                   $off_check = '';	
                               }else{
                                   $off_check = 'checked';
                                   $on_check = '';	
                               }
                          ?>                          
                          <input type="checkbox" data-toggle="toggle" name="Codes_Refunds_<?php echo $value['id'];?>" <?php echo $on_check;?>>
                       </td>
                       <td><a href="javascript:void(0)" type="button" class="btn btn-success updateSchedule" data-id="<?php echo $value['id'];?>" >Update</a></td>
                    </tr>                        
			    <?php }  ?>                
               </tbody>
            </table>
				<?php 
			if(isset($links)){?>
			  <nav class="site-pg">
			 <ul class="pagination">               
                <?php foreach ($links as $link) {
                        echo '<li>'. $link.'</li>';
                } ?>	
               </ul>
			   </nav>
			<?php }?>	
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->