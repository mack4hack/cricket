<table class="table table-bordered table-hover">
    <thead>
        <tr><th colspan="6">Dealer Code : <?php echo $_GET['user_code']; ?></th></tr>
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
                Debit
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
        foreach($data_weekly as $dw){ $player_id = $dw['player_id']; $week =$dw['week'];   ?>
         <tr class="success">
            <td><?php echo $dw['sr_no']; ?></td>
            <td id="week_player"><a week="<?php echo $week; ?>"  value="<?php echo $player_id ?>"><?php echo $dw['user_code']; ?></td>
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
<div id="mack3"></div>

<script type="text/javascript">
    
    $('.table #week_player').each(function(){
        dealer_id = $('#dealer_id').val();
        $(this).click(function(){
            week = $(this).find('a').attr('week');
            //week = '';
            player_id = $(this).find('a').attr('value');
            user_code = $(this).find('a').text();
            week = encodeURIComponent(week);
            $('#mack3').load('<?php echo base_url("/admin/playeraccountsweekly?user_code='+user_code+'&week='+week+'&player_id="); ?>'+player_id,function () { });
            return false;
        });
    });

</script>