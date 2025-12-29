<?php 
error_reporting(0);
$users_contribution_count = get_users_contribution_count();
$users_feedback_count = get_users_feedback_count();
$admin_users = admin_users_count();?> 
<div id="right-container">
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <div class="bg-light lter b-b wrapper-sm">
          <div class="row">
            <div class="col-sm-24">
              <h1 class="m-n font-thin h4 text-black">User Submissions Awaiting Review:&nbsp;<a href="<?php echo adm_base_url();?>/user_submissions" class="badge badge-xs up btn-danger pull-right-xs"><?php echo $users_contribution_count;?> </a></h1>
            </div>
          </div>
        </div><br>
        <div class="row">
        <div class="col-md-24">
          <div class="row row-sm text-center">
            <div class="col-xs-6">
              <div class="panel padder-v bg-success item">
                <div class="h1 font-thin h1"><?php echo $admin_users;?></div>
                <span class="text-muted text-xs">Admin Users</span>
                <div class="top text-right w-full">
                  <i class="fa fa-caret-down text-warning m-r-sm"></i>
                </div>
              </div>
            </div>
            <div class="col-xs-6">
              <a href="" class="block panel padder-v bg-primary item">
                <span class="text-white font-thin h1 block"><?php echo get_Firebase_vehicles_count();?></span>
                <span class="text-muted text-xs">Total Vehicle</span>
                <span class="bottom text-right w-full">
                  <i class="fa fa-cloud-upload text-muted m-r-sm"></i>
                </span>
              </a>
            </div>
            <div class="col-xs-6">
              <a href="" class="block panel padder-v bg-info item">
                <span class="text-white font-thin h1 block"><?php echo $total_users;?></span>
                <span class="text-muted text-xs">Total Customers</span>
                <span class="top text-left">
                  <i class="fa fa-caret-up text-warning m-l-sm"></i>
                </span>
              </a>
            </div>
            <div class="col-xs-6">
              <div class="panel padder-v bg-danger item">
                <div class="font-thin h1"><?php echo $users_feedback_count;?></div>
                <span class="text-muted text-xs">User Feedback Awaiting Review</span>
                <div class="bottom text-left">
                  <i class="fa fa-caret-up text-warning m-l-sm"></i>
                </div>
              </div>
            </div>            
          </div>
        </div>        
      </div>
      <br><br>
        <form class="site-form">
          <div class="table-responsive">
            <h3>Today's Admin Access logs</h3>
            <table class="table table-striped table-data mar0">
            <thead>
                <tr>
                  <th>Admin ID</th>
                  <th>Email</th>
                  <th>Login Time</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($access_logs as $logs){?>
                <tr>
                  <td><strong><?php echo $logs['admin_id'];?></strong></td>
                  <td><?php echo $logs['email'];?></td>
                  <td><?php echo $logs['loginTime'];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->
