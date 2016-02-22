<?php if($this->ion_auth->in_group('dealer'))
                    include 'dealer_header.php';
            else 
                    include 'header.php';
date_default_timezone_set('Asia/Calcutta');
$date = new DateTime();
$current_timestamp = $date->getTimestamp();
?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
            <div class="page-content" >

            <!-- If condition added to show/hide info -->
            <?php if(!$this->ion_auth->in_group('dealer')) {?>	


            <div class="row">
                              <div class="col-md-12">
                                <div class="well margin-top-20">
                                                                            <div class="row">
<!--											<div class="col-sm-3">
                                                                                            <a href="<?php echo base_url()?>admin/info" class="btn red">
                                                                                                                    Info <i class="fa fa-edit"></i>
                                                                                                                    </a>
                                                                                    </div>-->
<!--											<div class="col-sm-3">
                                                                                            <div id="clockDisplay" class="clockStyle"></div>
                                                                                    </div>-->
                                                                                    <div class="col-sm-4">
                                                                                            <span class="btn" style="font-size:16px; color:black;" >Time To Draw : <a id="countdownDisplay" class="btn" style="font-size:16px;font-weight:bold;padding:0px 0px 2px 0px; color:black;"  ></a></span>
                                                                                    </div>
                                                                                    <div class="col-sm-4">
                                                                                            <span class="btn" style="font-size:16px; color:black;" >Current Game :<span id="show_time"> <?php echo  $show_time  ;  ?></span></span>
                                                                                    </div>
                                                                                    <div class="col-sm-4"   >
                                                                                            <a href="javascript:;" class="btn"   style="float:right; color:black;" >
                                                                                                            Last Result  (<span id="last_time"><?php echo $last_time; ?></span>) :	<span id="ash"   style="font-size:17px;font-weight:bold;"  ><?php echo $lucky_number;  ?></span> 	

<!--
                                                                                                                    <i class="fa fa-edit"></i>
-->

                                                                                                                    </a>
                                                                                    </div>
                                                                            </div>
                                    </div>
              </div>
            </div>

        <div id="mack">
                            <div class="row">
                                    <div class="col-md-12" >
                                                    <!-- BEGIN CHART PORTLET-->
                                                        <div class="portlet light bordered">

                                                               <div class="portlet-title">
                                                                    <div class="caption">
                                                                            <i class="icon-bar-chart font-green-haze"></i>
                                                                            <span class="caption-subject bold uppercase font-green-haze"> Combination Chart</span>
                                                                            <span class="caption-subject bold uppercase font-red-haze"  > ( <?php  echo $jodi_bets;  ?> ) </span>
                                                                    </div>
                                                                    <div class="caption" style="float:right;">

                                                                            <span class="caption-subject bold uppercase font-green-haze"> Bet Amount</span>
                                                                            <span class="caption-subject bold uppercase font-red-haze"  > ( <?php  echo $bets_and_payout['bet_amount_jodi'];  ?> ) </span>
<!--                                                                            <span class="caption-subject bold uppercase font-green-haze"> Payout</span>
                                                                            <span class="caption-subject bold uppercase font-red-haze"  > ( <?php  echo $bets_and_payout['payout_jodi'];  ?> ) </span>-->
                                                                    </div>
                                                              </div>

                                                            <div class="portlet-body table-scrollable">
                                                             <table class="table table-bordered table-hover">
                                                               <thead>
                                                                 <tr>
                                                                    <th>
                                                                             Digit
                                                                    </th>
                                                                 <?php for($i=0; $i<=9 ;$i++) { ?>
                                                                      <th><?php echo "0".$i; ?></th>
                                                                 <?php	} ?>	
                                                                </tr>
                                                               </thead>
                                                               <tbody>
                                                               <tr class="active">
                                                                     <td>
                                                                             Total Bets
                                                                         </td>
                                                                    <?php for($i = 0 ; $i <= 9 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->bet_amount; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>

                                                               </tr>
                                                               <tr class="success">
                                                                    <td>
                                                                             Total Payouts
                                                                    </td>
                                                                    <?php for($i = 0 ; $i <= 9 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->payout; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>
                                                            </tr>
                                                               </tbody>


                                                            <thead>
                                                            <tr>
                                                                    <th>
                                                                             Digit
                                                                    </th>
                                                            <?php for($i=10; $i<=19 ;$i++) { ?>
                                                                      <th><?php echo $i; ?></th>
                                                            <?php	} ?>	

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="active">
                                                                     <td>
                                                                             Total Bets
                                                                         </td>
                                                                    <?php for($i = 10 ; $i <= 19 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->bet_amount; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>

                                                               </tr>
                                                               <tr class="success">
                                                                    <td>
                                                                             Total Payouts
                                                                    </td>
                                                                    <?php for($i = 10 ; $i <= 19 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->payout; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>
                                                            </tr>
                                                            </tbody>

                                                            <thead>
                                                            <tr>
                                                                    <th>
                                                                             Digit
                                                                    </th>
                                                            <?php for($i=20; $i<=29 ;$i++) { ?>
                                                                      <th><?php echo $i; ?></th>
                                                            <?php	} ?>	

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="active">
                                                                     <td>
                                                                             Total Bets
                                                                         </td>
                                                                    <?php for($i = 20 ; $i <= 29 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->bet_amount; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>

                                                               </tr>
                                                               <tr class="success">
                                                                    <td>
                                                                             Total Payouts
                                                                    </td>
                                                                    <?php for($i = 20 ; $i <= 29 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->payout; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>
                                                            </tr>
                                                            </tbody>


                                                            <thead>
                                                            <tr>
                                                                    <th>
                                                                             Digit
                                                                    </th>
                                                            <?php for($i=30; $i<=39 ;$i++) { ?>
                                                                      <th><?php echo $i; ?></th>
                                                            <?php	} ?>	

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="active">
                                                                     <td>
                                                                             Total Bets
                                                                         </td>
                                                                    <?php for($i = 30 ; $i <= 39 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->bet_amount; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>

                                                               </tr>
                                                               <tr class="success">
                                                                    <td>
                                                                             Total Payouts
                                                                    </td>
                                                                    <?php for($i = 30 ; $i <= 39 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->payout; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>
                                                            </tr>
                                                            </tbody>


                                                            <thead>
                                                            <tr>
                                                                    <th>
                                                                             Digit
                                                                    </th>
                                                            <?php for($i=40; $i<=49 ;$i++) { ?>
                                                                      <th><?php echo $i; ?></th>
                                                            <?php	} ?>	

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="active">
                                                                     <td>
                                                                             Total Bets
                                                                         </td>
                                                                    <?php for($i = 40 ; $i <= 49 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->bet_amount; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>

                                                               </tr>
                                                               <tr class="success">
                                                                    <td>
                                                                             Total Payouts
                                                                    </td>
                                                                    <?php for($i = 40 ; $i <= 49 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->payout; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>
                                                            </tr>
                                                            </tbody>


                                                            <thead>
                                                            <tr>
                                                                    <th>
                                                                             Digit
                                                                    </th>
                                                            <?php for($i=50; $i<=59 ;$i++) { ?>
                                                                      <th><?php echo $i; ?></th>
                                                            <?php	} ?>	

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="active">
                                                                     <td>
                                                                             Total Bets
                                                                         </td>
                                                                    <?php for($i = 50 ; $i <= 59 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->bet_amount; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>

                                                               </tr>
                                                               <tr class="success">
                                                                    <td>
                                                                             Total Payouts
                                                                    </td>
                                                                    <?php for($i = 50 ; $i <= 59 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->payout; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>
                                                            </tr>
                                                            </tbody>


                                                            <thead>
                                                            <tr>
                                                                    <th>
                                                                             Digit
                                                                    </th>
                                                            <?php for($i=60; $i<=69 ;$i++) { ?>
                                                                      <th><?php echo $i; ?></th>
                                                            <?php	} ?>	

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="active">
                                                                     <td>
                                                                             Total Bets
                                                                         </td>
                                                                    <?php for($i = 60 ; $i <= 69 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->bet_amount; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>

                                                               </tr>
                                                               <tr class="success">
                                                                    <td>
                                                                             Total Payouts
                                                                    </td>
                                                                    <?php for($i = 60 ; $i <= 69 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->payout; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>
                                                            </tr>
                                                            </tbody>
                                                            <thead>
                                                            <tr>
                                                                    <th>
                                                                             Digit
                                                                    </th>
                                                            <?php for($i=70; $i<=79 ;$i++) { ?>
                                                                      <th><?php echo $i; ?></th>
                                                            <?php	} ?>	

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="active">
                                                                     <td>
                                                                             Total Bets
                                                                         </td>
                                                                    <?php for($i = 70 ; $i <= 79 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->bet_amount; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>

                                                               </tr>
                                                               <tr class="success">
                                                                    <td>
                                                                             Total Payouts
                                                                    </td>
                                                                    <?php for($i = 70 ; $i <= 79 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->payout; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>
                                                            </tr>
                                                            </tbody>

                                                            <thead>
                                                            <tr>
                                                                    <th>
                                                                             Digit
                                                                    </th>
                                                            <?php for($i=80; $i<=89 ;$i++) { ?>
                                                                      <th><?php echo $i; ?></th>
                                                            <?php	} ?>	

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="active">
                                                                     <td>
                                                                             Total Bets
                                                                         </td>
                                                                    <?php for($i = 80 ; $i <= 89 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->bet_amount; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>

                                                               </tr>
                                                               <tr class="success">
                                                                    <td>
                                                                             Total Payouts
                                                                    </td>
                                                                    <?php for($i = 80 ; $i <= 89 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->payout; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>
                                                            </tr>
                                                            </tbody>


                                                            <thead>
                                                            <tr>
                                                                    <th>
                                                                             Digit
                                                                    </th>
                                                            <?php for($i=90; $i<=99 ;$i++) { ?>
                                                                      <th><?php echo $i; ?></th>
                                                            <?php	} ?>	

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="active">
                                                                     <td>
                                                                             Total Bets
                                                                         </td>
                                                                    <?php for($i = 90 ; $i <= 99 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->bet_amount; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>

                                                               </tr>
                                                               <tr class="success">
                                                                    <td>
                                                                             Total Payouts
                                                                    </td>
                                                                    <?php for($i = 90 ; $i <= 99 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($jodi_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->payout; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>
                                                            </tr>
                                                            </tbody>
                                                            </table>
                                                            </div>
                                                    </div>
                                                    <!-- END CHART PORTLET-->
                                    </div>
                                    </div>


                             <div class="row">

                                                <div class="col-md-12" >
                                                    <!-- BEGIN CHART PORTLET-->
                                                    <div class="portlet light bordered">
                                                            <div class="portlet-title">
                                                                    <div class="caption">
                                                                            <i class="icon-bar-chart font-green-haze"></i>
                                                                            <span class="caption-subject bold uppercase font-green-haze">Single Digit First</span>
                                                                            <span class="caption-subject bold uppercase font-red-haze"  > ( <?php  echo $first_bets;  ?> ) </span>
                                                                    </div>

                                                                    <div class="caption" style="float:right;">

                                                                            <span class="caption-subject bold uppercase font-green-haze"> Bet Amount</span>
                                                                            <span class="caption-subject bold uppercase font-red-haze"  > ( <?php  echo $bets_and_payout['bet_amount_first'];  ?> ) </span>
<!--                                                                            <span class="caption-subject bold uppercase font-green-haze"> Payout</span>
                                                                            <span class="caption-subject bold uppercase font-red-haze"  > ( <?php  echo $bets_and_payout['payout_first'];  ?> ) </span>-->
                                                                    </div>


                                                            </div>
                                                        <div class="table-scrollable ">
                                                                    <table class="table table-bordered table-hover">
                                                                            <thead>
                                                                            <tr>
                                                                                    <th>
                                                                                             Digit
                                                                                    </th>
                                                                            <?php for($i = 0 ;$i <= 9;$i++){ ?>

                                                                                    <th><?php echo $i ;?></th>
                                                                            <?php	}?>

                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr class="active">
                                                                                    <td>
                                                                                             Total Bets
                                                                                    </td>
                                                                                    <?php for($i = 0 ; $i <= 9 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($first_digit_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->bet_amount; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>

                                                                            </tr>
                                                                            <tr class="success">
                                                                                    <td>
                                                                                             Total Payouts
                                                                                    </td>
                                                                                    <?php for($i = 0 ; $i <= 9 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($first_digit_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->payout; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>

                                                                            </tr>
                                                                            </tbody>
                                                                            </table>	
                                                            </div>
                                                            </div>
                                                    </div>	
                                                    </div>	


                         <div class="row">
                                                             <div class="col-md-12" >
                                                               <div class="portlet light bordered">
                                                                 <div class="portlet-title">
                                                                      <div class="caption">
                                                                            <i class="icon-bar-chart font-green-haze"></i>
                                                                            <span class="caption-subject bold uppercase font-green-haze">Single Digit Second </span>
                                                                                                                                                                                <span class="caption-subject bold uppercase font-red-haze"  > ( <?php  echo $second_bets;  ?> ) </span>
                                                                      </div>
                                                                                                                                                                 <div class="caption" style="float:right;">

                                                                            <span class="caption-subject bold uppercase font-green-haze"> Bet Amount</span>
                                                                            <span class="caption-subject bold uppercase font-red-haze"  > ( <?php  echo $bets_and_payout['bet_amount_second'];  ?> ) </span>
<!--                                                                            <span class="caption-subject bold uppercase font-green-haze"> Payout</span>
                                                                            <span class="caption-subject bold uppercase font-red-haze"  > ( <?php  echo $bets_and_payout['payout_second'];  ?> ) </span>-->
                                                                    </div>


                                                                     </div>
                                                                   <div class="table-scrollable ">
                                                                            <table class="table table-bordered table-hover">
                                                                            <thead>
                                                                            <tr>
                                                                                    <th>
                                                                                             Digit
                                                                                    </th>
                                                                            <?php for($i = 0 ;$i <= 9;$i++){ ?>

                                                                                    <th><?php echo $i ;?></th>
                                                                            <?php	}?>

                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr class="active">
                                                                                    <td>
                                                                                             Total Bets
                                                                                    </td>
                                                                                    <?php for($i = 0 ; $i <= 9 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($second_digit_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->bet_amount; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>

                                                                            </tr>
                                                                            <tr class="success">
                                                                                    <td>
                                                                                             Total Payouts
                                                                                    </td>
                                                                                    <?php for($i = 0 ; $i <= 9 ; $i++){ 
                                                                                         $count = false; 
                                                                                        foreach ($second_digit_data->result() as $fd ) { 
                                             if($i == $fd->digit ){ 
                                             $count = true;	?>
                                                                                              <td><?php echo $fd->payout; ?></td>

                                                                                            <?php } 

                                                                                            }
                                                                                            if($count == false){ ?>

                                                                                                    <th></th>

                                                                                            <?php }

                                                                                             }	?>

                                                                            </tr>
                                                                            </tbody>
                                                                            </table>	

                                                                      </div>
                                                            </div>
                                                            </div>
                                                            </div>



                                       <div class="row" class="col-sm-12">
                                                                                    <div class="col-sm-3">
                                                                                            <b>Total Bets All</b>
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                            <a href="javascript:;" class="btn">
                                                                                                            <?php if(!empty($total_payout->bet_amount)){
                                                                                                                    echo $total_payout->bet_amount;
                                                                                                                    }else{
                                                                                                                            echo "0";
                                                                                                                            }?>

<!--
                                                                                                            <i class="fa fa-edit"></i>
-->
                                                                                                                    </a>
                                                                                    </div>

                                                            </div>	
                                                            <BR>
<!--								<div class="row">
                                                                                    <div class="col-sm-3">
                                                                                            <b>Winning Number</b>
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                            <a href="javascript:;" class="btn red">
                                                                                                            XX <i class="fa fa-edit"></i>
                                                                                                                    </a>
                                                                                    </div>
                                                                                    <div class="col-sm-3">

                                                                                    </div>
                                                                                    <div class="col-sm-3">

                                                                                    </div>
                                                            </div>
                                                            <BR>-->
<!--                                                            <div class="row">
                                                                                    <div class="col-sm-3">
                                                                                            <b>Total Payouts</b>
                                                                                    </div>
                                                                                    <div class="col-sm-3">
                                                                                            <a href="javascript:;" class="btn red">
                                                                                                                                                    <?php if(!empty($total_payout->payout)){
                                                                                                                    echo $total_payout->payout;
                                                                                                                    }else{
                                                                                                                            echo "0";
                                                                                                                            }?>

                                                                                                            <i class="fa fa-edit"></i>

                                                                                                                    </a>
                                                                                    </div>
                                                                                    <div class="col-sm-4">
                                                                                            <button type="button" class="btn btn-primary">Primary</button>
                                                                                    </div>

                                                            </div>-->
                            </div>				
                                                            <BR>
    <?php } ?> 	<!-- group users-->
                                                            <div class="row">
                                                                    <?php if(!$this->ion_auth->in_group('dealer')) {?>
                                                                            <!-- <div class="col-sm-3">
                                                                                    <input type="text" class="form-control" placeholder="Enter Result">
                                                                            </div> -->
                                                                            <div class="col-sm-1">
                                                                                    <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"><button type="button" class="btn btn-primary" id="execute">Execute</button></a>
                                                                            </div>
                                                                    <?php }?>		

                                                                    <div class="col-sm-10">
                                                                            <?php if(!$this->ion_auth->in_group('dealer')) {?>		
                                                                                    <a href="<?php echo base_url()?>admin/daysummary" class="btn red">
                                                                                                            Day Summary</a>

<!--											<a href="<?php //echo base_url()?>admin/add_amount" class="btn green">
                                                                                                    Add Amount</a>-->

<!--											<a href="<?php //echo base_url()?>admin/block_player" class="btn red">
                                                                                            Block Player</a>	-->


<!--                                                                                    <a href="<?php echo base_url()?>admin/adminaccount" class="btn green">
                                                                                    Admin Accounts	</a>-->

                                                                                    <a href="<?php echo base_url()?>admin/numbering_chart" class="btn green">
                                                                                    Numbering Chart	</a>

                                                                            <?php }?>

<!--                                                                                    <a href="<?php echo base_url()?>admin/accounts" class="btn red">
                                                                                     Accounts	</a>						-->
                                                                    </div>
                                                            </div>			





                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->

    <!-- END CONTENT -->
<div id="fade" class="black_overlay"></div>
    <div id="light"  class="portlet box blue white_content"  style="width:750px;">
                               <div class="portlet-title">
                                        <div class="caption">
                                            Manual Numbers
                                            <small>( Enter Numbers for upcomming timeslots )</small>
                                        </div>
                                       <div class="tools">
                                           <a href = "javascript:void(0)"  style="color:white;"    onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
                                        </div>
            </div>


            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-bordered">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <?php $i=1; foreach($time_slots as $timeslot) { ?>
                                            <tr class="col-sm-6"  style="padding: 0px;">
                                                <td  style="padding: 0px;"><input type="text" value="<?php echo $timeslot;?>" disabled /><input id="manual" name="ash" type="text"/></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <div class="tools"  style="float: right;" >
                                    <span  id="msg"  class="alert-success "></span>
                                    <button id="manuals"  class="btn btn-primary" >Submit</button>
            </div>
                                </div>

                       </div>

<!--                         <div class="portlet-body">
            <?php //$i=1; foreach($time_slots as $timeslot) { ?>
                    <input type="text" value="<?php //echo $timeslot;?>" disabled /><input id="manual" name="ash" type="text"/>
            <?php// } ?>
            <div style="float:right">
                    <button id="manuals">Submit</button>
                    <button >close</button>
            </div>
                          </div>-->


    </div>	
</div>
</div>
<!-- END CONTAINER -->
<!-- CODE FOR DIGITAL CLOCK -->

<script>
//	flag = true;
//	timer = '';
//	var diem = "AM";
//	setInterval(function(){renderTime();},1000);
//	function renderTime() {
//		if ( flag ) {
//			timer = <?php echo $current_timestamp;?>*1000;
//		}
//		var d = new Date(timer);
//
//		var h = d.getHours();
//		var m = d.getMinutes();
//		var s = d.getSeconds();
//
//	    if (h == 0) {
//			h = 12;
//		} else if (h > 12) { 
//			h = h - 12;
//			diem="PM";
//		}
//		if (h < 10) {
//			h = "0" + h;
//		}
//		if (m < 10) {
//			m = "0" + m;
//		}
//		if (s < 10) {
//			s = "0" + s;
//		}
//		
//	    var myClock = document.getElementById('clockDisplay');
//		myClock.textContent = h + ":" + m + ":" + s + " " + diem;
//		myClock.innerText = h + ":" + m + ":" + s + " " + diem;
//
//		flag = false;
//		timer = timer + 1000;
//	}
//	renderTime();

    flag1 = true;
    timer1 = '';
    setInterval(function(){countdown();},1000);
    function countdown() {
            if ( flag1 ) {
                            timer1 = <?php echo $current_timestamp;?>*1000;
                    }
            var d = new Date(timer);
            var ash = document.getElementById('clockDisplay').innerText;
            var arr = ash.split(':');

            var h1 = d.getHours();
            var m1 = d.getMinutes();
            var s1 = d.getSeconds();

     var h1 = arr[0];
     var m1 = arr[1];
     var seconds = arr[2];
     var seconds = seconds.split(' ');
     var s1 = seconds[0];


        if (h1 == 0) {
                    h1 = 12;
            } else if (h1 > 12) { 
                    h1 = h1 - 12;
                    diem="PM";
            }
            if (h1 < 10) {
                    h1 = "0" + h1;
            }
            /*if (m < 10) {
                    m = "0" + m;
            }*/
            if (m1 >= 45) {
                    m1 = 59-m1;
            }
            else if (m1 >= 30) {
                    m1 = 44-m1;
            }
            else if (m1 >= 15) {
                    m1 = 29-m1;
            }
            else if (m1 < 15) {
                    m1 = 14-m1;
            }if(m1 < 10){
                    m1 = "0" + m1;
            }

            if(s1 == 60)
            {
               s1 = "00";
            }
            else if(s1 == 0)
            {
               s1 = "0";
            }
            else if(s1 > 0 && s1 < 60)
            {
               s1 = 60 - s1;
            }
             if(s1 < 10)
            {
               s1 = "0" + s1;
            }

        var myClock = document.getElementById('countdownDisplay');
            myClock.textContent = m1 + ":" + s1 ;
            myClock.innerText = m1 + ":" + s1 ;

            flag1 = false;
            timer1 = timer1 + 1000;
    }
    countdown();
</script>
<!-- CODE END -->
<!-- BEGIN FOOTER -->
<?php include'footer.php';?>

<!-- END FOOTER -->
    <script type="text/javascript" >
            $(document).ready(function() {   
// initiate layout and plugins
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
// FormValidation.init();
//TableManaged.init();



$('#manuals').click(function(){


    var saveData = {};
    var i =1 ;

    $('#light #manual').each(function(){

    saveData[i] = $(this).val();
    i++;

    });
    saveData = JSON.stringify(saveData);
$.ajax({
              url: '<?php echo base_url("/admin/manualNumbers"); ?>',
              type: "POST",
              data: {numbers : saveData},
              dataType: "JSON",
                                    success:function(data){
                                                 $('#msg').html(data.message);

                                     }
    });
});




});

function loadlink(){

//$( "#mack" ).empty();
$('#mack').load('<?php echo base_url("/admin/chart"); ?>',function () {
    // $(this).unwrap();
});
}

//loadlink(); // This will run on page load
setInterval(function(){
loadlink() ;// this will run after every 5 seconds
}, 5000);

function loadresult(){

    $.get('<?php echo base_url("/admin/getLuckyNumber"); ?>',function(data) {
               $('#ash').text(data);
            });
}

//loadlink(); // This will run on page load
setInterval(function(){
loadresult() ;// this will run after every 5 seconds
}, 5000);
function loadcurrent(){

    $.get('<?php echo base_url("/admin/getcurrent"); ?>',function(data) {
               $('#show_time').text(data);
            });
}

//loadlink(); // This will run on page load
setInterval(function(){
loadcurrent() ;// this will run after every 5 seconds
}, 5000);
function loadlast(){

    $.get('<?php echo base_url("/admin/getlast"); ?>',function(data) {
               $('#last_time').text(data);
            });
}

//loadlink(); // This will run on page load
setInterval(function(){
loadlast() ;// this will run after every 5 seconds
}, 5000);

</script>

<script type="text/javascript" >
//function show_popup(id) {
//	if (document.getElementById){ 
//		obj = document.getElementById(id); 
//		if (obj.style.display == "none") { 
//			obj.style.display = ""; 
//		} 
//		
//		
//		 
//	} 
//}
//function hide_popup(id){ 
//	if (document.getElementById){ 
//		obj = document.getElementById(id); 
//		if (obj.style.display == ""){ 
//			obj.style.display = "none"; 
//		} 
//	} 
//}
</script>
<style>
.black_overlay{
    display: none;
    position: absolute;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 100%;
    background-color: black;
    z-index:1001;
    -moz-opacity: 0.8;
    opacity:.80;
    filter: alpha(opacity=80);
}
.white_content {
    display: none;
    position: absolute;
    bottom: 5%;
    left: 25%;
    width: 50%;
    //height: 50%;
    padding: 16px;
    border: 16px solid orange;
    background-color: white;
    z-index:1002;
    overflow: auto;
}
</style>
