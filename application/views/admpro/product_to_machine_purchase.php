<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
        <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
    <?php } ?>
        <div class="row">
            <div class="col-sm-12 col-md-12"> 
                    <form class="site-form " method ="post" id="AddPurchaseForm" action="<?php echo adm_base_url();?>/save_product_to_machine_purchase">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                        
                        <div class="row">
                        <div class=" col-sm-4 ">
                            <div class="labelcol">
                            <label class="control-label">Name</label>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="inputcol">
                            <input type="text" class="form-control" placeholder="Name" name="purchases_machine">
                            </div>
                        </div>
                        </div>        
                    <hr>
                        <div class="row">
                            <div class=" col-sm-4 ">
                            <div class="labelcol">
                            <label class="control-label"></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success" name="post">Submit</button>
                            <a href="<?php echo adm_base_url();?>/purchase_history" class="btn btn-danger">Back</a>
                        </div>   
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-12"> 
                <table class="table table-bordered  table-data mar0 tab-con">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($results as $value){?>
                            <tr>
                                <td><?php echo $value['machine'];?></td>
                                <td>
                                    <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_product_to_machine_purchase/')"  type="button" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php }?>                        
                    </tbody>
                </table>
            </div>
        </div>    
  </div>
  </div>
</div>
