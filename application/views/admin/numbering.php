<?php include'header.php';?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content" >
		
		
<!--                    <div id="loadingDiv" style="padding: 5% 0 0 30%;" ><img src="<?php echo base_url();  ?>images/ajax-loader.gif" />  </div>-->
            <div id="mack">
					<div class="row">
					<div class="col-md-12" >
							<!-- BEGIN CHART PORTLET-->
							    <div class="portlet light bordered ">
								
								   <div class="portlet-title">
									<div class="caption">
										<i class="icon-bar-chart font-green-haze"></i>
										<span class="caption-subject bold uppercase font-green-haze">Monthly Numbering Chart</span>
									</div>
								  </div>
								<?php //echo "<pre>";print_r($data);die;?>
								<div class="portlet-body table-scrollable">
								 <table class="table table-bordered table-hover ">
								   <?php foreach($data as $key =>$value ) { 
                                                                                                                                                        if($key == 0) {  ?> 
                                                                                                                                                         <thead>   <tr>
                                                                                                                                                          <?php  foreach($value as $a =>$b) {?>
                                                                                                                                                         
								                 <th><?php echo $b['digit']; ?></th>
							                          
                                                                                                                                                   <?php } ?>  
                                                                                                                                                    </tr></thead>
                                                                                                                                                   <?php }else{ ?>
                                                                                                                                                       
                                                                                                                                                       <tbody>   <tr>
                                                                                                                                                          <?php  foreach($value as $a =>$b) {?>
                                                                                                                                                            <?php if($a == 0){  ?>
                                                                                                                                                               <th><?php echo $b['digit']; ?></th>
                                                                                                                                                          <?php } else { ?>
                                                                                                                                                            <td><?php echo $b['digit']; ?></td>
                                                                                                                                                              <?php }  ?>
                                                                                                                                                   <?php } ?>  
                                                                                                                                                    </tr></tbody>
                                                                                                                                                       
                                                                                                                                                       
                                                                                                                                                  <?php } ?>  
                                                                                                                                                   <?php } ?>  
                                                                    
                                                                                                                                                
                                                                                                                                                   </table>
								</div>
							</div>
							<!-- END CHART PORTLET-->
					</div>
					</div>
						

			
				</div>				
										
					 




			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			
	<!-- END CONTENT -->
	
</div>
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<?php include'footer.php';?>
<!-- END FOOTER -->
<script type="text/javascript" >
		$(document).ready(function() {   
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
  // FormValidation.init();
   //TableManaged.init();
});

    //$( "#mack" ).empty();
    
    	
                 
//    	$('#mack').load('<?php echo base_url("/admin/ajaxnumberingchart"); ?>',function () {
//                      
//                   });
//              	
//    
//    $('#loadingDiv')
//    .hide()  // Hide it initially
//    .ajaxStart(function() {
//        $(this).show();
//    })
//    .ajaxStop(function() {
//        $(this).hide();
//    });




</script>
<style type="text/css">
  .portlet.light .portlet-body {
    max-height: 500px;
    overflow: scroll;
    padding-top: 8px;
}






</style>


