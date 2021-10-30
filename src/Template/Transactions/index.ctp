    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading c-list">
                    <span class="title" id="centerHistory">History of Transaction</span>
                </div>

                <div class="row" style="display: none;">
                    <div class="col-xs-12">
                        <div class="input-group c-search">
                            <input type="text" class="form-control" id="contact-list-search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search text-muted"></span></button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="color: black">

                        <thead>
                            <tr>
                            <th>Payer Email</th>
                            <th>Payment Date</th>
                            <th>End Date</th>
                            <th>Payment Status</th>
                            <th>Payment Type</th>
                            <th>Date of creation</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                    <?php

                    foreach($transactions as $transaction)
                    { 
                        if($transaction->item_name == "ITH")
                        {
                        ?>

                    <tr>

                    <td> <?php echo $transaction->payer_email; ?> </td>
                    <td> <?php echo $transaction->payment_date; ?> </td>
                    <td> <?php echo $transaction->end_date; ?> </td>
                    <td> 
                    <?php 

                    if($transaction->status = 1)
                    {
                        echo "Success";
                    }
                    else
                    {
                        echo "Failed";
                    }

                    ?>
                        
                    </td>
                    <td> <?php echo $transaction->payment_type; ?> </td>
                    <td> <?php echo $transaction->created; ?> </td>

                   </tr>

                    <?php                             
                        }

                        else
                        {
                            echo "No Transaction History";
                        }
                    }?>



                    </tbody>
                    </table>
</div>
            </div>
        </div>
    </div>
