<?php include'header.php';?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Block Player
			</h3>
			
			<!-- BEGIN PAGE CONTENT-->
			
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN VALIDATION STATES-->
						<form  id="form_sample_1" method="POST"  class="form-horizontal">
							<div class="alert alert-danger display-hide">
										<button class="close" data-close="alert"></button>
										Oops...You have missed some input values. 
									</div>
									<div class="alert alert-success display-hide">
										<button class="close" data-close="alert"></button>
										Player Blocked succesfully.
									</div>
						
						<div class="portlet light bordered">
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
											<div class="form-body">
												<div class="row">
													<div class="col-md-3"   style="width:20%;padding-right:0px; display:none;">
														<div class="form-group">
															
															<div class="col-md-9">
																<select name="country_id" class="form-control" onchange="selectState(this.options[this.selectedIndex].value)">
								<option value="">Select country</option>
													<?php foreach($list->result() as $country)
																	{
																	echo "<option value=".$country->id.">".$country->name."</option>";
																	}																	
																		?>
																</select>
															</div>
														</div>
													</div>
													<!--/span-->
													<div class="col-md-3" style="width:20%;padding-right:0px;">
														<div class="form-group has-error">
															<div class="col-md-9">
																<select name="state_id" class="form-control required" id="state_dropdown" onchange="selectCity(this.options[this.selectedIndex].value)">
								<option value="">Select state</option>
							</select><span id="state_loader"></span>
															</div>
														</div>
													</div>
													<div class="col-md-3" style="width:20%;padding-right:0px;">
														<div class="form-group has-error">
															<div class="col-md-9">
																<select name="city_id" onchange="selectDealer(this.options[this.selectedIndex].value)" class="form-control required" id="city_dropdown">
								<option value="">Select city</option>
							</select><span id="city_loader"></span>
															</div>
														</div>
													</div>
													<div class="col-md-3" style="width:20%;padding-right:0px;">
														<div class="form-group has-error">
															<div class="col-md-9">
																<select name="dealer_id" onchange="selectUser(this.options[this.selectedIndex].value)"  class="form-control required" id="dealer_dropdown">
								<option value="">Select Dealer</option>
							</select><span id="dealer_loader"></span>
															</div>
														</div>
													</div>
													<div class="col-md-3" style="width:20%;padding-right:0px;">
														<div class="form-group has-error">
															<div class="col-md-9">
																<select name="user_id"  class="form-control required" id="user_dropdown">
								<option value="">Select User</option>
							</select><span id="user_loader"></span>
															</div>
														</div>
													</div>
													<!--/span-->
												</div>
													
												
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-6">
														
															
																<div class="form-group">
															        <div class="col-md-4">
																		<input type="hidden"  name="block_player"  id="block_player"  class="form-control" />
																	 </div>
																   <input type="submit" style="float:right;" id="submit" class="btn green"  value="Block Selected Player" />
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
<!-- CODE FOR COUNTRY, STATE,CITY AUTO POPULATE -->
<script>
function selectState(country_id){
	//alert(country_id);
  if(country_id!="-1"){
    loadData('state',country_id);
    $("#city_dropdown").html("<option value=''>Select city</option>");
  }else{
    $("#state_dropdown").html("<option value=''>Select state</option>");
    $("#city_dropdown").html("<option value=''>Select city</option>");
  }
}
function selectCity(state_id){
	//alert(state_id);
  if(state_id!="-1"){
   loadData('city',state_id);
  }else{
   $("#city_dropdown").html("<option value=''>Select city</option>");
  }
}
function selectDealer(city_id){
	//alert(city_id);
  if(city_id!="-1"){
   loadData('dealer',city_id);
  }else{
   $("#dealer_dropdown").html("<option value=''>Select Dealer</option>");
  }
}
function selectUser(dealer_id){
	//alert(dealer_id);
  if(dealer_id!="-1"){
   loadData('user',dealer_id);
  }else{
   $("#user_dropdown").html("<option value=''>Select User</option>");
  }
}


function loadData(loadType,loadId){
  var dataString = 'loadType='+ loadType +'&loadId='+ loadId;
  $("#"+loadType+"_loader").show();
  $("#"+loadType+"_loader").fadeIn(400).html('<img src="<?php echo base_url()?>assets/global/img/loading-spinner-grey.gif" />');
  $.ajax({
    type: "POST",
    url: "<?php echo base_url()?>Admin/loadData",
    data: dataString,
    cache: false,
    success: function(result){
      $("#"+loadType+"_loader").hide();
      $("#"+loadType+"_dropdown").html("<option value='-1'>Select "+loadType+"</option>");
      $("#"+loadType+"_dropdown").append(result);
    }
 });
}


</script>
<!-- CODE END -->




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
  // TableManaged.init();
  selectState(1);
  
         $("#form_sample_1").submit(function (e){
                
               var user_id = $("#user_dropdown").val();
			   $('.alert-success').hide();
			   if(user_id != '')
			   {   
                var answer = confirm("Block Player? once blocked can never be unblocked") ;
                
                if(answer){   
                var url = '<?php echo base_url()?>admin/ajax_block_player';
                var method = $(this).attr('method');
                var data = $(this).serialize();
				   //alert("temp:"+data);
			    $("#submit").html('Blocking');
			    $.ajax({
                   url:url,
                   type:method,
                   data:data
                }).done(function(data){
				  //var returnedData = JSON.parse(data);
				  //location.reload(true);
                   if(data =='0')
                    {   //alert(data);
						$("#submit").html('Block Selected Player');
                        $("#error").show('fast');
                        $('#error').delay(5000).fadeOut('slow');
						
                        //$('#form_sample_1')[0].reset();
                    }
                    else
                    {	 //alert(data);
						 $('.alert-success').show();
						 $('#error').delay(5000).fadeOut('slow');
						 $('#form_sample_1')[0].reset();
                         throw new Error('go');
                    } 
                });
			    }
			   }
            
			  });
  
  
  
  
  
  
  
  
});


    


</script>


