<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;
use Cake\Http\Response;
use Cake\Validation\Validator;
use Cake\Filesystem\File;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function beforeRender(\Cake\Event\Event $event) {
        parent::beforeRender($event);
        if ($this->viewBuilder()->className() == null) {
            $this->viewBuilder()->className('App\View\AppView');
        }
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['States', 'Countries']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }


     /**
     * Initialize method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

     public function main()
     {
        //Added theme file main file into this
        $this->loadModel("RadioTracks");
        $this->set('csrf',$this->request->getParam('_csrfToken'));
        $RadioTracks = $this->RadioTracks->find()->where(['active'=>'1'])->order(["id DESC"])->first();
        $session = $this->getRequest()->getSession();
     
       
        if($this->request->getSession()->read('Auth') != null){
            $this->set('topPageBlock',$this->requestAction('/users/topPageBlock'));
            $showNotification = 1;
            $this->set('data',$this->requestAction('/notifications/view-all-notifications'));


            $poststable = TableRegistry::getTableLocator()->get('Posts');
            $news = $poststable->find('all', [
            'contain' => ['Medias', 'PostCategorys', 'PostTags'],
            'conditions' => [
            'Posts.status' => 1,
            'content_type' => 1
            ],
            'order' => ['Posts.created' => 'DESC']
            ])->toArray();


            // this is for fetching data into the login users states and country
            $uid = $this->Auth->user('id');

            $stateCountryGet = $this->Users->find('all',
                ['contain' => ['States', 'Countries']]
                )->where(['Users.id' => $uid])->first();

            $userStateName = $stateCountryGet->state->name;

            $userCountryName = $stateCountryGet->country->name;

            $userDateofBirth = $this->Users->find('all',
                ['contain' => ['Profiles']]
            )->where(['Users.id' => $uid])->first();

            $userDOB = $userDateofBirth->profile->dob;

            $this->loadModel("ArtistInfo");
            // fetch the artist info
            $entryCount = $this->ArtistInfo->find()->where(['user_id'=>$uid])->count();

            $progressBarPercentage = 0;
            if($entryCount > 0)
            {
                $totalcount = 0;
                $dataFilled = 0;
                $infoPercentage = $this->ArtistInfo->find()->where(['user_id'=>$uid])->first()->toArray();
                foreach ($infoPercentage as $key => $value) {
                    if($key == 'id' || $key == 'user_id' || $key == 'created_date')
                    {

                    }else{
                        if($value != null && $value != ''){
                            $dataFilled++;
                        }

                        $totalcount++;
                    }
                }
                if($totalcount !=0)
                $progressBarPercentage = (int)(($dataFilled / $totalcount)*100);
            }
           $disableProgressBar = $session->read('disableProgressBar');
           $this->set('RadioTracks',$RadioTracks);
           $this->set(compact('news','disableProgressBar','userStateName','userCountryName','userDOB','progressBarPercentage'));
        }

        else
        {
            $this->set('mainpageData',$this->requestAction('/Users/mainpage'));
            $showNotification = 0;
        }
        $this->set('showNotification',$showNotification);
     }

    public function mainpage(){
        $this->layout = 'ajax';
        $this->loadModel("RadioTracks");
        $RadioTracks = $this->RadioTracks->find()->where(['active'=>'1'])->order(["id DESC"])->first();
        $this->set('RadioTracks',$RadioTracks);
        $this -> render('/Element/mainpage');
    }

    public function topPageBlock(){
        $this->layout = 'ajax';
        $this->loadModel("RadioTracks");
        $RadioTracks = $this->RadioTracks->find()->where(['active'=>'1'])->order(["id DESC"])->first();
        $this->set('RadioTracks',$RadioTracks);
        $this -> render('/Element/topblocks');
    }

     public function mynotificationsmain()
     {
        $this->set('csrf',$this->request->getParam('_csrfToken'));
        if($this->request->getSession()->read('Auth') != null){
            $showNotification = 1;
            $this->set('data',$this->requestAction('/notifications/mynotifications'));

            $poststable = TableRegistry::getTableLocator()->get('Posts');
            $news = $poststable->find('all')->contain(['Medias', 'PostCategorys', 'PostTags'])->where(['content_type' => 1])->order(['Posts.created' => 'DESC'])->toArray();

             // this is for fetching data into the login users states and country
            $uid = $this->Auth->user('id');

            $stateCountryGet = $this->Users->find('all',
                ['contain' => ['States', 'Countries']]
                )->where(['Users.id' => $uid])->first();

            $userStateName = $stateCountryGet->state->name;

            $userCountryName = $stateCountryGet->country->name;

            $userDateofBirth = $this->Users->find('all',
                ['contain' => ['Profiles']]
            )->where(['Users.id' => $uid])->first();

            $userDOB = $userDateofBirth->profile->dob;

           $this->set(compact('news','userStateName','userCountryName','userDOB'));
        }
        else
        {
            $showNotification = 0;
        }
        $this->set('showNotification',$showNotification);
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
        $user = $this->Users->get($id, [
            'contain' => ['States', 'Countries', 'UserRoles']
        ]);
        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $states = $this->Users->States->find('list', ['limit' => 200]);
        $countries = $this->Users->Countries->find('list', ['limit' => 200]);
        $this->set(compact('user', 'states', 'countries'));
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
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $states = $this->Users->States->find('list', ['limit' => 200]);
        $countries = $this->Users->Countries->find('list', ['limit' => 200]);
        $this->set(compact('user', 'states', 'countries'));
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
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * SignUp method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function signup()
    {
        $alluser = $this->Users->newEntity();
        if($this->request->is('post'))
        {
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.SECRET.'&response='.$_POST['recaptcha']);
            $responseData = json_decode($verifyResponse);
            if($responseData->success) {
            $alluser = $this->Users->patchEntity($alluser, $this->request->getData());
            $alluser->is_featured = 0;
            if($this->Users->save($alluser))
            {
                $this->Users->save_member_role($alluser->id);
                $this->Users->newUserSupport($alluser->id);

                $this->Flash->set("You have been successfully registered and logged in.",
                    [
                        'element' => 'success_message'
                    ]);
                /*email send code into there start*/
                $firstName = $this->request->getData('first_name');
                $lastname = $this->request->getData('last_name');
                $emailSend = $this->request->getData('email');
                $username = $this->request->getData('username');
                $address = $this->request->getData('address');
                $city = $this->request->getData('city');
                $zipcode = $this->request->getData('zipcode');
                $gender = $this->request->getData('gender');
                $mobie_phone = $this->request->getData('mobie_phone');
                $state_id = $this->request->getData('state_id');
                $country_id = $this->request->getData('country_id');

                $sender = sender_email;
                $recepient =  $this->request->data['email'];
                $subject= "Registration";
                // $content = "Change the password";
                $Email = new Email('default');
                $Email->config('smtp');
                $Email->from($sender)
                    ->to($recepient)
                    ->subject($subject)
                    ->template('usr_signup')
                    ->setViewVars(
                            ['applierName' => $firstName . ' ' . $lastname])
                    ->emailFormat('html');
                $Email->send();
                /*email send code into there end*/
                $user = $this->Auth->identify();
                if($user)
                {
                    $this->Auth->setUser($user);
                    return $this->redirect(['controller' => 'Users', 'action' => 'main']);
                }
                return $this->redirect(['controller' => 'Users','action' => 'login']);
            }
            if($alluser->errors()){
                $error_msg = [];
                foreach( $alluser->errors() as $errors){
                    if(is_array($errors)){
                        foreach($errors as $error){
                            $error_msg[]    =   $error;
                        }
                    }else{
                        $error_msg[]    =   $errors;
                    }
                }

                if(!empty($error_msg)){
                    $this->Flash->set($error_msg[0], ['element' => 'error_message']);
                }
            }
        }
        else {
            $this->Flash->set('Recaptcha verification failed.  Please, try again.', ['element' => 'error_message']);
        }


        }

        $states = $this->Users->States->find('list');
        $countries = $this->Users->Countries->find('list');
        $this->set(compact('alluser', 'states', 'countries'));
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
        if($this->request->is('post')) {
            $user = $this->Auth->identify();
            if($user)
            {
                $this->Auth->setUser($user);

                return $this->redirect(['controller' => 'Users', 'action' => 'main']);
            } else {
                $this->Flash->set("You have entered an invalid email or password", ['element' => 'error_message']);
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
        $this->redirect($this->Auth->logout());
        session_destroy();
    }

    /**
    * Forgot Password method
    *
    * @param string|null $id User id.
    * @return \Cake\Http\Response|null Redirects to index.
    * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    */

    public function forgotPassword()
    {
        if($this->request->is('post'))
        {
            $myEmail = $this->request->getData('email');
            $myToken = Security::hash(Security::randomBytes(25));
            $usersTable = TableRegistry::get('Users');
            $user = $usersTable->find('all')->where(['email' => $myEmail])->first();
           // dd($user);
            if(!empty($user))
            {
            $user->password = '';
            $user->token = $myToken;
            if($usersTable->save($user))
            {
                $this->Flash->set("Reset password has been sent to your('.$myEmail.'), Please open your inbox",
                    [
                        'element' => 'success_message'
                    ]);

            $sender = sender_email;
            $recepient = $this->request->data['email'];
            $subject= "Forgot Password";
            $Email = new Email('default');
            $Email->config('smtp');
            $Email->from($sender)
                ->to($recepient)
                ->subject($subject)
                ->template('default')
                ->emailFormat('html');
                // ->viewVars(array('content' => $content));
            $Email->send('Hello '.$myEmail.'<br/>Please click link below to reset your password<br/><br/><a href=" http://inthehousemusic.com/users/resetpassword/'.$myToken.'">Reset Password</a>');

            }
        }
            else
            {
                $this->Flash->set("Email address is not registered",
                [
                    'element' => 'error_message'
                ]);
            }
        }
    }

    /**
    * Reset Password method
    *
    * @param string|null $id User id.
    * @return \Cake\Http\Response|null Redirects to index.
    * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
    */

    public function resetPassword($myToken)
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
                $this->Flash->set("Your password has been reset.",
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


    public function changepassword(){
        $id=$this->request->getSession()->read('Auth.User.id');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if($this->request->is('post')){
            $currentpassword=$this->request->getData('oldpassword');
            $newpassword=$this->request->getData('newpassword');
            $confirmpassword=$this->request->getData('confirmpassword');
            if($currentpassword!=NULL && $newpassword!=NULL && $confirmpassword!=NULL){
                    if ((new DefaultPasswordHasher)->check($currentpassword, $user->password)) {
                        if($newpassword===$this->request->getData('confirmpassword')){
                            $hasher = new DefaultPasswordHasher();
                            $mypassword = $hasher->hash($newpassword);
                            $usersTable =  TableRegistry::get('Users');
                            $usersTable = $this->Users->updateAll(array('password'=>$mypassword), array('id'=>$id));
                            if($usersTable)
                            {
                                $this->Flash->success(__('Password changes successfully !'));
                            }
                        }
                        else{
                            $this->Flash->error(__('Both password do not match !please check !'));
                        }
                    }
                else{
                    $this->Flash->error(__('Old password is wrong !please check !'));
                }
            }
            else{
               $this->Flash->error(__('Empty fields !please check !'));
            }
        }
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
    public function subscribe()
    {

    }

    public function success(){
        if($_REQUEST['st'] == 'Completed'){
         // Init cURL
         $request = curl_init();

         // Set request options
         curl_setopt_array($request, array
         (
           CURLOPT_URL => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
           CURLOPT_POST => TRUE,
           CURLOPT_POSTFIELDS => http_build_query(array
             (
               'cmd' => '_notify-synch',
               'tx' => $_REQUEST['tx'],
               'at' => 'sJVntOrbnYymhPJQe9ryQ87AKM7xV4k4nok_QI4azvkVL5DFlpaJLZg5Pb4',
             )),
           CURLOPT_RETURNTRANSFER => TRUE,
           CURLOPT_HEADER => FALSE,
           // CURLOPT_SSL_VERIFYPEER => TRUE,
           // CURLOPT_CAINFO => 'cacert.pem',
         ));

         // Execute request and get response and status code
         $response = curl_exec($request);
         $status   = curl_getinfo($request, CURLINFO_HTTP_CODE);

         // Close connection
         curl_close($request);
         if($status == 200 AND strpos($response, 'SUCCESS') === 0)
         {
             // Remove SUCCESS part (7 characters long)
             $response = substr($response, 7);

             // URL decode
             $response = urldecode($response);

             // Turn into associative array
             preg_match_all('/^([^=\s]++)=(.*+)/m', $response, $m, PREG_PATTERN_ORDER);
             $response = array_combine($m[1], $m[2]);

             // Fix character encoding if different from UTF-8 (in my case)
             if(isset($response['charset']) AND strtoupper($response['charset']) !== 'UTF-8')
             {
               foreach($response as $key => &$value)
               {
                 $value = mb_convert_encoding($value, 'UTF-8', $response['charset']);
               }
               $response['charset_original'] = $response['charset'];
               $response['charset'] = 'UTF-8';
             }

             // Sort on keys for readability (handy when debugging)
             ksort($response);
             $transactionsTable = TableRegistry::getTableLocator()->get('Transactions');

             $transactions = $transactionsTable->newEntity();

             $transactions->user_id = $response['custom'];
             $transactions->btn_id = $response['btn_id'];
             $transactions->business = $response['business'];
             $transactions->contact_phone = $response['contact_phone'];
             $transactions->item_name = $response['item_name'];
             $transactions->item_number = $response['item_number'];
             $transactions->last_name = $response['last_name'];
             $transactions->mc_currency = $response['mc_currency'];
             $transactions->mc_fee = $response['mc_fee'];
             $transactions->mc_gross = $response['mc_gross'];
             $transactions->option_name = $response['option_name1'];
             $transactions->option_selection = $response['option_selection1'];
             $transactions->payer_email = $response['payer_email'];
             $transactions->payer_id = $response['payer_id'];
             $transactions->payer_status = $response['payer_status'];
             $transactions->status = '1';
             $transactions->payment_date = $response['payment_date'];
             $now = Time::now();
             $now->addMonth(1);
             $transactions->end_date = $now;
             $transactions->payment_fee = $response['payment_fee'];
             $transactions->payment_gross = $response['payment_gross'];
             $transactions->payment_status = $response['payment_status'];
             $transactions->payment_type = $response['payment_type'];
             $transactions->protection_eligibility = $response['protection_eligibility'];
             $transactions->receiver_id = $response['receiver_id'];
             $transactions->residence_country = $response['residence_country'];
             $transactions->subscr_id = $response['subscr_id'];
             $transactions->transaction_subject = $response['transaction_subject'];
             $transactions->txn_id = $response['txn_id'];
             $transactions->txn_type = $response['txn_type'];

             $transactionsTable->save($transactions);

             $this->loadModel('UserRoles');
             $this->UserRoles->updateAll( array('role_id'=>4),array('user_id' => $response['custom']));

         }
         else
         {
             $this->Flash->error(__('The transaction could not be saved.'));
         }
        }
        else{
            $this->Flash->error(__('Payment failed.'));
        }
    }

    public function cancel(){
     $this->autoRender= false;
    }

    public function chat(){
        if($this->request->is('post','ajax'))
        {
            $chatsTable = TableRegistry::get('chats');
            $file=WWW_ROOT .'chat.txt';
            $function = $_POST['function'];

            $log = array();

            switch($function) {

                case('getState'):
                    if(file_exists($file)){
                    $lines = file($file);
                    }
                    $log['state'] = count($lines);
                    break;

                case('update'):
                    $state = $_POST['state'];
                    if(file_exists($file)){
                    $lines = file($file);
                    }
                    $count =  count($lines);
                    if($state == $count){
                        $log['state'] = $state;
                        $log['text'] = false;

                        }
                        else{
                            $text= array();
                            $log['state'] = $state + count($lines) - $state;
                            foreach ($lines as $line_num => $line)
                            {
                                if($line_num >= $state){
                                $text[] =  $line = str_replace("\n", "", $line);
                                }

                                }
                            $log['text'] = $text;

                        }

                    break;

                case('send'):
                $nickname = htmlentities(strip_tags($_POST['nickname']));
                    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                    $message = htmlentities(strip_tags($_POST['message']));
                if(($message) != "\n"){

                    if(preg_match($reg_exUrl, $message, $url)) {
                        $message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
                        }

                    fwrite(fopen($file, 'a'), "<span>". $nickname . "</span>" . $message = str_replace("\n", " ", $message) . "\n");

                    $chats = $chatsTable->newEntity();
                    $chats->username = $nickname;
                    $chats->message = $message;
                    $chatsTable->save($chats);

                }
                    break;

            }
            $this->set(['log' => $log,'_serialize' => 'log',]);
            $this->view = '/Element/chat';
        }
   }


    //for feature employee

     public function featureArtist()
     {
        $role = $this->request->getSession()->read('role');
        $users = $this->Users->find('all',[
            'contain' => [ 'UserRoles'=>'Roles']
        ])->toArray();
        $this->set(compact('users'));
     }

     public function comingSoon(){

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


}
