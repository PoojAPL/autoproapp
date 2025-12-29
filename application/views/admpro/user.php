<!-- right container start here -->
<?php 
$count= 0;
$get_user_feedbacks = get_user_feedbacks();
foreach ($get_user_feedbacks as $value) {
    $Status = $value['status'];
    if( $Status =='pending'){
      $count++;
    }else{
      $pending_hide = ''; 
    }
 } 
?>                
<div id="right-container">
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <h4>User Submissions Awaiting Review: <a href="<?php echo adm_base_url();?>/user_submissions" class="badge badge-sm up btn-danger pull-right-xs">37</a></h4>
        <div class="overview table-data">
           <div>
                  <span>Logins so far today:</span>
                  <span class="badge badge-sm up pull-right-xs">0</span>
           </div>
           <div>
                  <span>Logins yesterday:</span>
                  <span class="badge badge-sm up pull-right-xs">0</span>
           </div>
           <div>
                  <span>Total users:</span>
                  <span class="badge badge-sm up pull-right-xs">0</span>
           </div>         
           <div>
                  <span>User Feedback Awaiting Review:</span>
                  <span class="badge badge-sm up pull-right-xs"><?php echo $count;?></span>
           </div>
         </div> 
        <form class="site-form">
          <div class="table-responsive">
            <table class="table table-striped table-data">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Class</th>
                  <th>Score</th>
                  <th>Rank</th>
                  <th>Registered</th>
                  <th>Last Web Login</th>
                  <th>Last App Login</th>
                  <th>Tips</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>Yolanda Reyes</strong></td>
                  <td><select class="form-control sefect-field">
                      <option value="Administrator">Administrator</option>
                      <option value="Mediator">Mediator</option>
                      <option value="Expert">Expert</option>
                      <option value="Contributor">Contributor</option>
                      <option value="Newbie">Newbie</option>
                      <option value="Override Expert">Override Expert</option>
                      <option value="Override Contributor">Override Contributor</option>
                    </select>
                  </td>
                  <td>124</td>
                  <td>12</td>
                  <td>03/15/2015</td>
                  <td>03/15/2015</td>
                  <td>03/15/2015</td>
                  <td>iPhone 6S</td>
                  <td><button type="button" class="btn btn-success">Update</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->
