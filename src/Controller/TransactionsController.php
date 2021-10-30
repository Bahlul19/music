<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;

/**
 * Polls Controller
 *
 * @property \App\Model\Table\TransectionsTable $Transections
 *
 * @method \App\Model\Entity\Transection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TransactionsController extends AppController
{
	  /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

	  public function index()
	  {
	  	 $this->paginate = [
            'contain' => ['Users']
        ];
        $uid = $this->Auth->user('id');
        $transactions = $this->Transactions->find('all')->where(['user_id' => $uid])->toArray();
        $this->set(compact('transactions'));
	  }
}
