<?php if($this->ion_auth->in_group('dealer'))
			include 'dealer_header.php';
		else 
			include 'header.php';
//echo "<pre>";
//print_r($data); die;
?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content" >
			<h3 class="page-title">
				Player Account
			</h3>
			<div class="row">
			  <div class="col-md-12">
			    <div class="well margin-top-20">
					<div class="row">
						<div class="col-sm-3">
							<strong>Select Player Account : </strong>
							<select name="player" id="player">
							<option value="">--Select Player--</option>
							<?php foreach ($players as $player) { ?>
									<option value="<?php echo $player->id;?>"><?php echo $player->first_name.' '.$player->last_name;?></option>
							<?php  }?>
							</select>
						</div>
					</div>
				</div>
              </div>
            </div>
                    <div class="table-scrollable">
            <table class="print">
            <div id="mack" class="mack"></div>	
            </table>		
                        </div>
					 




			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			
	<!-- END CONTENT -->
	
</div>
</div>
<!-- END CONTAINER -->
<!-- CODE FOR DIGITAL CLOCK -->

<!-- CODE END -->
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

   $('#player').on('change',function(){
 	    var player = $(this).val();
 	    $('#mack').load('<?php echo base_url("/admin/playerAccountChart?player="); ?>'+player,function () { });
	});

    var dealer = $('#player').val();
    $('#mack').load('<?php echo base_url("/admin/playerAccountChart?player="); ?>'+player,function () { });

});
</script>
<style type="text/css">
	@media print {
    .print {
        background-color: white;
        height: 100%;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        margin: 0;
        padding: 15px;
        font-size: 14px;
        line-height: 18px;
    }
}
</style>