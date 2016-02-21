<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box grey-cascade">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>All Players
							</div>
							<input type="text" id="search_player"  class="col-sm-3 "    placeholder ="Search Player"   style="color:black;float: right;margin-top:8px;"  name="search_player" >

						</div>
						<div class="portlet-body table-scrollable">
							
							<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
							<tr>
								<th class="table-checkbox">
									<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
								</th>
								<th>
									 Player Name
								</th>
								<th>
									 User Code
								</th>
								<th>
									 Contact Number
								</th>
								<th>
									 Activated Date
								</th>
								<th>
									 Status
								</th>
								<th>
									 Option
								</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach($this->Admin_model->get_players() as $dealer )
							{
								?>
							<tr class="odd gradeX">
							
								<td>
									<input type="checkbox" class="checkboxes" value="1"/>
								</td>
								<td>
									 <?php echo ucwords($dealer->first_name ." ".$dealer->last_name);?>
								</td>
								<td>
									<a href="#">
									<?php echo $dealer->user_code ?> </a>
								</td>
								<td>
									<?php echo $dealer->contact_no;?>
								</td>
								<td class="center">
									 <?php echo date("d-m-Y",strtotime($dealer->activation_date));?>
								</td>
								<td>
								<?php if($dealer->is_blocked =='1'){?>
									<span class="label label-sm label-danger">
									Blocked </span>
								<?php }else {?>
									<span class="label label-sm label-success">
									Active </span>
								<?php }?>
								</td>
								<td class="center">
									 <a class="btn default" data-toggle="modal" href="<?php echo base_url()."admin/edit/".$dealer->id ?>">
									Edit</a>
								</td>
							</tr>
							
							<?php } ?>	
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
