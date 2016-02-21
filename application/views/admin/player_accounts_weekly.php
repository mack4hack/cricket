<table class="table table-bordered table-hover">
    <thead>
        <tr><th colspan="6">Player Code : <?php echo $_GET['user_code']; ?></th></tr>
        <tr>
            <th>
                Sr No
            </th>
            <th>
                Date
            </th>
            <th>
                Total Chips
            </th>
            <th>
                Total Payout
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
                $player_id = $_GET['player_id'];
        foreach($data_weekly as $dw){  $date = $dw['date'];
        ?>
        <tr class="success">
            <td><?php echo $dw['sr_no']; ?></td>
            <td id="week_player_day"><a date="<?php echo $date;?>" value="<?php echo $player_id ?>"><?php echo $dw['date']; ?></td>
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
<div id="mack4"></div>

<script type="text/javascript">
    
    $('.table #week_player_day').each(function(){
        //dealer_id = $('#dealer_id').val();
        $(this).click(function(){
            date = $(this).find('a').attr('date');
            //week = '';
            player_id = $(this).find('a').attr('value');
            //user_code = $(this).find('a').text();
            //week = encodeURIComponent(week);
            $('#mack4').load('<?php echo base_url("/admin/accountsPlayerWeeklyByDate?date='+date+'&player_id="); ?>'+player_id,function () { });
            return false;
        });
    });

</script>