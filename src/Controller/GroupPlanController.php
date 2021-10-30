<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * GroupPlan Controller
 *
 * @property \App\Model\Table\GroupPlanTable $GroupPlan
 *
 * @method \App\Model\Entity\GroupPlan[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GroupPlanController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $groupPlan = $this->paginate($this->GroupPlan);

        $this->set(compact('groupPlan'));
    }

    /**
     * View method
     *
     * @param string|null $id Group Plan id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $groupPlan = $this->GroupPlan->get($id, [
            'contain' => []
        ]);

        $this->set('groupPlan', $groupPlan);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $groupPlan = $this->GroupPlan->newEntity();
        if ($this->request->is('post')) {
            $groupPlan = $this->GroupPlan->patchEntity($groupPlan, $this->request->getData());
            if ($this->GroupPlan->save($groupPlan)) {
                $this->Flash->success(__('The group plan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The group plan could not be saved. Please, try again.'));
        }
        $this->set(compact('groupPlan'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Group Plan id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $groupPlan = $this->GroupPlan->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $groupPlan = $this->GroupPlan->patchEntity($groupPlan, $this->request->getData());
            if ($this->GroupPlan->save($groupPlan)) {
                $this->Flash->success(__('The group plan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The group plan could not be saved. Please, try again.'));
        }
        $this->set(compact('groupPlan'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Group Plan id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $groupPlan = $this->GroupPlan->get($id);
        if ($this->GroupPlan->delete($groupPlan)) {
            $this->Flash->success(__('The group plan has been deleted.'));
        } else {
            $this->Flash->error(__('The group plan could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
