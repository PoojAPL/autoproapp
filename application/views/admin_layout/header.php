<?php
$user_data = $this->session->userdata('login_user');
$user_username = $user_data['username'];
$email = $user_data['email'];
$get_admin_deatils = get_admin_deatils($email);
$users_feedback_count = get_users_feedback_count();
$users_contribution_count = get_users_contribution_count();
$user_type = $get_admin_deatils[0]['type'];
$get_type_access = get_type_access($user_type);
$user_type_access = explode(',',$get_type_access[0]['user']);
$content_type_access = explode(',',$get_type_access[0]['content']);
$key_codes_type_access = explode(',',$get_type_access[0]['key_codes']);
$admin_type_access = explode(',',$get_type_access[0]['admin']);
$other_type_access = explode(',',$get_type_access[0]['other']);
$userId = $get_admin_deatils[0]['UserID'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo str_replace('>','|', strip_tags($subTitle));?> | AutoProAppAdmin: Nginx</title>
    <!-- Bootstrap -->
    <link href="<?php echo asset_url(); ?>admin/css/futurico.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>admin/css/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="<?php echo asset_url(); ?>admin/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>admin/css/app.css" rel="stylesheet" type="text/css">
    
	  <link href="<?php echo asset_url(); ?>admin/css/style.css?v=<?php echo time();?>" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
 <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" id="site-nav">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo adm_base_url();?>/dashboard" title="AutoPro"><img src="<?php echo asset_url(); ?>admin/images/logo.png" alt="AutoPro"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        	  <div class="nav navbar-nav">
            	<h1 class="pg-heading1"><?php echo $subTitle;?></h1>
            </div>
            <ul class="nav navbar-nav navbar-right">
              <p>Logged in as <?php echo $user_username;?></p>
              <a href="<?php echo adm_base_url();?>/update_vehicle_info" class="btn btn-success" style="font-size: 14px;text-decoration: none;padding: 5px 10px;margin-top: -15px;">Firebase Update</a>   
			        <a href="<?php echo adm_base_url();?>/clear_cache" title="Account">Clear Cache</a> 
              <i class="spritor">|</i>
              <a href="<?php echo adm_base_url();?>/edit_users/<?php echo $userId;?>" title="Account">Account</a> 
              <i class="spritor">|</i> 
              <a href="<?php echo adm_base_url();?>/logout" title="Sign Out">Sign Out</a>
          </ul>
       </div>
      </div>
    </nav>
<?php 
$get_url = explode('/',$_SERVER["REQUEST_URI"]);
$get_last = explode('?',$get_url[count($get_url)-1]);
$url = $get_last[0];
?>
    <!--site nav end here-->
    <!--site main-con start here-->
    
    <main id="main-con">
    <div class="nav-menu-collapse-holder">
      <div class="nav-menu-collapse">
          <span class="glyphicon glyphicon-list" aria-hidden="true" title="Hide Menu"></span>
      </div>
    </div>
    	<div class="container-fluid">
        <!--sidebar start here-->
          <section class="sidebar">            
             <ul class="nav nav-sidebar">               
                 <!-- <li class="<?php echo ($url == 'payments' )?'active':"";?>" ><a href="<?php echo adm_base_url();?>/payments"  title="Payments">Payments</a></li> -->
                 <?php if( in_array('moderateUserFeedback', $content_type_access)){?>
                   <li class="<?php echo ($url == 'users_feedbacks' )?'active':"";?> user-contribution" >
                    <a href="<?php echo adm_base_url();?>/users_feedbacks"  title="User Submitions">User Feedback <b class="badge bg-danger pull-right"><?php echo $users_feedback_count;?></b></a>
                   </li>
                 <?php }?>
                 <?php if( in_array('moderateUserContribution', $content_type_access)){?>
                 <li class="<?php echo ($url == 'user_submissions' )?'active':"";?> user-contribution" >
                	<a href="<?php echo adm_base_url();?>/user_submissions"  title="User-Contributed Content">User Contributions <b class="badge bg-danger pull-right usersContribution"><?php echo $users_contribution_count;?></b></a>
                 </li>
                 <?php }?>
                 <?php if( in_array('machineReports', $other_type_access)){?>
                <li class="<?php echo ($url == 'success_reporting' )|| ($url=='add_machine_report')?'active':"";?> user-contribution">
                  <a href="<?php echo adm_base_url();?>/success_reporting" title="Success Rates" >Success Rates</a>
                </li> 
                <?php } ?>
                <li class="<?php echo ($url == 'quick_updates' )|| ($url=='quick_updates')?'active':"";?> user-contribution">
                  <a href="<?php echo adm_base_url();?>/quick_updates" title="Quick Update" >Quick Update</a>
                </li> 
                 <li class="<?php echo ($url == 'users' )?'active':"";?>"><a href="<?php echo adm_base_url();?>/users" title="Manage Users">Users</a></li>
                  <!--<li class="<?php echo ($url == 'firebase_images' )?'active':"";?>" >
                	<a href="<?php echo adm_base_url();?>/firebase_images"  title="Firebase Images">Firebase Images</a>
                 </li>-->                
                <!--<li> <a href="#" title="Tips ">Tips</a></li>
                <li class="<?php echo ($url == 'methods' )||($url=='add_method')?'active':"";?>"><a href="<?php echo adm_base_url();?>/methods" title="Method">Method</a></li>
                <li class="<?php echo ($url == 'corrections' )|| ($url=='add_correction')?'active':"";?>">
                  <a href="<?php echo adm_base_url();?>/corrections" title="corrections ">Corrections</a>
                </li> -->
                
                <?php if( in_array('keyCodes', $key_codes_type_access)){?>             
                 <li>
                	<a title="Key Codes" href="#collapsedropdown6" aria-expanded="false" aria-controls="collapsedropdown6" data-toggle="collapse">Key Codes
                     <span class="glyphicon glyphicon-triangle-bottom pull-right"  href="#collapsedropdown6" aria-expanded="false" aria-controls="collapsedropdown6"></span>
                   </a>
                   <ul class="collapse <?php echo ($url == 'schedule' )?'in':"";?>" id="collapsedropdown6">
                    <li class="<?php echo ($url == 'schedule' )?'active':"";?>"><a href="<?php echo adm_base_url();?>/schedule" title="Schedule" >Schedule </a></li>
                    <li class=""><a href="#" title="Schedule" >Requests </a></li>        
                   </ul>
                 </li> 
                 <?php } ?>       
                <?php //if(($user_data['user_type'] == 2) || ($user_data['user_type'] == 3)|| ($user_data['user_type'] == 0)){?> 
                <?php if( in_array('vehicleData', $content_type_access)){?>
                <li class="separator">
                	<a title="Vehicles" href="#collapsedropdown5" aria-expanded="false" aria-controls="collapsedropdown5" data-toggle="collapse">Vehicles
                     <span class="glyphicon glyphicon-triangle-bottom pull-right"  href="#collapsedropdown5" aria-expanded="false" aria-controls="collapsedropdown5"></span>
                   </a>
                   <ul class="collapse <?php echo ($url == 'makes' ) || ($url == 'add_makes') || ($url == 'model') || ($url =='add_model' ) || ($url =='codeseries') || ($url=='add_code')||($url == 'retainers' )||($url=='add_retainer')||($url=='vehicle')||($url=='add_vehicle')||($url=='obp_options')|| ($url=='add_obp_option')||($url == 'obp_options_categories' )|| ($url=='add_obp_options_categories')||($url=='obp_remotes')||($url=='add_obp_remotes')||($url == 'vehicle_types' )||($url == 'add_vehicle_type')||($url == 'keymaking_methods')||($url=='add_method')||($url=='tip_tricks')||($url == 'vehicle_images' )|| ($url=='add_vehicles_images')?'in':"";?>" id="collapsedropdown5">
                     
                        <li class="<?php echo ($url == 'vehicle' )|| ($url=='add_vehicle')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/vehicles/vehicle" title="Vehicles " >Vehicles</a>
                        </li>                   
                        <li class="<?php echo ($url == 'codeseries' )|| ($url=='add_code')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/vehicles/codeseries" title=" Code Series " >Code Series</a>
                        </li>
                        <li class="<?php echo ($url == 'vehicle_images' )|| ($url=='add_vehicles_images')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/vehicles/vehicle_images" title=" Code Series " >Vehicle Images</a>
                        </li>                        
                         <li class="<?php echo ($url == 'keymaking_methods' )|| ($url=='add_method')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/keymaking_methods" title="Keymaking Methods" >Keymaking Methods</a>
                        </li>
                        <li class="<?php echo ($url == 'tip_tricks' )|| ($url=='add_tip_tricks')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/vehicles/tip_tricks" title=" Tips & Tricks " >Tips & Tricks</a>
                        </li>
                        <li class="<?php echo ($url == 'obp_remotes' )|| ($url=='add_obp_remotes')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/vehicles/obp_remotes">OBP: Remotes</a>
                        </li>
                        <li><a href="">OBP: Keys</a></li>                   
                    
                        <li class="<?php echo ($url == 'obp_options' )|| ($url=='add_obp_option')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/vehicles/obp_options">(OBP: Options)</a>
                        </li>
                        
                        <li class="<?php echo ($url == 'obp_options_categories' )|| ($url=='add_obp_options_categories')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/vehicles/obp_options_categories">(OBP Option Cats)</a>
                        </li>
                         <li class="<?php echo ($url == 'vehicle_types' )||($url == 'add_vehicle_type')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/vehicles/vehicle_types">(Types)</a>
                        </li>
                        <li class="<?php echo ($url == 'makes' )|| ($url=='add_makes')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/vehicles/makes" title="Makes">(Makes)</a>
                        </li>
                        <li class="<?php echo ($url == 'model' )|| ($url=='add_model')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/vehicles/model" title="Model">(Models)</a>
                        </li>       
                        <li class="<?php echo ($url == 'retainers' )||($url=='add_retainer') ?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/retainers" title="Retainers ">(Retainers) </a>
                        </li>                               
                   </ul>
                 </li>
                 <li class="separator">
                	<a title="Parts" href="#collapsedropdown2" aria-expanded="false" aria-controls="collapsedropdown2" data-toggle="collapse">
                      Parts
                     <span class="glyphicon glyphicon-triangle-bottom pull-right"  href="#collapsedropdown2" aria-expanded="false" aria-controls="collapsedropdown2"></span>
                   </a>
                   <ul class="collapse <?php echo ($url == 'keyStyle' )|| ($url == 'Chips')|| ($url == 'keyType')|| ($url == 'addKeytype')|| ($url == 'addKeyStyle')|| ($url == 'add_chips')||($url=='batteries')||($url=='add_battery')||($url=='keys')||($url=='add_key')||($url=='remotes')||($url=='add_remote')||($url=='remote_types')||($url=='add_remote_type')||($url == 'buttons')||($url=='add_buttons') || ($url == 'locks_types')||($url=='add_part_types')||($url == 'locks')||($url=='add_parts')?'in':"";?>" id="collapsedropdown2">
                   		 
                            <li class="<?php echo ($url == 'keys')||($url=='add_key')?'active':"";?>"><a href="<?php echo adm_base_url();?>/keys" title="Keys">Keys</a></li>   
                            <li class="<?php echo ($url == 'remotes')||($url=='add_remote')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/remotes " title="Remotes">Remotes</a></li>                 
                            <li class="<?php echo ($url == 'add_chips')||($url=='Chips')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/Chips" title="Chips">Chips</a></li>
                            <li class="<?php echo ($url == 'batteries')||($url=='add_battery')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/batteries" title="Batteries">Batteries</a></li>                       
                            <li class="<?php echo ($url == 'locks')||($url=='add_parts')?'active':"";?>">
                                <a href="<?php echo adm_base_url();?>/locks" title="Ignition Locks">Ignition Locks </a>
                            </li> 
                            <li class="<?php echo ($url == 'addKeyStyle')||($url=='keyStyle')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/keyStyle" title="Key Styles">(Key Styles)</a></li>
                            <li class="<?php echo ($url == 'keyType')||($url=='addKeytype')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/keyType" title="Key Types">(Key Types)</a></li>  
                            <li class="<?php echo ($url == 'remote_types')||($url=='add_remote_type')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/remote_types" title="Remote Types">(Remote Types)</a></li>  
                            <li class="<?php echo ($url == 'buttons')||($url=='add_buttons')?'active':"";?>">
                            <a href="<?php echo adm_base_url();?>/buttons" title="Buttons">(Buttons)</a></li> 
                            <li class="<?php echo ($url == 'locks_types')||($url=='add_part_types')?'active':"";?>">
                                <a href="<?php echo adm_base_url();?>/locks_types" title="Lock Types  ">(Lock Types)</a>
                            </li>                                                                 
                    </ul>
                </li>
               <li class="separator">                	
                	<a title="Tools" href="#collapsedropdown3" aria-expanded="false" aria-controls="collapsedropdown3" data-toggle="collapse">
                      Tools
                     <span class="glyphicon glyphicon-triangle-bottom pull-right"  href="#collapsedropdown3" aria-expanded="false" aria-controls="collapsedropdown3"></span>
                   </a>
                   <ul class="collapse <?php echo ($url == 'accessories_type')||($url=='add_accessories_type') || ($url == 'software_type')||($url=='add_software_type') || ($url == 'manufacturers' ) ||($url == 'software' )||($url == 'add_software' ) ||($url == 'accessories' )||($url == 'add_accessories' ) || ($url == 'add_manufacturer' ) || ($url == 'add_too_type' ) || ($url == 'tool_type') || ($url == 'tools') || ($url == 'add_tools')|| ($url == 'tools')||($url == 'machines')||($url=='add_machines')?'in':"";?>" id="collapsedropdown3">                   		 
                        <li class="<?php echo ($url == 'tools')||($url=='add_tools')?'active':"";?>">
                        <a href="<?php echo adm_base_url();?>/tools" title="Tools">Tools</a></li>
                        <li class="<?php echo ($url == 'software')||($url=='add_software')?'active':"";?>">
                        <a href="<?php echo adm_base_url();?>/software" title="software">Software </a></li>
                        <li class="<?php echo ($url == 'accessories')||($url=='add_accessories')?'active':"";?>">
                        <a href="<?php echo adm_base_url();?>/accessories" title="accessories">Accessories</a></li>
                        <li class="<?php echo ($url == 'tool_type')||($url=='add_tool_type')?'active':"";?>">
                        <a href="<?php echo adm_base_url();?>/tool_type" title="Tools type">(Tool Types)</a></li>                        
                        <li class="<?php echo ($url == 'software_type')||($url=='add_software_type')?'active':"";?>">
                          <a href="<?php echo adm_base_url();?>/software_type" title="Software type">(Software Types)</a>                        
                        </li> 
                        <li class="<?php echo ($url == 'accessories_type')||($url=='add_accessories_type')?'active':"";?>">
                          <a href="<?php echo adm_base_url();?>/accessories_type" title="Accessories type">(Accessories Types)</a>                        
                        </li>  
                        <li class="<?php echo ($url == 'manufacturers')||($url=='add_manufacturer')?'active':"";?>">
                        <a href="<?php echo adm_base_url();?>/manufacturers" title="Manufacturers">(Manufacturers)</a></li>
                        <li class="<?php echo ($url == 'machines')||($url=='add_machines')?'active':"";?>">
                        <a href="<?php echo adm_base_url();?>/machines" title="Manufacturers">(Machines Info)</a></li>
                        
                      </ul>
                </li>       
                <li class="separator">                	
                	<a title="Other" href="#collapsedropdownOther" aria-expanded="false" aria-controls="collapsedropdownOther" data-toggle="collapse">Other
                    <span class="glyphicon glyphicon-triangle-bottom pull-right"  href="#collapsedropdownOther" aria-expanded="false" aria-controls="collapsedropdownOther"></span>
                   </a>
                   <ul class="collapse <?php echo ($url == 'image_types')||($url=='add_image_types')||($url=='images')||($url=='add_image')?'in':"";?>" id="collapsedropdownOther"> 
                   		<li class="<?php echo ($url == 'images')||($url=='add_image')?'active':"";?>">
                        	<a href="<?php echo adm_base_url();?>/images" title="Images">Images</a>
                        </li>                       
                        <li class="<?php echo ($url == 'image_types')||($url=='add_image_types')?'active':"";?>">
                        	<a href="<?php echo adm_base_url();?>/image_types" title="Image Types">(Image Types)</a>
                        </li>                        						                                       
                   </ul>
                </li>
              <?php } ?> 
              <li class="<?php echo ($url == 'ls_connect')?'active':"";?>">
                <a href="<?php echo adm_base_url();?>/ls_connect" title="Convert Code"> LS Connect Data</a>
              </li> 
               <li>                 
                  <a title="Tools" href="#collapsedropdownCodeConversion" aria-expanded="false" aria-controls="collapsedropdownCodeConversion" data-toggle="collapse">Code Conversions
                  <span class="glyphicon glyphicon-triangle-bottom pull-right" href="#collapsedropdownCodeConversion" aria-expanded="false" aria-controls="collapsedropdownCodeConversion"></span>
                   </a>
                   <ul class="collapse <?php echo ($url == 'code_series_list')||($url == 'convert_code')?'in':"";?>" id="collapsedropdownCodeConversion">
                    <li class="<?php echo ($url == 'code_series_list')?'active':"";?>">
                      <a href="<?php echo adm_base_url();?>/code_series_list" title="Code Series List">Code Series List</a>
                    </li>
                    <li class="<?php echo ($url == 'convert_code')?'active':"";?>">
                      <a href="<?php echo adm_base_url();?>/convert_code" title="Convert Code">Convert Code</a>
                    </li>                                       
                </ul>
              </li>      
              <?php if( in_array('autoProPAD', $other_type_access)){?>                              
               <li>                	
                	<a title="Tools" href="#collapsedropdownAutoProPAD" aria-expanded="false" aria-controls="collapsedropdownAutoProPAD" data-toggle="collapse">AutoProPAD.com
                  <span class="glyphicon glyphicon-triangle-bottom pull-right" href="#collapsedropdownAutoProPAD" aria-expanded="false" aria-controls="collapsedropdownAutoProPAD"></span>
                   </a>
                   <ul class="collapse <?php echo ($url == 'announcements')||($url=='add_announcement')||($url=='add_feedback')||($url == 'feedback')||($url=='applications')||($url=='add_applications')||($url == 'videos' )||($url == 'testimonials' )||($url == 'faqs' )||($url == 'distributors' )||($url == 'content' )?'in':"";?>" id="collapsedropdownAutoProPAD">
                   		<li class="<?php echo ($url == 'feedback')||($url=='add_feedback')?'active':"";?>">
                        	<a href="<?php echo adm_base_url();?>/autopropad/feedback" title="Purchase Feedback">Feedback</a>
                        </li>
                        <li class="<?php echo ($url == 'announcements')||($url=='add_announcement')?'active':"";?>">
                        	<a href="<?php echo adm_base_url();?>/autopropad/announcements" title="Accouncements">Accouncements </a>
                        </li> 
                        <!-- <li class="<?php echo ($url == 'applications')||($url=='add_applications')?'active':"";?>">
                                <a href="<?php echo adm_base_url();?>/autopropad/applications" title="Applications">Applications </a>
                            </li> -->                         
                        <li class="<?php echo ($url == 'export_csv' )?'active':"";?>"><a href="<?php echo adm_base_url();?>/export_csv" title="Export CSV" >Applications Export</a> </li>
                        <li class="<?php echo ($url == 'testimonials' )?'active':"";?>"><a href="<?php echo adm_base_url();?>/autopropad/testimonials" title="Testimonials" >Testimonials</a> 
                        </li>
                        <li class="<?php echo ($url == 'videos' )?'active':"";?>"><a href="<?php echo adm_base_url();?>/autopropad/videos" title="Videos" >Videos</a> 
                        </li>
                        <li class="<?php echo ($url == 'faqs' )?'active':"";?>"><a href="<?php echo adm_base_url();?>/autopropad/faqs" title="faqs" >FAQs</a> 
                        </li>
                         <li class="<?php echo ($url == 'distributors' )?'active':"";?>"><a href="<?php echo adm_base_url();?>/autopropad/distributors" title="Distributors" >Distributors</a> 
                        </li>
                        <li class="<?php echo ($url == 'content' )?'active':"";?>"><a href="<?php echo adm_base_url();?>/autopropad/content" title="content" >Content</a> 
                        <li class="<?php echo ($url == 'cash_back_request_detail' )?'active':"";?>"><a href="<?php echo adm_base_url();?>/autopropad/cash_back_request_detail" title="content" >Cash Back Request Detail</a> 
                        </li>                                                                  
                   </ul>
                </li>
                <?php } ?>
                <?php if( in_array('viewMachinePurchase', $other_type_access)){?> 
                <li class="<?php echo ($url == 'purchase_history')||($url=='add_purchase_history')?'active':"";?>">
                    <a href="<?php echo adm_base_url();?>/purchase_history" title="Machine Purchases">Machine Purchases</a>
                </li>
                <?php } ?>
               <!-- <li class="<?php echo ($url == 'feedback')||($url=='add_feedback')?'active':"";?>">
                    <a href="<?php echo adm_base_url();?>/feedback" title="AutoProPAD Feedback">AutoProPAD Feedback</a>
                </li> -->
              <?php //} ?>         
                            
                 <!-- <li class="<?php echo ($url == 'update_aaps' )?'active':"";?>" >
                  	<a href="<?php echo adm_base_url();?>/update_aaps"  title="Push App Updates">Push App Updates</a>
                 </li>   --> 
                  <li>
                <a title="App Admin" href="#collapsedropdownAppAdmin" aria-expanded="false" aria-controls="collapsedropdownAppAdmin" data-toggle="collapse">App Admin
                    <span class="glyphicon glyphicon-triangle-bottom pull-right"  href="#collapsedropdownAppAdmin" aria-expanded="false" aria-controls="collapsedropdownAppAdmin"></span>
                   </a>
                   <ul class="collapse <?php echo ($url == 'home_screen_menus')||($url=='announcements')||($url=='add_announcements')||($url=='avatars')||($url=='firebase_update_avtars')||($url == 'autopro_app_updates' )||($url == 'add_autoproapp_version')?'in':"";?>" id="collapsedropdownAppAdmin"> 
                      <?php if( in_array('announcements', $admin_type_access)){?>         
                      <li class="<?php echo ($url=='announcements')?'active':"";?>">
                        <a href="<?php echo adm_base_url();?>/announcements" title="Image Types">Announcements</a>
                      </li> 
                      <?php } ?>
                      <?php if( in_array('homeScreenMenu', $admin_type_access)){?>  
                      <li class="<?php echo ($url=='home_screen_menus')?'active':"";?>">
                        <a href="<?php echo adm_base_url();?>/home_screen_menus" title="Image Types">Home Screen Menus</a>
                      </li>
                    <?php } ?>
                    <li class="<?php echo ($url=='avatars')?'active':"";?>">
                        <a href="<?php echo adm_base_url();?>/avatars" title="Image Types">Avatars</a>
                      </li>
                     <?php if( in_array('firebaseUpdates', $admin_type_access)){?>
                      <li class="<?php echo ($url == 'firebase' )?'active':"";?>">
                        <a href="<?php echo adm_base_url();?>/firebase" title="firebase" class="auto">Firebase Updates</a>
                      </li> 
                      <?php } ?>  
                      <li class="<?php echo ($url == 'autopro_app_updates' )?'active':"";?>">
                        <a href="<?php echo adm_base_url();?>/autopro_app_updates" title="firebase" class="auto">AutoProAPP Updates</a>
                      </li> 
                      <li class="<?php echo ($url == 'get_firebase_updates' )?'active':"";?>">
                        <a href="<?php echo adm_base_url();?>/get_firebase_updates" title="firebase" class="auto">Get Firebase Updates</a>
                      </li>                                                                         
                   </ul>
               </li>  
                <?php if( in_array('adminAccess', $admin_type_access)){?>         
                <li class="separator">                  
                  <a title="Admin Access" href="#collapsedropdownAdminAccess" aria-expanded="false" aria-controls="collapsedropdownAdminAccess" data-toggle="collapse">Admin Access
                    <span class="glyphicon glyphicon-triangle-bottom pull-right"  href="#collapsedropdownAdminAccess" aria-expanded="false" aria-controls="collapsedropdownAdminAccess"></span>
                   </a>
                   <ul class="collapse <?php echo ($url == 'manage_user') || ($url == 'users_types')||($url=='add_user_types') ?'in':"";?>" id="collapsedropdownAdminAccess"> 
                        <li class="<?php echo ($url == 'manage_user' )?'active':"";?>">
                          <a href="<?php echo adm_base_url();?>/manage_user" title="Users" class="auto">Users</a>
                        </li>                        
                        <li class="<?php echo ($url == 'users_types')||($url=='add_user_types')?'active':"";?>">
                          <a href="<?php echo adm_base_url();?>/users_types" title="Image Types">User Types</a>
                        </li>                                                                          
                   </ul>
                </li>
              <?php } ?>                               
            </ul>
            <!-- <p class="affix affix-bottom">
                © <?php echo date('Y');?><br>
                American Key Supply, Inc.<br>
                All rights reserved.<br>
            </p> -->
          </section>
         <!--sidebar start here--> 
         <div class="loading hide"></div>
         <div class="hide" id="loader"></div>
         <div class="updatingLoading hide">
           <div class="progress" style="margin: 10px 10px 10px 200px;">
              <div id="myBar" class="progress-bar progress-bar-striped progress-bar-animated active" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
         </div>