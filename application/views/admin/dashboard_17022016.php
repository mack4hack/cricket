<?php if($this->ion_auth->in_group('dealer'))
		include 'dealer_header.php';
		else 
			include 'header.php';
		?>
<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			
			<!-- BEGIN PAGE HEADER-->
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						 <a href="<?php echo base_url() ;?>admin">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Dashboard</a>
					</li>
				</ul>
				
			</div>
			<h3 class="page-title">
			Dashboard 
                                                      <!--                        <small>reports & statistics</small>-->
			</h3>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="fa fa-money"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php echo $amount;  ?>
							</div>
							<div class="desc">
								 Lottery
							</div>
						</div>
						<a class="more" href="<?php echo base_url()?>admin/lot_chart">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat red-intense">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>
						<div class="details">
							<div class="number">
								 125
							</div>
							<div class="desc">
								 Cricket
							</div>
						</div>
						<a class="more" href="<?php echo base_url()?>admin/cricket">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat green">
						<div class="visual">
							<i class="fa fa-users"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php echo $dealers;   ?>
							</div>
							<div class="desc">
								 Dealers
							</div>
						</div>
						<a class="more" href="<?php echo base_url()?>admin/add_dealer">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple">
						<div class="visual">
							<i class="fa fa-users"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php echo $players;   ?>
							</div>
							<div class="desc">
								 Players
							</div>
						</div>
						<a class="more" href="<?php echo base_url()?>admin/add_player">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				</div>
				
				
			</div>
                                                        <div class="row">
                                                                      <div class="col-md-6 col-sm-6">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-share font-red-sunglo hide"></i>
                                        <span class="caption-subject font-red-sunglo bold uppercase">Lottery</span>
                                        <span class="caption-helper">Daily stats...</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                   <div style="margin: 20px 0 10px 30px">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                <span class="label label-sm label-success"> BET CHIPS </span>
                                                <h3><?php echo $chips; ?></h3>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                <span class="label label-sm label-info"> DEBIT </span>
                                                <h3><?php echo $debit; ?></h3>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                <span class="label label-sm label-danger"> COMMISSION </span>
                                                <h3><?php echo $commission; ?></h3>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                <span class="label label-sm label-warning"> BALANCE </span>
                                                <h3><?php echo $amount; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                       
                            <!-- END PORTLET-->
                        </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                      <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-share font-red-sunglo hide"></i>
                                        <span class="caption-subject font-red-sunglo bold uppercase">Cricket</span>
                                        <span class="caption-helper">Daily stats...</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                   <div style="margin: 20px 0 10px 30px">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                <span class="label label-sm label-success"> BET CHIPS </span>
                                                <h3><?php echo $chips_cric; ?></h3>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                <span class="label label-sm label-info"> DEBIT </span>
                                                <h3><?php echo $debit_cric; ?></h3>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                <span class="label label-sm label-danger"> COMMISSION </span>
                                                <h3><?php echo $commission_cric; ?></h3>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                                <span class="label label-sm label-warning"> BALANCE </span>
                                                <h3><?php echo $amount_cric; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                                
                                                            </div>


                                                        </div>
			<!-- END DASHBOARD STATS -->
			<div class="clearfix">
			</div>
			
		</div>
	</div>
	<!-- END CONTENT -->
	<?php include'footer.php';?>
	<script type="text/javascript" >
$(document).ready(function() {   
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
   Layout.init(); // init current layout 
   QuickSidebar.init(); // init quick sidebar
   Demo.init(); // init demo features
   //FormValidation.init();
   //TableManaged.init();
});
</script>
		 
		
        
	
	
	
