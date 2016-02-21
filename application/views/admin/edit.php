<?php include'header.php';
foreach($edit_data->result() as $data){}
?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Player Details
			</h3>
			
			<!-- BEGIN PAGE CONTENT-->
			
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN VALIDATION STATES-->
						<form action="" id="form_sample_1" method="POST"  class="form-horizontal">
						<div class="alert alert-danger display-hide">
										<button class="close" data-close="alert"></button>
										Oops...You have missed some input values. 
									</div>
									<div class="alert alert-success display-hide">
										<button class="close" data-close="alert"></button>
										Data updated succesfully. You will be redirecting...
									</div>
						<div class="portlet light bordered">
									<div class="portlet-title">
										<div class="caption">
											<i class="icon-equalizer font-red-sunglo"></i>
											<span class="caption-subject font-red-sunglo bold uppercase">Select Player City</span>
										</div>
										<div class="tools">
											<a href="" class="collapse">
											</a>
											<a href="#portlet-config" data-toggle="modal" class="config">
											</a>
											<a href="" class="reload">
											</a>
											<a href="" class="remove">
											</a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
											<div class="form-body">
												
												<h3 class="form-section">Player Info</h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">First Name</label>
															<div class="col-md-9">
																<input type="text" value="<?php echo $data->first_name?>" name="fname" pattern="[a-zA-Z]+" data-required="1" class="form-control required" placeholder="Enter First Name">
																
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Last Name</label>
															<div class="col-md-9">
																<input type="text" value="<?php echo $data->last_name?>" name="lname" class="form-control required" placeholder="Enter Last Name">
															</div>
														</div>
													</div>
													<!--/span-->
												</div>  
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Contact No</label>
															<div class="col-md-9">
																<input type="number" value="<?php echo $data->contact_no?>" name="contact_no" minlength="10" maxlength="10" class="form-control required text" placeholder="Enter Contact Number">
																
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Alternate No</label>
															<div class="col-md-9">
																<input type="number" value="<?php echo $data->alternate_no?>" maxlength="11" name="alternate_no" class="form-control" placeholder="Enter Alternate Number">
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Email Id</label>
															<div class="col-md-9">
																<input type="email" readonly value="<?php echo $data->email_id?>" name="email" onblur="email_check()" id="email" class="form-control required" placeholder="Enter Email Id">
																<span id="email_status"></span>
																
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Gender</label>
															<div class="col-md-9">
																<select name="gender" class="form-control required">
																	<option value="Male">Male</option>
																	<option value="Female">Female</option>
																</select>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<h3 class="form-section">Address</h3>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Address 1</label>
															<div class="col-md-9">
																<input type="text" value="<?php echo $data->address_1?>" name="address1" placeholder="House name,street" class="form-control required">
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Address 2</label>
															<div class="col-md-9">
																<input type="text" value="<?php echo $data->address_2?>" placeholder="Nearby landmark" name="address2" class="form-control">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">City</label>
															<div class="col-md-9">
																<input type="text" name="city_name"  value="<?php echo $data->city;?>"  placeholder="Ex-Pune" class="form-control required">
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Pin Code</label>
															<div class="col-md-9">
																<input type="text" name="pincode" value="<?php echo $data->pincode?>" maxlength="6" minlength="6" placeholder="Ex-411032" class="form-control required">
																<input type="hidden" id="temp" value="">
																<input type="hidden" name="updateid" value="<?php echo $this->uri->segment(3);?>">
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
												<!--/row-->
												
												<h3 class="form-section">Account Deatils</h3>
												<!--/row-->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Initial Amount</label>
															<div class="col-md-9">
																<input type="text" value="<?php echo $data->deposited_amount; ?>" name="deposited_amount" class="form-control">
															</div>
														</div>
													</div>
											        <div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Present Amount</label>
															<div class="col-md-9">
																<input type="text" value="<?php echo $data->present_amount; ?>"  readonly name="present_amount" class="form-control">
															</div>
														</div>
													</div>   
												</div>
<!--
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label col-md-3">Add Amount</label>
															<div class="col-md-9">
																<input type="text"   name="add_amount" class="form-control">
															</div>
														</div>
													</div>   
												</div>
-->
											
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-6">
														<div class="row">
															<div class="col-md-offset-3 col-md-9">
																<button type="submit" id="submit" class="btn green">Submit</button>
																<button type="button" class="btn default">Cancel</button>
															</div>
														</div>
													</div>
													<div class="col-md-6">
													</div>
												</div>
											</div>
										<!-- END FORM-->
									</div>
								</div>
								</form>
					<!-- END VALIDATION STATES-->
					
				</div>
			</div>
			
			
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
	
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<?php include'footer.php';?>
<!-- END FOOTER -->
<script type="text/javascript" src="<?php echo base_url()?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/pages/scripts/form-validation.js"></script>
<script>
$(document).ready(function() {   
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
   FormValidation.init();
});
</script>
		 <script>
        $(document).ready(function (){
			//alert("in function");
            $("#form_sample_1").submit(function (e){
             var temp = $("#temp").val();
			   
			   if(temp!='')
			   {
				var id = '<?php echo $this->uri->segment(3);?>';   
                e.preventDefault();
                var url = '<?php echo base_url()?>admin/ajax_player_data_edit';
                var method = $(this).attr('method');
                var data = $(this).serialize();
				  // alert("data:"+data);
			   $("#submit").html('Saving Data...');
			    $.ajax({
                   url:url,
                   type:method,
                   data:data
                }).done(function(data){
				//var returnedData = JSON.parse(data);
                   if(data =='0')
                    {   //alert(data);
						$("#submit").html('Save');
                        $("#error").show('fast');
                        $('#error').delay(5000).fadeOut('slow');
						
						
                    }
                    else
                    {	//alert(data);
						//$('#error').delay(5000).fadeOut('slow');
						//$('#form_sample_1')[0].reset();
						window.location=window.location;
                    //throw new Error('go');
                    } 
                });
			   }
            });
             
            
             
        });
		
        </script>
