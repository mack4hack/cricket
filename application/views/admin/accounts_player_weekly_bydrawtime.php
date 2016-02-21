<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>
                Sr No
            </th>
            <th>
                Transaction No.
            </th>
            <th>
                Total Chips
            </th>
            <th>
                Total Payout
            </th>
            <!-- <th>
                Balance
            </th> -->
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($data_weekly)  ) {
            $draw_time = $_GET['draw_time']; 
            $date = $_GET['date']; 
        foreach($data_weekly as $dw){ $transaction_id = $dw['transaction_id']; ?>
        <tr class="success">
            <td><?php echo $dw['sr_no']; ?></td>
            <td id="week_player_trans"><a date="<?php echo $date; ?>" drawtime="<?php echo $draw_time ?>"><?php echo $dw['transaction_id']; ?></a></td>
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
<div id="mack6"></div>

<script type="text/javascript">
    
    $('.table #week_player_trans').each(function(){
        //dealer_id = $('#dealer_id').val();
        $(this).click(function(){
            transaction_id = $(this).find('a').text();
            //week = '';
            date = $(this).find('a').attr('date');
            draw_time = $(this).find('a').attr('drawtime');
            //week = encodeURIComponent(week);
            $('#mack6').load('<?php echo base_url("/admin/accountsplayerweeklybytransactionid?date='+date+'&draw_time='+draw_time+'&transaction_id="); ?>'+transaction_id,function () { });
            return false;
        });
    });

</script>