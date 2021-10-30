<?= $this->Form->create($profile,['id'=>'userDataEdit','method'=>'post','onSubmit'=>'return validateData();']) ?>
<section id="contact-info-writer">
      <div class="container">
        <form>
          <div class="row">
            <div class="col-sm-12">
              <h1 class="text-center wiz-title">New User Registration</h1>
            </div>
          </div>
          <div class="row font-style">
            <div class="col-sm-12">
              <div class="panel panel-default inner-panel">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <h2>ARTIST/GROUP/WRITER INFORMATION</h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="addressOne">Are you affiliated as a writer with a performing rights organization?<br> If yes, select one:</label>
                        <?= $this->Form->control('performing_right_org',array('class'=>'form-control','label' => false,'options'=>$performing_right_org,'empty'=> 'Select...','value'=>$defaultData['performing_right_org'])); ?>
                        <span id="HelpBlock" class="help-block"></span>
                      </div>
                      <div class="form-group">
                        <label for="addressOne">Are you affiliated as a publisher with a performing rights organization?<br> if yes, select one:</label>
                        <?= $this->Form->control('publisher_with_right_org',array('class'=>'form-control','label' => false,'options'=>$performing_right_org,'empty'=> 'Select...','value'=>$defaultData['publisher_with_right_org'])); ?>
                        <span id="HelpBlock" class="help-block"></span>
                      </div>
                      <div class="form-group">
                        <label for="addressOne">Are you a member of a union or guild?<br> If yes, please select one or specify below:</label>
                        <?= $this->Form->control('member_of_a_union',array('class'=>'form-control','label' => false,'options'=>$member_of_a_union,'empty'=> 'Select...','value'=>$defaultData['member_of_a_union'])); ?>
                        <label for="other_union">If Other (please specify)</label>
                        <?= $this->Form->control('other_union',array('class'=>'form-control','label' => false,'value'=>$defaultData['other_union'])); ?>
                        <span id="otherOneHelpBlock" class="help-block"></span>
                      </div>
                      <div class="form-group">
                        <label for="addressOne">Are you a member of any other music related organization?<br> If yes, please specify:</label>
                        <?= $this->Form->control('music_related_organization',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['music_related_organization'])); ?>
                        <span id="HelpBlock" class="help-block"></span>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="addressOne">Musical Genre<br> (pull down list containing these categories)</label>
                        <?= $this->Form->control('genre',array('class'=>'form-control','label' => false,'options'=>$genre,'empty'=> 'Select...','value'=>$defaultData['genre'])); ?>
                        <span id="HelpBlock" class="help-block"></span>
                      </div>
                      <div class="form-group">
                        <label for="recordLabel">Is artist/group currently under contract with a record label?<br> If yes, label name:</label>
                        <?= $this->Form->control('record_label',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['record_label'])); ?>
                        <span id="recordLabelHelpBlock" class="help-block"></span>
                      </div>
                      <div class="form-group">
                        <label for="underManagment">Is artist/group currently under a management contract?<br> If yes, management company name:</label>
                        <?= $this->Form->control('management_contract',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['management_contract'])); ?>
                        <span id="underManagmentHelpBlock" class="help-block"></span>
                      </div>
                      <div class="form-group">
                        <label for="bookingAgency">Is artist/group currently under a booking agency contract?<br> If yes, booking agency name:</label>
                        <?= $this->Form->control('booking_agency_contract',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['booking_agency_contract'])); ?>
                        <span id="bookingAgencyHelpBlock" class="help-block"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="row">
          <div class="col-sm-3">
            <span name="0" class="new-patient-step-btn new-patient-step-0-btn btn btn-default"  onclick="nextTab(1)">&lt;&lt;&lt; Back</span>
          </div>
          <div class="col-sm-6">
            <div class="progress">
              <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
            </div>
          </div>
          <div class="col-sm-3 hidden-xs">
            <span name="2" class="btn btn-primary pull-right" onclick="nextTab(2)">Continue &gt;&gt;&gt;</span>
          </div>
          <div class="visible-xs">
            <span name="2" class="btn btn-primary pull-right">Continue &gt;&gt;&gt;</span>
            <span name="0" class="new-patient-step-btn new-patient-step-0-btn btn btn-default">&lt;&lt;&lt; Back</span>
          </div>
        </div>
      </div>
    </section>

    <section id="contact-info-group" class="hide">
      <div class="container ">
          <div class="row">
            <div class="col-sm-12">
              <h1 class="text-center wiz-title">New User Registration</h1>
            </div>
          </div>
          <div class="row font-style">
            <div class="col-sm-12">
              <div class="panel panel-default inner-panel">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <h2>ARTIST/GROUP/WRITER INFORMATION</h2>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="artistName">Artist/Group Name*</label>
                            <?= $this->Form->control('artistName',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['artistName'])); ?>
                            <span id="artistNameHelpBlock" class="help-block"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="numberOfMembers">If Group, # Of Members</label>
                            <?= $this->Form->control('numberOfMembers',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['numberOfMembers'])); ?>
                            <span id="numberOfMembersHelpBlock" class="help-block"></span>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="city">City*</label>
                            <?= $this->Form->control('city',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['city'])); ?>
                            <span id="cityHelpBlock" class="help-block"></span>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label for="state">State*</label>
                            <?= $this->Form->control('state',array('class'=>'form-control','label' => false,'type'=>'select','options'=>$states,'empty'=> 'Select...','value'=>$defaultData['state'])); ?>
                            <span id="stateHelpBlock" class="help-block"></span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="recordLabel">Has artist/group been under contract with a record label in the past?<br> If yes, label name:</label>
                            <?= $this->Form->control('recordLabel',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['recordLabel'])); ?>
                            <span id="recordLabelHelpBlock" class="help-block"></span>
                          </div>
                          <div class="form-group">
                            <label for="recordings">Have recordings of artist/group been commercially released?<br> If yes, specify below:</label>
                            <div class="row">
                              <div class="col-sm-4">
                                <?= $this->Form->control('recordingsTitle1',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['recordingsTitle1'])); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= $this->Form->control('recordingsLabel1',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['recordingsLabel1'])); ?>
                              </div>
                              <div class="col-sm-4">
                                <input type="date" class="form-control input-sm" id="recordingsDate1" name="recordingsDate1" placeholder="Release Date" value="<?php echo $defaultData['recordingsDate1']; ?>">
                              </div>
                            </div>
                            <span id="recordingsHelpBlock1" class="help-block"></span>
                            <div class="row">
                              <div class="col-sm-4">
                                <?= $this->Form->control('recordingsTitle2',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['recordingsTitle2'])); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= $this->Form->control('recordingsLabel2',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['recordingsLabel2'])); ?>
                              </div>
                              <div class="col-sm-4">
                                <input type="date" class="form-control input-sm" id="recordingsDate2" name="recordingsDate2" placeholder="Release Date" value="<?php echo $defaultData['recordingsDate2']; ?>">
                              </div>
                            </div>
                            <span id="recordingsHelpBlock2" class="help-block"></span>
                            <div class="row">
                              <div class="col-sm-4">
                                 <?= $this->Form->control('recordingsTitle3',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['recordingsTitle3'])); ?>
                              </div>
                              <div class="col-sm-4">
                                <?= $this->Form->control('recordingsLabel3',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['recordingsLabel3'])); ?>
                              </div>
                              <div class="col-sm-4">
                                <input type="date" class="form-control input-sm" id="recordingsDate3" name="recordingsDate3" placeholder="Release Date" value="<?php echo $defaultData['recordingsDate3']; ?>">
                              </div>
                            </div>
                            <span id="recordingsHelpBlock3" class="help-block"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="playLive">Does artist/group perform live? If yes, how often?</label>
                        <?= $this->Form->control('playLive',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['playLive'])); ?>
                        <span id="playLiveHelpBlock" class="help-block"></span>
                      </div>
                      <div class="form-group">
                        <label for="homeRecord">Does artist/group have a home recording facilcity or own a recording studio? If yes, what type of software/equipment do you use?</label>
                        <?= $this->Form->control('homeRecordSoftware',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['homeRecordSoftware'])); ?>
                        <span id="homeRecordSoftwareHelpBlock" class="help-block"></span>
                        <?= $this->Form->control('homeRecordHardware',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['homeRecordHardware'])); ?>
                        <span id="homeRecordHardwareHelpBlock" class="help-block"></span>
                      </div>
                      <div class="form-group">
                        <label for="purchase">What software, hardware, recording equipment or musical instruments do you plan to purchase in the next 6-24 months?</label>
                        <?= $this->Form->control('purchaseSoftware',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['purchaseSoftware'])); ?>
                        <span id="purchaseSoftwareHelpBlock" class="help-block"></span>
                        <?= $this->Form->control('purchaseHardware',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['purchaseHardware'])); ?>
                        <span id="purchaseHardwareHelpBlock" class="help-block"></span>
                        <?= $this->Form->control('purchaseInstruments',array('class'=>'form-control','label' => false,'type'=>'text','value'=>$defaultData['purchaseInstruments'])); ?>
                        <span id="purchaseInstrumentsHelpBlock" class="help-block"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="row">
          <div class="col-sm-3">
            <span name="0" class="new-patient-step-btn new-patient-step-0-btn btn btn-default" onclick="nextTab(1)">&lt;&lt;&lt; Back</span>
          </div>
          <div class="col-sm-6">
            <div class="progress">
              <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div>
            </div>
          </div>
          <div class="col-sm-3 hidden-xs">
            <span name="2" class="btn btn-primary pull-right" onclick="nextTab(3)">Continue &gt;&gt;&gt;</span>
          </div>
          <div class="visible-xs">
            <span name="2" class="btn btn-primary pull-right">Continue &gt;&gt;&gt;</span>
            <span name="0" class="new-patient-step-btn new-patient-step-0-btn btn btn-default">&lt;&lt;&lt; Back</span>
          </div>
        </div>
      </div>
    </section>

    <section id="contact-info-group-description" class="hide">
        <div class="container">
          <div class="row">
          <div class="col-sm-12">
            <h1 class="text-center wiz-title">New User Registration</h1>
          </div>
        </div>
        <div class="row font-style">
          <div class="col-sm-12">
                  <div class="panel panel-default inner-panel">
                    <div class="panel-body">
                      <div class="row">
                  <div class="col-sm-12">
                        <h2>ARTIST/GROUP/WRITER INFORMATION Cont.</h2>
                      </div>
                    </div>
                    <div class="row">
                  <div class="col-sm-12">
                        <div class="form-group">
                            <label for="producer">Has artist/group ever recorded under the guidance of a producer? Please provide a brief description of artist/group:</label>
                            <?= $this->Form->input('producer', array('type' => 'textarea', 'escape' => false,'class' =>'input email required form-control input-sm','label' => false,'rows'=>'3','value'=>$defaultData['producer'])) ?>
                            <span id="producerHelpBlock" class="help-block"></span>
                          </div>
                          <div class="form-group">
                            <label for="history">Please provide a brief description of the goals of artist/group over the next 2 to 3 years:</label>
                            <?= $this->Form->input('history', array('type' => 'textarea', 'escape' => false,'class' =>'input email required form-control input-sm','label' => false,'rows'=>'3','value'=>$defaultData['history'])) ?>
                            <span id="historyHelpBlock" class="help-block"></span>
                          </div>
                          <div class="form-group">
                            <label for="career">What do artist/group consider to be the most important issues that need to be addressed in relation to artist’s/group’s music career?</label>
                            <?= $this->Form->input('career', array('type' => 'textarea', 'escape' => false,'class' =>'input email required form-control input-sm','label' => false,'rows'=>'3','value'=>$defaultData['career'])) ?>
                            <span id="careerHelpBlock" class="help-block"></span>
                          </div>
                          <div class="form-group form-inline">
                            <label for="addressOne">During the next 2 to 3 years, artist/group plans to:</label>
                                <?= $this->Form->control('group_plan',array('class'=>'form-control','label' => false,'type'=>'select','options'=>$group_plan,'empty'=> 'Select...','value'=>$defaultData['group_plan'])); ?>
                            <span id="HelpBlock" class="help-block"></span>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <span name="0" class="new-patient-step-btn new-patient-step-0-btn btn btn-default" onclick="nextTab(2)">&lt;&lt;&lt; Back</span>
              </div>
              <div class="col-sm-6">
                <div class="progress">
                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                </div>
              </div>
              <div class="col-sm-3 hidden-xs">
                <span name="2" class="btn btn-primary pull-right" onclick="nextTab(4)">Continue &gt;&gt;&gt;</span>
              </div>
              <div class="visible-xs">
                <span name="2" class="btn btn-primary pull-right">Continue &gt;&gt;&gt;</span>
                <span name="0" class="new-patient-step-btn new-patient-step-0-btn btn btn-default">&lt;&lt;&lt; Back</span>
              </div>
            </div>
        </div>
    </section>

    <section id="contact-info-terms-conditions" class="hide">
        <div class="container">
          <div class="row">
          <div class="col-sm-12">
            <h1 class="text-center wiz-title">New User Registration</h1>
          </div>
        </div>
        <div class="row font-style">
          <div class="col-sm-12">
                  <div class="panel panel-default inner-panel">
                    <div class="panel-body">
                      <div class="row">
                  <div class="col-sm-12">
                        <h2>REGISTRATION TERMS AND CONDITIONS</h2>
                      </div>
                    </div>
                    <div class="row">
                  <div class="col-sm-12">
                    <div class="text-scroll">
                            <p>As a user or subscriber, I hereby agree and understands that <b>IN THE HOUSE</b> makes no representation or warranties regarding activities in the music industry by its users or subscribers or the acceptance by the general public of the users or subscriber’s work. it is fully understood that <b>IN THE HOUSE</b> acts solely as a provider of services to its users and subscribers.</p>
                            <p>As a user or subscriber, I hereby agree and understand that <b>IN THE HOUSE</b> will provide my registration information to affiliated third parties in order to provide me with certain benefits. By agreeing to these terms, I hereby authorize <b>IN THE HOUSE</b> to release such information and agree to allow affiliated third parties to contact me directly in connection with services and products. As a user or subscriber, I hereby hold <b>IN THE HOUSE</b> harmless from any action in connection with any business dealings between me and any affiliated third party.</p>
                            <p>I hereby release in the house from any and all liability arising out of or in connection with any tapes, songs, or recordings that I submit to <b>IN THE HOUSE</b>, post on my profile page or share with any other user or subscriber, including but not limited to any claims of copyright infringement by any third party.</p>
                            <p>I hereby warrant and represent that all material submitted is an original creation, or that I have obtained the rights to submit such material. I hereby agree that I will follow the guidelines of <b>IN THE HOUSE</b> in regards to the submission and posting of songs and recordings, and I understand that in the house reserves the right to remove any material that violates the rights of any third party.</p>
                            <p>In the event of legal action resulting from the violation of copyright or ownership rights of musical compositions or recordings, I understand that I will be responsible for any costs arising from such legal action. The obligation on the part of the other party shall be deemed to have accrued on the date of the commencement of such action and shall be enforceable whether or not the action is prosecuted to judgement. Should <b>IN THE HOUSE</b> be named as a defendant in any suit brought by or against users or subscribers in connection with or arising out of member’s songs or recordings, user or subscriber shall be responsible for all costs and expenses incurred by in the house including reasonable attorney fees.</p>
                            <p>The laws of the state of massachusetts shall govern the validity, performance and enforcement of this agreement. Should either party institute legal suit or action for enforcement of any obligation contained herein it is agreed that the venue of such suit or action shall be in the state of massachusetts and I hereby consent to in the house designating the venue of any such suit or action.</p>
                            <p>The provisions herein shall inure to the benefit of the parties herein and any heirs, successors or assigns and shall survive the termination or cancellation of this agreement.</p>
                            <p>I, the undersigned registrant do hereby accept the terms and conditions above by affixing my signature and date below.</p>
                          </div>
                        <hr>
                        <div class="row">
                      <div class="col-sm-12">
                            <b>Online registrants - Please type your name and date in fields below:</b>
                          </div>
                        </div>
                        <div class="row">
                                            <div class="col-sm-9">
                                              <div class="form-group">
                                                <label for="signature">Name*</label>
                                                <?= $this->Form->input('signature', array('type' => 'text','class' =>'input form-control input-sm','label' => false,'value'=>$defaultData['signature'])) ?>
                                                <span id="signatureHelpBlock" class="help-block"></span>
                                              </div>
                                            </div>
                                            <div class="col-sm-3">
                                              <div class="form-group">
                                                <label for="date">Date*</label>
                                                <input type="date" name="date" id="date" class="form-control input-sm" value="<?php echo $defaultData['date'];?>">
                                                <span id="dateHelpBlock" class="help-block"></span>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                    </div>
                            </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <span name="0" class="btn btn-default btn-lg hidden-xs" onclick="nextTab(3)">&lt;&lt;&lt; Back</span>
              </div>
              <div class="col-sm-6">
                <div class="progress">
                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
              </div>
              <div class="col-sm-3 hidden-xs">
                <button type="submit" class="btn btn-primary pull-right" value="Done">Done</button>
              </div>
              <div class="visible-xs">
                <input type="submit" class="btn btn-primary pull-right" value="Done">
                <a href="registration3.html" name="0" class="btn btn-default">&lt;&lt;&lt; Back</a>
              </div>
            </div>
        </div>
    </section>

<?= $this->Form->end() ?>
