<?= $this->Html->css('/css/jquery.dataTables.css', ['block' => 'css']); ?>
<div class="blackOutDays index large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0"  id="friends-search" class="datatable search-artist-table">
        <thead>
            <tr>
                <th scope="col" style="display:none;">a</th>
            </tr>
        </thead>
        <tbody>
                    <?php
                    $count = 0;
                     foreach($friend as $row)
                    {
                     $count++;
                    ?>
                    <tr>
                <td>
                   <font class="black-font"> <li class="list-group-item">
                        <div class="col-xs-12 col-sm-3">
                         <?php   if(isset($row->medias[0]['name'])){ ?>

                         <?php
                            $imgName = '';
                         foreach($row->medias as $media){
                            if($media->type == 3)
                             $imgName = $media->name;
                        }

                         ?>
                        <?php if($imgName == '' || $imgName == null)
                        { ?>
                            <a href="/profiles/viewProfile/<?php echo $row['id']; ?>"><img src="/files/images/default-profile.jpg" alt="<?php echo $row['name'];?>" class="img-responsive img-circle" /></a>
                        <?php }
                        else{ ?>
                            <a href="/profiles/viewProfile/<?php echo $row['id']; ?>"><img src="<?php echo '/files/userData/'.$row['id'].'/profileImg/'.$imgName; ?>" alt="<?php echo $row['name'];?>" class="img-responsive img-circle" /></a>

                        <?php
                        }
                    }else{ ?>
                            <a href="/profiles/viewProfile/<?php echo $row['id']; ?>"><img src="/files/images/default-profile.jpg" alt="<?php echo $row['name'];?>" class="img-responsive img-circle" /></a>

                        <?php
                        }
                        ?></div>
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

                    ?>
                    <?php
                     foreach($friendwithskill as $row)
                    {
                    $count++;
                    ?>
                        <?php
                            $imgName = '';
                         foreach($row->medias as $media){
                            if($media->type == 3)
                             $imgName = $media->name;
                        }

                    ?>
                   <font class="black-font"> <li class="list-group-item">
                        <div class="col-xs-12 col-sm-3">
                            <a href="/profiles/viewProfile/<?php echo $row->id; ?>"><img src="<?php echo '/files/userData/'.$row->id.'/profileImg/'.$imgName; ?>" alt="<?php echo $row->first_name.' '.$row->last_name;?>" class="img-responsive img-circle" /></a>
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
                    </font></td>
                    <?php
                    }

                    ?>
                    <?php if($count == 0) { ?>
                   <font class="black-font">
                        <li class="list-group-item">
                            <div class="col-xs-12 col-sm-12">
                               <center> <h3>Artist Not Found</h1> </center>
                            </div>
                             <div class="clearfix"></div>
                        </li>
                    </font>
                    </td></tr>
                    <?php
                    }
                    ?>
                </tbody>
    </table>

</div>
<?= $this->Html->script('/js/jquery-1.8.2.min.js'); ?>
<?= $this->Html->script('/js/jquery.dataTables.min.js'); ?>
<?php if($count != 0) { ?>
<?= $this->Html->script('/js/initialiseDataTable.js'); ?>

<?php } ?>
