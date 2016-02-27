<table class="table table-bordered table-hover">
    <thead>
        <tr><th colspan="6">Player Code : <?php echo $_GET['user_code']; ?></th></tr>
        <tr>
            <th>
                Sr No
            </th>
            <th>
                Match
            </th>
            <th>
                Total Bets
            </th>
            <th>
                Total Wins
            </th>
            <th>
                Balance
            </th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($data_weekly)  ) {
        $date = $_GET['date']; 
        $date = date('Y-m-d',strtotime($date));
        $player_id = $_GET['player_id'];
        foreach($data_weekly as $dw){ $match_id = $dw['match_id'];   ?>
        <tr class="success">
            <td><?php echo $dw['sr_no']; ?></td>
            <td id="week_player_draw"><a match="<?php echo $match_id;?>" date="<?php echo $date?>" value="<?php echo $player_id ?>"><?php echo $dw['match']; ?></a></td>
            <td><?php echo $dw['bet_amount']; ?></td>
            <td><?php echo $dw['payout']; ?></td>
            <td><?php echo $dw['balance']; ?></td>
        <!--<td><?php //echo $draw['profit']; ?></td>-->
        </tr>
        <?php    } ?>
        <tr><td>Total</td><td></td><td><?php echo $dw['total_bet']; ?></td><td><?php echo $dw['total_wins']; ?></td><td><?php echo $dw['total_balance']; ?></td></tr>
    <?php    }else{ ?>
        <tr class='active'><th style='text-align:center'; colspan='5'>No Records Found</th></tr>
        <?php  } ?>
    </tbody>
</table>
<div id="mack51"></div>

<script type="text/javascript">
    
    $('.table #week_player_draw').each(function(){
        //dealer_id = $('#dealer_id').val();
        $(this).click(function(){
            date = $(this).find('a').attr('date');
            //week = '';
            player_id = $(this).find('a').attr('value');
            match_id = $(this).find('a').attr('match');
            match =  $(this).find('a').text();
            match = encodeURIComponent(match);
            $('#mack51').load('<?php echo base_url("/admin/accountsplayercricketdailybymatch?date='+date+'&match='+match+'&match_id='+match_id+'&player_id="); ?>'+player_id,function () { });
            return false;
        });
    });

</script>