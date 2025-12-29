<div class="clone-with-holder">
      <div class="inputcol">
         <select type="text" class="form-control" name="Cloning_Machine[]">
         	<option value="">Please select</option>
            <?php $get_clonabnle_tools = get_clonabnle_tools();
			foreach($get_clonabnle_tools as $tools){?>
				<option value="<?php echo $tools['Tool_Name'];?>"><?php echo $tools['Tool_Name'];?></option>
			<?php } ?>
         </select>        
       <span class="glyphicon glyphicon-remove removeMoreToolType" aria-hidden="true"></span>
   </div>
</div>