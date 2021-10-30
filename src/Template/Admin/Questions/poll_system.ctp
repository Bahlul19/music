    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Polling System</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <?php 
dd($question);
                foreach($question as $questions)
                {
                    echo "Question: ". $questions['question'].'<br/>';

                    $getQuestionAnswer = $questions['answers'];

                    foreach($getQuestionAnswer as $questionAns)
                    {
                        echo $questionAns['answer'].'<br/>';
                    }
                    echo "<br/>";
                }

                ?>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

<?php $this->start('scriptBottom'); ?>

<?php $this->end(); ?>