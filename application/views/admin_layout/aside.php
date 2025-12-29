 <main id="main-con">
    	<div class="container-fluid">
        <!--sidebar start here-->
          <section class="sidebar">
             <ul class="nav nav-sidebar">
                <li ><a href="<?php echo base_url();?>admin/overview" title="Overview">Overview</a></li>
                <li><a href="<?php echo base_url();?>admin/manage_user" title="Manager Users">Manage Users</a></li>
                <li><a href="#" title="Subscriptions">Subscriptions</a></li>
                <li><a href="<?php echo base_url();?>admin/payments"  title="Payments">Payments</a></li>
                <li><a href="#" title="User Submissions">User Submissions</a></li>
                <a href="#" title=" Vehicle Details">
                      Vehicle Details
                     <span class="glyphicon glyphicon-triangle-bottom pull-right" data-toggle="collapse" href="#collapsedropdown" aria-expanded="false" aria-controls="collapsedropdown"></span>
                   </a>
                   <ul class="collapse" id="collapsedropdown">
                    <li><a href="#">Code</a></li>
                    <li><a href="#" title="Series">Series</a></li>
                    <li><a href="#" title="Chips">Chips</a></li>
                    <li><a href="#" title="Keys">Keys</a></li>
                    <li><a href="#" title="Parts">Parts</a></li>
                    <li><a href="#" title="Remotes">Remotes</a></li>
                    <li><a href="#" title="Batteries">Batteries</a></li>
                    <li><a href="#" title="Programmers">Programmers</a></li>
                    <li><a href="#" title="Tools">Tools</a></li>
                   </ul>
                </li>
                <li><a href="#" title="Key Codes">Key Codes</a></li>
                <li><a href="#" title="Admin Access">Admin Access</a></li>
            </ul>
            <p class="affix affix-bottom">
                © <?php echo date('Y');?><br>
                American Key Supply, Inc.<br>
                All rights reserved.<br>
            </p>
          </section>