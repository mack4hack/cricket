<?php include'header.php'; ?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <div class="row">
            <div class="slider4"></div>
        </div>

        <div id="MatchPanelContener">
            <!--   <div class="btn-group btn-group btn-group-justified"  style="padding:0% 10% 1% 9%;">
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
               </div> --->

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

                    <div class="portlet box red">
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
                                    <div class=" tab-pane active table-scrollable" id="tab_1_1_1">
                                        <table class="table table-striped table-bordered table-hover" id="sample_11">
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
                                            <tbody class="TossDetailsClass"></tbody>
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
            </div><!--End of game 1 as Toss-->

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
        
        
        <div id="ScoreCardContainer">
            <div class="SectionTeamA">
                <div class="tBodyTeamA"></div>
                <b>Batsman Scorecard</b>
                <div class="divBatsmanBattingContener">                    
                    <div>
                        <span>#</span>
                        <span>Batsman</span>
                        <span>Runs(B)</span>
                        <span>Strike Rate</span>
                    </div>                  
                    <div class="tBodyBatsmansA"></div>
                </div>
                <b>Fall OF Wicket</b>
                <div>                    
                    <div>
                        <span>Batsman Name</span>
                        <span>Runs/Wicket</span>
                        
                    </div>                  
                    <div class="tBodyBatsmansOutAtRunsA"></div>
                </div>
            </div>
            <div class="SectionTeamB"> 
                <div class="tBodyTeamB"></div>
                <b>Batsman Scorecard</b>
                <div>                    
                    <div>
                        <span>#</span>
                        <span>Batsman</span>
                        <span>Runs(B)</span>
                        <span>Strike Rate</span>
                    </div>                  
                    <div class="tBodyBatsmansB"></div>
                </div>
                
                <b>Fall OF Wicket</b>
                <div>                    
                    <div>
                        <span>Batsman Name</span>
                        <span>Runs/Wicket</span>
                        
                    </div>                  
                    <div class="tBodyBatsmansOutAtRunsB"></div>
                </div>
            </div>
            
        </div>
        
        
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
                            $('#ScoreCardContainer').hide();
                            $("#dialog").hide();
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
                                        MatchListDataArray += '<div class="visual"><i class="fa fa-money"></i></div>\n\
                                       <div class="details">\n\
                                        ' + value['status'] + '<br> \n\
                                        ' + value['format'] + '<br>\n\
                                        ' + value['start_date'] + '\
                                       <div class="desc"><a class="more" href="#" onclick="MatchScoreCardValues(\'' + value['id'] + '\',\'' + value['format'] + '\')";>' + value['name'] + '</a></div>\n\
                                       </div>\n\
                                        <a class="more" href="#" onclick="MatchDetailValues(\'' + value['id'] + '\',\'' + value['format'] + '\')";>View more <i class="m-icon-swapright m-icon-white"></i></a>';
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
                        
                        function MatchDetailValues(MatchId, MatchFormat)
                        {
                            $('.ClassHundreds').hide();
                            $('.ClassThirties').hide();
                            $('.ClassFifties').hide();
                            $('#MatchPanelContener').show();
                            if (MatchFormat == "t20")
                            {
                                $('.ClassHundreds').hide();
                                $('.ClassThirties').show();
                                $('.ClassFifties').show();

                            }
                            if (MatchFormat == "one-day")
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
                                    
                                    
                                    
                                    var TeamDataA = '';
                                    var TeamDataB = '';
                                    var TeamTossArrayHtmlDataValue = "";
                                    var TeamDataExecuteA = '';
                                    var TeamDataWinFlagA = '';


                                    $.each(res, function (key, value) {
                                        // alert( key + ": " + value['id'] );
                                        var IndiexId = key + 1;

                                        if (value['m_id'] == 2)
                                        {
                                            
                                            TeamDataWinFlagA = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteA = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteA = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteA = 'Not Available';
                                            }


                                            TeamTossArrayHtmlDataValue += '<tr '+TeamDataWinFlagA+' class="odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteA+'</td>\n\
                                                          </tr>';

                                        }



                                    });
                                    
                                    $(".TossDetailsClass").html(TeamTossArrayHtmlDataValue);
                                    
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
                                    
                                    var TeamDataExecuteA = '';
                                    var TeamDataWinFlagA = '';
                                    
                                    var TeamDataExecuteB = '';
                                    var TeamDataWinFlagB = '';


                                    $.each(res, function (key, value) {
                                        // alert( key + ": " + value['id'] );
                                        var IndiexId = key + 1;
                                        if (value['m_id'] == 3)
                                        {
                                            TeamDataWinFlagA = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteA = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteA = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteA = 'Not Available';
                                            }
                                            


                                            TeamDataA += '<tr class="'+TeamDataWinFlagA+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteA+'</td>\n\
                                                          </tr>';

                                        }
                                        if (value['m_id'] == 4)
                                        {
                                            
                                            TeamDataWinFlagB = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteB = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteB = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteB = 'Not Available';
                                            }
                                            


                                            TeamDataB += '<tr class="'+TeamDataWinFlagB+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteB+'</td>\n\
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
                                    
                                    var TeamDataExecuteA = '';
                                    var TeamDataWinFlagA = '';
                                    
                                    var TeamDataExecuteB = '';
                                    var TeamDataWinFlagB = '';


                                    $.each(res, function (key, value) {
                                        // alert( key + ": " + value['id'] );
                                        var IndiexId = key + 1;
                                        if (value['m_id'] == 5)
                                        {
                                            TeamDataWinFlagA = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteA = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteA = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteA = 'Not Available';
                                            }
                                            


                                            TeamDataA += '<tr class="'+TeamDataWinFlagA+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteA+'</td>\n\
                                                          </tr>';

                                        }
                                        if (value['m_id'] == 6)
                                        {
                                            
                                            TeamDataWinFlagB = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteB = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteB = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteB = 'Not Available';
                                            }
                                            


                                            TeamDataB += '<tr class="'+TeamDataWinFlagB+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteB+'</td>\n\
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
                                    
                                    var TeamDataExecuteA = '';
                                    var TeamDataWinFlagA = '';
                                    
                                    var TeamDataExecuteB = '';
                                    var TeamDataWinFlagB = '';


                                    $.each(res, function (key, value) {
                                        // alert( key + ": " + value['id'] );
                                        var IndiexId = key + 1;
                                        if (value['m_id'] == 7)
                                        {
                                            TeamDataWinFlagA = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteA = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteA = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteA = 'Not Available';
                                            }
                                            


                                            TeamDataA += '<tr class="'+TeamDataWinFlagA+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteA+'</td>\n\
                                                          </tr>';

                                        }
                                        if (value['m_id'] == 8)
                                        {
                                            
                                            TeamDataWinFlagB = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteB = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteB = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteB = 'Not Available';
                                            }
                                            


                                            TeamDataB += '<tr class="'+TeamDataWinFlagB+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteB+'</td>\n\
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
                                    
                                    var TeamDataExecuteA = '';
                                    var TeamDataWinFlagA = '';
                                    
                                    var TeamDataExecuteB = '';
                                    var TeamDataWinFlagB = '';


                                    $.each(res, function (key, value) {
                                        // alert( key + ": " + value['id'] );
                                        var IndiexId = key + 1;
                                        if (value['m_id'] == 9)
                                        {
                                            TeamDataWinFlagA = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteA = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteA = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteA = 'Not Available';
                                            }
                                            


                                            TeamDataA += '<tr class="'+TeamDataWinFlagA+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteA+'</td>\n\
                                                          </tr>';

                                        }
                                        if (value['m_id'] == 10)
                                        {
                                            
                                            TeamDataWinFlagB = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteB = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteB = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteB = 'Not Available';
                                            }
                                            


                                            TeamDataB += '<tr class="'+TeamDataWinFlagB+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteB+'</td>\n\
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
                                    
                                    var TeamDataExecuteA = '';
                                    var TeamDataWinFlagA = '';
                                    
                                    var TeamDataExecuteB = '';
                                    var TeamDataWinFlagB = '';


                                    $.each(res, function (key, value) {
                                        // alert( key + ": " + value['id'] );
                                        var IndiexId = key + 1;
                                        if (value['m_id'] == 15)
                                        {
                                            TeamDataWinFlagA = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteA = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteA = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteA = 'Not Available';
                                            }
                                            


                                            TeamDataA += '<tr class="'+TeamDataWinFlagA+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteA+'</td>\n\
                                                          </tr>';

                                        }
                                        if (value['m_id'] == 16)
                                        {
                                            
                                            TeamDataWinFlagB = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteB = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteB = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteB = 'Not Available';
                                            }
                                            


                                            TeamDataB += '<tr class="'+TeamDataWinFlagB+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteB+'</td>\n\
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
                                    
                                    var TeamDataExecuteA = '';
                                    var TeamDataWinFlagA = '';
                                    
                                    var TeamDataExecuteB = '';
                                    var TeamDataWinFlagB = '';


                                    $.each(res, function (key, value) {
                                        // alert( key + ": " + value['id'] );
                                        var IndiexId = key + 1;
                                        if (value['m_id'] == 17)
                                        {
                                            TeamDataWinFlagA = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteA = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteA = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteA = 'Not Available';
                                            }
                                            


                                            TeamDataA += '<tr class="'+TeamDataWinFlagA+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteA+'</td>\n\
                                                          </tr>';

                                        }
                                        if (value['m_id'] == 18)
                                        {
                                            
                                            TeamDataWinFlagB = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteB = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteB = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteB = 'Not Available';
                                            }
                                            


                                            TeamDataB += '<tr class="'+TeamDataWinFlagB+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteB+'</td>\n\
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
                                    
                                    var TeamDataExecuteA = '';
                                    var TeamDataWinFlagA = '';
                                    
                                    var TeamDataExecuteB = '';
                                    var TeamDataWinFlagB = '';


                                    $.each(res, function (key, value) {
                                        // alert( key + ": " + value['id'] );
                                        var IndiexId = key + 1;
                                        if (value['m_id'] == 19)
                                        {
                                            TeamDataWinFlagA = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteA = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteA = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteA = 'Not Available';
                                            }
                                            


                                            TeamDataA += '<tr class="'+TeamDataWinFlagA+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteA+'</td>\n\
                                                          </tr>';

                                        }
                                        if (value['m_id'] == 20)
                                        {
                                            
                                            TeamDataWinFlagB = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteB = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteB = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteB = 'Not Available';
                                            }
                                            


                                            TeamDataB += '<tr class="'+TeamDataWinFlagB+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteB+'</td>\n\
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
                                    
                                    var TeamDataExecuteA = '';
                                    var TeamDataWinFlagA = '';
                                    
                                    var TeamDataExecuteB = '';
                                    var TeamDataWinFlagB = '';


                                    $.each(res, function (key, value) {
                                        // alert( key + ": " + value['id'] );
                                        var IndiexId = key + 1;
                                        if (value['m_id'] == 13)
                                        {
                                            TeamDataWinFlagA = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteA = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteA = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteA = 'Not Available';
                                            }
                                            


                                            TeamDataA += '<tr class="'+TeamDataWinFlagA+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteA+'</td>\n\
                                                          </tr>';

                                        }
                                        if (value['m_id'] == 14)
                                        {
                                            
                                            TeamDataWinFlagB = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteB = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteB = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteB = 'Not Available';
                                            }
                                            


                                            TeamDataB += '<tr class="'+TeamDataWinFlagB+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteB+'</td>\n\
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
                                    
                                    var TeamDataExecuteA = '';
                                    var TeamDataWinFlagA = '';
                                    
                                    var TeamDataExecuteB = '';
                                    var TeamDataWinFlagB = '';


                                    $.each(res, function (key, value) {
                                        // alert( key + ": " + value['id'] );
                                        var IndiexId = key + 1;
                                        if (value['m_id'] == 21)
                                        {
                                            TeamDataWinFlagA = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteA = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteA = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteA = 'Not Available';
                                            }
                                            


                                            TeamDataA += '<tr class="'+TeamDataWinFlagA+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteA+'</td>\n\
                                                          </tr>';

                                        }
                                        if (value['m_id'] == 22)
                                        {
                                            
                                            TeamDataWinFlagB = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteB = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteB = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteB = 'Not Available';
                                            }
                                            


                                            TeamDataB += '<tr class="'+TeamDataWinFlagB+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteB+'</td>\n\
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
                                    
                                    var TeamDataExecuteA = '';
                                    var TeamDataWinFlagA = '';


                                    $.each(res, function (key, value) {
                                        // alert( key + ": " + value['id'] );
                                        var IndiexId = key + 1;

                                        if (value['m_id'] == 1)
                                        { 
                                            TeamDataWinFlagA = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteA = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteA = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteA = 'Not Available';
                                            }
                                            


                                            TeamDataA += '<tr class="'+TeamDataWinFlagA+' odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteA+'</td>\n\
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
                                    
                                    var TeamDataExecuteA = '';
                                    var TeamDataWinFlagA = '';


                                    $.each(res, function (key, value) {
                                        // alert( key + ": " + value['id'] );
                                        var IndiexId = key + 1;

                                        if (value['m_id'] == 11)
                                        {
                                            TeamDataWinFlagA = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteA = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteA = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteA = 'Not Available';
                                            }


                                            TeamDataA += '<tr '+TeamDataWinFlagA+' class="odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteA+'</td>\n\
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
                                    
                                    var TeamDataExecuteA = '';
                                    var TeamDataWinFlagA = '';


                                    $.each(res, function (key, value) {
                                        // alert( key + ": " + value['id'] );
                                        var IndiexId = key + 1;

                                        if (value['m_id'] == 12)
                                        {
                                            
                                            TeamDataWinFlagA = (value['result_bet'] == "win")?"WinBetFlag":"";
                                            
                                            if(value['result_bet'] == "win" && value['execute_flag'] == 0)
                                            {
                                                TeamDataExecuteA = '<input type="button" name="execute"  id="execute" class="execute btn" value="Execute" onclick="MatchExecuteData(\'' + value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id'] + '\')"; /> ';
                                            }
                                            else if(value['result_bet'] == "win" && value['execute_flag'] == 1)
                                            {
                                                TeamDataExecuteA = 'Payment Paid';
                                            }
                                            else
                                            {
                                                TeamDataExecuteA = 'Not Available';
                                            }


                                            TeamDataA += '<tr '+TeamDataWinFlagA+' class="odd gradeX">\n\
                                                            <td>' + value['perticulars'] + '</td>\n\
                                                            <td> <input type="text" class="OddToraceFiftyClass" name="odds_' + IndiexId + '" id="odds_' + value['match_id'] + '_' + value['odd_id'] + '_' + value['id'] + '" value="' + value['odds'] + '"/> </td>\n\
                                                            <td> ' + value['total_chips'] + ' </td> \n\
                                                            <td class="center">' + value['payout'] + '  </td>\n\
                                                            <td class="center ">'+TeamDataExecuteA+'</td>\n\
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
                            $(".OddToraceFiftyClass").each(function () {
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
                                data: {OddsKey: OddsJavascriptArray},
                                success: function (res) {

                                    //alert(res['MatchId']);
                                    MatchDetailValues(res['MatchId'], res['MatchFormat']);
                                }
                            });



                        }

                        function CallOddFunctionData()
                        {
                            $("#dialog").show();
                            // $( "#dialog" ).dialog();
                            $("#dialog").dialog({
                                resizable: false,
                                height: 140,
                                width: 340,
                                modal: true,
                                buttons: {
                                    "All Matches": function () {
                                        FunctionToChangeOdds(1);
                                        $(this).dialog("close");
                                    },
                                    "This Match": function () {
                                        FunctionToChangeOdds(0);
                                        $(this).dialog("close");
                                    }
                                }
                            });
                        }



                        function MatchScoreCardValues(MatchId, MatchFormat)
                        {
                            //MatchId = 41;
                            $('#MatchPanelContener').hide();
                            $('#ScoreCardContainer').show();
                            
                            //alert(MatchId+ " "+MatchFormat);
                            MatchBatsmanScoreDataFun(MatchId);
                            MatchBatsmanOutAtRunDataFun(MatchId);
                            MatchBatsmanOutAtRunOFTeamBDataFun(MatchId);
                           
                        }
                        
                        function MatchBatsmanOutAtRunOFTeamBDataFun(MatchId)
                        {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetAllBatsmanOutAtRunOFTeamBData",
                                dataType: 'json',
                                data: {key: MatchId},
                                success: function (res) {

                                    var TeamDataA = '';
                                    var TeamDataB = '';
                                    var IncrementalA = 1;
                                    var IncrementalB = 1;
                                    $.each(res, function (key, value) {
                                       
                                            TeamDataA += '<div>\n\
                                                            <span>' + value['player_name'] + '</span>\n\
                                                            <span>' + value['team_runs'] + '/' + value['player_wicket_index'] + '  </span>\n\
                                                          </div>';
                                            IncrementalA = IncrementalA + 1; 

                                    });

                                    $(".tBodyBatsmansOutAtRunsB").html(TeamDataA);
                                    
                                }
                            })
                        }
                        
                        
                        function MatchBatsmanOutAtRunDataFun(MatchId)
                        {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetAllBatsmanOutAtRunData",
                                dataType: 'json',
                                data: {key: MatchId},
                                success: function (res) {

                                    var TeamDataA = '';
                                    var TeamDataB = '';
                                    var IncrementalA = 1;
                                    var IncrementalB = 1;
                                    $.each(res, function (key, value) {
                                       
                                            TeamDataA += '<div>\n\
                                                            <span>' + value['player_name'] + '</span>\n\
                                                            <span>' + value['team_runs'] + '/' + value['player_wicket_index'] + '  </span>\n\
                                                          </div>';
                                            IncrementalA = IncrementalA + 1; 

                                    });

                                    $(".tBodyBatsmansOutAtRunsA").html(TeamDataA);
                                    
                                }
                            })
                        }
                        
                        function MatchBatsmanScoreDataFun(MatchId)
                        {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetAllBatsmanData",
                                dataType: 'json',
                                data: {key: MatchId},
                                success: function (res) {

                                    var TeamDataA = '';
                                    var TeamDataB = '';
                                    var TeamNameA = '';
                                    var TeamNameB = '';
                                    var IncrementalA = 1;
                                    var IncrementalB = 1;
                                    $.each(res, function (key, value) {
                                        
                                        
                                        if(value['Innings_code'] == value['batting_team']+"_1")
                                        {
                                            TeamDataA += '<div>\n\
                                                            <span>' + IncrementalA + '</span>\n\
                                                            <span>' + value['player_name'] + '</span>\n\
                                                            <span> ' + value['player_runs'] + '(' + value['player_balls'] + ') </span> \n\
                                                            <span>' + value['player_strike_rate'] + '  </span>\n\
                                                       </div>';
                                            IncrementalA = IncrementalA + 1; 
                                            TeamNameA = value['team_a'];
                                            
                                        }
                                        else
                                        {
                                            TeamDataB += '<div>\n\
                                                            <span>' + IncrementalB + '</span>\n\
                                                            <span>' + value['player_name'] + '</span>\n\
                                                            <span> ' + value['player_runs'] + '(' + value['player_balls'] + ') </span> \n\
                                                            <span>' + value['player_strike_rate'] + '  </span>\n\
                                                       </div>';
                                            IncrementalB = IncrementalB + 1;
                                             TeamNameB = value['team_b'];
                                        } 

                                    });

                                    $(".tBodyBatsmansA").html(TeamDataA);
                                    $(".tBodyBatsmansB").html(TeamDataB);
                                    
                                    $(".tBodyTeamA").html(TeamNameA);
                                    $(".tBodyTeamB").html(TeamNameB);
                                    // $(".tBodyRunRateTeamB").html(TeamDataB);

                                }
                            })
                        }
                        
                        function MatchExecuteData(MatchId, mId, OddId )
                        {
                           // value['match_id'] + '\',\'' + value['m_id'] + '\',\'' + value['odd_id']
                           
                           $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>" + "index.php/cricketcontroller/GetWinLoasAjaxExecute",
                                dataType: 'json',
                                data: { match_id: MatchId, m_id: mId, odd_id: OddId },
                                success: function (res) {
                                    
                                    MatchDetailValues(res['MatchId'], res['MatchFormat']);
                                
                                }
                            })
                           
                           
                        }


</script>
<style type="text/css">
    .cancel{
        color:black !important;
    }
    thead {
        background-color: #95a5a6;
    }
    
    .WinBetFlag {
         background-color: #fdbf79 !important;
    }

</style>