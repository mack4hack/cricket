
				<div class="row">
					<div class="col-md-12" >
							<!-- BEGIN CHART PORTLET-->
							    <div class="portlet light bordered">
								
								   <div class="portlet-title">
									<div class="caption">
										<i class="icon-bar-chart font-green-haze"></i>
										<span class="caption-subject bold uppercase font-green-haze">Monthly Numbering Chart</span>
									</div>
								  </div>
								<?php //echo "<pre>";print_r($data);die;?>
								<div class="portlet-body table-scrollable">
								 <table class="table table-bordered table-hover">
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
						

				
										
					 



