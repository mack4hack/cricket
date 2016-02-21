<head>
<script type="text/javascript">
	$('.table #slots').each(function(){
		$(this).click(function(){
			time_slot = $(this).find('a').attr('value');
			time_slot = encodeURIComponent(time_slot);
 	    	$('#mack').load('<?php echo base_url("/admin/summary?time="); ?>'+time_slot,function () { });
			return false;
		});
	});
</script>
	
</head>
			<div class="portlet-body">
						<div class="nav-justified">
							<div class="tab-content table-scrollable">
								<table class="table table-bordered table-hover">
								<thead>
								<tr>
									<th>
										 Sr No
									</th>
									<th>
										 Draw Time
									</th>
									<th>
										 Bet Chips
									</th>
									<th>
										 Wins
									</th>
									<th>
										 Commission
									</th>
									<th>
										 Balance
									</th>
<!--									<th>
										 Profit Percentage
									</th>-->
									
								</tr>
								</thead>
								<tbody>
                    <?php if(!empty($data_daily)  ) {
                                          $i =1;      
                              foreach($data_daily as $dd){ $time = $dd['timeslot_range']; ?>
                                  
                                <tr class="success">
									<td><?php echo $i; ?></td>
									<td id='slots'><a value="<?php echo $time; ?>"><?php echo $dd['draw_time']; ?></a></td>
									<td><?php echo $dd['credited']; ?></td>
									<td><?php echo $dd['debited']; ?></td>
									<td><?php echo $dd['commission']; ?></td>
									<td><?php echo $dd['profit']; ?></td>
<!--									<td><?php //echo $draw['profit']; ?></td>-->
								</tr> 
                                          
                                    <?php  $i++;  }                                                                                                                                       


                            }else{ ?>
                                
                                <tr class='active'><th style='text-align:center'; colspan='7'>No Records Found</th></tr>
                                
                                                                                           <?php  } ?>
								</tbody>
								</table>	
								
								</div>
							</div>
							
					</div>