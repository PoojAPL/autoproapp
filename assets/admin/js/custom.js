// JavaScript Document
//var bse_url = "/";
var bse_url = "http://localhost/autoproapp.com/";
var adm_bse_url = bse_url+"admpro/";

$().ready(function(){
$("#login_form").validate({
		rules:{
				user_name : {
					required: true,
					email: true
				},
				password :  {
					required: true,
					minlength : 5,
					maxlength : 20
				},
		},
		messages:{
			user_name : "Please enter your email",
			password: {
				required: "Please enter password",
				minlength: "Password must contain at least 5 characters and maximum 20 characters.",
				maxlength: "assword must contain at least 5 characters and maximum 20 characters."
		},
		},submitHandler: function(form) {
		 var response = grecaptcha.getResponse();
		  if (response.length == 0) {
			 $('.captcha_error').removeClass('hide');		
			 setTimeout(function() {
				 $('.captcha_error').addClass('hide');
			 }, 2000);
			return false;
		  }else {
			  form.submit();
		  }			
	  }
	})		
})

$().ready(function(){
$("#key_style").validate({
		rules:{
			name : "required",			
		},
		messages:{
			name : "Please enter key style name",
		}
	})		
})
$().ready(function(){
$("#key_type").validate({
		rules:{
			name : "required",
		},
		messages:{
			name : "Please enter key type name",
		}
	})		
})
$().ready(function(){
$("#chips").validate({
		rules:{
			name : "required",			
			cloneable : "required",
			reusable : "required",
			cloning_chip : "required",
		},
		messages:{
			name : "Please enter chip name",			
			cloneable :"Please enter clonable value",
			reusable :"Please enter reusable value",
			cloning_chip :"Plaese enter cloning chip value",
		}
	})		
})


/*=========================================Check Email===========================================================*/
var emailvalid	= 1;
	$(document).on('blur', '#email', function(){
		var email = $(this).val();
		if( email != ""){
			$.ajax({
				  url:adm_bse_url+'check_email',
				  type:'POST',	
				  data:'email='+email+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
				  success:function(result){								
					if(result == 0){ 
						emailvalid = 0;
						$('.emailAvailability').html('')
						$(".availability_email").html('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');
					}else if(result == 1){  
							$(".availability_email").html('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>');
							$('.emailAvailability').html('<div>E-mail already exists, please try another.</div>')
							emailvalid = 1;
					}else if(result == 2){  
						$(".availability_email").html('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>');
						emailvalid = 1;
						$('.emailAvailability').html('')
					 }
				 },
				 error: function(xhr, status, error) {
				   
				   alert("Something went wrong, please try again");
				 }  			
			  })
		}
	})
/*$().ready(function(){
	$("#add_user").validate({
		rules:{
			user_name : "required",
			select_admin : "required",
			email : {
				required : true,
				email :true
			},
			select_admin : "required",
			password :  "required",
			company: "required"
		},
		messages:{
			user_name : "Please enter your name",
			select_admin :"Please select admin type",
			email : "Please enter your valid email",
			password : "Please enter your password"	,
			company: "Please enter company name"
		},submitHandler: function(form) {
			
				
			return false;		
			if( emailvalid == 0){
				form.submit();
			}else{
				$('#email').focus();	
			}		 
	   }
	})
})*/

/*===========================================Delete user==========================================================*/

function DeleteFunction(id, url){
	var r = confirm("Are you sure you would like to delete? This action cannot be undone.");
	if(r==true){
		 window.location.href = url+''+id;
	  }else{
	 }
}

function DeleteFunction2(url){
	var r = confirm("Are you sure you would like to delete? This action cannot be undone.");
	if(r==true){
		 window.location.href = url;
	  }else{
	 }	
}

function DeleteEZPages(id, url){
	var r = confirm("Are you sure you would like to delete? This action cannot be undone.");
	if(r==true){
		 window.location.href = url+''+id;
	  }else{
	 }
}
/*=================================Makes Name validation=======================================================================*/
$().ready(function(){
$("#makes_name").validate({
		rules:{
			make_name : "required"
			
		},
		messages:{
			make_name : "Please enter your make name"
			
		}
	})		
})
$().ready(function(){
$("#edit_makename").validate({
		rules:{
			make_name : "required"
			
		},
		messages:{
			make_name : "Please change make name"
			
		}
	})		
})

var uservalid	= 1;
	$(document).on('blur', '#make_name', function(){
		var username = $(this).val();
		if( username != ""){
			$.ajax({
				  url:adm_bse_url+'check_makename',
				  type:'POST',	
				  data:'make_name='+make_name,
				  success:function(result){								
					if(result == 0){ 
						uservalid = 0;
						$('.MakenameAvailability').html('')
						$(".availability_makename").html('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');
					}else if(result == 1){  
							$(".availability_makename").html('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>');
							$('.MakenameAvailability').html('<div>E-mail already exists, please try another.</div>')
							uservalid = 1;
					}else if(result == 2){  
						$(".availability_makename").html('<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>');
						uservalid = 1;
						$('.MakenameAvailability').html('')
					 }
				 },
				 error: function(xhr, status, error) {
				   
				   alert("Something went wrong, please try again");
				 }  			
			  })
		}
	})
/*===============================================Delete Make user===================================================================================*/
function DeleteMakeName(id, url){
	var r = confirm("Are you sure you would like to delete? This action cannot be undone.");
	if(r==true){
		 window.location.href = url+''+id;
	  }else{
	 }
}
/*===============================================Delete Model=================================================================================*/
function DeleteModelFunction(id, url){
	var r = confirm("Are you sure you would like to delete? This action cannot be undone.");
	if(r==true){
		 window.location.href = url+''+id;
	  }else{
	 }
}
/*==========================================================sorting list=================================================*/
$(document).on('click','#sortlist', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var angle = $(this).attr('data-angle');
	//alert('angle');
	$.ajax({
		url: adm_bse_url+'vehicles/makeSortList',
		type: 'POST',
		data: {sorting: sorts, angle:angle,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.make_users').html(response);
			$('.loading').addClass('hide');
		}
	})
})
/*=========================================================================Model makename sorting list===================================================*/
$(document).on('click','#makesname_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var angle = $(this).attr('data-angle');
	$.ajax({
		url: adm_bse_url+'vehicles/MakeNamesSorting',
		type: 'POST',
		data: {sorting: sorts,angle:angle,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.make_names').html(response);
			$('.loading').addClass('hide');
			
		}
	})
})
/*====================================================================================Model validation==================================================*/
$().ready(function(){
$("#model_name").validate({
		rules:{
			model_name : "required",
			make_name :"required"
			
		},
		messages:{
			model_name : "Please enter your model name",
			make_name :"Please select make name"
			
		}
	})		
})
/*====================================================================================Code validation==============================================*/
$().ready(function(){
$("#code_series").validate({
		rules:{
			code_series_name : "required",
		},
		messages:{
			code_series_name : "Please enter name",
		}
	})		
})
/*===============================================================================Delete Code Series=================================*/
function DeleteCodeFunction(id, url){
	var r = confirm("Are you sure you would like to delete? This action cannot be undone.");
	if(r==true){
		 window.location.href = url+''+id;
	  }else{
	 }
}

/*===============================================================================Delete key style===================================*/
function DeleteKeystyle(id, url){
	var r = confirm("Are you sure you would like to delete? This action cannot be undone.");
	if(r==true){
		 window.location.href = url+''+id;
	  }else{
	 }
}
/*===============================================================================Delete Chips================================================*/
function DeleteChipsFunction(id, url){
	var r = confirm("Are you sure you would like to delete? This action cannot be undone.");
	if(r==true){
		 window.location.href = url+''+id;
	  }else{
	 }
}
/*===============================================================================Delete key type==============================================*/
function DeleteKeytype(id, url){
	var r = confirm("Are you sure you would like to delete? This action cannot be undone.");
	if(r==true){
		 window.location.href = url+''+id;
	  }else{
	 }
}
/*==================================================================================Result============================================*/


$(document).on('change','#result', function(){
		var searchs = $(this).val();	
		//alert(searchs)
		$('.loading').removeClass('hide');
		$.ajax({
			url: adm_bse_url+'pagination',
			type: 'POST',
			data: {searching: searchs,csrf_test_name: $.cookie('csrf_cookie_name')},
			success: function( response ){
				var url = document.URL				
				var x = url.substr(url.lastIndexOf('/') + 1)			
				if($.isNumeric( x )){										
					window.location.replace('http://autoproapp.com/admin/manage_model/');	
				}else{
					location.reload();
				}	
				$('.loading').addClass('hide');
		} 
	})
})


$(document).on('change', '.filterByMakes', function(){
	var makes = $(this).val();
	$('.loading').removeClass('hide');	
	$.ajax({
		url: adm_bse_url+'vehicles/filter_by_makes',
		type: 'POST',
		data: {make_uuid: makes,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.table-data').html(response);
			$('.loading').addClass('hide');
		}
	})
})

$(document).on('click', '.searchModels', function(){
	var search_key = $('#search_key').val();	
	
})
$("#searchModels").validate({
		rules:{
			search_key : "required",			
		},
		messages:{
			search_key : "",			
		}, submitHandler: function(form){
			$('.loading').removeClass('hide');
			$.ajax({
				url: adm_bse_url+'vehicles/search_makes',
				type: 'POST',
				data: $('#searchModels').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
				success: function( response ){
					$('.table-data').html(response);
					$('.loading').addClass('hide');
				}
			})
		}
})	

$(document).on('click', '.user_sorting', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id'); 
	  var sortby1 = $(this).attr('data-sort'); 
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'user_sorting',
		  type: 'POST',
		  data:{sorting: sorts, sortby: sortby1,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.usersData').html(response);
			  $('.loading').addClass('hide');
		  }
	})
})


$(document).on('change', '.show_userby_types', function(){
		var type1 = $(this).val();
		$('.loading').removeClass('hide');
		$.ajax({
		  url: adm_bse_url+'show_userby_types',
		  type: 'POST',
		  data:{type: type1,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.usersData').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('change', '.show_userby_access', function(){
		var type1 = $(this).val();
		$('.loading').removeClass('hide');
		$.ajax({
		  url: adm_bse_url+'show_userby_access',
		  type: 'POST',
		  data:{type: type1,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.usersData').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})


$("#addManufacture").validate({
	rules:{
		manufacturer_name : "required"
	},
	messages:{
		manufacturer_name : "Please enter manufacturer name"
	}
})
$("#tool_type").validate({
	rules:{
		tooltype_name : "required"
	},
	messages:{
		tooltype_name : "Please enter tool type name"
	}
})	
	

$(document).on('click', '.code_sorting', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');	 
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'vehicles/code_sorting',
		  type: 'POST',
		  data:{sorting: sorts,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.code_series_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('click', '.tool_type_sorting', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');	 
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'tool_type_sorting',
		  type: 'POST',
		  data:{sorting: sorts,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.tool_type').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})



$("#addTool").validate({
	rules:{
		tool_name : "required"
	},
	messages:{
		tool_name : "Please enter tool name"
	}
})



$(document).on('click', '.tools_sorting', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');	 
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'tools_sorting',
		  type: 'POST',
		  data:{sorting: sorts,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.tool_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('click', '.tools_sorting_by_type', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');	  
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'tools_sorting_by_type',
		  type: 'POST',
		  data:{sorting: sorts,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.tool_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('click', '.tools_sorting_by_manufacturer', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');	  
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'tools_sorting_by_manufacturer',
		  type: 'POST',
		  data:{sorting: sorts,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.tool_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('change', '.selectByTypes', function(){
	  $('.loading').removeClass('hide');
	  var types = $(this).val();	
	  var colname = $(this).attr('data-id');  
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'select_tools',
		  type: 'POST',
		  data:{types: types, columnName: colname,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.tool_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('change','#tools_result', function(){
		var searchs = $(this).val();	
		//alert(searchs)
		$('.loading').removeClass('hide');
		$.ajax({
			url: adm_bse_url+'tool_pagination',
			type: 'POST',
			data: {searching: searchs,csrf_test_name: $.cookie('csrf_cookie_name')},
			success: function( response ){
				var url = document.URL				
				var x = url.substr(url.lastIndexOf('/') + 1)			
				if($.isNumeric( x )){										
					window.location.replace('http://autoproapp.com/admin/tools/');	
				}else{
					location.reload();
				}	
			$('.loading').addClass('hide');
		} 
	})
})

$("#searchTools").validate({
		rules:{
			search_key : "required",			
		},
		messages:{
			search_key : "",			
		}, submitHandler: function(form){
			$('.loading').removeClass('hide');
			$.ajax({
				url: adm_bse_url+'search_tools',
				type: 'POST',
				data: $('#searchTools').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
				success: function( response ){
					$('.tool_data').html(response);
					$('.loading').addClass('hide');
				}
			})
		}
})



$(document).on('click', '.chips_sorting', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');	  
	   var sorting_by = $(this).attr('data-by');	  
	  $.ajax({
		  url: adm_bse_url+'chips_sorting',
		  type: 'POST',
		  data:{sorting: sorts,sorting_by:sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})



$("#add_battery").validate({
	rules:{
		battery_name : "required",
	},
	messages:{
		battery_name : "Please enter battery name",		
	}
})

$(document).on('click', '.battery_sorting', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');	  
	  var sorting_by = $(this).attr('data-by');
	  $.ajax({
		  url: adm_bse_url+'battery_sorting',
		  type: 'POST',
		  data:{sorting: sorts,sorting_by:sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})


$("#add_key").validate({
	rules:{
		key_name : "required",
		key_type: "required"
       
	},
	messages:{
		key_name : "Please enter key name",
		key_type: ""
       			
	}
})

$(document).on('click', '.keys_sorting', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');
	  var sorting_by = $(this).attr('data-by');	
	  var keytype = $(".show_keysby_types").val();
	  var keylocktype = $(".show_keysby_lock_types").val();	
	 var searchkey	 =   $(".searchkey").val();	
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'keys_sorting',
		  type: 'POST',
		  data:{sorting: sorts, sorting_by: sorting_by,keytype:keytype,keylocktype:keylocktype,searchkey:searchkey,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})
$(document).on('change', '.show_keysby_types', function(){
	  $('.loading').removeClass('hide');
	  var type = $(this).val();	  
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'show_keysby_types',
		  type: 'POST',
		  data:{typeUuid: type,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			$('.chips_data').html(response);
			if(type =='all'){
				location.reload();
			}
			$('.loading').addClass('hide');
			$(".searchkey").val('');
			$(".show_keysby_lock_types").val('');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('change', '.show_keysby_lock_types', function(){
	  $('.loading').removeClass('hide');
	  var type = $(this).val();	 
	  var keybytype = $(".show_keysby_types").val();	  
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'show_keysby_lock_types',
		  type: 'POST',
		  data:{typeUuid: type,keybytype:keybytype,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  if(type =='all'){
				location.reload();
			}
			  $('.loading').addClass('hide');
			  $(".searchkey").val('');			   
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})



$("#searchKyes").validate({
  rules:{
	  search_key : "required",			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'search_kyes',
		  type: 'POST',
		  data: $('#searchKyes').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
			  $('.show_keysby_lock_types').val('');
			 
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})

$(document).on('change','#keys_pagination', function(){
		var searchs = $(this).val();	
		//alert(searchs)
		$('.loading').removeClass('hide');
		$.ajax({
			url: adm_bse_url+'keys_pagination',
			type: 'POST',
			data: {searching: searchs,csrf_test_name: $.cookie('csrf_cookie_name')},
			success: function( response ){
				var url = document.URL				
				var x = url.substr(url.lastIndexOf('/') + 1)			
				if($.isNumeric( x )){										
					window.location.replace('http://autoproapp.com/admin/keys/');	
				}else{
					location.reload();
				}	
			$('.loading').addClass('hide');
		} 
	})
})
$(document).on('change','#success_reporting_pagination', function(){
		var searchs = $(this).val();
		$('.loading').removeClass('hide');
		$.ajax({
			url: adm_bse_url+'success_reporting_pagination',
			type: 'POST',
			data: {searching: searchs,csrf_test_name: $.cookie('csrf_cookie_name')},
			success: function( response ){
				var url = document.URL				
				var x = url.substr(url.lastIndexOf('/') + 1)			
				if($.isNumeric( x )){										
					window.location.replace('http://autoproapp.com/admin/success_reporting/');	
				}else{
					location.reload();
				}	
			$('.loading').addClass('hide');
		} 
	})
})


$(document).on('click','.addAnotherTryOutKey', function(){
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'vehicles/get_try_out_keys',
		type: 'POST',
		data: $('#searchKyes').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name')+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		success: function( response ){
			$('.TryOutKeysData').append(response);
			$('.loading').addClass('hide');
		}
	})
})	

$(document).on('click', '.removeTryOutKey', function(){
	$(this).parents('.tryout_keys_row').remove();
})  

$(document).on('change','#code_series_pagination', function(){
		var searchs = $(this).val();	
		//alert(searchs)
		$('.loading').removeClass('hide');
		$.ajax({
			url: adm_bse_url+'vehicles/code_series_pagination',
			type: 'POST',
			data: {searching: searchs,csrf_test_name: $.cookie('csrf_cookie_name')},
			success: function( response ){
				var url = document.URL				
				var x = url.substr(url.lastIndexOf('/') + 1)			
				if($.isNumeric( x )){										
					window.location.replace('http://autoproapp.com/admin/vehicles/codeseries/');	
				}else{
					location.reload();
				}	
			$('.loading').addClass('hide');
		} 
	})
})


$(document).on('change','.filterCsBykstyle', function(){
	$('.loading').removeClass('hide');
	var kstyleid = $(this).val();
	$.ajax({
		url: adm_bse_url+'vehicles/filter_cs_by_kstyle',
		type: 'POST',
		data: {keyStyleID: kstyleid,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.code_series_data').html(response);
			$('.loading').addClass('hide');
		}
	})
})	

$("#searchCodeSeries").validate({
  rules:{
	  search_key : "required",			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/search_code_series',
		  type: 'POST',
		  data: $('#searchCodeSeries').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.code_series_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})



/*============================================= Remotes Module ================================================================*/


$("#AddRemoteForm").validate({
	rules:{
		Remote_Type_UUID: 'required',
		Remote_Name : "required"
	},
	messages:{
		Remote_Type_UUID: '',
		Remote_Name : "Please enter name"
	}
})

$(document).on('change','#remotes_pagination', function(){
		var searchs = $(this).val();	
		//alert(searchs)
		$('.loading').removeClass('hide');
		$.ajax({
			url: adm_bse_url+'remotes_pagination',
			type: 'POST',
			data: {searching: searchs,csrf_test_name: $.cookie('csrf_cookie_name')},
			success: function( response ){
				$(".show_remoteby_types").val('All');
				var url = document.URL				
				var x = url.substr(url.lastIndexOf('/') + 1)			
				if($.isNumeric( x )){										
					window.location.replace('http://autoproapp.com/admin/remotes/');	
				}else{
					location.reload();
				}
				
			$('.loading').addClass('hide');
		} 
	})
})



$(document).on('click', '.remote_type_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');	
	var sorting_by = $(this).attr('data-by');	
	var search_key = $(".search_romate_key").val();	 
	var remoteby_types =$('.show_remoteby_types ').val();	 			
	$.ajax({
	  url: adm_bse_url+'remote_type_sorting',
	  type: 'POST',
	  data:{sorting: sorts,sorting_by:sorting_by,search_key:search_key,remoteby_types:remoteby_types,csrf_test_name: $.cookie('csrf_cookie_name')},
	  success: function( response ){
		  $('.chips_data').html(response);
		  $('.loading').addClass('hide');
	  },
	  error: function(xhr, status, error) {
		$('.loading').addClass('hide');
		
		alert("Something went wrong, please try again");
	  }
	})
})


$(document).on('change', '.show_remoteby_types', function(){
	  $('.loading').removeClass('hide');
	  var type = $(this).val();	  
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'show_remoteby_types',
		  type: 'POST',
		  data:{typeUuid: type,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  if(type =='all'){
				  location.reload(true);
			  }
			  $('.chips_data').html(response);
			  
			  $('.loading').addClass('hide');
			  $('.search_romate_key ').val('');
			  $('.sortByDate').val('');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})



$("#searchRemotes").validate({
  rules:{
	  search_key : "required",			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'search_remotes',
		  type: 'POST',
		  data: $('#searchRemotes').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
			  $('.sortByDate').val('');
			  
			   
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})


$("#AddRemoteTypeForm").validate({
	rules:{
		Remote_Type_Name: 'required',		
	},
	messages:{
		Remote_Type_Name: 'Please enter name',		
	}
})

$(document).on('click', '.remoteTypeSorting', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');	  
	  $.ajax({
		  url: adm_bse_url+'m_remote_type_sorting',
		  type: 'POST',
		  data:{sorting: sorts,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})



/*================================================= Retainers Module  =============================================================*/


$("#AddRetainerForm").validate({
	rules:{
		Retainer_Name: 'required',		
	},
	messages:{
		Retainer_Name: 'Please enter name',		
	}
})


$(document).on('click', '.ratainer_sorting', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');	  
	  $.ajax({
		  url: adm_bse_url+'ratainer_sorting',
		  type: 'POST',
		  data:{sorting: sorts,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})
$(document).on('change', '.filterVehicleByMake', function(){
	$('.loading').removeClass('hide');
	  var make = $(this).val();		  
	   var vehicle_models = "";  
	  $.ajax({
		  url: adm_bse_url+'vehicles/get_vehicle_models',
		  type: 'POST',
		  data:{makeId: make,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  var x = $(response).filter('div');
			  vehicle_models = x.filter('#vehicle_models').html();			 
			  var vehicle_data = x.filter('#vehicle_data').html();	
			  $('.getModels').html(vehicle_models);
			  $('.vehiclesData').html(vehicle_data);			  
			  $('.loading').addClass('hide');
			  $(".search_key").val('');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})




$("#AddVehicleForm").validate({
	rules:{
		Make_UUID: 'required',
		Model_UUID : "required",
		fromYear: "required",	
	},
	messages:{
		Make_UUID: '',
		Model_UUID : "",
		fromYear: "Please enter year"
	}
})

$('.Tumblers').keyup(function(){	
    $('span.error-keyup-3').remove();
    var inputVal = $(this).val();
    //var characterReg1 = /^\(([\.-]?\w+)*\)\w+([\.-]?\w+)*(\;)+$/;
	var characterReg2 = /^\(([\.-]?\w+)*\)\w+([\.-]?\w+)*(\;)+$|(,)([0-9]{2})(\;)+$/;
	console.log(inputVal)
    if( (!characterReg2.test(inputVal)) ) {
        $(this).after('<span class="error error-keyup-3">Please use pattern like: (Ignition)1-8; OR (Ignition)1-8,10</span>');
    }
});
 

$(document).on('click', '.vehicle_sorting_make', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');	
	  var makeId = $('.filterVehicleByMake option:selected').val();	 
	  var modelId = $('.filterVehicleByModel select option:selected').val();  
	  $.ajax({
		  url: adm_bse_url+'vehicles/vehicle_sorting_make',
		  type: 'POST',
		  data:{sorting: sorts,makeId:makeId,modelId:modelId,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})
$(document).on('click', '.vehicle_sorting_model', function(){
	  $('.loading').removeClass('hide');
	  var makeId = $('.filterVehicleByMake option:selected').val();	 
	  var modelId = $('.filterVehicleByModel select option:selected').val(); 
	  var sorts = $(this).attr('data_id');	  
	  $.ajax({
		  url: adm_bse_url+'vehicles/vehicle_sorting_model',
		  type: 'POST',
		  data:{sorting: sorts,modelId:modelId,makeId:makeId,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})


$(document).on('click', '.vehicle_sorting_year', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');
	  var makeId = $('.filterVehicleByMake option:selected').val();	 
	  var modelId = $('.filterVehicleByModel select option:selected').val(); 
	  $.ajax({
		  url: adm_bse_url+'vehicles/vehicle_sorting_year',
		  type: 'POST',
		  data:{sorting: sorts,makeId:makeId,modelId:modelId,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('change', '.filterVehicleByModel select', function(){
	  $('.loading').removeClass('hide');
	  var model = $(this).val();	  
	  $.ajax({
		  url: adm_bse_url+'vehicles/filter_vehicle_by_model',
		  type: 'POST',
		  data:{modelId: model,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
			  $('.site-pg').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$("#searchVehicles").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/search_vehicles',
		  type: 'POST',
		  data: $('#searchVehicles').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
			  $('.site-pg').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})

$(document).on('click', '.HideMachineInfo', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.machine').addClass('hide');
		value = 1;
	}else{
		$('.machine').removeClass('hide')
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/HideMachineInfo',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.HideDecoders', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.decoder').addClass('hide');
		value = 1;
	}else{
		$('.decoder').removeClass('hide');
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/HideDecoders',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})
$(document).on('click', '.edit_determinator', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('.decoder').find('.determinatorDropbox');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');
	var data_key = $(this).attr('data-key');
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/get_determinator',
		  type: 'POST',
		  data: {uuId: UUId, dataId: data_id, column: data_column, key: data_key ,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.determinator_update', function(){
	$(this).parents('.decoder').find('.edit_determinator').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/update_determinator',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('.decoder').find('.tdvalue').text(response);		
			  $(i).parents('.determinatorDropbox').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.determinator_remove', function(){
	$(this).parents('.decoder').find('.edit_determinator').removeClass('hide');
	$(this).parents('.determinatorDropbox').html('') 
})


$(document).on('change', '.selectKeyType', function(){
	var value = $(this).val();
	$('.availableSubstitutes2').empty();
	if( (value == '706fb41c-3ce7-11e6-8f40-525400180921') || ( value == '391021e9-3d59-11e6-8f40-525400180921')){
		$('.TestkeyShellRow').removeClass('hide');
		$('.ChipRow').removeClass('hide');
		$('.keyShellDiv').removeClass('hide');
		$('.replcaementBlade').addClass('hide')
	}else if( value == '706fb125-3ce7-11e6-8f40-525400180921' || value == '9ec3b5aa-5f3c-11e6-8f40-525400180921'){
		$('.TestkeyShellRow').addClass('hide')
		$('.ChipRow').addClass('hide');
		$('.keyShellDiv').removeClass('hide');
		$('.replcaementBlade').removeClass('hide')
	}else if( value == 'ea244906-4d80-11e6-8f40-525400180921' ){
		$('.TestkeyShellRow').removeClass('hide')
		$('.ChipRow').addClass('hide');
		$('.keyShellDiv').addClass('hide')
		$('.replcaementBlade').addClass('hide')
	}else{
		$('.TestkeyShellRow').addClass('hide')
		$('.ChipRow').addClass('hide');
		$('.keyShellDiv').addClass('hide')
		$('.replcaementBlade').addClass('hide')
	}	
	var this_val = $('.availableSubstitutes').find('.get_substitute_keys');
	if( value == ""){
	}else{
		$('.loading').removeClass('hide');
		  $.ajax({
			  url: adm_bse_url+'get_substitute_keys',
			  type: 'POST',
			  data: {key: value,csrf_test_name: $.cookie('csrf_cookie_name')},
			  success: function( response ){
				  $(this_val).html(response);			  
				  $('.loading').addClass('hide');
			  },
			  error: function(xhr, status, error) {
				$('.loading').addClass('hide');
				
				alert("Something went wrong, please try again");
			  }
		  })
	}
})

$(document).on('change', '.selectRemoteType', function(){
	$('select[name="Battery_UUID"]').find('option[value="d704833b-3cca-11e6-8f40-525400180921"]').attr("selected",false);
	var value = $(this).val();	
	if( value == 'a5451618-49ec-11e6-beb8-9e71128cae77' || value == '00d6a462-3c7b-11e8-9e21-525400df8778'){ //Remote Shell 
		$('#Emergency_Key_UUID').prop('disabled', true);
		$('#frequency').prop('disabled', false);
		$('#Fcc_ID').prop('disabled', false);
		$('#IC').prop('disabled', false);		
		$('#Chips_UUID').prop('disabled', true);
		$('#TestKey_UUID').prop('disabled', true);
		
		$('.loading').removeClass('hide');
	  	$.ajax({
		  url: adm_bse_url+'get_remote_shells',
		  type: 'POST',
		  data: {data_type: 'Remote Shell',csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.shellData').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	   })	
	}else if(value == 'a54519b0-49ec-11e6-beb8-9e71128cae77'){ //Remote Head Key Shell
		$('#Emergency_Key_UUID').prop('disabled', true);
		$('#frequency').prop('disabled', false);
		$('#Fcc_ID').prop('disabled', false);
		$('#IC').prop('disabled', false);		
		$('#Chips_UUID').prop('disabled', true);
		$('#TestKey_UUID').prop('disabled', true);
			
		$('.loading').removeClass('hide');
	  	$.ajax({
		  url: adm_bse_url+'get_remote_shells',
		  type: 'POST',
		  data: {data_type: 'Remote Head Key Shell',csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.shellData').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	   })	
	  /* $.ajax({
		  url: adm_bse_url+'get_remote_keys',
		  type: 'POST',
		  data: {data_type: 'Mechanical Key'},
		  success: function( response ){
			  $('.TestKey_UUID').html(response);
			  $('.loading').addClass('hide');
		  }
	    })*/
	}else if(value == 'a5451b68-49ec-11e6-beb8-9e71128cae77' ||value == 'd8d12d60-49eb-11e6-beb8-9e71128cae77'){ //Smart Key Shell
		$('#Emergency_Key_UUID').prop('disabled', true);
		$('#frequency').prop('disabled', false);
		$('#Fcc_ID').prop('disabled', false);
		$('#IC').prop('disabled', false);		
		$('#Chips_UUID').prop('disabled', true);
		$('#TestKey_UUID').prop('disabled', true);
		
		$('.loading').removeClass('hide');
	  	$.ajax({
		  url: adm_bse_url+'get_remote_shells',
		  type: 'POST',
		  data: {data_type: 'Smart Key Shell',csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.shellData').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	   })	
	}else if(value == 'd8d12888-49eb-11e6-beb8-9e71128cae77'){ //Remote (Keyless Entry)
		$('#Emergency_Key_UUID').prop('disabled', true);
		$('#frequency').prop('disabled', false);
		$('#Fcc_ID').prop('disabled', false);
		$('#IC').prop('disabled', false);		
		$('#Chips_UUID').prop('disabled', true);
		$('#TestKey_UUID').prop('disabled', true);		
		$('.loading').removeClass('hide');
	  	$.ajax({
		  url: adm_bse_url+'get_remote_shells',
		  type: 'POST',
		  data: {data_type: 'Remote Shell',csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.shellData').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	   })
		
}else if(value == 'd8d12888-49eb-11e6-beb8-9e71128cae77'){ //Remote (Keyless Entry)
		$('#Emergency_Key_UUID').prop('disabled', true);
		$('#frequency').prop('disabled', false);
		$('#Fcc_ID').prop('disabled', false);
		$('#IC').prop('disabled', false);		
		$('#Chips_UUID').prop('disabled', true);
		$('#TestKey_UUID').prop('disabled', true);		
		$('.loading').removeClass('hide');
	  	$.ajax({
		  url: adm_bse_url+'get_remote_shells',
		  type: 'POST',
		  data: {data_type: 'Remote Shell',csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.shellData').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	   })
		
	}else if(value == 'd8d12afe-49eb-11e6-beb8-9e71128cae77'){ //Remote Head Key
		$('#Emergency_Key_UUID').prop('disabled', true);
		$('#frequency').prop('disabled', false);
		$('#Fcc_ID').prop('disabled', false);
		$('#IC').prop('disabled', false);		
		$('#Chips_UUID').prop('disabled', true);
		$('#TestKey_UUID').prop('disabled', true);		
		$('.loading').removeClass('hide');
	  	$.ajax({
		  url: adm_bse_url+'get_remote_shells',
		  type: 'POST',
		  data: {data_type: 'Remote Head Key Shell',csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.shellData').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	   })
		
	}
	
})

$(document).on('click', '.editInputType', function(){
	var i = this;
	$(this).addClass('hide');
	var thisval = $(this).attr('data-val');
	var UUId =  $(this).attr('data-id');
	var column = $(this).attr('data-col');
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/get_cs_column_data',
		  type: 'POST',
		  data: {value: thisval, dataId: UUId, ColumnName: column,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			 $(i).parents('.column_data').find('.get_column_data').html(response) 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.csinput_update', function(){
	$(this).parents('.column_data').find('.editInputType').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/csinput_update',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('.column_data').find('.tdvalue').text(response);		
			 $(i).parents('.column_data').find('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.csinput_remove', function(){
	$(this).parents('.column_data').find('.editInputType').removeClass('hide');
	$(this).parents('.column_data').find('.get_column_data').html('')
})




$(document).on('click', '.edit_cs_keys', function(){
	var i = this;
	$(this).addClass('hide');
	var thisval = $(this).attr('data-val');
	var UUId =  $(this).attr('data-id');
	var column = $(this).attr('data-col');
	var key_data1 = $(this).attr('data-key1');
	var key_data2 = $(this).attr('data-key2');
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/get_cs_keys_data',
		  type: 'POST',
		  data: {value: thisval, dataId: UUId, ColumnName: column, key1: key_data1, key2: key_data2,csrf_test_name: $.cookie('csrf_cookie_name') },
		  success: function( response ){
			  $(i).parents('.decoder').find('.ckKeysDropbox').html(response) 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})


$(document).on('click', '.csKyes_update', function(){
	$(this).parents('.decoder').find('.edit_cs_keys').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/cs_keys_data_update',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('.decoder').find('.tdvalue').text(response);		
			  $(i).parents('.ckKeysDropbox').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.csKyes_remove', function(){
	$(this).parents('.decoder').find('.editInputType').removeClass('hide');
	$(this).parents('.decoder').find('.ckKeysDropbox').html('')
})

$(document).on('click', '.editMachineData', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('.machine').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');
	var data_key = $(this).attr('data-key');
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/get_machine_data',
		  type: 'POST',
		  data: {uuId: UUId, dataId: data_id, column: data_column, key: data_key,csrf_test_name: $.cookie('csrf_cookie_name') },
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})


$(document).on('click', '.machine_data_update', function(){
	$(this).parents('.decoder').find('.editMachineData').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/update_machine_data',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('.machine').find('.tdvalue').text(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.machine_data_remove', function(){
	$(this).parents('.machine').find('.editMachineData').removeClass('hide');
	$(this).parents('.machine').find('.get_column_data').html('')
})

$(document).on('click', '.machine_data_update', function(){
	$(this).parents('.decoder').find('.editMachineData').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/update_machine_data',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('.machine').find('.tdvalue').text(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.edit_cs_key_style', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('.dropbox_data').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');
	var data_key = $(this).attr('data-key');
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/get_key_style_data',
		  type: 'POST',
		  data: {uuId: UUId, dataId: data_id, column: data_column,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.keyStyle_data_update', function(){
	$(this).parents('.dropbox_data').find('.edit_cs_key_style').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/update_key_style_data',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('.dropbox_data').find('.tdvalue').text(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.keyStyle_data_remove', function(){
	$(this).parents('.dropbox_data').find('.edit_cs_key_style').removeClass('hide');
	$(this).parents('.dropbox_data').find('.get_column_data').html('')
})


/*=========================== Vehicle Page Editing ==========================================*/

$(document).on('click', '.edit_vh_inputs', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val')
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/edit_vh_inputs',
		  type: 'POST',
		  data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})
$(document).on('click', '.edit_image_inputs', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val');
	var img_uuid =  $(this).attr('data-uuid');
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/edit_image_inputs',
		  type: 'POST',
		  data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val,img_uuid: img_uuid,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})
$(document).on('click', '.vh_input_update', function(){
	$(this).parents('td').find('.edit_vh_inputs').removeClass('hide');
	var formName = $(this).parents('form');	
	var decimalGen = $(this).parents('td').find('.decimalGen').val();
	var decimalGenNotes = $(this).parents('td').find('.decimalGenNotes').val();
	if($(this).parents('td').find('.columnName').val() == 'gen'){
		$(this).parents('td').find('.edit_vh_inputs').attr('data-val', decimalGen+"__"+decimalGenNotes);
	}
	var i = this;
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'vehicles/vh_input_update',
		type: 'POST',
		data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		success: function( response ){
			$(i).parents('td').find('.td_data').html(response);		
			$(i).parents('.get_column_data').html('') 
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})
$(document).on('click', '.vh_input_remove', function(){
	$(this).parents('td').find('.edit_vh_inputs').removeClass('hide');
	$(this).parents('td').find('.get_column_data').html('')
})


$(document).on('click', '.edit_vh_dropbox', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val');
	var data_key = $(this).attr('data-key');
	var data_type = $(this).attr('data-type')
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/edit_vh_dropbox',
		  type: 'POST',
		  data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val, key: data_key, type: data_type,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.vh_dropbox_update', function(){
	$(this).parents('td').find('.edit_vh_dropbox').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/vh_dropbox_update',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('td').find('.td_data').html(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.edit_vh_programmers_box', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val');
	var data_key = $(this).attr('data-key');
	var data_type = $(this).attr('data-type')
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/edit_vh_programmers_box',
		  type: 'POST',
		  dataType: "html",
		  data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val, key: data_key, type: data_type,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.vh_programmers_dropbox_update', function(){
	$(this).parents('td').find('.edit_vh_programmers_box').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/vh_programmers_dropbox_update',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('td').find('.td_data').html(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})
$(document).on('click', '.vh_dropbox_remove', function(){
	$(this).parents('td').find('.edit_vh_dropbox').removeClass('hide');
	$(this).parents('td').find('.edit_vh_programmers_box').removeClass('hide');	
	$(this).parents('td').find('.get_column_data').html('')
})

$(document).on('click', '.edit_vh_multiple_box', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val');
	var data_key = $(this).attr('data-key');
	var data_type = $(this).attr('data-type')
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/edit_vh_multiple_box',
		  type: 'POST',
		  dataType: "html",
		  data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val, key: data_key, type: data_type,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.vh_multiple_dropbox_update', function(){
	$(this).parents('td').find('.edit_vh_multiple_box').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/vh_multiple_dropbox_update',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('td').find('.td_data').html(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})
$(document).on('click', '.vh_multiple_dropbox_remove', function(){
	$(this).parents('td').find('.vh_multiple_dropbox_remove').removeClass('hide');	
	$(this).parents('td').find('.get_column_data').html('')
	$(this).parents('td').find('.edit_vh_multiple_box').removeClass('hide');	
})


/*=============================== Tool Page Editing =========================================*/

$(document).on('click','.edit_tools_inputs', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val')
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'edit_tools_inputs',
		type: 'POST',
		data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$(thisval).html(response);
			$('.loading').addClass('hide');
		}
	})	
})

$(document).on('click', '.tools_input_update', function(){
	$(this).parents('td').find('.edit_tools_inputs').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'tools_input_update',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('td').find('.td_data').html(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})
$(document).on('click', '.tools_input_remove', function(){
	$(this).parents('td').find('.edit_tools_inputs').removeClass('hide');
	$(this).parents('td').find('.get_column_data').html('')
})



$(document).on('click', '.edit_tools_dropbox', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val');
	var data_key = $(this).attr('data-key');
	var data_type = $(this).attr('data-type')
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'edit_tools_dropbox',
		  type: 'POST',
		  data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val, key: data_key, type: data_type,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.tools_dropbox_update', function(){
	$(this).parents('td').find('.edit_vh_dropbox').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'tools_dropbox_update',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('td').find('.td_data').text(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})


$(document).on('click', '.tools_dropbox_remove', function(){
	$(this).parents('td').find('.edit_tools_dropbox').removeClass('hide');	
	$(this).parents('td').find('.get_column_data').html('')
})

$(document).on('click', '.HideAdvancedign', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.AdvDiagn').addClass('hide');
		value = 1;
	}else{
		$('.AdvDiagn').removeClass('hide')
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/HideAdvancedign',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.HideProlok', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.ProLok').addClass('hide');
		value = 1;
	}else{
		$('.ProLok').removeClass('hide')
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/HideProlok',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.HideCcode_keyInfo', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.code_keyInfo').addClass('hide');
		value = 1;
	}else{
		$('.code_keyInfo').removeClass('hide')
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/HideCcode_keyInfo',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.HideAutoProPAD', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.AutoProPAD').addClass('hide');
		value = 1;
	}else{
		$('.AutoProPAD').removeClass('hide')
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/HideAutoProPAD',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.HideHotWire', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.Hotwire').addClass('hide');
		value = 1;
	}else{
		$('.Hotwire').removeClass('hide')
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/HideHotWire',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.HideTKOSDD', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.TKOSDD').addClass('hide');
		value = 1;
	}else{
		$('.TKOSDD').removeClass('hide')
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/HideTKOSDD',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})


/*======================== Machines Info Module=========================================*/


$("#AddMachineForm").validate({
	rules:{
		Name: 'required',
		Type : "required"			
	},
	messages:{
		Name: 'Please enter name',
		Type : ""	
	}
})


$(document).on('click', '.HideAlternativeKeys', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.alternative').addClass('hide');
		value = 1;
	}else{
		$('.alternative').removeClass('hide')
		value = 2;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'HideAlternativeKeys',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})



$(document).on('click', '.addAnotherSubstitute', function(){	
	var value = $('.selectKeyType').val();
	var this_val = $('.availableSubstitutes').find('.get_substitute_keys');
	if( value == ""){
	}else{
		$('.loading').removeClass('hide');
		  $.ajax({
			  url: adm_bse_url+'add_another_substitute',
			  type: 'POST',
			  data: {key: value,csrf_test_name: $.cookie('csrf_cookie_name')},
			  success: function( response ){
				  $('.availableSubstitutes2').append(response);			  
				  $('.loading').addClass('hide');
			  },
			  error: function(xhr, status, error) {
				$('.loading').addClass('hide');
				
				alert("Something went wrong, please try again");
			  }
		  })
	}	
})

$(document).on('click', '.subsitutesRemove', function(){	
	var this_val = $(this).parents('.anotherSubs').remove();
})


/*=============================== Keys Page Editing =========================================*/

$(document).on('click','.edit_keys_inputs', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val')
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'edit_keys_inputs',
		type: 'POST',
		data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$(thisval).html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})	
})

$(document).on('click', '.keys_input_update', function(){
	$(this).parents('td').find('.edit_keys_inputs').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'keys_input_update',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('td').find('.td_data').html(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})
$(document).on('click', '.keys_input_remove', function(){
	$(this).parents('td').find('.edit_keys_inputs').removeClass('hide');
	$(this).parents('td').find('.get_column_data').html('')
})


$(document).on('click', '.edit_keys_dropbox', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val');
	var data_key = $(this).attr('data-key');
	var data_type = $(this).attr('data-type')
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'edit_keys_dropbox',
		  type: 'POST',
		  data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val, key: data_key, type: data_type,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.keys_dropbox_update', function(){
	$(this).parents('td').find('.edit_vh_dropbox').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'keys_dropbox_update',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('td').find('.td_data').text(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})


$(document).on('click', '.keys_dropbox_remove', function(){
	$(this).parents('td').find('.edit_keys_dropbox').removeClass('hide');	
	$(this).parents('td').find('.get_column_data').html('')
})


/*=============================== Remote Page Editing =========================================*/

$(document).on('click','.edit_remotes_inputs', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val')
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'edit_remotes_inputs',
		type: 'POST',
		data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$(thisval).html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})	
})

$(document).on('click', '.remotes_input_update', function(){
	$(this).parents('td').find('.edit_remotes_inputs').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'remotes_input_update',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('td').find('.td_data').html(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})
$(document).on('click', '.remotes_input_remove', function(){
	$(this).parents('td').find('.edit_remotes_inputs').removeClass('hide');
	$(this).parents('td').find('.get_column_data').html('')
})


$(document).on('click', '.edit_remotes_dropbox', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val');
	var data_key = $(this).attr('data-key');
	var data_type = $(this).attr('data-type')
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'edit_remotes_dropbox',
		  type: 'POST',
		  data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val, key: data_key, type: data_type,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.remotes_dropbox_update', function(){
	$(this).parents('td').find('.edit_remotes_dropbox').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'remotes_dropbox_update',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('td').find('.td_data').text(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})


$(document).on('click', '.remotes_dropbox_remove', function(){
	$(this).parents('td').find('.edit_remotes_dropbox').removeClass('hide');	
	$(this).parents('td').find('.get_column_data').html('')
})


/*=============================== Page Editing Functions ===============================================*/


$(document).on('click', '.edit_chips_inputs', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val');
	var data_table = $(this).attr('data-table');
	var img =  $(this).attr('data-img');
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'edit_chips_inputs',
		type: 'POST',
		data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val, dataTable: data_table, image:  img,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$(thisval).html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})	
})

$(document).on('click', '.chips_input_update', function(){
	$(this).parents('td').find('.edit_chips_inputs').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'chips_input_update',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('td').find('.td_data').html(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})
$(document).on('click', '.chips_input_remove', function(){
	$(this).parents('td').find('.edit_chips_inputs').removeClass('hide');
	$(this).parents('td').find('.get_column_data').html('')
})



$(document).on('click', '.edit_table_dropbox', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val');
	var data_table = $(this).attr('data-table');
	var data_type = $(this).attr('data-type');
	var img =  $(this).attr('data-img');
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'edit_table_dropbox',
		type: 'POST',
		data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val, dataTable: data_table, image:  img, dataType: data_type,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$(thisval).html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})	
})

$(document).on('click', '.table_dropbox_update', function(){
	$(this).parents('td').find('.edit_table_dropbox').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	 $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'table_dropbox_update',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('td').find('.td_data').html(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.table_dropbox_remove', function(){
	$(this).parents('td').find('.edit_table_dropbox').removeClass('hide');
	$(this).parents('td').find('.get_column_data').html('')
})


/*=============================== Update Schedule  ==============================*/

$(document).on('click', '.updateSchedule', function(){
	var id = $(this).attr('data-id');
	var parent = $(this).parents('tr');
	var Codes_Available = $(parent).find("input[name=Codes_Available_"+id+"]:checked").val();
	var Codes_Years = $(parent).find("input[name=Codes_Years_"+id+"]").val();
	var Codes_Afterhours = $(parent).find("input[name=Codes_Afterhours_"+id+"]:checked").val();
	var Codes_Price_Normal = $(parent).find("input[name=Codes_Price_Normal_"+id+"]").val();
	var Codes_Price_Afterhours = $(parent).find("input[name=Codes_Price_Afterhours_"+id+"]").val();	
	var Codes_Wait_Time = $(parent).find("input[name=Codes_Wait_Time_"+id+"]").val();
	var Codes_Refunds = $(parent).find("input[name=Codes_Refunds_"+id+"]:checked").val();	
	$('.loading').removeClass('hide');
	 $.ajax({
		url: adm_bse_url+'update_schedule',
		type: 'POST',
		data: {id: id, Codes_Available: Codes_Available, Codes_Years: Codes_Years, Codes_Afterhours: Codes_Afterhours, Codes_Price_Normal: Codes_Price_Normal, Codes_Price_Afterhours: Codes_Price_Afterhours,Codes_Wait_Time: Codes_Wait_Time, Codes_Refunds: Codes_Refunds ,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.message_display').html(response);			
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})	
})

$(document).on('click', '.machine_sorting', function(){
	$('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id'); 
	  var sortby1 = $(this).attr('data-sort'); 	  
	  $.ajax({
		  url: adm_bse_url+'machine_sorting',
		  type: 'POST',
		  data:{sorting: sorts, sortby: sortby1,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('change', '.selectByMachineTypes', function(){
	  $('.loading').removeClass('hide');
	  var type = $(this).val(); 	 
	  $.ajax({
		  url: adm_bse_url+'select_by_machine',
		  type: 'POST',
		  data:{type_uuid: type,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})



$("#add_image_types").validate({
	rules:{
		Name: 'required',
		
	},
	messages:{
		Name: 'Please enter name',
		
	}
})


$("#add_images").validate({
	rules:{
		Filename: 'required',
		Image_Type_UUID: 'required',
	},
	messages:{
		Filename: '',
		Image_Type_UUID: '',
	}
})

$(document).on('click', '.image_sorting_by_type', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id'); 
	  var sortby1 = $(this).attr('data-sort'); 
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'image_sorting_by_type',
		  type: 'POST',
		  data:{sorting: sorts, sortby: sortby1,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})


$(document).on('change', '.selectImageTypes', function(){
 	  $('.loading').removeClass('hide');
	  var types = $(this).val();	
	  var colname = $(this).attr('data-id'); 
	  $.ajax({
		  url: adm_bse_url+'select_image_types',
		  type: 'POST',
		  data:{types: types, columnName: colname},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})	


$(document).on('click', '.obp_cat_options', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id'); 
	  var sortby1 = $(this).attr('data-sort'); 
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'vehicles/obp_options_sorting',
		  type: 'POST',
		  data:{sorting: sorts, sortby: sortby1,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})



$("#add_obp_category").validate({
	rules:{
		Name: 'required',
	},
	messages:{
		Name: 'Please enter name',
	}
})

$(document).on('change', '.sortByDate', function(){
 	  
	  if( $(this).val() != "" ){
		  $('.loading').removeClass('hide');	  
		  $.ajax({
			  url: adm_bse_url+'sort_remote_by_date',
			  type: 'POST',
			  data:{csrf_test_name: $.cookie('csrf_cookie_name')},
			  success: function( response ){
				  $('.chips_data').html(response);
				  $('.loading').addClass('hide');
				  $(".search_romate_key").val('');
				  
			  },
			  error: function(xhr, status, error) {
				$('.loading').addClass('hide');
				
				alert("Something went wrong, please try again");
			  }
		})
	  }
})	


$(document).on('change', '.select_obp_Models', function(){
	$('.loading').removeClass('hide');
	  var make = $(this).val();	  
	  $.ajax({
		  url: adm_bse_url+'vehicles/get_obp_models',
		  type: 'POST',
		  data:{makeId: make,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.getModels').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('change', '.selectModels', function(){
	$('.loading').removeClass('hide');
	  var make = $(this).val();	  
	  $.ajax({
		  url: adm_bse_url+'vehicles/get_obp_models2',
		  type: 'POST',
		  data:{makeId: make,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.getModels').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('change', '.select_obp_vehicles', function(){
	$('.loading').removeClass('hide');
	  var make = $(this).attr('data-id');
	  var model = $(this).val();	  
	  $.ajax({
		  url: adm_bse_url+'vehicles/get_obp_vehicles',
		  type: 'POST',
		  data:{ModelId: model,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.getVehicles').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})


$(document).on('change', '.select_obp_category', function(){   	  
	var cat = $(this).val();
	var i = this;  
	if(cat != ""){
		 $('.loading').removeClass('hide');	  
		$.ajax({
			url: adm_bse_url+'vehicles/get_obp_ptions',
			type: 'POST',
			data:{catId: cat,csrf_test_name: $.cookie('csrf_cookie_name')},
			success: function( response ){
				$(i).parents('fieldset').find('.get_default_image_data').html(response);
				$('.loading').addClass('hide');
			},
			error: function(xhr, status, error) {
			  $('.loading').addClass('hide');
			  
			  alert("Something went wrong, please try again");
			}
	   })
	}else{
		$(i).parents('fieldset').find('.get_default_image_data').html('');
	}
})


$(document).on('change', '.select_image_uuid', function(){
     var i = this;  
	var cat = $(this).val();
	if(cat != ""){
		 $('.loading').removeClass('hide');		  
		$.ajax({
			url: adm_bse_url+'vehicles/get_obp_image',
			type: 'POST',
			data:{catId: cat,csrf_test_name: $.cookie('csrf_cookie_name')},
			success: function( response ){
				$(i).parents('fieldset').find('.get_default_image_uuid_data').html(response);
				$('.loading').addClass('hide');
			},
			error: function(xhr, status, error) {
			  $('.loading').addClass('hide');
			  
			  alert("Something went wrong, please try again");
			}
	   })
	}else{
		$(i).parents('fieldset').find('.get_default_image_uuid_data').html('');
	}
})



$("#AddObpRemoteForm").validate({
	rules:{
		Make_UUID: 'required',
		Model_UUID: 'required',
		Vehicle_UUID: 'required',		
	},
	messages:{
		Make_UUID: '',
		Model_UUID: '',	
		Vehicle_UUID: 'Please select valid vehicle',	
	}
})


$(document).on('click', '.changeImage', function(){
    $('.loading').removeClass('hide');
	var i = this;  	 
	var Image_Type_UUID  = 'OBP Icon';	  
	$.ajax({
		url: adm_bse_url+'vehicles/change_obp_image',
		type: 'POST',
		data:{Image_Type_UUID: Image_Type_UUID,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$(i).parents('fieldset').find('.get_default_image_uuid_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
   })
	
})


$(document).on('change', '.selectImageDeafultText', function(){     
	var Default_Image_UUID = $(this).val();
	var i = this;  
	if(Default_Image_UUID != ""){
		 $('.loading').removeClass('hide');		  
		 $.ajax({
			url: adm_bse_url+'vehicles/get_image_deafult_text',
			type: 'POST',
			data:{Default_Image_UUID: Default_Image_UUID,csrf_test_name: $.cookie('csrf_cookie_name')},
			success: function( response ){
				$(i).parents('fieldset').find('.getImageDeafultText').html(response);
				$('.loading').addClass('hide');
			},
			error: function(xhr, status, error) {
			  $('.loading').addClass('hide');
			  
			  alert("Something went wrong, please try again");
			}
	   })
	}else{
		$(i).parents('fieldset').find('.getImageDeafultText').html('');
	}
})

$(document).on('click', '.addAnotherProcedure', function(){
    $('.loading').removeClass('hide');	 
	var procedure  = $(this).attr('data-id');
	var procedure_num = parseInt(procedure) + 1;
	var i = this;  
	$.ajax({
		url: adm_bse_url+'vehicles/add_another_procedure',
		type: 'POST',
		data:{procedure: procedure,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.getAnotherProcedure').append(response);
			$(i).attr('data-id', procedure_num);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
   })	
})

$(document).on('click', '.removeProcedure', function(){
    $(this).parents('fieldset').remove();
	var procedure  = $('.addAnotherProcedure').attr('data-id');
	var procedure_num = parseInt(procedure) - 1;
	$('.addAnotherProcedure').attr('data-id', procedure_num);
})


$(document).on('change', '#Emergency_Key_UUID', function(){
	var value = $(this).val();
	if(value != ""){
		$('#Emergency_Key_UUID2').prop('disabled', false);	
	}else{
		$('#Emergency_Key_UUID2').prop('disabled', true);
	}
})


/*==================== Add Part Type  ==================================================================*/

$("#AddPartType").validate({
	rules:{
		Name: 'required'	
	},
	messages:{
		Name: ''	
	}
})

$("#AddParts").validate({
	rules:{
		Manufacturer: 'required',
		Part_Number: 'required',
		Part_Name: 'required',
		PartType_UUID: 'required',
		Vehicles_UUID: 'required'		
	},
	messages:{
		Manufacturer: '',
		Part_Number: '',
		Part_Name: '',
		PartType_UUID: '',
		Vehicles_UUID: ''		
	}
})



$("#AddMethods").validate({
	rules:{
		Title: 'required',
		Vehicle_UUID: 'required'	
	},
	messages:{
		Title: '',
		Vehicle_UUID: ''	
	}
})


$(document).on('click', '.UpdateFirebaseUsers', function(){
	 $('.loading').removeClass('hide');
	 $.ajax({
		url: adm_bse_url+'update_aks_users',
		type: 'POST',
		data:{csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			if(response == 0){
				alert('Error in updating data!')
			}else{
				alert('Data updated successfully!');
				location.reload();
			}		
			$('.loading').addClass('hide');
		},
		error: function (xhr, ajaxOptions, thrownError) {
		  $('.loading').addClass('hide');
		  alert(xhr.status+' : '+thrownError);				
		} 
   })	
})

$(document).on('change', '.changeUsersStatus', function(){
	$('.loading').removeClass('hide');
	var uid = $(this).attr('id');
	var status = $(this).val();
	 $.ajax({
		url: adm_bse_url+'change_users_status',
		type: 'POST',
		data:{uid: uid, status: status,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){				
			$('.loading').addClass('hide');
		},
		error: function (xhr, ajaxOptions, thrownError) {
		  $('.loading').addClass('hide');
		  alert(xhr.status+' : '+thrownError);				
		} 
   })	
})



$("#correctionForm").validate({
	rules:{
		feed_type: 'required',
		Make_UUID: 'required',
		Model_UUID: 'required',
		Vehicle_UUID: 'required',		
	},
	messages:{
		feed_type: '',
		Make_UUID: '',
		Model_UUID: '',
		Vehicle_UUID: '',		
	}
})


$(document).on('change', '.feedbackStatus', function(){
	$('.loading').removeClass('hide');
	var uid = $(this).attr('id');
	var status = $(this).val();
	 $.ajax({
		url: adm_bse_url+'change_feedback_status',
		type: 'POST',
		data:{uid: uid, status: status,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){				
			$('.loading').addClass('hide');
		},
		error: function (xhr, ajaxOptions, thrownError) {
		  $('.loading').addClass('hide');
		  alert(xhr.status+' : '+thrownError);				
		} 
   })		
})

$(document).on('change', '.show_feedback_types', function(){
	  $('.loading').removeClass('hide');
	  var types = $(this).val();	
	  var colname = $(this).attr('data-id');  
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'show_feedback_types',
		  type: 'POST',
		  data:{types: types, columnName: colname,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.usersData').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$("#feed_search").validate({
	rules:{
		searchkey: 'required'		
	},
	messages:{
		searchkey: ''		
	},submitHandler: function(form) {
		$('.loading').removeClass('hide');
		  $.ajax({
			  url: adm_bse_url+'search_feedback',
			  type: 'POST',
			  data:$('#feed_search').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
			  success: function( response ){
				  $('.usersData').html(response);
				  $('.loading').addClass('hide');
			  },
			  error: function(xhr, status, error) {
				$('.loading').addClass('hide');
				
				alert("Something went wrong, please try again");
			  }
		})			
	}
})

/*=========================Admin website add enable using AutoPro switcher==============*/


$(document).on('change', '.appSwitcher', function(){	
	var userid =  $(this).attr('id');	
	if($(this).parents('.toggle').hasClass('off')){
		var value = 0;
	}else{
	   var value = 1;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'enable_app',
		  type: 'POST',
		  data:{userid: userid, value: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})


$(document).on('change', '.select_obp_Models2', function(){
	$('.loading').removeClass('hide');
	  var make = $(this).val();	  
	  $.ajax({
		  url: adm_bse_url+'vehicles/get_obp_models2',
		  type: 'POST',
		  data:{makeId: make,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.getModels').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('change', '.select_obp_vehicles2', function(){
	  $('.loading').removeClass('hide');
	  var make = $(this).attr('data-id');
	  var model = $(this).val();	  
	  $.ajax({
		  url: adm_bse_url+'vehicles/get_obp_vehicles2',
		  type: 'POST',
		  data:{ModelId: model,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.getVehicles').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('click', '.addAnotherCodeSeries', function(){
	$('.loading').removeClass('hide');	  
	$.ajax({
		url: adm_bse_url+'vehicles/get_more_code_series',
		type: 'POST',
		data:{csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.code_series_box').append(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
    })
})

$(document).on('click', '.remove_series_holder', function(){
	$(this).parent('.series_holder').remove();
})

/*--------------------------------User Submission -----------------------------------------*/


$(document).on('change', '.show_status_user_submission', function(){
	var status = $(this).val();
	$('.loading').removeClass('hide');	  
	$.ajax({
		url: adm_bse_url+'us_by_status',
		type: 'POST',
		data:{status:status,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.userSubmission_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
    })
})

$(document).on('change', '.show_type_user_submission', function(){
	var status = $(this).val();
	$('.loading').removeClass('hide');
	if(status == 'all' ){
		location.reload();
	}else{	  
		$.ajax({
			url: adm_bse_url+'us_by_type',
			type: 'POST',
			data:{status:status,csrf_test_name: $.cookie('csrf_cookie_name')},
			success: function( response ){
				$('.userSubmission_data').html(response);
				$('.loading').addClass('hide');
			},
			error: function(xhr, status, error) {
			  $('.loading').addClass('hide');
			  
			  alert("Something went wrong, please try again");
			}
		})
	}
})



$("#search_user_submissions").validate({
	rules:{
		search_key: 'required'		
	},
	messages:{
		search_key: ''		
	},submitHandler: function(form) {
		$('.loading').removeClass('hide');
		  $.ajax({
			  url: adm_bse_url+'search_submissions',
			  type: 'POST',
			  data:$('#search_user_submissions').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
			  success: function( response ){
				  $('.userSubmission_data').html(response);
				  $('.loading').addClass('hide');
			  },
			  error: function(xhr, status, error) {
				$('.loading').addClass('hide');
				
				alert("Something went wrong, please try again");
			  }
		})			
	}
})

$(document).on('click', '.vehicle_sort_retainer', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');
	  var sorting_by = 	$(this).attr('data-by'); 
	  var makeId = $('.filterVehicleByMake option:selected').val();	 
	  var modelId = $('.filterVehicleByModel select option:selected').val();
	  var search_key = $('#searchVehicles input[name=search_key]').val();
	  $.ajax({
		  url: adm_bse_url+'vehicles/vehicle_common_sorting',//vehicle_sort_retainer',
		  type: 'POST',
		  data:{sorting: sorts, sorting_by: sorting_by,makeId:makeId,modelId:modelId,search_key:search_key,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			alert("Something went wrong, please try again");
		  }
	})
})

/*--------------------------- Code Series Sorting------------------------------------------*/

$(document).on('click', '.code_series_sort', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');
	  var sorting_by = 	$(this).attr('data-by');  
	  $.ajax({
		  url: adm_bse_url+'vehicles/code_series_sort',
		  type: 'POST',
		  data:{sorting: sorts, sorting_by: sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.code_series_data').html(response);
			  $('.loading').addClass('hide');
			  $('.site-pg').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('click', '.code_series_uuid_sort', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');
	  var sorting_by = 	$(this).attr('data-by');  
	  $.ajax({
		  url: adm_bse_url+'vehicles/code_series_uuid_sort',
		  type: 'POST',
		  data:{sorting: sorts, sorting_by: sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.code_series_data').html(response);
			  $('.loading').addClass('hide');
			  $('.site-pg').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('click', '.obp_opt_cateogry_sort', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');
	  var sorting_by = 	$(this).attr('data-by');  
	  $.ajax({
		  url: adm_bse_url+'vehicles/obp_opt_cateogry_sort',
		  type: 'POST',
		  data:{sorting: sorts, sorting_by: sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
			  $('.site-pg').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})


$(document).on('click', '.keys_uuid_sorting', function(){
	  $('.loading').removeClass('hide');
	  var sorts = $(this).attr('data_id');
	  var sorting_by = $(this).attr('data-by');	
	  //alert(sorts)
	  $.ajax({
		  url: adm_bse_url+'keys_uuid_sorting',
		  type: 'POST',
		  data:{sorting: sorts, sorting_by: sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

/*--------------------------------- key style sorting ------------------------------------*/

$(document).on('click', '.key_style_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var sorting_by = $(this).attr('data-by');
	$.ajax({
		url:adm_bse_url+'key_style_sorting',
		type:'POST',
		data:{sorting:sorts, sorting_by: sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')}, 
		success: function( response ){
			$('.chips_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
		
	})
})

$(document).on('click', '.key_type_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var sorting_by = $(this).attr('data-by');
	$.ajax({
		url:adm_bse_url+'key_type_sorting',
		type:'POST',
		data:{sorting:sorts, sorting_by: sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')}, 
		success: function( response ){
			$('.chips_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
		
	})
})

$(document).on('click', '.buttons_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var sorting_by = $(this).attr('data-by');
	$.ajax({
		url:adm_bse_url+'buttons_sorting',
		type:'POST',
		data:{sorting:sorts, sorting_by: sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')}, 
		success: function( response ){
			$('.tool_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).on('click', '.part_type_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var sorting_by = $(this).attr('data-by');
	$.ajax({
		url:adm_bse_url+'part_type_sorting',
		type:'POST',
		data:{sorting:sorts, sorting_by: sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')}, 
		success: function( response ){
			$('.tool_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).on('click', '.part_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var sorting_by = $(this).attr('data-by');
	$.ajax({
		url:adm_bse_url+'part_sorting',
		type:'POST',
		data:{sorting:sorts, sorting_by: sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')}, 
		success: function( response ){
			$('.tool_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})


$(document).on('click', '.manufacturers_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var sorting_by = $(this).attr('data-by');
	$.ajax({
		url:adm_bse_url+'manufacturers_sorting',
		type:'POST',
		data:{sorting:sorts, sorting_by: sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')}, 
		success: function( response ){
			$('.chips_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$().ready(function(){
$("#AddPurchaseForm").validate({
		rules:{
			Order_Number : "required",
			Customer_Name : "required",
			Customer_Email : "required",
		},
		messages:{
			Order_Number : "",
			Customer_Name :"",
			Customer_Email : "",
		}
	})		
})


$(function() {
     $( "#prchaseDate" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,	 
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
});

$(function() {
     $( ".datepickerDate" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,	 
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
});


$(document).on('click', '.purchases_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var sorting_by = $(this).attr('data-by');
	$.ajax({
		url:adm_bse_url+'purchases_sorting',
		type:'POST',
		data:{sorting:sorts, sorting_by: sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')}, 
		success: function( response ){
			$('.chips_data').html(response);
			//$('.site-pg').addClass('hide');
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).on('click', '.edit_purchase_inputs', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val')
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'edit_purchase_inputs',
		  type: 'POST',
		  data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.purchase_input_update', function(){
	$(this).parents('td').find('.edit_purchase_inputs').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'purchase_input_update',
		type: 'POST',
		data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		success: function( response ){
			$(i).parents('td').find('.td_data').html(response);		
			$(i).parents('.get_column_data').html('') 
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})
$(document).on('click', '.purchase_input_remove', function(){
	$(this).parents('td').find('.edit_purchase_inputs').removeClass('hide');
	$(this).parents('td').find('.purchase_input_update').removeClass('hide');
	$(this).parents('td').find('.get_column_data').html('')
})

$(document).on('click', '.feedback_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var sorting_by = $(this).attr('data-by');
	$.ajax({
		url:adm_bse_url+'feedback_sorting',
		type:'POST',
		data:{sorting:sorts, sorting_by: sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')}, 
		success: function( response ){
			$('.chips_data').html(response);
			$('.site-pg').addClass('hide');
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})


$(document).on('click', '.edit_feedback_inputs', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val')
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'edit_feedback_inputs',
		  type: 'POST',
		  data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})


$(document).on('click', '.feedback_input_update', function(){
	$(this).parents('td').find('.edit_feedback_inputs').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'feedback_input_update',
		type: 'POST',
		data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		success: function( response ){
			$(i).parents('td').find('.td_data').text(response);		
			$(i).parents('.get_column_data').html('') 
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})
$(document).on('click', '.feedback_input_remove', function(){
	$(this).parents('td').find('.edit_feedback_inputs').removeClass('hide');
	$(this).parents('td').find('.feedback_input_update').removeClass('hide');
	$(this).parents('td').find('.get_column_data').html('')
})

$("#search_feedbacks").validate({
		rules:{
			search_key : "required",			
		},
		messages:{
			search_key : "",			
		}, submitHandler: function(form){
			$('.loading').removeClass('hide');
			$.ajax({
				url: adm_bse_url+'search_feedbacks',
				type: 'POST',
				data: $('#search_feedbacks').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
				success: function( response ){
					$('.chips_data').html(response);
					$('.loading').addClass('hide');
				},
				error: function(xhr, status, error) {
				  $('.loading').addClass('hide');
				  
				  alert("Something went wrong, please try again");
				}
			})
		}
})

$(document).on('click', '.HideAddressed', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.addressed').addClass('hide');
		value = 1;
	}else{
		$('.addressed').removeClass('hide')
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'HideAddressed',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.HideCancelReturns', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.cancelReturn').addClass('hide');
		value = 1;
	}else{
		$('.cancelReturn').removeClass('hide')
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'HideCancelReturns',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('change', '.purchase_products_filter', function(){
	var value = $(this).val();
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'purchase_products_filter',
		type: 'POST',
		data: {value: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){	
			$('.chips_data').html(response);		  
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})



$("#search_purchases").validate({
  rules:{
	  search_key : "required",			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'search_purchases',
		  type: 'POST',
		  data: $('#search_purchases').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})

$(document).on('change', '.feedback_worked_filter', function(){
	var value = $(this).val();
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'feedback_worked_filter',
		type: 'POST',
		data: {value: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){	
			$('.chips_data').html(response);		  
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})



/*=============================== Admin Access Page Editing =========================================*/

$(document).on('click','.edit_adminAccess_inputs', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val')
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'edit_adminAccess_inputs',
		type: 'POST',
		data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$(thisval).html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})	
})

$(document).on('click', '.adminAccess_input_update', function(){
	$(this).parents('td').find('.edit_adminAccess_inputs').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'adminAccess_input_update',
		  type: 'POST',
		  data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $(i).parents('td').find('.td_data').html(response);		
			  $(i).parents('.get_column_data').html('') 
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})
$(document).on('click', '.adminAccess_input_remove', function(){
	$(this).parents('td').find('.edit_adminAccess_inputs').removeClass('hide');
	$(this).parents('td').find('.get_column_data').html('')
})


/*---------------------- Edit Annoucements ------------------------------------------*/

$(document).on('click', '.edit_announcements', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val')
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'autopropad/edit_announcements_input',
		  type: 'POST',
		  data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.annouce_input_update', function(){
	$(this).parents('td').find('.edit_announcements').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'autopropad/annouce_input_update',
		type: 'POST',
		data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		success: function( response ){
			$(i).parents('td').find('.td_data').text(response);		
			$(i).parents('.get_column_data').html('') 
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})
$(document).on('click', '.announce_input_remove', function(){
	$(this).parents('td').find('.edit_announcements').removeClass('hide');
	$(this).parents('td').find('.annouce_input_update').removeClass('hide');
	$(this).parents('td').find('.get_column_data').html('')
})

$(document).on('blur', '.purchase_sale_price', function(){
	var sale_price = $(this).val();
	var Support_Paid_Amount =  (sale_price *10)/100;
	$('.Support_Paid_Amount').val(Support_Paid_Amount);
	$('.Support_Paid_Amount2').val(Support_Paid_Amount);
})


$(document).on('click', '.HideSupportPaid', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.SupportPaid').addClass('hide');
		value = 1;
	}else{
		$('.SupportPaid').removeClass('hide')
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'HideSupportPaid',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.HideDMaxcheckbox', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.Dmax').addClass('hide');
		value = 1;
	}else{
		$('.Dmax').removeClass('hide')
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/HideDMaxcheckbox',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})


$(document).on('click', '.HideImage', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.HImage').addClass('hide');
		value = 1;
	}else{
		$('.HImage').removeClass('hide')
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/HideImage',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.HideParts', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.Parts').addClass('hide');
		value = 1;
	}else{
		$('.Parts').removeClass('hide')
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/HideParts',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.HideTypes', function(){
	var value = 0;
	if( $(this).is(':checked') ){
		$('.Types').addClass('hide');
		value = 1;
	}else{
		$('.Types').removeClass('hide')
		value = 0;
	}
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/HideTypes',
		  type: 'POST',
		  data: {remember: value,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('change', '.show_vehicle_by_type', function(){
	 $('.loading').removeClass('hide');
	  var type = $(this).val();		
	  $.ajax({
		  url: adm_bse_url+'vehicles/show_vehicle_by_type',
		  type: 'POST',
		  data:{type: type,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);
			  if(type =='All'){
				  location.reload();
			  }
			  $('.loading').addClass('hide');
			  $(".search_key").val('');	
			  $(".filterVehicleByMake").val('');
			  $(".model").val(''); 
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('click', '.addAnotherVehicle', function(){
	$.ajax({
		  url: adm_bse_url+'vehicles/get_obp_remote_vehicle',
		  type: 'POST',
		  data:{csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.getAnotherVehicle').append(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			alert("Something went wrong, please try again");
		  }
	})
})
$(document).on('click', '.remove_obp_vehcile ', function(){
	$(this).parents('.get_obp_remote_vehicle').remove();
})

$(document).on('change', '.select_obp_more_Models', function(){
	var i = this;
	$('.loading').removeClass('hide');
	  var make = $(this).val();	  
	  $.ajax({
		  url: adm_bse_url+'vehicles/select_obp_more_Models',
		  type: 'POST',
		  data:{makeId: make,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(i).parents('.get_obp_remote_vehicle').find('.get_more_Models').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('change', '.select_more_obp_vehicles', function(){
	 $('.loading').removeClass('hide');
	  var make = $(this).attr('data-id');
	  var model = $(this).val();	
	  var i = this;  
	  $.ajax({
		  url: adm_bse_url+'vehicles/get_obp_vehicles',
		  type: 'POST',
		  data:{ModelId: model,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			   $(i).parents('.get_obp_remote_vehicle').find('.getMoreVehicles').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

/*--------------------------------- Part Vehicle Section --------------------------------------*/

$(document).on('change', '.selectPartsModels', function(){
	$('.loading').removeClass('hide');
	  var make = $(this).val();	
	  if(make == ""){
		  $('.add_parts_vehicle').addClass('hide'); 
		  $('.loading').addClass('hide');
	  }else{
		  $.ajax({
			  url: adm_bse_url+'selectPartsModels',
			  type: 'POST',
			  data:{makeId: make,csrf_test_name: $.cookie('csrf_cookie_name')},
			  success: function( response ){
				  $('.getModels').html(response);
				  $('.loading').addClass('hide');
			  },
			  error: function(xhr, status, error) {
				$('.loading').addClass('hide');
				
				alert("Something went wrong, please try again");
			  }
		  })
	  }
})

$(document).on('change', '.select_parts_vehicles_years', function(){
	  $('.loading').removeClass('hide');
	  var make = $(this).attr('data-id');
	  var model = $(this).val();	  
	  $.ajax({
		  url: adm_bse_url+'select_parts_vehicles_years',
		  type: 'POST',
		  data:{ModelId: model,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.getYearsList').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('change', '.parts_years', function(){
	var makes = $(this).parents('.parts_vehicle_section').find('.makes option:selected').val();
	var models = $(this).parents('.parts_vehicle_section').find('.models option:selected').val();
	if( ($(this).val() == "") || (makes == "") || (models == "")){
		$('.add_parts_vehicle').addClass('hide');
	}else{
		$('.add_parts_vehicle').removeClass('hide');
	}
})
$(document).on('click', '.add_parts_vehicle', function(){
	var make = $(this).parents('.parts_vehicle_section').find('.makes option:selected').text();
	var models = $(this).parents('.parts_vehicle_section').find('.models option:selected').text();
	var parts_years = $(this).parents('.parts_vehicle_section').find('.parts_years option:selected').text();
	var parts_vehicle = $(this).parents('.parts_vehicle_section').find('.parts_years option:selected').val();
	$('.vehicle_text').append('<span> <input type="hidden" name="parts_vehicle[]" value="'+parts_vehicle+'">'+make +' '+ models +' '+ parts_years+' <i class="glyphicon glyphicon-remove removePartsVehicle"></i></span>');
	$(this).addClass('hide');
	$(this).parents('.parts_vehicle_section').find('.makes').prop('selectedIndex', 0);
	$(this).parents('.parts_vehicle_section').find('.models').prop('selectedIndex', 0);
	$(this).parents('.parts_vehicle_section').find('.parts_years').prop('selectedIndex', 0);
})

$(document).on('click', '.removePartsVehicle', function(){
	$(this).parent('span').remove();
})


/*----------------------------------- Edit Applications Columns --------------------------*/

$(document).on('click', '.edit_application_cols', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val')
	$('.loading').removeClass('hide');
	$.ajax({
	  url: adm_bse_url+'autopropad/edit_application_cols',
	  type: 'POST',
	  data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val,csrf_test_name: $.cookie('csrf_cookie_name')},
	  success: function( response ){
		  $(thisval).html(response);
		  $('.loading').addClass('hide');
	  },
	  error: function(xhr, status, error) {
		$('.loading').addClass('hide');
		
		alert("Something went wrong, please try again");
	  }
	})
})


$(document).on('click', '.application_input_update', function(){
	$(this).parents('td').find('.edit_application_cols').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'autopropad/application_input_update',
		type: 'POST',
		data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		success: function( response ){
			$(i).parents('td').find('.td_data').text(response);		
			$(i).parents('.get_column_data').html('') 
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})
$(document).on('click', '.application_input_remove', function(){
	$(this).parents('td').find('.edit_application_cols').removeClass('hide');
	$(this).parents('td').find('.application_input_update').removeClass('hide');
	$(this).parents('td').find('.get_column_data').html('')
})

$("#applicationForm").validate({
  rules:{
	  Make : "required",
	  Model_UUID : "required",
	  Year : "required",
  },
  messages:{
	  Make : "",
	  Model_UUID :"",
	  Year : "",
  }
})	

$(document).on('click', '.applications_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var sorting_by = $(this).attr('data-by');
	$.ajax({
		url:adm_bse_url+'autopropad/applications_sorting',
		type:'POST',
		data:{sorting:sorts, sorting_by: sorting_by,csrf_test_name: $.cookie('csrf_cookie_name')}, 
		success: function( response ){
			$('.chips_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).on('change', '.filterApplicationByMake', function(){
	$('.loading').removeClass('hide');
	  var make = $(this).val();	
	   var vehicle_models = "";  
	  $.ajax({
		  url: adm_bse_url+'autopropad/filterApplicationByMake',
		  type: 'POST',
		  data:{makeId: make,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);			  
			  $('.loading').addClass('hide');
			  $('.site-pg').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$("#searchApplication").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'autopropad/searchApplication',
		  type: 'POST',
		  data: $('#searchApplication').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
			  $('.site-pg').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})

$(document).on('change','.show_chips_filter', function(){
	$('.loading').removeClass('hide');
	var chip = $(this).val();
	$.ajax({
		url: adm_bse_url+'show_chips_filter',
		type: 'POST',
		data: {chip:chip,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.chips_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).ready(function() {
    $('input[type=radio][name=cloning_chip]').change(function() {
        if (this.value == 1) {
           $('.cloning_type').prop('readonly', false);
		   $('.Cloning_Machine').prop('disabled', false);
        }else if (this.value == 0) {
            $('.cloning_type').prop('readonly', true);
			$('.Cloning_Machine').prop('disabled', true);
        }
    });
});

$(document).on('click','.addMoreCloneWith', function(){
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'get_cloneable_chips',
		type: 'POST',
		data:{csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.addMoreCloneWithRow').append(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).on('click', '.removeMoreCloneWith', function(){
	$(this).parents('.clone-with-holder').remove();
}) 

$(document).on('click','.addMoreToolType', function(){
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'get_more_tools_type',
		type: 'POST',
		data:{csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.addMoreToolTypeRow').append(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).on('click', '.removeMoreToolType', function(){
	$(this).parents('.clone-with-holder').remove();
})

$(document).on('click','.addMoreCloneMachine', function(){
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'get_more_clone_machine',
		type: 'POST',
		data:{csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.addMoreCloneMachineRow').append(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})
$(document).on('click', '.ez_pages_locations', function(){
	var value = $(this).val();
	if(value ==='Tool References'){
		$('.ManufacturerRow').removeClass('hide')
	}else{
		$('.ManufacturerRow').addClass('hide')
	}
})

$(document).on('change','.filter_keysby_types', function(){
	var location = $(this).val();
	if(location ==='Tool References'){
		$('.ezpages_Manufacturer').removeClass('hide')
	}else{
		$('.ezpages_Manufacturer').addClass('hide')
	}
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'filter_keysby_types',
		type: 'POST',
		data:{location: location,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.chips_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})
$(document).on('change','.filter_ezpages_Manufacturer', function(){
	var location = $(this).val();

	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'filter_ezpages_Manufacturer',
		type: 'POST',
		data:{location: location,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.chips_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})


$(document).on('change','.data_sort_order', function(){
	var order = $(this).val();
	var id = $(this).attr('id');
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'data_sort_order',
		type: 'POST',
		data:{order: order,id:id,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).on('click', '.addMoreLockType', function(){
	$('.loading').removeClass('hide');	  
	$.ajax({
		url: adm_bse_url+'addMoreLockType',
		type: 'POST',
		data:{csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.more_lock_type_holder').append(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
    })
})
$(document).on('click', '.removeLockType', function(){
	$(this).parents('.row-holder').remove();
})
$(document).on('change', '.select_page_types', function(){
	var page_type = $(this).val();
	$('.loading').removeClass('hide');	  
	$.ajax({
		url: adm_bse_url+'select_page_types',
		type: 'POST',
		data:{page_type:page_type,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.pageContentHolder').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
    })
})

$(document).on('click', '.show_approved', function(){
	if($(this).is(':checked')){
		$('tr.approved').removeClass('hide')
	}else{
		$('tr.approved').addClass('hide')
	}
})
$(document).on('click', '.show_rejected', function(){
	if($(this).is(':checked')){
		$('tr.rejected_hide').removeClass('hide')
	}else{
		$('tr.rejected_hide').addClass('hide')
	}
})
$(document).on('click', '.show_pending', function(){
	if($(this).is(':checked')){
		$('tr.pending').removeClass('hide')
	}else{
		$('tr.pending').addClass('hide')
	}
})

$("#searchFeedbacks").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'search_user_feedbacks',
		  type: 'POST',
		  data: $('#searchFeedbacks').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.userSubmission_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})

$("#searchUsers").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
  		$('.users_data').html('');
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'search_aks_users',
		  type: 'POST',
		  data: $('#searchUsers').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.users_data').html(response);
			  $('.loading').addClass('hide');
			  $('.site-pg').empty();
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})

$(document).on('click','.aks_users_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var column = $(this).attr('data-col');
	//alert('angle');
	$.ajax({
		url: adm_bse_url+'aks_users_sorting',
		type: 'POST',
		data: {sorting: sorts, sorting_by:column,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.tool_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).on('click','.ezpages_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var column = $(this).attr('data-col');
	//alert('angle');
	$.ajax({
		url: adm_bse_url+'ezpages_sorting',
		type: 'POST',
		data: {sorting: sorts, sorting_by:column,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.chips_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})


$("#searchUsersFeedbacks").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'search_users_feedbacks',
		  type: 'POST',
		  data: $('#searchUsersFeedbacks').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.userSubmission_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})

$(document).on('change', '.show_feedback_by_type', function(){
	var page_type = $(this).val();
	$('.loading').removeClass('hide');	  
	$.ajax({
		url: adm_bse_url+'show_feedback_by_type',
		type: 'POST',
		data:{page_type:page_type,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.userSubmission_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
    })
})

$("#searchKeymakingMethod").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'search_keymaking_method',
		  type: 'POST',
		  data: $('#searchKeymakingMethod').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.tool_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})

$("#searchTipsTricks").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/search_tips_tricks',
		  type: 'POST',
		  data: $('#searchTipsTricks').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.tool_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})


$(document).on('click','.tips_tricks_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var column = $(this).attr('data-col');
	//alert('angle');
	$.ajax({
		url: adm_bse_url+'vehicles/tips_tricks_sorting',
		type: 'POST',
		data: {sorting: sorts, sorting_by:column,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.tool_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).on('click','.keymaking_method_sorting', function(){
	$('.loading').removeClass('hide');
	var sorts = $(this).attr('data_id');
	var column = $(this).attr('data-col');
	//alert('angle');
	$.ajax({
		url: adm_bse_url+'keymaking_method_sorting',
		type: 'POST',
		data: {sorting: sorts, sorting_by:column,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.tool_data').html(response);
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).on('change','.tipTrick_score_order', function(){
	var order = $(this).val();
	var id = $(this).attr('id');
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'vehicles/tipTrick_score_order',
		type: 'POST',
		data:{order: order,id:id,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).on('change','.keymakingMethod_score_order', function(){
	var order = $(this).val();
	var id = $(this).attr('id');
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'keymakingMethod_score_order',
		type: 'POST',
		data:{order: order,id:id,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).ready(function($) {
    $('#search').multiselect({
        search: {
            left: '',
            right: '',
        },
        fireSearch: function(value) {
            return value.length > 3;
        }
    });
});
$(".chosen").chosen();
$(document).on('keyup','.searchAvailableVehicles', function(){
	var search_key = $(this).val();
	$('.loading').removeClass('hide');
	$.ajax({
		  url: adm_bse_url+'vehicles/searchAvailableVehicles',
		  type: 'POST',
		  data: {search_key:search_key,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.searchAvailableVehiclesHolder').html(response);
			  $('.loading').addClass('hide');
			  $('.site-pg').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})
$(document).on('keyup','.searchAvailableVehicles2', function(){
	var search_key = $(this).val();
	$('.loading').removeClass('hide');
	$.ajax({
		  url: adm_bse_url+'vehicles/searchAvailableVehicles2',
		  type: 'POST',
		  data: {search_key:search_key,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.searchAvailableVehiclesHolder').html(response);
			  $('.loading').addClass('hide');
			  $('.site-pg').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('change', '.filterMethodsByMake', function(){
	$('.loading').removeClass('hide');
	  var make = $(this).val();	
	  var res = make.split("|");
	   var vehicle_models = "";  
	  $.ajax({
		  url: adm_bse_url+'get_keymaking_methods_models',
		  type: 'POST',
		  data:{search_key: res[1],makeId:res[0],type:'modal',csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  var x = $(response).filter('div');
			  vehicle_models = x.filter('#vehicle_models').html();			 
			  var vehicle_data = x.filter('#vehicle_data').html();	
			  $('.getModels').html(vehicle_models);
			  $('.tool_data').html(vehicle_data);			  
			  $('.loading').addClass('hide');
			  $('.site-pg').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})
$(document).on('change', '.filterMakeByModel select', function(){
	  $('.loading').removeClass('hide');
	  var model = $(this).val();
	  var res = model.split("|");	  
	  $.ajax({
		  url: adm_bse_url+'get_keymaking_methods_models',
		  type: 'POST',
		  data:{modelId: res[0],search_key:res[1],type:'years',csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  var x = $(response).filter('div');
			  vehicle_models = x.filter('#vehicle_models').html();			 
			  var vehicle_data = x.filter('#vehicle_data').html();	
			  $('.getYears').html(vehicle_models);
			  $('.tool_data').html(vehicle_data);			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})
$(document).on('change', '.filterMakeByYears select', function(){
	  $('.loading').removeClass('hide');
	  var year = $(this).val();	  
	  $.ajax({
		  url: adm_bse_url+'get_keymaking_methods_models',
		  type: 'POST',
		  data:{search_key:year,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  var x = $(response).filter('div');
			  vehicle_models = x.filter('#vehicle_models').html();			 
			  var vehicle_data = x.filter('#vehicle_data').html();	
			  //$('.getYears').html(vehicle_models);
			  $('.tool_data').html(vehicle_data);			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$("#searchMacineReports").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'search_machine_reports',
		  type: 'POST',
		  data: $('#searchMacineReports').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.tool_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})

$(document).on('change', '.filterMacineReport, .filterMacineResultReport', function(){
	  $('.loading').removeClass('hide');
	  var machine = $('.filterMacineReport :selected').val();
	  var result = $('.filterMacineResultReport :selected').val();	
	  var colname = $(this).attr('col-name');	
	  var type = 'top';  
	  $.ajax({
		  url: adm_bse_url+'filterMacineReport',
		  type: 'POST',
		  data:{machine:machine,colname:colname,result:result,type:type,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.tool_data').html(response);			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('click', '.machineData .m_data', function(){
	  $('.loading').removeClass('hide');	
	  var result = $(this).attr('data-result');	
	  var machine = $(this).attr('data-val');  
	  var type = 'top_bar'; 
	  $.ajax({
		  url: adm_bse_url+'filterMacineReport',
		  type: 'POST',
		  data:{machine:machine,result:result,type:type,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.tool_data').html(response);			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('keyup','.searchAvailableVehiclesMethod', function(){
	var search_key = $(this).val();
	$('.loading').removeClass('hide');
	$.ajax({
		  url: adm_bse_url+'vehicles/searchAvailableVehiclesMethod',
		  type: 'POST',
		  data: {search_key:search_key,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.searchAvailableVehiclesHolder').html(response);
			  $('.loading').addClass('hide');
			  $('.site-pg').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})
$(document).on('click','.limitVehicleTransponder', function(){
	var search_key = $(this).val();
	$('.loading').removeClass('hide');
	$.ajax({
		  url: adm_bse_url+'vehicles/limitVehicleTransponder',
		  type: 'POST',
		  data: {search_key:search_key,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.searchAvailableVehiclesHolder').html(response);
			  $('.loading').addClass('hide');
			  $('.site-pg').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('change', '.filterVehicleImagesByMake', function(){
	$('.loading').removeClass('hide');
	  var make = $(this).val();	
	  var res = make.split("|");
	   var vehicle_models = "";  
	  $.ajax({
		  url: adm_bse_url+'vehicles/vehicles_image_filter_data',
		  type: 'POST',
		  data:{search_key: res[1],makeId:res[0],type:'modal',csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  var x = $(response).filter('div');
			  vehicle_models = x.filter('#vehicle_models').html();			 
			  var vehicle_data = x.filter('#vehicle_data').html();	
			  $('.getModels').html(vehicle_models);
			  $('.tool_data').html(vehicle_data);			  
			  $('.loading').addClass('hide');
			  $('.site-pg').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('change', '.filterVehicleImageByModel select', function(){
	  $('.loading').removeClass('hide');
	  var model = $(this).val();
	  var res = model.split("|");	  
	  $.ajax({
		  url: adm_bse_url+'vehicles/vehicles_image_filter_data',
		  type: 'POST',
		  data:{modelId: res[0],search_key:res[1],type:'years',csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  var x = $(response).filter('div');
			  vehicle_models = x.filter('#vehicle_models').html();			 
			  var vehicle_data = x.filter('#vehicle_data').html();	
			  $('.getYears').html(vehicle_models);
			  $('.tool_data').html(vehicle_data);			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})
$(document).on('change', '.filterVehicleImageByYears select', function(){
	  $('.loading').removeClass('hide');
	  var year = $(this).val();	  
	  $.ajax({
		  url: adm_bse_url+'vehicles/vehicles_image_filter_data',
		  type: 'POST',
		  data:{search_key:year,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  var x = $(response).filter('div');
			  vehicle_models = x.filter('#vehicle_models').html();			 
			  var vehicle_data = x.filter('#vehicle_data').html();	
			  //$('.getYears').html(vehicle_models);
			  $('.tool_data').html(vehicle_data);			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$("#searchVehicleImage").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'vehicles/searchVehicleImage',
		  type: 'POST',
		  data: $('#searchVehicleImage').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.tool_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})

$(document).on('click','.addMoreImages', function(){
	var timestamp = 'id_'+new Date().getUTCMilliseconds();
	var html = '<div class="row"><div class="imageRow" id="imageRow"> <div class="col-sm-4"> <div class="labelcol"> <label class="control-label">Images</label> </div></div><div class="col-sm-10"> <div class="inputcol"> <input type="text" class="form-control" id="'+timestamp+'" value="" name="Image_path[]" readonly="readonly"> </div></div><div class="col-sm-2"><div class="previewImage" id="'+timestamp+'Img"></div></div><div class="col-sm-3" style="width: 11.9%;"> <span id="fileselector"> <label class="btn btn-info" for="upload-file-selector" style="margin-top: 15px;"> <input type="file" name="filename_'+timestamp+'" data-id="'+timestamp+'" onchange="imageUpload2(event)" > </label> </span> </div><span class="glyphicon glyphicon-remove removeImageRow" aria-hidden="true"></span></div></div>';
	$('.moreImageHolder').append(html);
	var length = $('.imageRow').length;
	if(length >= 3){
		$(this).addClass('hide')
	}

})
$(document).on('click','.removeImageRow', function(){
	$(this).parent('.imageRow').remove();
	var length = $('.imageRow').length;
	if(length <= 3){
		$('.addMoreImages').removeClass('hide')
	}
})


$(document).on('change', '.filter_announcements_types', function(){
	  $('.loading').removeClass('hide');
	  var year = $(this).val();	  
	  $.ajax({
		  url: adm_bse_url+'filter_announcements_data',
		  type: 'POST',
		  data:{search_key:year,type:'types',csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.chips_data').html(response);			  
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$("#searchAnnouncements").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'filter_announcements_data',
		  type: 'POST',
		  data: $('#searchAnnouncements').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})

$("#searchAdminUsers").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'search_admin_users',
		  type: 'POST',
		  data: $('#searchAdminUsers').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.tool_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})
var validUserType = 0;
$(document).on('blur','#users_types', function(){	
	var type = $(this).val();
	if(type !="" ){
		$('.loading').removeClass('hide');
		$.ajax({
			  url: adm_bse_url+'check_user_types',
			  type: 'POST',
			  data: {type:type,csrf_test_name: $.cookie('csrf_cookie_name')},
			  success: function( response ){
				if(response > 0){
					$('.availabilty').html('<font color="red">Type is already exists.</font>');
					validUserType = 1;
				}else{
					$('.availabilty').html('<font color="green">Type is available.</font>');
					validUserType = 0;
				}			  
				$('.loading').addClass('hide');
			  } ,
			  error: function(xhr, status, error) {
				$('.loading').addClass('hide');
				
				alert("Something went wrong, please try again");
			  }
		})
	}
})

$("#add_user_type").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  },submitHandler: function(form){	  
	  if(validUserType == 1){
	  	$('#users_types').focus();
	  }else{
	  	form.submit();
	  }
  }
})

$(document).on('change','.enableAllItems', function(){
	if($(this).is(':checked')){
		$(this).parents('fieldset').find('.inputToggel').bootstrapToggle('on');
	}else{
		$(this).parents('fieldset').find('.inputToggel').bootstrapToggle('off');
	}
})

$(document).on('click', '.show_enabled_announcements', function(){
	$('.inactive').toggleClass('hide')
})

$(document).on('change', '.changeActivation', function(){
	if( $(this).is(':checked') ){
		var active = 'Yes';
	}else{
		var active = 'No';	
	}	
	var id = $(this).attr('data-id');
	console.log(active);
	$('.loading').removeClass('hide');
	$.ajax({
		  url: adm_bse_url+'change_activation',
		  type: 'POST',
		  data: {active:active,id:id,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){			  
			$('.loading').addClass('hide');
		  } ,
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('change','.select_announcements_type',function(){
	if( $(this).val() == 'View With Version Update'){
		$('.versionRow').removeClass('hide');
	}else{
		$('.versionRow').addClass('hide');	
	}
	
})

$(document).on('click','.firebaseUpdate', function(){
	$('.updatingLoading').removeClass('hide');
	move();
})
function move() {
  var elem = document.getElementById("myBar");   
  var width = 1;
  var id = setInterval(frame, 50);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
    }
  }
}

$(document).on('change','.avatars_sort_order', function(){
	var order = $(this).val();
	var id = $(this).attr('id');
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'avatars_sort_order',
		type: 'POST',
		data:{order: order,id:id,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).on('change','.testimonials_sort_order', function(){
	var order = $(this).val();
	var id = $(this).attr('id');
	var data_table = $(this).attr('data-table');
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'autopropad/testimonials_sort_order',
		type: 'POST',
		data:{order: order,id:id,data_table:data_table,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})

$(document).on('click', '.showMissingCodeSeries', function(){
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'vehicles/show_missing_code_series',
		type: 'POST',
		data:{type:'t_Vehicles.Code_Series_UUID',csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('click', '.showMissingImages', function(){
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'vehicles/show_missing_images',
		type: 'POST',
		data:{type:'t_Vehicles.Vehicle_Image',csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			  $('.chips_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			alert("Something went wrong, please try again");
		  }
	})
})

$(document).on('keyup','.searhAksUser', function(){
	var search_key = $(this).val();
	if(search_key != ""){
		$('.loading').removeClass('hide');
		$.ajax({
			  url: adm_bse_url+'vehicles/searhAksUser',
			  type: 'POST',
			  data: {search_key:search_key,csrf_test_name: $.cookie('csrf_cookie_name')},
			  success: function( response ){
				  $('.usersResults').html(response);
				  $('.loading').addClass('hide');
				  $('.site-pg').addClass('hide');
			  },
			  error: function(xhr, status, error) {
				$('.loading').addClass('hide');
				
				alert("Something went wrong, please try again");
			  }
		  })
	}
})


$(document).on('click', '.edit_all_inputs', function(){
	$(this).addClass('hide');
	var thisval = $(this).parents('td').find('.get_column_data');
	var UUId =  $(this).attr('id');
	var data_id = $(this).attr('data-id');
	var data_column = $(this).attr('data-col');	
	var data_val = $(this).attr('data-val');
	var tablename = $(this).attr('data-table');
	$('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'edit_all_inputs',
		  type: 'POST',
		  data: {uuId: UUId, dataId: data_id, column: data_column, value: data_val,tablename:tablename,csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $(thisval).html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
})

$(document).on('click', '.all_input_update', function(){
	$(this).parents('td').find('.edit_all_inputs').removeClass('hide');
	var formName = $(this).parents('form');	
	var i = this;
	$('.loading').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'all_input_update',
		type: 'POST',
		data: $(formName).serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		success: function( response ){
			$(i).parents('td').find('.td_data').text(response);		
			$(i).parents('.get_column_data').html('') 
			$('.loading').addClass('hide');
		},
		error: function(xhr, status, error) {
		  $('.loading').addClass('hide');
		  
		  alert("Something went wrong, please try again");
		}
	})
})
$(document).on('click', '.all_input_remove', function(){
	$(this).parents('td').find('.edit_all_inputs').removeClass('hide');
	$(this).parents('td').find('.all_input_update').removeClass('hide');
	$(this).parents('td').find('.get_column_data').html('')
})

$("#searchCodeList").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'search_code_list',
		  type: 'POST',
		  data: $('#searchCodeList').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.tool_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})

$(document).on('change','.filter_keysby_types', function(){
    var options = $('select.filter_ezpages_Manufacturer option');
    var arr = options.map(function(_, o) {
        return {
            t: $(o).text(),
            v: o.value
        };
    }).get();
    arr.sort(function(o1, o2) {
        return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
    });
    options.each(function(i, o) {
        console.log(i);
        o.value = arr[i].v;
        $(o).text(arr[i].t);
    });
});
$(document).ready(function(){
	var options = $('select.filter_ezpages_Manufacturer option');
    var arr = options.map(function(_, o) {
        return {
            t: $(o).text(),
            v: o.value
        };
    }).get();
    arr.sort(function(o1, o2) {
        return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
    });
    options.each(function(i, o) {
        console.log(i);
        o.value = arr[i].v;
        $(o).text(arr[i].t);
    });
});

$(document).on('click', '.copyContent', function(){
	  $('.copyContent').text('Copy');
	  $(this).text('Copied!');	
	  var element = $(this).attr('data_id');	
	  var $temp = $("<input>");
	  $("body").append($temp);
	  $temp.val($(element).html()).select();
	  document.execCommand("copy");
	  $temp.remove();
})
$(document).on('click', '.previewData', function(){
	  var element = $(this).attr('data_id');
	  var data = $(element).html();
	  $('#mycontentModal').modal();
	  $('#mycontentModal .modal-body textarea').html(data);
})
$(document).on('click', '.previewVehicleData', function(){
	  var element = $(this).attr('data_id');
	  var data = $(element).text();
	  $('#mycontentModal').modal();
	  $('#mycontentModal .modal-body textarea').html(data);
})

$(document).on('click', '.copyVehicleContent', function(){
	  $('.copyContent').text('Copy');
	  $(this).text('Copied!');	
	  var element = $(this).attr('data_id');	
	  var $temp = $("<input>");
	  $("body").append($temp);
	  $temp.val($(element).text()).select();
	  document.execCommand("copy");
	  $temp.remove();
})

$(document).on('change', '.ls_complete', function(){
	$('.loading').removeClass('hide');
	var uid = $(this).attr('data-id');
	if( $(this).is(':checked') ){
		var status = 'Yes';
	}else{
		var status = 'No';	
	}
	//var status = $(this).val();
	 $.ajax({
		url: adm_bse_url+'ls_complete',
		type: 'POST',
		data:{uid: uid, status: status,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){				
			$('.loading').addClass('hide');
		},
		error: function (xhr, ajaxOptions, thrownError) {
		  $('.loading').addClass('hide');
		  alert(xhr.status+' : '+thrownError);				
		} 
   })	
})

$(document).on('change', '.machine_worked_status', function(){
	$('.loading').removeClass('hide');
	var uid = $(this).attr('data-id');
	if( $(this).is(':checked') ){
		var status = 'Yes';
	}else{
		var status = 'No';	
	}
	//var status = $(this).val();
	 $.ajax({
		url: adm_bse_url+'machine_worked_status',
		type: 'POST',
		data:{uid: uid, status: status,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){				
			$('.loading').addClass('hide');
		},
		error: function (xhr, ajaxOptions, thrownError) {
		  $('.loading').addClass('hide');
		  alert(xhr.status+' : '+thrownError);				
		} 
   })	
})

$("#searchLSConnect").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'search_Ls_connect',
		  type: 'POST',
		  data: $('#searchLSConnect').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.tool_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})

$("#searchConvertCodeList").validate({
  rules:{
	  search_key :{
	  	required: true
	 },			
  },
  messages:{
	  search_key : "",			
  }, submitHandler: function(form){
	  $('.loading').removeClass('hide');
	  $.ajax({
		  url: adm_bse_url+'search_convert_code_list',
		  type: 'POST',
		  data: $('#searchConvertCodeList').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
		  success: function( response ){
			  $('.tool_data').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
  }
})

$(document).on('click', '.showLsComplete', function(){
	$('.complete').toggleClass('hide')
})

$(document).on('click', '.ShowAutoProPADOnly', function(){
	$('.AutoProPAD').removeClass('hide');
	$('.Types').addClass('hide');
	$('.HImage').addClass('hide');
	$('.code_keyInfo').addClass('hide');
	$('.AdvDiagn').addClass('hide');
	$('.Hotwire').addClass('hide');
	$('.TKOSDD').addClass('hide');
	$('.Dmax').addClass('hide');
	$('.ProLok').addClass('hide');
	$('.Parts').addClass('hide');
	$('.vehicles_checkbox input[type=checkbox]').prop('checked', true);
	$('.vehicles_checkbox .HideAutoProPAD').prop('checked', false)
})

/*$(function() {
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');
    $('#autoproapp_version_form').ajaxForm({
        beforeSend: function() {
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal);
            percent.html(percentVal);
            $('.loading').removeClass('hide');
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal);
            percent.html(percentVal);
        },
        complete: function(xhr) {
            status.html(xhr.responseText);
            $('.loading').addClass('hide');
            $('#autoproapp_version_form')[0].reset();
        }
    });
}); */

function getUserContribution(){
	 $.ajax({
		  url: adm_bse_url+'getUserContribution',
		  type: 'POST',
		  data:{csrf_test_name: $.cookie('csrf_cookie_name')},
		  success: function( response ){
			  $('.usersContribution').html(response);
			  $('.loading').addClass('hide');
		  },
		  error: function(xhr, status, error) {
			$('.loading').addClass('hide');
			
			alert("Something went wrong, please try again");
		  }
	  })
}

// setInterval(function(){ 
// 	getUserContribution();
// }, 15000);

$(document).on('change','.obdcategory',function(){
	if( $(this).val() == 'OBD2' ) {
		$('.Obdmake').removeClass('hide')
	}else{
		$('.Obdmake').addClass('hide')
	}
})
$(document).on('change', '.showOnAutoPad', function(){
	$('.loading').removeClass('hide');
	var uid = $(this).attr('checkid');
	var status = $(this).val();
	 $.ajax({
		url: adm_bse_url+'autopropad/show_on_autopad',
		type: 'POST',
		data:{uid: uid, status: status,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){				
			$('.loading').addClass('hide');
		},
		error: function (xhr, ajaxOptions, thrownError) {
		  $('.loading').addClass('hide');
		  alert(xhr.status+' : '+thrownError);				
		} 
   })	
})

function vehicle_info_ajax(part){
	$('#loader').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'vehicle_info_ajax/'+part,
		type: 'POST',
		data:{part: part,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			//console.log(response);
			if(response == 200){
				var next_part = part+1;
				$('#vid_'+part).addClass('active');
				$('#vid_'+part+' a').html('Update Vehicle Info Part'+part+' &#10004;');
				var total_pg = $('.vparts_updates').attr('data-total');
				if(next_part > total_pg){
					$('#loader').addClass('hide');
					$('.v-succuess').html('<h3>Data updated successfully</h3>');
				}else{
					setTimeout(() => {
						vehicle_info_ajax(next_part);
					}, 2000);
					
				}				
			}else{
				alert(response+', Something is wrong, please try again');
				$('#loader').addClass('hide');
			}				
			
		},
		error: function (xhr, ajaxOptions, thrownError) {
		  $('#loader').addClass('hide');
		    setTimeout(() => {
				vehicle_info_ajax(part);
			}, 1000);			
		} 
   })	
}
var url      = window.location.href;  
if( (url == 'https://autoproapp.com/admpro/update_vehicle_info') || (url== 'https://www.autoproapp.com/admpro/update_vehicle_info') ){
	window.addEventListener('load', 
  function() { 
    vehicle_info_ajax(1);
  }, false);
}
function DeleteCashBackRequest(id, url){
	var r = confirm("Are you sure you would like to delete? This action cannot be undone.");
	if(r==true){
		 window.location.href = url+''+id;
	  }else{
	 }
}
$(document).on('change','.changefile',function(){
	var file1 = $("#file1").val();
	var file2 = $("#file2").val();
	if(file1 !=""){
	//ssalert(filename);
	var extension = file1.replace(/^.*\./, '');
	
		if(extension =='jpg' || extension =='png'){
			$('.image1').html('');	
			$(".submit-btn").attr("type","submit");
			var data =  $("#cashbackRequest").attr("action",bse_url+"admin/autopropad/update_cashback_request");
		}else{			
			var data =  $("#cashbackRequest").attr("action","#");			
			 $('.image1').html('Please select only PNG and JPG image');	
			$(".submit-btn").attr("type","button");
		}
	}
	
	
})
$(document).ready(function(){	
	$("#editcashbackRequest").validate({
		rules:{			
			first_name:'required',
			last_name:'required',	
			address1:'required',
			address2:'required',
			city:'required',
			state:	'required',
			zip_code:	'required',
			email:{
				required :true,
				email:true
			},			
			agree:'required',
			user_name:"required",
			purchase_date:"required",
			phone:{
				 required  : true,
				 minlength : 10,
				maxlength : 10
				
			},
			
					
		},messages:{			
			first_name:"",
			last_name:"",
			address1:"",
			address2:"",
			city:"",
			state:"",
			zip_code:"",
			email:"",			
			purchase_date:"",
			phone:"",
		}
	})
})

$(document).on('click', '.showStatus', function(){
	$('.loading').removeClass('hide');
	var value_var = "";
	$('.showStatus').each( function(){
		var i  = this;		
		if( $(i).is(':checked')){
			value_var +=$(i).val()+',';
		}else{
			value_var +='';
		}
	})
	$.ajax({
		url: adm_bse_url+'user_submissions_status',
		type: 'POST',
		data:{status: value_var,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){				
			//$('.loading').addClass('hide');
			location.reload();
		},
		error: function (xhr, ajaxOptions, thrownError) {
		  $('.loading').addClass('hide');
		  alert(xhr.status+' : '+thrownError);				
		} 
   })	
})


$("#globalSearchKyes").validate({
	rules:{
		search_global_key : "required",			
	},
	messages:{
		search_global_key : "",			
	}, submitHandler: function(form){
		$('.loading').removeClass('hide');
		$.ajax({
			url: adm_bse_url+'search_global_key',
			type: 'POST',
			data: $('#globalSearchKyes').serialize()+ "&csrf_test_name=" + $.cookie('csrf_cookie_name'),
			success: function( response ){
				$('.table-responsive').html(response);
				$('.loading').addClass('hide');
			},
			error: function(xhr, status, error) {
			  $('.loading').addClass('hide');
			  var err = eval("Something went wrong, please try again");
			  alert("Something went wrong, please try again");
			}
		})
	}
})
$(document).on('click', '.nav-menu-collapse-holder', function(){
	$('#main-con').toggleClass('collapse-menus');
})
$(document).ready(function(){
	$(document).on('change', '#csv_file', function(){
		var file1 = $("#csv_file").val();	
		if(file1 !=""){	
			var extension = file1.replace(/^.*\./, '');	
			if(extension !="csv"){
				$('.importmsg').html('Please select only csv file.');
				$("#import_csv_btn").attr("type","button");			
			}else{			
				$("#import_csv_btn").attr("type","submit");						
				$('.importmsg').html('');
			}
		}
	});
	$(document).on('change', '#key_csv_file', function(){
		var file1 = $("#key_csv_file").val();	
		if(file1 !=""){	
			var extension = file1.replace(/^.*\./, '');	
			if(extension !="csv"){
				$('.keyimportmsg').html('Please select only csv file.');
				$("#key_import_csv_btn").attr("type","button");			
			}else{			
				$("#key_import_csv_btn").attr("type","submit");						
				$('.keyimportmsg').html('');
			}
		}
	});	
});

function aks_customers_info_ajax(part){
	$('#loader').removeClass('hide');
	$.ajax({
		url: adm_bse_url+'aks_customers_info_ajax/'+part,
		type: 'POST',
		data:{part: part,csrf_test_name: $.cookie('csrf_cookie_name')},
		success: function( response ){
			//console.log(response);
			if(response > 0){
				var next_part = part+1;
				$('#vid_'+part).addClass('active');
				$('#vid_'+part+' a').html('Update Vehicle Info Part'+part+' &#10004;');
				var total_pg = $('.vparts_updates').attr('data-total');
				if(next_part > total_pg){
					$('#loader').addClass('hide');
					$('.v-succuess').html('<h3>Data updated successfully</h3>');
				}else{
					setTimeout(() => {
						aks_customers_info_ajax(next_part);
					}, 2000);
					
				}				
			}else{
				alert(response+', Something is wrong, please try again');
				$('#loader').addClass('hide');
			}				
			
		},
		error: function (xhr, ajaxOptions, thrownError) {
		  $('#loader').addClass('hide');
		    setTimeout(() => {
				aks_customers_info_ajax(part);
			}, 1000);			
		} 
   })	
}
var url      = window.location.href;
if( (url == 'https://autoproapp.com/admpro/update_aks_users_with_aks') || (url== 'https://www.autoproapp.com/admpro/update_aks_users_with_aks') ){  
	window.addEventListener('load', 
  function() { 
    aks_customers_info_ajax(1);
  }, false);
}
setTimeout(function(){ $(".alert").fadeOut(); }, 5000);




$(document).on('keyup', '.decimalInput', function(){
	var sanitizedValue = $(this).val().replace(/[^\d.]/g, '');
	if (sanitizedValue.length > 1 && sanitizedValue.startsWith('0') && !sanitizedValue.startsWith('0.')) {
		sanitizedValue = sanitizedValue.substr(1);
	}
	var decimalIndex = sanitizedValue.indexOf('.');
	if (decimalIndex !== -1) {
		var decimalPart = sanitizedValue.substr(decimalIndex + 1);
		if (decimalPart.length > 1) {
			sanitizedValue = sanitizedValue.substr(0, decimalIndex + 2);
		}
	}
	$(this).val(sanitizedValue);
});
