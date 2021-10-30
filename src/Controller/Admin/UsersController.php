<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Http\Response;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\Mailer\Email;
use Cake\Event\Event;

class UsersController extends AppController
{
     /**
     * Index method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	 public function index()
     {
       $role = $this->request->getSession()->read('role');

       $userAccess = array("superadmin");

       if(in_array($role,$userAccess))
       {
        
        $users=$this->Users->find('all',[
            'contain' => ['States', 'Countries', 'UserRoles'=>'Roles']
        ])->toArray();
        $this->set(compact('users'));
        }
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
        }
    }
     /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->request->getSession()->read('role');

       $userAccess = array("superadmin");

       if(in_array($role,$userAccess))
       {
        $user = $this->Users->get($id, [
            'contain' => ['States', 'Countries', 'UserRoles']
        ]);
        $this->set('user', $user);
       }
       else
       {
           $this->Flash->error(__('You are not authorised access.'));
           return $this->redirect(['controller'=>'posts','action' => 'index']);
       }
    }

     /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->request->getSession()->read('role');
        
        $userAccess = array("superadmin");
 
        if(in_array($role,$userAccess))
        {
                $this->loadModel('Roles');
                $role = $this->request->getSession()->read('role');

                if($role == 'superadmin')
                {
                    $user = $this->Users->get($id, [
                        'contain' => ['UserRoles']
                    ]);

                    if ($this->request->is(['patch', 'post', 'put'])) {

                        $user = $this->Users->patchEntity($user, $this->request->getData());
                    // $roles = $this->request->getData('user_roles');

                        if ($this->Users->save($user)) {

                        if (!empty($this->request->getData('roles'))) {
                                    $this->UserRoles->deleteAll(['UserRoles.user_id' => $user->id]);
                                    foreach ($this->request->getData('roles') as $role_id) {
                                        $userRoles = $this->UserRoles->newEntity();
                                        $userRoles->user_id = $user->id;
                                        $userRoles->role_id = $role_id;
                                        $this->UserRoles->save($userRoles);
                                    }
                                }

                        $this->Flash->success(__('The user has been saved.'));
                        return $this->redirect(['action' => 'index']);
                        }

                        $this->Flash->error(__('The user could not be saved. Please, try again.'));
                    }
                    $states = $this->Users->States->find('list', ['limit' => 200]);
                    $countries = $this->Users->Countries->find('list', ['limit' => 200]);
                    $roles = $this->Roles->find('all');
                    $this->set(compact('user', 'states', 'countries','roles'));
                }
                else
                {
                    return $this->redirect(['action' => 'index']);
                }
            }
            else
            {
                $this->Flash->error(__('You are not authorised access.'));
                return $this->redirect(['controller'=>'posts','action' => 'index']);
            }
}

    public function editUserData($id = null)
    {
       $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin");
 
        if(in_array($role,$userAccess))
        {
            $user1=$this->Users->get($id,[
                'contain' => [
                'Profiles','Countries','States','Medias',
                'UserRoles'=>['Roles'],
                ]
                ]);
            $this->set('user1', $user1);
            $currentprofileimage=$user1->medias['0']['name'];
            $states = $this->Users->States->find('list');
            $countries = $this->Users->Countries->find('list');
            $this->loadModel('Skills');
            $allskills = $this->Skills->find('all');
            foreach ($allskills as $skill) {
                $skills[$skill['id']] = $skill['skill'];
            }

            $this->loadModel('Interests');
            $allinterests = $this->Interests->find('all');
            foreach ($allinterests as $interest) {
                $interests[$interest['id']] = $interest['interest'];
            }

            $this->loadModel('ProfileTags');
            $alltags = $this->ProfileTags->find('all');
            foreach ($alltags as $tag) {
                $tags[$tag['id']] = $tag['tag'];
            }
            $this->loadModel('Roles');
            $roles = $this->Roles->find('list')
            ->hydrate(false)
            ->toArray();

            if($this->request->is(['patch', 'post', 'put'])) {
                    $data=$this->request->getData();
                    //debug($data['is_featured']);
                    $user1 = $this->Users->patchEntity(
                        $user1,
                        $this->request->getData(),
                        [
                            'associated' => ['Profiles'],
                        ]
                    );
                    $user1->is_featured=$data['is_featured'];
                    //debug($user);
                    $user1->profile->interest=json_encode($data['interests']);
                    $user1->profile->skill=json_encode($data['skills']);
                    $user1->profile->tag=json_encode($data['tags']);
                    if($this->Users->save($user1)){

                        $user_rolesTable=TableRegistry::getTableLocator()->get('UserRoles');
                        $user_rolesTable = $this->UserRoles->updateAll(array('role_id'=>$data['user_roles']['0']['role_id']), array('user_id'=>$user1->id));
                       
                        if($data['media']['file']['name']!=NULL){
                            $imgTmp=$data['media']['file']['tmp_name'];
                            $folder="files/userData/".$id."/profileImg/";
                            $dir = new Folder();
                            $dir->create(WWW_ROOT . 'files/userData/'.$id.'/profileImg/');
                            if($imgTmp !='')
                            {
                                move_uploaded_file($imgTmp, $folder.'profileimg.jpg');
                                $this->loadModel('Medias');
                                $this->Medias->updateAll( array('name'=>'profileimg.jpg'),array('id' => $data['media']['id']));
                                //unlink($folder.basename($user->medias['0']['name']));
                                $user1->medias['0']['name'] = 'profileimg.jpg';
                                $this->request->getSession()->write('profile_img','profileimg.jpg');

                            }
                        }
                        $this->Flash->success(__('The user has been saved.'));
                        $user1=$this->Users->get($id,[
                            'contain' => [
                            'Profiles','Countries','States','Medias',
                            'UserRoles'=>['Roles'],
                            ]
                            ]);
                            $this->set('user1', $user1);
                    }
                    else $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            
            $this->set(compact('states', 'countries','roles','skills','interests','tags'));
       }
       else
            {
                $this->Flash->error(__('You are not authorised access.'));
                return $this->redirect(['controller'=>'posts','action' => 'index']);
            }
    }

    public function add()
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin");
 
        if(in_array($role,$userAccess))
        {
                $userADD = $this->Users->newEntity();
                if ($this->request->is('post')) {
                    $data=$this->request->getData();
                    $userADD = $this->Users->patchEntity($userADD, $this->request->getData());
                    $myToken = Security::hash(Security::randomBytes(25));
                    $userADD->password=$myToken;
                    $userADD->password_confirmation=$myToken;
                    $userADD->token=$myToken;
                    if ($this->Users->save($userADD)) {
                        $firstName = $this->request->getData('first_name');
                        $lastname = $this->request->getData('last_name');

                        $this->loadModel('UserRoles');
                        $userTable = $this->UserRoles->newEntity();
                        $userTable->user_id= $userADD->id;
                        $userTable->role_id = $data['role_id'];
                        $userTableSave = $this->UserRoles->save($userTable);
                        $this->Users->newUserSupport($userADD->id);              
                        $sender = $this->request->getSession()->read('Auth.User.email');
                        $recepient = $data['email'];
                        $subject= "Please Set your Password";
                        $Email = new Email('default');
                        $Email->config('smtp');
                        $Email->from($sender)
                            ->to($recepient)
                            ->subject($subject)
                            ->template('default')
                            ->emailFormat('html');
                        $Email->send('Hello '.$firstName.' '.$lastname.'!!<br/>For logging into your account, Click Here.<br/><br/><a href="http://inthehousemusic.com/users/set_password/'.$myToken.'">Set Password</a>');

                        $this->Flash->success(__('The user has been saved.'));

                        return $this->redirect(['action' => 'index']);
                    }
                    else{
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                    }
                }
                $states = $this->Users->States->find('list', ['limit' => 200]);
                $countries = $this->Users->Countries->find('list', ['limit' => 200]);
                $this->loadModel('Roles');
                $roles = $this->Roles->find('list')
                ->hydrate(false)
                ->toArray();
                $this->set(compact('userADD', 'states', 'countries','roles'));
        }
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
        }
    }

//this function is for setpassword
    public function setPassword($myToken)
    {
        if($this->request->is('post'))
        {
            $passwordGet = $this->request->getData('password');
            $confirmPasswordGet = $this->request->getData('password_confirmation');

            if($passwordGet == $confirmPasswordGet)
            {
             $hasher = new DefaultPasswordHasher();
             $mypassword = $hasher->hash($this->request->getData('password'));
              $usersTable =  TableRegistry::get('Users');
              $usersTable = $this->Users->updateAll(array('password'=>$mypassword), array('token'=>$myToken));
              if($usersTable)
              {
                $this->Flash->set("Your password has been updated.",
                [
                    'element' => 'success_message'
                ]);

                return $this->redirect(['action'=>'login']);
              }
            }
            else
             {
                 $this->Flash->set("New Password and Confirm Password Not Match!",
                 [
                    'element' => 'error_message'
                 ]);
             }
        }
    }


    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $role = $this->request->getSession()->read('role');

        $userAccess = array("superadmin");
 
        if(in_array($role,$userAccess))
        {
                $this->request->allowMethod(['post', 'delete']);
                $user = $this->Users->get($id);
                if ($this->Users->delete($user)) {
                    $this->Flash->success(__('The user has been deleted.'));
                } else {
                    $this->Flash->error(__('The user could not be deleted. Please, try again.'));
                }

                return $this->redirect(['action' => 'index']);
        }
        else
        {
            $this->Flash->error(__('You are not authorised access.'));
            return $this->redirect(['controller'=>'posts','action' => 'index']);
        }
    }

     /**
     * Login method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function login()
    {

       $role = $this->request->getSession()->read('role');

       $superAdmin = "superadmin";

       $adminUser = "admin";

       $userAccess = array("superadmin");

       $adminUserAcess = array("admin");
       

       if ($role != $superAdmin && $role != $adminUser) 
       {
            return $this->redirect($this->Auth->redirectUrl('/'));
       }

       else
       {

           if(in_array($role,$userAccess))
           {
               return $this->redirect(['controller'=>'posts','action' => 'index']);
           }
           else if(in_array($role, $adminUserAcess))
           {
                return $this->redirect(['controller'=>'posts','action' => 'index']);
           }
           else
           {
               if($this->request->is('post'))
               {
                   $user = $this->Auth->identify();
                   if($user)
                   {
                       $this->Auth->setUser($user);
                       $this->Flash->set("Login successfully",
                           [
                               'element' => 'success_message'
                           ]);
                       return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
                   }
                   else
                   {
                       $this->Flash->set("Only admin can access this location.",
                           [
                               'element' => 'error_message'
                           ]);
                   }
                }
            }
        }
    }

	 /**
	 * Logout method
	 *
	 * @param string|null $id User id.
	 * @return \Cake\Http\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
    public function logout()
    {
        // $this->redirect($this->Auth->logout());
        $this->Auth->logout();
        session_destroy();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function stateDropdown()
    {
        $this->autoRender = false;
        if($this->request->is('Ajax'))
        {
            $country_id = $this->request->input('json_decode');
            $statesTable =  TableRegistry::get('States');
            $query = $statesTable->find()->select(['id', 'name'])->where(['country_id' => $country_id])->toArray();
            echo json_encode($query);
            exit();
        }
    }


     /**
     * Is Feature method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

     public function premiumIndex()
     {
        $role = $this->request->getSession()->read('role');
        $users = $this->Users->find('all',[
            'contain' => [ 'UserRoles'=>'Roles']
        ])->toArray();
        $this->set(compact('users'));
     }

}
