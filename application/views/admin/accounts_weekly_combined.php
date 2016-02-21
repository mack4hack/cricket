<table class="table table-bordered table-hover">
    <thead>
        <tr><th colspan="6">Week : <?php if(!empty($data_weekly)  ) {
        foreach($data_weekly as $dw){ echo $dw['week']; break;}} ?></th></tr>
        <tr>
            <th>
                Sr No
            </th>
            <th>
                Dealer Code
            </th>
            <th>
                Bet Amount
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
        foreach($data_weekly as $dw){ $dealer_id = $dw['dealer_id']; ?>
         <tr class="success">
            <td><?php echo $dw['sr_no']; ?></td>
            <!-- <td><a href="<?php echo base_url("/admin/accountsdealer?dealer_id=$dealer_id") ?>"><?php echo $dw['user_code']; ?></td> -->
            <td id="week_dealer"><a attr="<?php echo $dw['dealer_id']; ?>" value="<?php echo $dw['week'] ?>"><?php echo $dw['user_code']; ?></td>
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
<div id="mack1"></div>
<script type="text/javascript">
    
    $('.table #week_dealer').each(function(){
        dealer_id = $('#dealer_id').val();
        $(this).click(function(){
            week = $(this).find('a').attr('value');
            dealer_id = $(this).find('a').attr('attr');
            user_code = $(this).find('a').text();
            week = encodeURIComponent(week);
            $('#mack1').load('<?php echo base_url("/admin/dealeraccountsweeklycombined?week='+week+'&user_code='+user_code+'&dealer_id="); ?>'+dealer_id,function () { });
            return false;
        });
    });

</script>