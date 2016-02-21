<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>
                Sr No
            </th>
            <th>
                TimeSlot
            </th>
            <th>
                Total Chips
            </th>
            <th>
                Total Payout
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
        foreach($data_weekly as $dw){ $timeslot_id = $dw['timeslot_id'];   ?>
        <tr class="success">
            <td><?php echo $dw['sr_no']; ?></td>
            <td id="week_player_draw"><a drawtime="<?php echo $timeslot_id;?>" date="<?php echo $date?>" value="<?php echo $player_id ?>"><?php echo $dw['draw_time']; ?></a></td>
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
<div id="mack5"></div>

<script type="text/javascript">
    
    $('.table #week_player_draw').each(function(){
        //dealer_id = $('#dealer_id').val();
        $(this).click(function(){
            date = $(this).find('a').attr('date');
            //week = '';
            player_id = $(this).find('a').attr('value');
            draw_time = $(this).find('a').attr('drawtime');
            //week = encodeURIComponent(week);
            $('#mack5').load('<?php echo base_url("/admin/accountsplayerweeklybydrawtime?date='+date+'&draw_time='+draw_time+'&player_id="); ?>'+player_id,function () { });
            return false;
        });
    });

</script>