<table class="table table-bordered table-hover">
    <thead>
        <tr><th colspan="6">Match : <?php echo $_GET['match']; ?></th></tr>
        <tr>
            <th>
                Sr No
            </th>
            <th>
                Transaction No.
            </th>
            <th>
                Total Bets
            </th>
            <th>
                Total Wins
            </th>
            <!-- <th>
                Balance
            </th> -->
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($data_weekly)  ) {
            $match_id = $_GET['match_id']; 
            $date = $_GET['date']; 
        foreach($data_weekly as $dw){ $transaction_id = $dw['transaction_id']; ?>
        <tr class="success">
            <td><?php echo $dw['sr_no']; ?></td>
            <td id="week_player_trans"><a date="<?php echo $date; ?>" match="<?php echo $match_id ?>"><?php echo $dw['transaction_id']; ?></a></td>
            <td><?php echo $dw['bet_amount']; ?></td>
            <td><?php echo $dw['payout']; ?></td>
            <!-- <td><?php echo $dw['balance']; ?></td> -->
        <!--<td><?php //echo $draw['profit']; ?></td>-->
        </tr>
        <?php    } ?>
        <tr><td>Total</td><td></td><td><?php echo $dw['total_bet']; ?></td><td><?php echo $dw['total_wins']; ?></td></tr>
    <?php    }else{ ?>
        <tr class='active'><th style='text-align:center'; colspan='4'>No Records Found</th></tr>
        <?php  } ?>
    </tbody>
</table>
<div id="mack61"></div>

<script type="text/javascript">
    
    $('.table #week_player_trans').each(function(){
        //dealer_id = $('#dealer_id').val();
        $(this).click(function(){
            transaction_id = $(this).find('a').text();
            //week = '';
            date = $(this).find('a').attr('date');
            //draw_time = $(this).find('a').attr('drawtime');
            //week = encodeURIComponent(week);
            $('#mack61').load('<?php echo base_url("/admin/accountsPlayerCricketDailyByTransactionId?date='+date+'&transaction_id="); ?>'+transaction_id,function () { });
            return false;
        });
    });

</script>