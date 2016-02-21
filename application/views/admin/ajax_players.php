
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box grey-cascade">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>All Players
							</div>
                                                                                                                          <div class="myclass"    style="float: right;margin-top:8px;color:black;" >
                                                                                                                               <input type="button"  name="restore_default" id="restore_default" value="Restore Default" class="btn"  style="padding:2px;float:right;"  /> 
							 <input type="text" id="search_player"  class="col-sm-6 "    placeholder ="Search Player"     name="search_player" >

                                                                                                                            </div>
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
									 Current Balance
								</th>
								<th>
									 Default Balance 
								</th>
								<th>
									 Add Amount
								</th>
								<th>
									 Withdraw  Amount
								</th>
								<th>
									 Action
								</th>
							</tr>
							</thead>
							<tbody>
							<?php if(!empty($results) ){ foreach($results as $dealer )
							{
								?>
							<tr class="odd gradeX">
							
								<td>
                                                                    <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $dealer->id;  ?>"    />
								</td>
								<td>
									 <?php echo ucwords($dealer->first_name ." ".$dealer->last_name);?>
									 
								</td>
								<td>
									<a href="#">
									<?php echo $dealer->user_code ?> </a>
								</td>
								<td>
									<?php echo $dealer->present_amount ; ?>
								</td>
								<td class="center">
									 <?php echo $dealer->deposited_amount;?>
								</td>
								<td>
                                                                                                                                                        <input type="text"   name="add_amount"  id="add_amount"    />
                                                                                                                                                        <input type="hidden" value="<?php echo $dealer->id ; ?>"   name="user_id"  id="user_id"    />
                                                                                                                                                        
								</td>
								<td>
								    <input type="text"   name="withdraw_amount"  id="withdraw_amount"    />
								</td>
								<td class="center ">
									 
									 <input type="button"   name="enter"  id="enter" class="enter btn"  value="Enter"   />
								</td>
							</tr>
							
							<?php } ?>	
                                                                                                                                            <?php }else{   ?>

                                                        <tr class="odd gradeX">
                                                            <td colspan="8"  style="text-align: center;">No Players Found</td>
                                                        </tr>

                                                                                                                                            <?php } ?>	
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>


<script type="text/javascript">
$('.group-checkable').on('click',function(){
        if(this.checked){
            $('.checkboxes').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkboxes').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkboxes').on('click',function(){
        if($('.checkboxes:checked').length == $('.checkboxes').length){
            $('.group-checkable').prop('checked',true);
        }else{
            $('.group-checkable').prop('checked',false);
        }
    });
    
    
    
                            
                    // New selector
                    jQuery.expr[':'].Contains = function(a, i, m) {
                     return jQuery(a).text().toUpperCase()
                         .indexOf(m[3].toUpperCase()) >= 0;
                    };

                    // Overwrites old selecor
                    jQuery.expr[':'].contains = function(a, i, m) {
                     return jQuery(a).text().toUpperCase()
                         .indexOf(m[3].toUpperCase()) >= 0;
                    };

             
             
                 $('#search_player').keyup(function () { 
                    $('#sample_1  tbody tr').hide();
                         $("#sample_1  tbody tr:Contains('"+ $("#search_player").val() +"')  ").show();
                 });
 

 $(".enter").on('click',function(){
  var a = $(this).parent().siblings().children('input[name=add_amount]').val();
  var b = $(this).parent().siblings().children('input[name=withdraw_amount]').val();
  var c = $(this).parent().siblings().children('input[name=user_id]').val();
    if(a !=''){
        if (confirm("Are you sure to add amount?")) {
        $.ajax({
				  url: '<?php echo base_url()?>admin/update_amount?add=true&amount='+a+'&user_id='+c,
				   type: 'get',		
				   dataType: 'json',
				
				    success: function(json) {
                                                                                           if(json.success){
                                                                                            $('.alert-success').html(json.success);
                                                                                            $('.alert-success').show();
                                                                                            setTimeout(function() {
                                                                                                    $(".alert-success").hide('blind', {}, 500)
                                                                                                }, 3000);
				        	  var dealer_id = $('#dealer_dropdown').val();
                                                                                             if(dealer_id != -1){
                                                                                             $('#players_list').load('<?php echo base_url("/admin/ajaxPlayersList?dealer_id="); ?>'+dealer_id,function () {
                                                                                               // $(this).unwrap();
                                                                                                 });
                                                                                              }
                                                                                           }else{
                                                                                                 $('.alert-danger').html(json.error);
                                                                                                 $('.alert-danger').show();
                                                                                                 setTimeout(function() {
                                                                                                    $(".alert-danger").hide('blind', {}, 500)
                                                                                                }, 3000);
                                                                                           }
                                                                                             
				                                                                             
				      },			
				
          });
         }
    return false;
          
    }
     if(b !=''){
        if (confirm("Are you sure to withdraw amount?")) {
          $.ajax({
				   url: '<?php echo base_url()?>admin/update_amount?withdraw=true&amount='+b+'&user_id='+c,
				   type: 'get',		
				   dataType: 'json',
				
				    success: function(json) {
				        		         if(json.success){
                                                                                            $('.alert-success').html(json.success);
                                                                                            $('.alert-success').show();
                                                                                            setTimeout(function() {
                                                                                                    $(".alert-success").hide('blind', {}, 500)
                                                                                                }, 3000);
				        	  var dealer_id = $('#dealer_dropdown').val();
                                                                                             if(dealer_id != -1){
                                                                                             $('#players_list').load('<?php echo base_url("/admin/ajaxPlayersList?dealer_id="); ?>'+dealer_id,function () {
                                                                                               // $(this).unwrap();
                                                                                                 });
                                                                                              }
                                                                                           }else{
                                                                                                 $('.alert-danger').html(json.error);
                                                                                                 $('.alert-danger').show();
                                                                                                 setTimeout(function() {
                                                                                                    $(".alert-danger").hide('blind', {}, 500)
                                                                                                }, 3000);
                                                                                           }
                                                                                           
                                                                                           
				      },			
				
          });
          }
          return false;
     }
  
   
        });

$('#restore_default').on('click',function(){
 
   var saveData = {};
    var i =1 ;
 
       $('#sample_1 tbody').find('input[type="checkbox"]:checked').each(function () {
   
         var a =  $(this).parent().siblings().children('input[name=user_id]').val();
         saveData[i] = $(this).val();
         i++;
   });
       saveData = JSON.stringify(saveData);
    //   console.log(saveData);
        if (confirm("Are you sure to restore selected accounts?")) { 
           $.ajax({
              url: '<?php echo base_url("/admin/restoreAccount"); ?>',
              type: "POST",
              data: {users : saveData},
              dataType: "JSON",
                                    success:function(data){
                                        if(data.success){
                                                  $('.alert-success').html(data.success);
                                                  $('.alert-success').show();
                                                  setTimeout(function() {
                                                     $(".alert-success").hide('blind', {}, 500)
                                                  }, 3000);
                                                 var dealer_id = $('#dealer_dropdown').val();
                                                                                                if(dealer_id != -1){
                                                                                      $('#players_list').load('<?php echo base_url("/admin/ajaxPlayersList?dealer_id="); ?>'+dealer_id,function () {
                                                                                      // $(this).unwrap();
                                                                                                 });
                                                                                             }

                                                   }else{
                                                            $('.alert-danger').html('failed to restore');
                                                           $('.alert-danger').show();
                                                           setTimeout(function() {
                                                              $(".alert-danger").hide('blind', {}, 500)
                                                           }, 3000);
                                                            var dealer_id = $('#dealer_dropdown').val();
                                                                                                if(dealer_id != -1){
                                                                                      $('#players_list').load('<?php echo base_url("/admin/ajaxPlayersList?dealer_id="); ?>'+dealer_id,function () {
                                                                                      // $(this).unwrap();
                                                                                                 });
                                                                                             }
                                                   }
                                                   
                                                }
               });
        }
        return false;
        
       
       
});
  

</script>

<style type="text/css">
    
     .btn:hover{
        background-color: #2e8ece;
    }
</style>