<?php include'header.php'; ?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="slider4"></div>
        </div>

        <div id="MatchPanelContener">
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
            
            <br><br>
                <div class="col-sm-4">
                    <button onclick="CallOddFunctionData();" class="btn green">
                        Master Odds Change
                    </button>
                </div>
                <br><br>
            
            <div class="row"  id="game6">
                
                <div class="col-md-12">

                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Win/Loss
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
                                    <div class=" tab-pane active table-scrollable" id="tab_1_6_1">
                                        <table class="table table-striped table-bordered table-hover" id="sample_61">
                                            <thead>
                                                <tr>



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
                                            <tbody class="tBodyWinLoassTeam"></tbody>
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
            </div><!--End of game6 as Win and loss-->
            
            

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
                                    <div class=" tab-pane active  table-scrollable TossClass" id="tab_1_1_1"></div>

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
                                            <tbody class="tBodyFirstBallTeamA"></tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane table-scrollable" id="tab_1_2_2">
                                        <table class="table table-striped table-bordered table-hover" id="sample_22">
                                            <thead>
                                                <tr>


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
                                            <tbody class="tBodyFirstBallTeamB"></tbody>
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
                                            <tbody class="tBodyFirstOverTeamA"></tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane table-scrollable" id="tab_1_3_2">
                                        <table class="table table-striped table-bordered table-hover" id="sample_32">
                                            <thead>
                                                <tr>
                                                    
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
                                            <tbody class="tBodyFirstOverTeamB"></tbody>
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
                                            <tbody class="tBodyFirstTenOverSessionTeamA"></tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane table-scrollable" id="tab_1_4_2">
                                        <table class="table table-striped table-bordered table-hover" id="sample_42">
                                            <thead>
                                                <tr>
                                                   
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
                                            <tbody class="tBodyFirstTenOverSessionTeamB"></tbody>
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
                                            <tbody class="tBodyFirstWicketTeamA"></tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane table-scrollable" id="tab_1_5_2">
                                        <table class="table table-striped table-bordered table-hover" id="sample_52">
                                            <thead>
                                                <tr>
                                                   
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
                                            <tbody class="tBodyFirstWicketTeamB"></tbody>
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

            <div class="row ClassThirties" id="game7">

                <div class="col-md-12">

                    <div class="portlet box purple">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>To Make Thirities  
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
                                            <tbody class="tBodyFirstThirtiesTeamA"></tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane table-scrollable" id="tab_1_7_2">
                                        <table class="table table-striped table-bordered table-hover" id="sample_72">
                                            <thead>
                                                <tr>
                                                    
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
                                            <tbody class="tBodyFirstThirtiesTeamB"></tbody>
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

            <div class="row ClassFifties" id="game8">

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
                                            <tbody class="tBodyFirstFiftiesTeamA"></tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane table-scrollable" id="tab_1_8_2">
                                        <table class="table table-striped table-bordered table-hover" id="sample_82">
                                            <thead>
                                                <tr>
                                                   
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
                                            <tbody class="tBodyFirstFiftiesTeamB"></tbody>
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

            <div class="row ClassHundreds" id="game9">

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
                                            <tbody class="tBodyFirstHundredTeamA"></tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane table-scrollable" id="tab_1_9_2">
                                        <table class="table table-striped table-bordered table-hover" id="sample_92">
                                            <thead>
                                                <tr>
                                                    
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
                                            <tbody class="tBodyFirstHundredTeamB"></tbody>
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
            
            <div class="row ClassHundreds" id="game13">

                <div class="col-md-12">

                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>First Wicket Fall At Run
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
                                        <a href="#tab_1_13_1" data-toggle="tab">
                                            Team A</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_13_2" data-toggle="tab">
                                            Team B</a>
                                    </li>

                                </ul>
                                <div class="tab-content">
                                    <div class=" tab-pane active table-scrollable" id="tab_1_13_1">
                                        <table class="table table-striped table-bordered table-hover" id="sample_131">
                                            <thead>
                                                <tr>
                                                   
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
                                            <tbody class="tBodyWicketFallAtRunsTeamA"></tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane table-scrollable" id="tab_1_9_2">
                                        <table class="table table-striped table-bordered table-hover" id="sample_132">
                                            <thead>
                                                <tr>
                                                    
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
                                            <tbody class="tBodyWicketFallAtRunsTeamB"></tbody>
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
                                            <tbody class="tBodyRunRateTeamA"></tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane table-scrollable" id="tab_1_10_2">
                                        <table class="table table-striped table-bordered table-hover" id="sample_102">
                                            <thead>
                                                <tr>
                                                   
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
                                            <tbody class="tBodyRunRateTeamB"></tbody>
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
            
            
            <div class="row"  id="game11">

                <div class="col-md-12">

                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Highest Opening Partnership
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
                                    <div class=" tab-pane active table-scrollable" id="tab_1_11_1">
                                        <table class="table table-striped table-bordered table-hover" id="sample_111">
                                            <thead>
                                                <tr>



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
                                            <tbody class="tBodyHighestOpeningPartnerShipTeam"></tbody>
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
            </div><!--End of game 11 as Highest opening partnership-->
            
            
            <div class="row"  id="game12">

                <div class="col-md-12">

                    <div class="portlet box red">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-gift"></i>Race To Fifty
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
                                    <div class=" tab-pane active table-scrollable" id="tab_1_12_1">
                                        <table class="table table-striped table-bordered table-hover" id="sample_121">
                                            <thead>
                                                <tr>



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
                                            <tbody class="tBodyRaceToFiftyTeam"></tbody>
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
            </div><!--End of game 12 as Race to Fifty-->

        </div><!---End Of Hide Div--->
    </div>
    <!-- BEGIN CONTENT -->
</div>
<!-- END CONTENT -->


<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->

<div id="dialog" title="Basic dialog">
  <p>Would You like to change these odds?</p
</div>

<?php include'footer.php'; ?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  
<!-- END FOOTER -->
<link href="<?php echo base_url() ?>assets/global/plugins/jquery.bxslider/jquery.bxslider.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url() ?>/assets/global/plugins/jquery.bxslider/jquery.bxslider.min.js" type="text/javascript"></script>

<script type="text/javascript" >

$(document).ready(function () {

    $('#MatchPanelContener').hide();
    $( "#dialog" ).hide();
    GetAllMatchList();
    //$( "#dialog" ).dialog();
});

function GetAllMatchList()
{
    //alert("First");
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetAllMatchList",
        dataType: 'json',
        data: {key: "1"},
        success: function (res) {
            //alert(res);

            var MatchListDataArray = '';
            var AddClassValue = '';
            $.each(res, function (key, value) {
                // alert( key + ": " + value['id'] );
                var IndiexId = key + 1;
                if (IndiexId % 4 == 0) {
                    AddClassValue = "class='dashboard-stat red-intense slide' ";
                }
                else if (IndiexId % 3 == 0)
                {
                    AddClassValue = "class='dashboard-stat green  slide' ";
                }
                else if (IndiexId % 2 == 0)
                {
                    AddClassValue = "class='dashboard-stat purple  slide' ";
                }
                else
                {
                    AddClassValue = "class='dashboard-stat yellow  slide' ";
                }
                asd = value['format'];
                // alert(AddClass);
                //AddClass = 'class="dashboard-stat yellow  slide" ';
                MatchListDataArray += '<div ' + AddClassValue + '>';
                MatchListDataArray += '<div class="visual"><i class="fa fa-money"></i></div><div class="details">' + value['status'] + '&nbsp;&nbsp;&nbsp; ' + value['format'] + '&nbsp;&nbsp;&nbsp;' + value['start_date'] + '<div class="number"></div><div class="desc">' + value['name'] + '</div></div><a class="more" href="#" onclick="MatchDetailValues(\'' + value['id'] + '\',\'' + value['format'] + '\')";>View more <i class="m-icon-swapright m-icon-white"></i></a>';
                MatchListDataArray += '</div>';

            });


            $(".slider4").html(MatchListDataArray);
            $('.slider4').bxSlider({
                slideWidth: 300,
                minSlides: 2,
                maxSlides: 4,
                moveSlides: 1,
                slideMargin: 10
            });


        }
    });

}

function MatchDetailValues(MatchId , MatchFormat)
{
    $('.ClassHundreds').hide();
    $('.ClassThirties').hide();
    $('.ClassFifties').hide();
    $('#MatchPanelContener').show();
    if(MatchFormat == "t20")
    {
        $('.ClassHundreds').hide();
        $('.ClassThirties').show();
        $('.ClassFifties').show();
        
    }
    if(MatchFormat == "one-day")
    {
        $('.ClassThirties').hide();
        $('.ClassFifties').show();
        $('.ClassHundreds').show();
    }
     
    
    
    MatchTossTabDataFun(MatchId);
    MatchFirstBallTabDataFun(MatchId);
    MatchFirstOverTabDataFun(MatchId);
    MatchFirstTenOverSessionTabDataFun(MatchId);
    MatchFirstWicketTabDataFun(MatchId);
    MatchFirstThirtyTabDataFun(MatchId);
    MatchFirstFiftyTabDataFun(MatchId);
    MatchFirstHundredTabDataFun(MatchId);
    MatchFirstRunRateTabDataFun(MatchId);
    MatchWinLossTabDataFun(MatchId);
    MatchHighestOpeningPartnerShipTabDataFun(MatchId);
    MatchRaceToFiftyTabDataFun(MatchId);
    MatchWicketFallAtRunsTabDataFun(MatchId);
}

function MatchTossTabDataFun(MatchId)
{
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetTossGameData",
        dataType: 'json',
        data: {key: MatchId},
        success: function (res) {

            var AllMatchDetailDataValue = '';
            var MatchTeamNameValueA = "";
            var MatchTeamNameValueB = "";
            
            if (res[0].toss_win != null)
            {
               
                if (res[0].toss_win == "a" && res[0].decision == "bowl")
                {
                    //$("#teama").text(res[0].team_a);
                    MatchTeamNameValueA = res[0].team_b;
                    MatchTeamNameValueB = res[0].team_a;
                }
                
               if (res[0].toss_win == "b" && res[0].decision == "bowl")
                {
                    //$("#teama").text(res[0].team_a);
                    MatchTeamNameValueA = res[0].team_a;
                    MatchTeamNameValueB = res[0].team_b;
                }
                
                if (res[0].toss_win == "a" && res[0].decision == "bat")
                {
                    //$("#teama").text(res[0].team_a);
                    MatchTeamNameValueA = res[0].team_a;
                    MatchTeamNameValueB = res[0].team_b;
                }
                
               if (res[0].toss_win == "b" && res[0].decision == "bat")
                {
                    //$("#teama").text(res[0].team_a);
                    MatchTeamNameValueA = res[0].team_b;
                    MatchTeamNameValueB = res[0].team_a;
                }

            }
            else
            {
                //alert("out");
                MatchTeamNameValueA = res[0].team_a;
                MatchTeamNameValueB = res[0].team_b;
            }
            
            //alert("Before");
            AllMatchDetailDataValue += '<table class="table table-striped table-bordered table-hover" id="sample_1"><thead><tr>';
            AllMatchDetailDataValue += '<td>' + MatchTeamNameValueA + '</td><td>' + MatchTeamNameValueB + '</td><td>Total Bet on Team A</td><td>Payout</td><td>Total Bet on Team B</td><td>Payout</td><td>Enter Result</td><td><input type="button"   name="execute"  id="execute" class="execute btn"  value="Execute"   /></td>';
            AllMatchDetailDataValue += '</tr></thead></table>';

            $(".TossClass").html(AllMatchDetailDataValue);

        }
    });


}


function MatchFirstBallTabDataFun(MatchId)
{
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetFirstBallData",
        dataType: 'json',
        data: {key: MatchId},
        success: function (res) {

       var TeamDataA = '';
       var TeamDataB = '';
 

            $.each(res, function (key, value) {
                // alert( key + ": " + value['id'] );
                var IndiexId = key + 1;
                if(value['m_id'] == 3)
                {  
                    
                    TeamDataA += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                if(value['m_id'] == 4)
                { 
                    
                    
                    TeamDataB += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                
                

            });

            $(".tBodyFirstBallTeamA").html(TeamDataA);
            $(".tBodyFirstBallTeamB").html(TeamDataB);




        }
        })
}



function MatchFirstOverTabDataFun(MatchId)
{
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetFirstOverData",
        dataType: 'json',
        data: {key: MatchId},
        success: function (res) {

       var TeamDataA = '';
       var TeamDataB = '';
 

            $.each(res, function (key, value) {
                // alert( key + ": " + value['id'] );
                var IndiexId = key + 1;
                if(value['m_id'] == 5)
                {  
                    
                    TeamDataA += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                if(value['m_id'] == 6)
                { 
                    
                    
                    TeamDataB += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                
                

            });

            $(".tBodyFirstOverTeamA").html(TeamDataA);
            $(".tBodyFirstOverTeamB").html(TeamDataB);




        }
        })
}


function MatchFirstTenOverSessionTabDataFun(MatchId)
{
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetFirstTenOverSessionData",
        dataType: 'json',
        data: {key: MatchId},
        success: function (res) {

       var TeamDataA = '';
       var TeamDataB = '';
 

            $.each(res, function (key, value) {
                // alert( key + ": " + value['id'] );
                var IndiexId = key + 1;
                if(value['m_id'] == 7)
                {  
                    
                    TeamDataA += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                if(value['m_id'] == 8)
                {
                    
                    
                    TeamDataB += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                
                

            });

            $(".tBodyFirstTenOverSessionTeamA").html(TeamDataA);
            $(".tBodyFirstTenOverSessionTeamB").html(TeamDataB);




        }
        })
}



function MatchFirstWicketTabDataFun(MatchId)
{
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetFirstWicketData",
        dataType: 'json',
        data: {key: MatchId},
        success: function (res) {

       var TeamDataA = '';
       var TeamDataB = '';
 

            $.each(res, function (key, value) {
                // alert( key + ": " + value['id'] );
                var IndiexId = key + 1;
                if(value['m_id'] == 9)
                {  
                    
                    TeamDataA += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                if(value['m_id'] == 10)
                { 
                    
                    
                    TeamDataB += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                
                

            });

            $(".tBodyFirstWicketTeamA").html(TeamDataA);
            $(".tBodyFirstWicketTeamB").html(TeamDataB);




        }
        })
}



function MatchFirstThirtyTabDataFun(MatchId)
{
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetFirstThirtiesRunData",
        dataType: 'json',
        data: {key: MatchId},
        success: function (res) {

       var TeamDataA = '';
       var TeamDataB = '';
 

            $.each(res, function (key, value) {
                // alert( key + ": " + value['id'] );
                var IndiexId = key + 1;
                if(value['m_id'] == 15)
                {  
                    
                    TeamDataA += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                if(value['m_id'] == 16)
                { 
                    
                    
                    TeamDataB += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                
                

            });

            $(".tBodyFirstThirtiesTeamA").html(TeamDataA);
            $(".tBodyFirstThirtiesTeamB").html(TeamDataB);

        }
        })
}


function MatchFirstFiftyTabDataFun(MatchId)
{
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetFirstFiftyRunData",
        dataType: 'json',
        data: {key: MatchId},
        success: function (res) {

       var TeamDataA = '';
       var TeamDataB = '';
 

            $.each(res, function (key, value) {
                // alert( key + ": " + value['id'] );
                var IndiexId = key + 1;
                if(value['m_id'] == 17)
                {  
                    
                    TeamDataA += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                if(value['m_id'] == 18)
                { 
                    
                    
                    TeamDataB += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                
                

            });

            $(".tBodyFirstFiftiesTeamA").html(TeamDataA);
            $(".tBodyFirstFiftiesTeamB").html(TeamDataB);

        }
        })
}


function MatchFirstHundredTabDataFun(MatchId)
{
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetFirstHundredRunData",
        dataType: 'json',
        data: {key: MatchId},
        success: function (res) {

       var TeamDataA = '';
       var TeamDataB = '';
 

            $.each(res, function (key, value) {
                // alert( key + ": " + value['id'] );
                var IndiexId = key + 1;
                if(value['m_id'] == 19)
                {  
                    
                    TeamDataA += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                if(value['m_id'] == 20)
                { 
                    
                    
                    TeamDataB += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                
                

            });

            $(".tBodyFirstHundredTeamA").html(TeamDataA);
            $(".tBodyFirstHundredTeamB").html(TeamDataB);

        }
        })
}


function MatchWicketFallAtRunsTabDataFun(MatchId)
{
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetWicketFallAtRunsGameData",
        dataType: 'json',
        data: {key: MatchId},
        success: function (res) {

       var TeamDataA = '';
       var TeamDataB = '';
 

            $.each(res, function (key, value) {
                // alert( key + ": " + value['id'] );
                var IndiexId = key + 1;
                if(value['m_id'] == 13)
                {  
                    
                    TeamDataA += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                if(value['m_id'] == 14)
                { 
                    
                    
                    TeamDataB += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                
                

            });

            $(".tBodyWicketFallAtRunsTeamA").html(TeamDataA);
            $(".tBodyWicketFallAtRunsTeamB").html(TeamDataB);

        }
        })
}

function MatchFirstRunRateTabDataFun(MatchId)
{
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetFirstRunRateData",
        dataType: 'json',
        data: {key: MatchId},
        success: function (res) {

       var TeamDataA = '';
       var TeamDataB = '';
 

            $.each(res, function (key, value) {
                // alert( key + ": " + value['id'] );
                var IndiexId = key + 1;
                if(value['m_id'] == 21)
                {  
                    
                    TeamDataA += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                if(value['m_id'] == 22)
                { 
                    
                    
                    TeamDataB += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                
                

            });

            $(".tBodyRunRateTeamA").html(TeamDataA);
            $(".tBodyRunRateTeamB").html(TeamDataB);

        }
        })
}





function MatchWinLossTabDataFun(MatchId)
{
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetWinLossData",
        dataType: 'json',
        data: {key: MatchId},
        success: function (res) {

       var TeamDataA = '';
       var TeamDataB = '';
 

            $.each(res, function (key, value) {
                // alert( key + ": " + value['id'] );
                var IndiexId = key + 1;
               
                if(value['m_id'] == 1)
                { 
                    
                    
                    TeamDataA += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                
                

            });

            $(".tBodyWinLoassTeam").html(TeamDataA);
           // $(".tBodyRunRateTeamB").html(TeamDataB);

        }
        })
}





function MatchHighestOpeningPartnerShipTabDataFun(MatchId)
{
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetHighestOpeningPartnerShipData",
        dataType: 'json',
        data: {key: MatchId},
        success: function (res) {

       var TeamDataA = '';
       var TeamDataB = '';
 

            $.each(res, function (key, value) {
                // alert( key + ": " + value['id'] );
                var IndiexId = key + 1;
               
                if(value['m_id'] == 11)
                { 
                    
                    
                    TeamDataA += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                
                

            });

            $(".tBodyHighestOpeningPartnerShipTeam").html(TeamDataA);
           // $(".tBodyRunRateTeamB").html(TeamDataB);

        }
        })
}


function MatchRaceToFiftyTabDataFun(MatchId)
{
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetRaceToFiftyData",
        dataType: 'json',
        data: {key: MatchId},
        success: function (res) {

       var TeamDataA = '';
       var TeamDataB = '';
 

            $.each(res, function (key, value) {
                // alert( key + ": " + value['id'] );
                var IndiexId = key + 1;
               
                if(value['m_id'] == 12)
                { 
                    
                    
                    TeamDataA += '<tr class="odd gradeX">\n\
                                                <td>'+value['perticulars']+'</td>\n\
                                                 <td> <input type="text" class="OddToraceFiftyClass" name="odds_'+IndiexId+'" id="odds_'+value['match_id']+'_'+value['odd_id']+'_'+value['id']+'" value="'+value['odds']+'"/> </td>\n\
                                                <td>  </td> \n\
                                                <td class="center">  </td>\n\
                                                <td class="center ">\n\
                                                <input type="button" name="execute"  id="execute" class="execute btn" value="Execute" /> </td>\n\
                                            </tr>';
                    
                }
                
                

            });

            $(".tBodyRaceToFiftyTeam").html(TeamDataA);
           // $(".tBodyRunRateTeamB").html(TeamDataB);

        }
        })
}

function FunctionToChangeOdds(GameTypeFlag)
{ // 1 for Change Master odds also // 0 for change only selected match odds 
    //alert("Coming Odds");
   // OddToraceFiftyClass
   var OddsJavascriptArray = [];
   $(".OddToraceFiftyClass").each(function() {
    //alert($(this).val()+" "+$(".OddToraceFiftyClass").attr('id'));
    OddsJavascriptArray.push({
        GameTypeFlag: GameTypeFlag,
        OddsValue: $(this).val(),
        OddsId: $(this).attr('id')
        });
    
    });
    //alert(els);
    
    
    $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/SetChangeOddsCommonData",
    dataType: 'json',
    data: {OddsKey : OddsJavascriptArray},
    success: function (res) {

        //alert(res['MatchId']);
        MatchDetailValues(res['MatchId'], res['MatchFormat']);
    }
    });
    
    
    
}

function CallOddFunctionData()
{
    $( "#dialog" ).show();
   // $( "#dialog" ).dialog();
        $( "#dialog" ).dialog({
      resizable: false,
      height:140,
      width:340,
      modal: true,
      buttons: {
        "All Matches": function() {
            FunctionToChangeOdds(1);
          $( this ).dialog( "close" );
        },
        "This Match": function() {
            FunctionToChangeOdds(0);
          $( this ).dialog( "close" );
        }
      }
    });
}


</script>
<style type="text/css">
    .cancel{
        color:black !important;
    }
    thead {
        background-color: #95a5a6;
    }

</style>