<?php include'header.php';?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<div class="page-content">

    

    <div class="row">
        <div class="slider4">
        <?php for($i=1;$i<9;$i++){ ?>
				
					<div  <?php  if ($i % 4 == 0) { 
                                            echo "class='dashboard-stat red-intense slide' ";
}elseif($i%3==0){
    echo "class='dashboard-stat green  slide' ";
}elseif($i%2==0){
    echo "class='dashboard-stat purple  slide' ";
}else{
    echo "class='dashboard-stat yellow  slide' ";
} ?>>
						<div class="visual">
							<i class="fa fa-money"></i>
						</div>
						<div class="details">
							<div class="number">
								
							</div>
							<div class="desc">
								Match 1
							</div>
						</div>
						<a class="more" href="">
						View more <i class="m-icon-swapright m-icon-white"></i>
						</a>
					</div>
				
        <?php } ?>	
				
		</div>		
			</div>
			
    
    <div class="btn-group btn-group btn-group-justified"  style="padding:0% 10% 1% 9%;">
   <div class="btn-group">
            <button data-toggle="dropdown"  data-hover="dropdown"  class="btn yellow dropdown-toggle" type="button" id="btnGroupVerticalDrop5" aria-expanded="false"> Game Menu
                <i class="fa fa-angle-down"></i>
            </button>
            <ul aria-labelledby="btnGroupVerticalDrop5" role="menu" class="dropdown-menu">
                <li><a href="#game1" onclick="expand(1);"  >Toss </a></li>
                <li><a href="#game2"  onclick="expand(2);"  >First Ball </a></li>
                <li><a href="#game3"  onclick="expand(3);" > First Over Runs  </a></li>
                <li><a href="#game4"  onclick="expand(4);" >10 Over Session </a></li>
                <li><a href="#game5"  onclick="expand(5);"  >First Wicket Method   </a></li>
                <li><a href="#game6"   onclick="expand(6);"   >Top Batsman </a></li>
                <li><a href="#game7"   onclick="expand(7);"  >  Top Bowler </a></li>
                <li><a href="#game8"   onclick="expand(8);"  >To Make Fifty </a></li>
                <li><a href="#game9"   onclick="expand(9);"  > To Make Hundred</a></li>
                <li><a href="#game10"   onclick="expand(10);"  > Innings Run Rate</a></li>
            </ul>
    </div>
    <div class="btn-group">
            <button data-toggle="dropdown"  data-hover="dropdown"  class="btn red dropdown-toggle" type="button" id="btnGroupVerticalDrop5" aria-expanded="false"> Stop All Bets
                <i class="fa fa-angle-down"></i>
            </button>
            <ul aria-labelledby="btnGroupVerticalDrop5" role="menu" class="dropdown-menu">
                <li><a href="" onclick="stop(1);"  >Toss </a></li>
                <li><a href=""  onclick="stop(2);"  >First Ball </a></li>
                <li><a href=""  onclick="stop(3);" > First Over Runs  </a></li>
                <li><a href=""  onclick="stop(4);" >10 Over Session </a></li>
                <li><a href=""  onclick="stop(5);"  >First Wicket Method   </a></li>
                <li><a href=""   onclick="stop(6);"   >Top Batsman </a></li>
                <li><a href=""   onclick="stop(7);"  >  Top Bowler </a></li>
                <li><a href=""   onclick="stop(8);"  >To Make Fifty </a></li>
                <li><a href=""   onclick="stop(9);"  > To Make Hundred</a></li>
                <li><a href=""   onclick="stop(10);"  > Innings Run Rate</a></li>
            </ul>
    </div>
    <div class="btn-group">
            <button data-toggle="dropdown"  data-hover="dropdown"  class="btn green dropdown-toggle" type="button" id="btnGroupVerticalDrop5" aria-expanded="false"> Menu
                <i class="fa fa-angle-down"></i>
            </button>
            <ul aria-labelledby="btnGroupVerticalDrop5" role="menu" class="dropdown-menu">
                <li><a href="" onclick=""  >Detail Scorecard </a></li>
                <li><a href="" onclick=""  >Upcoming Matches</a></li>
                <li><a href="" onclick=""  >Cricket Calender</a></li>
                <li><a href="" onclick=""  >Day Summary</a></li>
                <li><a href="" onclick=""  >All Games Result</a></li>
                <li><a href="" onclick=""  >Info</a></li>
                <li><a href="" onclick=""  >Execute Results</a></li>
               
            </ul>
    </div>
</div>
   
    <div class="row"  id="game1">

            <div class="col-md-12">

                    <div class="portlet box green">
                            <div class="portlet-title">
                                    <div class="caption">
                                            <i class="fa fa-gift"></i>Toss
                                    </div>
                                    <div class="tools">
                                        <input type="button"   name="cancel"  id="cancel" class="cancel btn"  value="cancel all bets"   />
                                            <a href="javascript:;" class="collapse">
                                            </a>
                                    </div>
                            </div>
                            <div class="portlet-body">
                                    <div class="tabbable-custom nav-justified">
                                       
                                            <div class="tab-content">
                                                    <div class=" tab-pane active  table-scrollable" id="tab_1_1_1">
                                                     <table class="table table-striped table-bordered table-hover" id="sample_1">
                                                        <thead>
                                                        <tr>

                                                                <td>
                                                                      <input type="text"   name="event"  id="event"  value="TEAM A"   />       
                                                                </td>
                                                                <td>
                                                                      <input type="text"   name="event"  id="event"  value="TEAM B"   />       
                                                                </td>
                                                                <td>
                                                                      <input type="text"   name="event"  id="event"  value="Total Bet on Team A"   />       
                                                                </td>
                                                                <td>
                                                                      <input type="text"   name="event"  id="event"  value="Payout"   />       
                                                                </td>
                                                                <td>
                                                                      <input type="text"   name="event"  id="event"  value="Total Bet on Team B"   />       
                                                                </td>
                                                                <td>
                                                                      <input type="text"   name="event"  id="event"  value="Payout"   />       
                                                                </td>
                                                                <td>
                                                                      <input type="text"   name="event"  id="event"  value="Enter Result"   />       
                                                                </td>
                                                                <td>
                                                                       <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />  
                                                                </td>
                                                                
                                                              
                                                               
                                                             

                                                        </tr>
                                                        </thead>
                                                     
                                                        </table>	
                                                    </div>
                                                
                                            </div>
                                                      <div class="row pull-right col-sm-6" >
                                                                         
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn purple">
                                                                                Profit/Loss
                                                                              </a>
                                                                            </div>
                                                    </div>
                                    </div>
                                   
                                                                            
                                   
                            </div>
                        
                        
                        
                    </div>
            </div>
    </div>
    
    <div class="row"  id="game2">

            <div class="col-md-12">

                    <div class="portlet box red">
                            <div class="portlet-title">
                                    <div class="caption">
                                            <i class="fa fa-gift"></i>First Ball
                                    </div>
                                    <div class="tools">
                                              <input type="button"   name="cancel"  id="cancel" class="cancel btn"  value="cancel all bets"   />
                                        
                                            <a href="javascript:;" class="collapse">
                                            </a>
                                    </div>
                            </div>
                            <div class="portlet-body">
                                    <div class="tabbable-custom nav-justified">
                                            <ul class="nav nav-tabs nav-justified">
                                                    <li class="active">
                                                            <a href="#tab_1_2_1" data-toggle="tab">
                                                            First Innings</a>
                                                    </li>
                                                    <li>
                                                            <a href="#tab_1_2_2" data-toggle="tab">
                                                            Second Innings</a>
                                                    </li>

                                            </ul>
                                            <div class="tab-content">
                                                    <div class=" tab-pane active table-scrollable" id="tab_1_2_1">
                                                     <table class="table table-striped table-bordered table-hover" id="sample_21">
                                                        <thead>
                                                        <tr>

                                                            
                                                                <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_21 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         Particular
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                             

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                       <?php for($i=0; $i<8 ; $i++){ ?>
                                                        <tr class="odd gradeX">

                                                                 <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="event"  id="event"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                               
                                                        </tr>
                                                       <?php } ?>

                                                        </tbody>
                                                        </table>	
                                                    </div>
                                                    <div class="tab-pane table-scrollable" id="tab_1_2_2">
                                                           <table class="table table-striped table-bordered table-hover" id="sample_22">
                                                        <thead>
                                                        <tr>

                                                              <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_22 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         particular
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                              

                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                   <?php for($i=0; $i<8 ; $i++){ ?>
                                                        <tr class="odd gradeX">

                                                                <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="event"  id="event"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                             
                                                        </tr>
                                                       <?php } ?>


                                                        </tbody>
                                                        </table>
                                                    </div>
                                            
                                             
                                            
                                            </div>
                                                      <div class="row pull-right col-sm-6" >
                                                                           <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn red">
                                                                                Grand Total       
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn green">
                                                                               Winning Amount
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn purple">
                                                                                Profit/Loss
                                                                              </a>
                                                                            </div>
                                                    </div>
                                    </div>
                                   
                                                                            
                                   
                            </div>
                        
                        
                        
                    </div>
            </div>
    </div>
    
    <div class="row" id="game3">

            <div class="col-md-12">

                    <div class="portlet box yellow">
                            <div class="portlet-title">
                                    <div class="caption">
                                            <i class="fa fa-gift"></i>First Over Runs
                                    </div>
                                    <div class="tools">
                                        <input type="button"   name="cancel"  id="cancel" class="cancel btn"  value="cancel all bets"   />
                                            <a href="javascript:;" class="collapse">
                                            </a>
                                          
                                    </div>
                            </div>
                            <div class="portlet-body">
                                    <div class="tabbable-custom nav-justified">
                                            <ul class="nav nav-tabs nav-justified">
                                                    <li class="active">
                                                            <a href="#tab_1_3_1" data-toggle="tab">
                                                            Team A</a>
                                                    </li>
                                                    <li>
                                                            <a href="#tab_1_3_2" data-toggle="tab">
                                                            Team B</a>
                                                    </li>

                                            </ul>
                                            <div class="tab-content">
                                                    <div class=" tab-pane active table-scrollable" id="tab_1_3_1">
                                                     <table class="table table-striped table-bordered table-hover" id="sample_31">
                                                        <thead>
                                                        <tr>
                                                                 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_31 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         Runs
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                           

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                       <?php for($i=0; $i<12 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="event"  id="event"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                               
                                                        </tr>
                                                       <?php } ?>

                                                        </tbody>
                                                        </table>	
                                                    </div>
                                                    <div class="tab-pane table-scrollable" id="tab_1_3_2">
                                                           <table class="table table-striped table-bordered table-hover" id="sample_32">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_32 .checkboxes"/>
			            </th>
                                                                <th>
                                                                        Runs
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                            

                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                   <?php for($i=0; $i<12 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="event"  id="event"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                               
                                                        </tr>
                                                       <?php } ?>


                                                        </tbody>
                                                        </table>
                                                    </div>
                                            
                                             
                                            
                                            </div>
                                                      <div class="row pull-right col-sm-6" >
                                                                           <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn red">
                                                                                Grand Total       
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn green">
                                                                               Winning Amount
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn purple">
                                                                                Profit/Loss
                                                                              </a>
                                                                            </div>
                                                    </div>
                                    </div>
                                   
                                                                            
                                   
                            </div>
                        
                        
                        
                    </div>
            </div>
    </div>
    
    <div class="row"   id="game4">

            <div class="col-md-12">

                    <div class="portlet box purple">
                            <div class="portlet-title">
                                    <div class="caption">
                                            <i class="fa fa-gift"></i>10 Over Session
                                    </div>
                                    <div class="tools">
                                        <input type="button"   name="cancel"  id="cancel" class="cancel btn"  value="cancel all bets"   />
                                            <a href="javascript:;" class="collapse">
                                            </a>
                                         
                                    </div>
                            </div>
                            <div class="portlet-body">
                                    <div class="tabbable-custom nav-justified">
                                            <ul class="nav nav-tabs nav-justified">
                                                    <li class="active">
                                                            <a href="#tab_1_4_1" data-toggle="tab">
                                                            First Innings</a>
                                                    </li>
                                                    <li>
                                                            <a href="#tab_1_4_2" data-toggle="tab">
                                                            Second Innings</a>
                                                    </li>

                                            </ul>
                                            <div class="tab-content">
                                                    <div class=" tab-pane active table-scrollable" id="tab_1_4_1">
                                                     <table class="table table-striped table-bordered table-hover" id="sample_41">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_41 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         Particular
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                            

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                       <?php for($i=0; $i<10 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="session"  id="session"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                             
                                                        </tr>
                                                       <?php } ?>

                                                        </tbody>
                                                        </table>	
                                                    </div>
                                                    <div class="tab-pane table-scrollable" id="tab_1_4_2">
                                                           <table class="table table-striped table-bordered table-hover" id="sample_42">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_42 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         particular
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                              

                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                   <?php for($i=0; $i<10 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="session"  id="session"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                              
                                                        </tr>
                                                       <?php } ?>


                                                        </tbody>
                                                        </table>
                                                    </div>
                                            
                                             
                                            
                                            </div>
                                                      <div class="row pull-right col-sm-6" >
                                                                           <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn red">
                                                                                Grand Total       
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn green">
                                                                               Winning Amount
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn purple">
                                                                                Profit/Loss
                                                                              </a>
                                                                            </div>
                                                    </div>
                                    </div>
                                   
                                                                            
                                   
                            </div>
                        
                        
                        
                    </div>
            </div>
    </div>
    
    <div class="row"   id="game5">

            <div class="col-md-12">

                    <div class="portlet box green">
                            <div class="portlet-title">
                                    <div class="caption">
                                            <i class="fa fa-gift"></i>First Wicket Method
                                    </div>
                                    <div class="tools">
                                        <input type="button"   name="cancel"  id="cancel" class="cancel btn"  value="cancel all bets"   />
                                            <a href="javascript:;" class="collapse">
                                            </a>
                                         
                                    </div>
                            </div>
                            <div class="portlet-body">
                                    <div class="tabbable-custom nav-justified">
                                            <ul class="nav nav-tabs nav-justified">
                                                    <li class="active">
                                                            <a href="#tab_1_5_1" data-toggle="tab">
                                                            First Innings</a>
                                                    </li>
                                                    <li>
                                                            <a href="#tab_1_5_2" data-toggle="tab">
                                                            Second Innings</a>
                                                    </li>

                                            </ul>
                                            <div class="tab-content">
                                                    <div class=" tab-pane active table-scrollable" id="tab_1_5_1">
                                                     <table class="table table-striped table-bordered table-hover" id="sample_51">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_51 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         Particular
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                            

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                       <?php for($i=0; $i<8 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="event"  id="event"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                             
                                                        </tr>
                                                       <?php } ?>

                                                        </tbody>
                                                        </table>	
                                                    </div>
                                                    <div class="tab-pane table-scrollable" id="tab_1_5_2">
                                                           <table class="table table-striped table-bordered table-hover" id="sample_52">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_52 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         particular
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                              

                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                   <?php for($i=0; $i<8 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="event"  id="event"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                              
                                                        </tr>
                                                       <?php } ?>


                                                        </tbody>
                                                        </table>
                                                    </div>
                                            
                                             
                                            
                                            </div>
                                                      <div class="row pull-right col-sm-6" >
                                                                           <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn red">
                                                                                Grand Total       
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn green">
                                                                               Winning Amount
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn purple">
                                                                                Profit/Loss
                                                                              </a>
                                                                            </div>
                                                    </div>
                                    </div>
                                   
                                                                            
                                   
                            </div>
                        
                        
                        
                    </div>
            </div>
    </div>

    <div class="row"  id="game6">

            <div class="col-md-12">

                    <div class="portlet box red">
                            <div class="portlet-title">
                                    <div class="caption">
                                            <i class="fa fa-gift"></i>Top Batsman
                                    </div>
                                    <div class="tools">
                                        <input type="button"   name="cancel"  id="cancel" class="cancel btn"  value="cancel all bets"   />
                                            <a href="javascript:;" class="collapse">
                                            </a>
                                     
                                    </div>
                            </div>
                            <div class="portlet-body">
                                    <div class="tabbable-custom nav-justified">
                                            <ul class="nav nav-tabs nav-justified">
                                                    <li class="active">
                                                            <a href="#tab_1_6_1" data-toggle="tab">
                                                            Team A</a>
                                                    </li>
                                                    <li>
                                                            <a href="#tab_1_6_2" data-toggle="tab">
                                                            Team B</a>
                                                    </li>

                                            </ul>
                                            <div class="tab-content">
                                                    <div class=" tab-pane active table-scrollable" id="tab_1_6_1">
                                                     <table class="table table-striped table-bordered table-hover" id="sample_61">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_61 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         Batsmans Name
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                               

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                       <?php for($i=0; $i<15 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="batsman"  id="batsman"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                              
                                                        </tr>
                                                       <?php } ?>

                                                        </tbody>
                                                        </table>	
                                                    </div>
                                                    <div class="tab-pane table-scrollable" id="tab_1_6_2">
                                                           <table class="table table-striped table-bordered table-hover" id="sample_62">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_62 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         Batsman Name
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                              

                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                   <?php for($i=0; $i<15 ; $i++){ ?>
                                                        <tr class="odd gradeX">
  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="batsman"  id="batsman"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                               
                                                        </tr>
                                                       <?php } ?>


                                                        </tbody>
                                                        </table>
                                                    </div>
                                            
                                             
                                            
                                            </div>
                                                      <div class="row pull-right col-sm-6" >
                                                                           <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn red">
                                                                                Grand Total       
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn green">
                                                                               Winning Amount
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn purple">
                                                                                Profit/Loss
                                                                              </a>
                                                                            </div>
                                                    </div>
                                    </div>
                                   
                                                                            
                                   
                            </div>
                        
                        
                        
                    </div>
            </div>
    </div>

    <div class="row"  id="game7">

            <div class="col-md-12">

                    <div class="portlet box yellow">
                            <div class="portlet-title">
                                    <div class="caption">
                                            <i class="fa fa-gift"></i>Top Bowler
                                    </div>
                                    <div class="tools">
                                        <input type="button"   name="cancel"  id="cancel" class="cancel btn"  value="cancel all bets"   />
                                            <a href="javascript:;" class="collapse">
                                            </a>
                                        
                                    </div>
                            </div>
                            <div class="portlet-body">
                                    <div class="tabbable-custom nav-justified">
                                            <ul class="nav nav-tabs nav-justified">
                                                    <li class="active">
                                                            <a href="#tab_1_7_1" data-toggle="tab">
                                                            Team A</a>
                                                    </li>
                                                    <li>
                                                            <a href="#tab_1_7_2" data-toggle="tab">
                                                            Team B</a>
                                                    </li>

                                            </ul>
                                            <div class="tab-content">
                                                    <div class=" tab-pane active table-scrollable" id="tab_1_7_1">
                                                     <table class="table table-striped table-bordered table-hover" id="sample_71">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_71 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         Bowler Name
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                               

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                       <?php for($i=0; $i<5 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="bowler"  id="bowler"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                               
                                                        </tr>
                                                       <?php } ?>

                                                        </tbody>
                                                        </table>	
                                                    </div>
                                                    <div class="tab-pane table-scrollable" id="tab_1_7_2">
                                                           <table class="table table-striped table-bordered table-hover" id="sample_72">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_72 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         Bowler Name
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                             

                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                   <?php for($i=0; $i<5 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="bowler"  id="bowler"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                             
                                                        </tr>
                                                       <?php } ?>


                                                        </tbody>
                                                        </table>
                                                    </div>
                                            
                                             
                                            
                                            </div>
                                                      <div class="row pull-right col-sm-6" >
                                                                           <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn red">
                                                                                Grand Total       
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn green">
                                                                               Winning Amount
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn purple">
                                                                                Profit/Loss
                                                                              </a>
                                                                            </div>
                                                    </div>
                                    </div>
                                   
                                                                            
                                   
                            </div>
                        
                        
                        
                    </div>
            </div>
    </div>
    
    <div class="row" id="game8">

            <div class="col-md-12">

                    <div class="portlet box purple">
                            <div class="portlet-title">
                                    <div class="caption">
                                            <i class="fa fa-gift"></i>To Make Fifty
                                    </div>
                                    <div class="tools">
                                        <input type="button"   name="cancel"  id="cancel" class="cancel btn"  value="cancel all bets"   />
                                            <a href="javascript:;" class="collapse">
                                            </a>
                                        
                                    </div>
                            </div>
                            <div class="portlet-body">
                                    <div class="tabbable-custom nav-justified">
                                            <ul class="nav nav-tabs nav-justified">
                                                    <li class="active">
                                                            <a href="#tab_1_8_1" data-toggle="tab">
                                                            Team A</a>
                                                    </li>
                                                    <li>
                                                            <a href="#tab_1_8_2" data-toggle="tab">
                                                            Team B</a>
                                                    </li>

                                            </ul>
                                            <div class="tab-content">
                                                    <div class=" tab-pane active table-scrollable" id="tab_1_8_1">
                                                     <table class="table table-striped table-bordered table-hover" id="sample_81">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_81 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         Batsmans Name
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                          

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                       <?php for($i=0; $i<5 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="batsman"  id="batsman"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                              
                                                        </tr>
                                                       <?php } ?>

                                                        </tbody>
                                                        </table>	
                                                    </div>
                                                    <div class="tab-pane table-scrollable" id="tab_1_8_2">
                                                           <table class="table table-striped table-bordered table-hover" id="sample_82">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_82 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         Batsman Name
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                            

                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                   <?php for($i=0; $i<5 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="batsman"  id="batsman"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                              
                                                        </tr>
                                                       <?php } ?>


                                                        </tbody>
                                                        </table>
                                                    </div>
                                            
                                             
                                            
                                            </div>
                                                      <div class="row pull-right col-sm-6" >
                                                                           <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn red">
                                                                                Grand Total       
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn green">
                                                                               Winning Amount
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn purple">
                                                                                Profit/Loss
                                                                              </a>
                                                                            </div>
                                                    </div>
                                    </div>
                                   
                                                                            
                                   
                            </div>
                        
                        
                        
                    </div>
            </div>
    </div>

    <div class="row" id="game9">

            <div class="col-md-12">

                    <div class="portlet box green">
                            <div class="portlet-title">
                                    <div class="caption">
                                            <i class="fa fa-gift"></i>To Make Hundred
                                    </div>
                                    <div class="tools">
                                        <input type="button"   name="cancel"  id="cancel" class="cancel btn"  value="cancel all bets"   />
                                            <a href="javascript:;" class="collapse">
                                            </a>
                                       
                                    </div>
                            </div>
                            <div class="portlet-body">
                                    <div class="tabbable-custom nav-justified">
                                            <ul class="nav nav-tabs nav-justified">
                                                    <li class="active">
                                                            <a href="#tab_1_9_1" data-toggle="tab">
                                                            Team A</a>
                                                    </li>
                                                    <li>
                                                            <a href="#tab_1_9_2" data-toggle="tab">
                                                            Team B</a>
                                                    </li>

                                            </ul>
                                            <div class="tab-content">
                                                    <div class=" tab-pane active table-scrollable" id="tab_1_9_1">
                                                     <table class="table table-striped table-bordered table-hover" id="sample_91">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_91 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         Batsmans Name
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                        

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                       <?php for($i=0; $i<4 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="batsman"  id="batsman"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                            
                                                        </tr>
                                                       <?php } ?>

                                                        </tbody>
                                                        </table>	
                                                    </div>
                                                    <div class="tab-pane table-scrollable" id="tab_1_9_2">
                                                           <table class="table table-striped table-bordered table-hover" id="sample_92">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_92 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         Batsman Name
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                           

                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                   <?php for($i=0; $i<4 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="batsman"  id="batsman"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                               
                                                        </tr>
                                                       <?php } ?>


                                                        </tbody>
                                                        </table>
                                                    </div>
                                            
                                             
                                            
                                            </div>
                                                      <div class="row pull-right col-sm-6" >
                                                                           <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn red">
                                                                                Grand Total       
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn green">
                                                                               Winning Amount
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn purple">
                                                                                Profit/Loss
                                                                              </a>
                                                                            </div>
                                                    </div>
                                    </div>
                                   
                                                                            
                                   
                            </div>
                        
                        
                        
                    </div>
            </div>
    </div>
    
    <div class="row" id="game10">

            <div class="col-md-12">

                    <div class="portlet box red">
                            <div class="portlet-title">
                                    <div class="caption">
                                            <i class="fa fa-gift"></i>Innings Run Rate
                                    </div>
                                    <div class="tools">
                                        <input type="button"   name="cancel"  id="cancel" class="cancel btn"  value="cancel all bets"   />
                                            <a href="javascript:;" class="collapse">
                                            </a>
                                       
                                    </div>
                            </div>
                            <div class="portlet-body">
                                    <div class="tabbable-custom nav-justified">
                                            <ul class="nav nav-tabs nav-justified">
                                                    <li class="active">
                                                            <a href="#tab_1_10_1" data-toggle="tab">
                                                            Team A</a>
                                                    </li>
                                                    <li>
                                                            <a href="#tab_1_10_2" data-toggle="tab">
                                                            Team B</a>
                                                    </li>

                                            </ul>
                                            <div class="tab-content">
                                                    <div class=" tab-pane active table-scrollable" id="tab_1_10_1">
                                                     <table class="table table-striped table-bordered table-hover" id="sample_101">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_101 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         Particulars
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                        

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                       <?php for($i=0; $i<14 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="runrate"  id="runrate"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                            
                                                        </tr>
                                                       <?php } ?>

                                                        </tbody>
                                                        </table>	
                                                    </div>
                                                    <div class="tab-pane table-scrollable" id="tab_1_10_2">
                                                           <table class="table table-striped table-bordered table-hover" id="sample_102">
                                                        <thead>
                                                        <tr>
 <th class="table-checkbox">
				<input type="checkbox" class="group-checkable" data-set="#sample_102 .checkboxes"/>
			            </th>
                                                                <th>
                                                                         Particulars
                                                                </th>
                                                                <th>
                                                                         Odds
                                                                </th>
                                                                <th>
                                                                         Total Bets
                                                                </th>
                                                                <th>
                                                                         Payout
                                                                </th>
                                                                <th>
                                                                         Action
                                                                </th>
                                                           

                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                   <?php for($i=0; $i<14 ; $i++){ ?>
                                                        <tr class="odd gradeX">

  <td>
                                                                       <input type="checkbox" class="checkboxes"  name="checkboxes[]" value="<?php echo $i;  ?>"    />
			            </td>
                                                                <td>
                                                                        <input type="text"   name="runrate"  id="runrate"  value=""   />       

                                                                </td>
                                                                <td>
                                                                         <input type="text"   name="odds"  id="odds"     value=""   />	
                                                                </td>
                                                                <td>
                                                                        40
                                                                </td>
                                                                <td class="center">
                                                                         320
                                                                </td>
                                                                <td class="center ">

                                                                         <input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   />
                                                                </td>
                                                               
                                                        </tr>
                                                       <?php } ?>


                                                        </tbody>
                                                        </table>
                                                    </div>
                                            
                                             
                                            
                                            </div>
                                                      <div class="row pull-right col-sm-6" >
                                                                           <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn red">
                                                                                Grand Total       
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn green">
                                                                               Winning Amount
                                                                              </a>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                             <a href="javascript:;" class="btn purple">
                                                                                Profit/Loss
                                                                              </a>
                                                                            </div>
                                                    </div>
                                    </div>
                                   
                                                                            
                                   
                            </div>
                        
                        
                        
                    </div>
            </div>
    </div>
    
    
    
</div>
<!-- BEGIN CONTENT -->
</div>
<!-- END CONTENT -->


<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<?php include'footer.php';?>
<!-- END FOOTER -->
<link href="<?php echo base_url()?>assets/global/plugins/jquery.bxslider/jquery.bxslider.css" rel="stylesheet" type="text/css"/>
 <script src="<?php echo base_url()?>/assets/global/plugins/jquery.bxslider/jquery.bxslider.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url()?>/assets/global/plugins/jquery.bxslider/jquery.bxslider.js" type="text/javascript"></script>
<script type="text/javascript" >
$(document).ready(function() {   
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
});

$(document).ready(function(){


   $('.slider4').bxSlider({
    slideWidth: 300,
    minSlides: 2,
    maxSlides: 4,
    moveSlides: 1,
    slideMargin: 10
  });
      
   $('.portlet-body').css('display','none') ;
   $('.tools  a').removeClass('collapse');
   $('.tools  a').addClass('expand');

    
});



function expand(a){
       
   if($('#game'+a).find('.tools a').hasClass('expand')){
        $('#game'+a).find('.tools a').click();
    }
}


$('.group-checkable').on('click',function(){
        
       var id =  $(this).parent().parent().parent().parent().parent().parent().attr('id');
        var a= '#'+id+' .checkboxes';
            var b= '#'+id+' span';
        if(this.checked){
           
            $(a).prop('checked',true);
            $(b).addClass('checked');
        }else{
            $(a).prop('checked',false);
            $(b).removeClass('checked');
        }
    });
    
    $('.checkboxes').on('click',function(){
         var id =  $(this).parent().parent().parent().parent().parent().parent().attr('id');
        
        var a= '#'+id+' .checkboxes:checked';
        var b= '#'+id+' .checkboxes';
        
        if($(a).length == $(b).length){
            $('#'+id+' .group-checkable').prop('checked',true);
        }else{
        
            $('#'+id+' .group-checkable').prop('checked',false);
            $('#'+id+' .group-checkable ').parent().removeClass('checked');
        }
    });

</script>
<style type="text/css">
   .cancel{
        color:black !important;
    }
thead {
background-color: #95a5a6;
}

/*.portlet.box{
    border:solid 1px;
}

.portlet.box > .portlet-title{
    color:#000;
}
.portlet > .portlet-title > .tools > a{
    background:#000;
}*/
</style>