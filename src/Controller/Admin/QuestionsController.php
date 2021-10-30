<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;

/**
 * Questions Controller
 *
 * @property \App\Model\Table\QuestionsTable $Questions
 *
 * @method \App\Model\Entity\Question[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class QuestionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null)
    {
        $questions = $this->Questions->find('all');
        $this->set(compact('questions'));
    }

    /**
     * View method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => ['Answers', 'Polls']
        ]);

        $this->set('question', $question);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $question = $this->Questions->newEntity();
        if ($this->request->is('post')) {
            $question = $this->Questions->patchEntity($question, $this->request->getData());
            if ($this->Questions->save($question)) {
                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $this->set(compact('question'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => ['Answers']
        ]);
        $this->loadModel('Answers');

        $answer = $this->Questions->find('list')->where(['id' => $id])->toArray();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $question = $this->Questions->patchEntity($question, $this->request->getData());
            if ($this->Questions->save($question)) {

//For updating answers
                $this->loadModel('Answers');
                    $answerValue = $this->Answers->newEntity();
                  
                    $answerTableID = $this->request->data['answerid'];
                   
                    $answerNewValue = $this->request->getData(['answer']);
                    for($i = 0; $i<count($answerNewValue); $i++)
                    {
                        $this->Answers->updateAll([  // fields
                        'answer' => $answerNewValue[$i]
                    ],
                    [ 
                        'id' => $answerTableID[$i]
                    ]);
                    }

                $this->Flash->success(__('The question has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $this->set(compact('question'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Question id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Questions->get($id);
        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Poll Question method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */

    public function pollQuestions()
    { 
        $pollQuestion = $this->Questions->newEntity();
        if($this->request->is('post'))
        {
           $pollQuestion = $this->Questions->patchEntity($pollQuestion, $this->request->getData());
            if($this->Questions->save($pollQuestion))
            {
                $answerTable = TableRegistry::get('answers');
                $getAnswer = $this->request->getData("answer");
                foreach($getAnswer as $answers)
                {
                    $pollAnswer = $answerTable->newEntity();
                    $pollAnswer->question_id = $pollQuestion->id;
                    $pollAnswer->answer = $answers;
                    $answerTable->save($pollAnswer);
                }

                 $this->Flash->set("Polling system is ready",
                    [
                        'element' => 'success_message'
                    ]);
            }

             else
            {
                 $this->Flash->set("Please check the input field",
                 [
                    'element' => 'error_message'
                 ]);       
            }
        }
            $this->set('pollQuestion', $pollQuestion);
    }

     /**
     * Poll System method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */

     public function pollSystem()
     {
       $question = $this->Questions->find('all', [
            'contain' => ['Answers'], 'order' => ['id' => 'desc'], 'limit' => 1
        ])->toArray();
       
        $this->set('question', $question);
     }


}
