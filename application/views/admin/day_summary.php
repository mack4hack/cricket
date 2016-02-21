<?php include'header.php';
date_default_timezone_set('Asia/Calcutta');
$date = new DateTime();
$current_timestamp = $date->getTimestamp();
?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content" >
			<div class="row">
				  <div class="col-md-12">
				    <div class="well margin-top-20">
		                <div class="row">
							<div class="col-sm-2">
								<span>Select Date</span>
								<select name="date" id="date">
									<?php foreach ($dates as $date) {  ?>
										<?php if($date['value'] == date('Y-m-d')) {  ?>
											<option  value="<?php echo $date['value']; ?>" selected><?php echo $date['display']; ?></option>	
									<?php	} else { ?>
										<option  value="<?php echo $date['value']; ?>"><?php echo $date['display']; ?></option>
									<?php  } } ?>
								</select>
							</div>
							<div class="col-sm-2">
								<span>Select Time</span>
								<select name="time_slot" id="time_slot">
									<?php foreach ($time_slots as $time_slot) {  ?>
										<option  value="<?php echo $time_slot['value']; ?>"><?php echo $time_slot['display']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>				

            <div id="mack"></div>				
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			
	<!-- END CONTENT -->
	
</div>
</div>
<!-- END CONTAINER -->
<!-- CODE FOR DIGITAL CLOCK -->
<style>
.clockStyle {
	background-color:#cb5a5e;
	padding:6px;
	color:#fff;
	font-family:"Arial Black", Gadget, sans-serif;
    font-size:16px;
    font-weight:bold;
	letter-spacing: 2px;
	display:inline;
}
</style>

<!-- CODE END -->
<!-- BEGIN FOOTER -->
<?php include'footer.php';?>

<!-- END FOOTER -->
	<script type="text/javascript" >
		$(document).ready(function() {   
			
			//$('#mack').hide();
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
   ///FormValidation.init();
   //TableManaged.init();
  //  getChart();	 
    getSlots();	 
});


     $('#time_slot').on('change',function(){
		 getChart();	    
	});

    $('#date').on('change',function(){
		 getSlots();	    
	});

    function getChart()
    {
    	var time = $('#time_slot').val();
 	    var date = $('#date').val();
 	    time_slot = date+' '+time;
 	    time_slot = encodeURIComponent(time_slot);
 	    $('#mack').load('<?php echo base_url("/admin/summary?time="); ?>'+time_slot,function () { });
    }

    function getSlots()
    {
    	//var time = $('#time_slot').val();
 	    var date = $('#date').val();
 	    //time_slot = date+' '+time;
 	    date = encodeURIComponent(date);
 	    $('#mack').load('<?php echo base_url("/admin/daysummaryslots?date="); ?>'+date,function () { });
    } 
</script>
