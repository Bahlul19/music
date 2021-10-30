                    <?php
                    if($friendreqcount != 0)
                    {
                     foreach($friend as $row)
                    {
                    ?>
                   <font class="black-font"> <li class="list-group-item">
                        <div class="col-xs-12 col-sm-3">
                            <a href="/profiles/viewProfile/<?php echo $row->id; ?>"><img src="<?php echo '/files/userData/'.$row->id.'/profileImg/'.$row->medias[0]['name']; ?>" alt="<?php echo $row->first_name.' '.$row->last_name;?>" class="img-responsive img-circle" /></a>
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <a href="/profiles/viewProfile/<?php echo $row->id; ?>"><span class="name"><?php echo $row->first_name.' '.$row->last_name;?></span></a><br/>
                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="<?php echo $row->address;?>"></span>
                            <span class="visible-xs"> <span class="text-muted"><?php echo $row->address;?></span><br/></span>
                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="<?php echo $row->mobie_phone;?>"></span>
                            <span class="visible-xs"> <span class="text-muted"><?php echo $row->mobie_phone;?></span><br/></span>
                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="<?php echo $row->email;?>"></span>
                            <span class="visible-xs"> <span class="text-muted"><?php echo $row->email;?></span><br/></span>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    </font>
                    <?php
                    }
                    }
                    else
                    {
                    ?>
                    <font class="black-font">
                        <li class="list-group-item">
                            <div class="col-xs-12 col-sm-12">
                                <h3>Friends list is Empty</h1>
                            </div>
                             <div class="clearfix"></div>
                        </li>
                    </font>

                    <?php
                    }
                    ?>