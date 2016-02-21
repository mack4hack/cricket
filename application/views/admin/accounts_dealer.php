<?php include'header.php';?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
        Players wise Account
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN ACCORDION PORTLET-->
                <!-- END ACCORDION PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Summary
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">
                            </a>
                            <a href="#portlet-config" data-toggle="modal" class="config">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="tabbable-custom nav-justified">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#tab_1_1_1" data-toggle="tab">
                                    Daily </a>
                                </li>
                                <li>
                                    <a href="#tab_1_1_2" data-toggle="tab">
                                    Weekly </a>
                                </li>
                                <li>
                                    <a href="#tab_1_1_3" data-toggle="tab">
                                    Monthly </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active  table-scrollable" id="tab_1_1_1">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Sr No
                                                </th>
                                                <th>
                                                    Player Code
                                                </th>
                                                <th>
                                                    Bet Chips
                                                </th>
                                                <th>
                                                    Wining Payout
                                                </th>
                                                <th>
                                                    Commission
                                                </th>
                                                <th>
                                                    Balance
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($data_daily)  ) {
                                            foreach($data_daily as $dd){ $player_id = $dd['player_id']; ?>
                                            <tr class="success">
                                                <td><?php echo $dd['sr_no']; ?></td>
                                                <td><a href="<?php echo base_url("/admin/accountsplayer?player_id=$player_id") ?>"><?php echo $dd['user_code']; ?></a></td>
                                                <td><?php echo $dd['bet_amount']; ?></td>
                                                <td><?php echo $dd['payout']; ?></td>
                                                <td><?php echo $dd['commission']; ?></td>
                                                <td><?php echo $dd['balance']; ?></td>
                                            <!--<td><?php //echo $draw['profit']; ?></td>-->
                                            </tr>
                                            <?php    } ?>
                                            <tr><td>Total</td><td></td><td><?php echo $dd['total_bet']; ?></td><td><?php echo $dd['total_wins']; ?></td><td><?php echo $dd['total_commission']; ?></td><td><?php echo $dd['total_balance']; ?></td></tr>
                                        <?php    }else{ ?>
                                            <tr class='active'><th style='text-align:center'; colspan='6'>No Records Found</th></tr>
                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane  table-scrollable" id="tab_1_1_2">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        	<tr><th colspan="6">Week : <?php if(!empty($data_weekly)  ) {
                                            foreach($data_weekly as $dw){ echo $dw['week']; break;}} ?></th></tr>
                                            <tr>
                                                <th>
                                                    Sr No
                                                </th>
                                                <th>
                                                    Player Code
                                                </th>
                                                <th>
                                                    Bet Chips
                                                </th>
                                                <th>
                                                    Wining Payout
                                                </th>
                                                <th>
                                                    Commission
                                                </th>
                                                <th>
                                                    Balance
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($data_weekly)  ) {
                                            foreach($data_weekly as $dw){ $player_id = $dw['player_id']; ?>
                                            <tr class="success">
                                                <td><?php echo $dw['sr_no']; ?></td>
                                                <td><a href="<?php echo base_url("/admin/accountsplayer?player_id=$player_id") ?>"><?php echo $dw['user_code']; ?></a></td>
                                                <td><?php echo $dw['bet_amount']; ?></td>
                                                <td><?php echo $dw['payout']; ?></td>
                                                <td><?php echo $dw['commission']; ?></td>
                                                <td><?php echo $dw['balance']; ?></td>
                                            <!--<td><?php //echo $draw['profit']; ?></td>-->
                                            </tr>
                                            <?php    } ?>
                                            <tr><td>Total</td><td></td><td><?php echo $dw['total_bet']; ?></td><td><?php echo $dw['total_wins']; ?></td><td><?php echo $dw['total_commission']; ?></td><td><?php echo $dw['total_balance']; ?></td></tr>
                                        <?php    }else{ ?>
                                            <tr class='active'><th style='text-align:center'; colspan='6'>No Records Found</th></tr>
                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane table-scrollable" id="tab_1_1_3">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Sr No
                                                </th>
                                                <th>
                                                    Week
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($data_monthly)  ) {
                                                $i=1;
                                            foreach($data_monthly as $dm){  ?>
                                             <tr class="success">
                                                <td><?php echo $i; ?></td>
                                                <td id="week"><a value="<?php echo $dm; ?>"><?php echo $dm; ?></td>
                                            </tr>
                                             <?php  $i++;  } ?>
                                        <?php    }else{ ?>
                                            <tr class='active'><th style='text-align:center'; colspan='6'>No Records Found</th></tr>
                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                    <div id="mack">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <!-- BEGIN CONTENT -->
</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<?php include'footer.php';?>
<!-- END FOOTER -->
<script type="text/javascript" >
$(document).ready(function() {
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
});
</script>

<script type="text/javascript">
    
    $('.table #week').each(function(){
        $(this).click(function(){
            week = $(this).find('a').attr('value');
            week = encodeURIComponent(week);
            $('#mack').load('<?php echo base_url("/admin/dealeraccountsweekly?week="); ?>'+week,function () { });
            return false;
        });
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