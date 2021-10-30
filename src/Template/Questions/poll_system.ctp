<div class="container-fluid">
    <div class="col-md-3"></div>
        <div class="col-md-6" id="submit">     
            <?php 

            if($questions)
            {

            foreach($questions as $question)
            {
                echo $this->Form->create(null,['url' => ['controller' => 'Polls', 'action' => 'getQuestionAnswer', 'id' => 'submit']]);
                echo " Question: " . $question->question . '<br/>';
                $getQuestionAnswer = $question->answers;
                foreach($getQuestionAnswer as $questionAns)
                { ?>
                    <input type="hidden" name="question_id" value="<?=$question->id?>">
                    <input type="radio" name="answer_id" value='<?=$questionAns->id?>' placeholder="<?php echo $questionAns->id; ?>" required="">
                    <?php echo $questionAns->answer.'<br/>';
                }
                echo "<br/>"; ?>
                <button type="submit" class="btn btn-success">Submit</button><br/><br/>
                <?php  echo $this->Form->end(); }    
            }
            else
            {
                 echo "<p style='font-size:30px; color: orange; font-weight: bold'>You Answered All The Questions</p>" . "<br/>";
            }

                     ?>  
    </div>
    <div class="col-md-3" id="chartContainer"></div>
</div>

