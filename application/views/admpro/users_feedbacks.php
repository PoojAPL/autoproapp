<?php 
error_reporting(0);
$correction_status = array('pending' => 'Waiting for Review','reviewed' => 'Reviewed');
?>
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">
   	 <div class="col-sm-6">
   	 	<form method="post" id="searchUsersFeedbacks" novalidate="novalidate">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
			<div class="form-group">                     
				<input type="text" name="search_key" class="form-control" style="width: 500px !important;" placeholder="Enter at least 3 characters for searching">
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
      	<div class="row">
		   	 <div class="col-sm-4">
		   	 	<input type="checkbox" checked class="show_pending">&nbsp;Show Reviewed
		   	 </div>
	     </div>
        <?php if($this->session->flashdata('message_display')){?>
        	<div class="alert alert-success"><?php echo $this->session->flashdata('message_display');?></div>
        <?php } ?>
        <div id="fireResult" style="text-align:left;"></div><br />
        <div class="site-form" method="post">
          <div class="table-responsive userSubmission_data" style="overflow: visible;">
          	<?php //print_r($outputs1);?>
            <table class="table table-data mar0">
              <thead>
                <tr>
                  <th>Submission Date/User</th>   
                  <th>Subject</th>  
                  <th>Message</th>    
                  <th>Image</th> 
                  <th>Status</th>                                                  
                </tr>
              </thead>
	              <tbody>
	              	<?php $get_user_feedbacks = get_user_feedbacks();
	              		foreach ($get_user_feedbacks as $value) {
	              			$Status = $value['status'];
	              			if( $Status=='reviewed'){
								$pending_hide = 'pending';
							}else{
								$pending_hide = ''; 
							}?>
							<tr class="<?php echo $pending_hide;?>">
								<td><?php echo date('m/d/y',strtotime($value['dated']));?>
									<br><?php echo $value['User_Name'];?>
									<br><?php echo $value['User_Email'];
									if($value['userid'] !=""){echo '('.$value['userid'].')';}?>	
								</td>
								<td><?php echo $value['subject'];?></td>
								<td><?php echo $value['feedback'];?></td>
								<td>
									<?php if( isset( $value['imageURL'] ) ){
									$image_data = explode(',', $value['imageURL']);
									for($im = 0; $im < count($image_data);$im++){
										if($image_data[$im] !=""){ ?>
										<a href="<?php echo $image_data[$im];?>" target="_blank"><img src="<?php echo $image_data[$im];?>" style="width:100px;margin-bottom: 10px;"></a>
										<?php } 
									}
									}?>
								</td>
								<td>
									<select style="width:160px;" id="<?php echo $value['id'];?>" class="form-control" onchange="ChangeCorrection(event)" data-cid="/feedbacks/<?php echo $value['UUID'];?>">
										<?php								
										foreach($correction_status as $skey => $status){
											if( $Status == $skey){
												$selected = 'selected';
												$disabled = 'disabled';
											}else{
												$selected = '';
											}?>
											<option <?php echo $selected;?> value="<?php echo $skey;?>"><?php echo $status;?></option>
										<?php  } ?>
									</select>
								</td>
							</tr>
	              	<?php } ?>	              	
	              </tbody>             
              </table>            
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<script src="https://www.gstatic.com/firebasejs/4.3.1/firebase.js"></script>
<script>
var config = {
    apiKey: "AIzaSyA1kkLsRv7v_tTafk5aCQWnXeWV_plC5_k",
    authDomain: "autoproapp2017.firebaseapp.com",
    databaseURL: "https://autoproapp2017.firebaseio.com",
    projectId: "autoproapp2017",
    storageBucket: "autoproapp2017.appspot.com",
    messagingSenderId: "988140303282"
};
/*var config = {
    apiKey: "AIzaSyAOGEGaxRqauTKn14rrg7NsfSpgAgqmWQ4",
    authDomain: "american-key.firebaseapp.com",
    databaseURL: "https://american-key.firebaseio.com",
    projectId: "american-key",
    storageBucket: "american-key.appspot.com",
    messagingSenderId: "699615089846"
};*/
firebase.initializeApp(config);

function ChangeCorrection(e){	
	document.getElementById("loader").className = ""; 
	var status_val = e.target.value;
	var id = e.target.getAttribute("id");
	var image_root_path = e.target.getAttribute("data-cid");
	var fireBaseRef3 = firebase.database().ref(image_root_path);
	var newPostKey = firebase.database().ref().child('posts').push().key;
	var csrf_test_name =  "<?php echo $this->security->get_csrf_hash();?>";
	if(status_val != ''){
		fireBaseRef3.update( { status:status_val}, function(error) {})
		// setTimeout(function(){ 
		// 	document.getElementById('fireResult').innerText = 'Data updated succesfully';
		// 	document.getElementById("loader").className = "hide";
		// }, 2000);
		var http = new XMLHttpRequest();
		var url = bse_url+'admpro/update_users_feedbacks';
		var params = "id="+id+"&status="+status_val+"&csrf_test_name="+csrf_test_name;
		http.open("POST", url, true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
		http.onreadystatechange = function() {
			if(http.readyState == 4 && http.status == 200) {
				arr = http.responseText;
				document.getElementById("loader").className = "hide";
			}
		}
		http.send(params);
		// if(status_val == 'reviewed'){
		// 	e.target.closest("tr").className='hide';
		// }	
	}else{
		location.reload();
	}
}
</script>