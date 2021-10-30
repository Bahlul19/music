<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\I18n\Time;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * Profiles Controller
 *
 * @property \App\Model\Table\ProfilesTable $Profiles
 *
 * @method \App\Model\Entity\Profile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProfilesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    /*public function initialize(){
        $this->loadModel("Medias");
    }*/
    public function initialize()
    {
        parent::initialize();
        $this->loadModel("Medias");
    }
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Media']
        ];
        $profiles = $this->paginate($this->Profiles);

        $this->set(compact('profiles'));
    }

    /**
     * View method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $profile = $this->Profiles->get($id, [
            'contain' => ['Users', 'Media']
        ]);

        $this->set('profile', $profile);
    }

    public function viewpublicprofile($id)
    {
        $friend = false;
        $entryfound = false;
        $status = -1;
        $friend_user_id = 0;
        $this->set("friendreqlinkshow","");
        $this->set("hidefollow",0);
        $this->set("showpendingbuttons",0);
        $this->set("showactionbuttons",1);
        $val = $this->request->getSession()->read('Auth');
        //debug($val);
        $currentuserid = $val['User']['id'];
        $profile=$this->Profiles->get($id,[
        'contain' => [
        'Users' => ['Countries','States'],
        'Medias'
        ]
        ]);

        // to check if public profile of same user is seen or not
        if($profile->user->id == $currentuserid)
        {
            $this->set('showactionbuttons', 0);
        }

        //

        $result = $this->loadModel('Friends');
        $data = $result->find()->where(['OR' => [
            ['user_id' => $currentuserid,'friend_user_id' => $profile->user->id],
            ['friend_user_id' => $currentuserid,'user_id' => $profile->user->id]
        ]]);
        foreach($data as $row)
        {
           $entryfound = true;
           $status = $row->status;
           $friend_user_id = $row->friend_user_id;
        }

        $findiffriend = $result->find()->where([
            'OR' => [
                ['user_id' => $currentuserid,'friend_user_id' => $profile->user->id],
                ['friend_user_id' => $currentuserid,'user_id' => $profile->user->id]
            ],
            'AND'=>[
                ['(status = 1 or status = 3)'],
            ]
        ]);
        foreach($findiffriend as $row)
        {
           $friend = true;
        }
        $array_to_sort = array();
        if($friend == true || ($this->getRequest()->getSession()->read('role')=='prime_member')){
            $i=0;
            $this->loadModel("Medias");
            $mediaResult = $this->Medias->find('all')->where(['Medias.user_id '=> $profile->user->id,'status'=>1,'(type = 1 or type = 2)'])->order(['Medias.created'=>'desc'])->contain(['MediaMetas']);
            foreach($mediaResult as $media){
                $array_to_sort[$i]=$media;
                $i++;
            }
            //debug($array_to_sort);
            $this->loadModel("Notifications");
            $NotificationsResult = $this->Notifications->find('all')->where(['Notifications.user_id' => $profile->user->id])->order(['Notifications.created'=>'desc']);
            foreach($NotificationsResult as $notification){
                $array_to_sort[$i]=$notification;
                $i++;
            }
            if(count($array_to_sort) != 0){
                $sortedArray = array();
                $counter = 0;
                for($j=0;$j<count($array_to_sort);$j++)
                {
                    $createdon = $array_to_sort[$j]['created'];
                    $now = Time::parse($createdon);
                    $currenttime = strtotime($now->i18nFormat('yyyy-MM-dd HH:mm:ss'));
                    for($i=$j; $i<count($array_to_sort);$i++)
                    {
                        $now2 = Time::parse($array_to_sort[$i]['created']);
                        $currenttime2 = strtotime($now2->i18nFormat('yyyy-MM-dd HH:mm:ss'));
                        if($currenttime2 > $currenttime)
                        {
                            $sortedArray = $array_to_sort[$counter];
                            $array_to_sort[$counter] = $array_to_sort[$i];
                            $array_to_sort[$i] = $sortedArray;
                            $currenttime = $currenttime2;
                        }
                    }
                    $counter++;
                }
            }
            $this->set('my_feed', $array_to_sort);
        }

        // to load skills, interest and tags
        $profile->tag=json_decode($profile->tag);
        $profile->skill=json_decode($profile->skill);
        $profile->interest=json_decode($profile->interest);

        $this->loadModel('Skills');
        $skillset = '';
        $setofinterest = '';
        $setoftags = '';
        if($profile->skill != null)
        {
            $allskills = $this->Skills->find('all')->where(['Skills.id IN' => $profile->skill]);
            foreach ($allskills as $skill) {
                $skillset .= $skill['skill'].', ';
            }
        }

        $this->loadModel('Interests');
        if($profile->interest != null)
        {
            $allinterests = $this->Interests->find('all')->where(['Interests.id IN' => $profile->interest]);
            foreach ($allinterests as $interest) {
                 $setofinterest .= $interest['interest'].', ';
            }
        }

        $this->loadModel('ProfileTags');
        if($profile->tag != null)
        {
            $alltags = $this->ProfileTags->find('all')->where(['ProfileTags.id IN' => $profile->tag]);
            foreach ($alltags as $tag) {
               $setoftags .= $tag['tag'].', ';
            }
        }

        $profile->tag=substr_replace($setoftags ,"",-2);
        $profile->skill=substr_replace($skillset ,"",-2);
        $profile->interest=substr_replace($setofinterest ,"",-2);


        // end

        if($entryfound == true)
        {
            // for Pending req
            if($status == 0)
            {
                // case to check if its pending with current user
                if($friend_user_id == $currentuserid)
                {

                    $this->set("showpendingbuttons",1);
                    $this->set("showactionbuttons",0);
                    $this->set("acceptlink",'/profiles/acceptfriendrequest/'.$profile->user->id.'/'.$id);
                    $this->set("rejectlink",'/profiles/unfriend/'.$profile->user->id.'/'.$id);
                }
                $this->set("friendreqtitle","Friend Request Sent");
                $this->set("friendreqlink","#");
                $this->set("friendreqlinkshow","disabled");
                $this->set("followreqtitle","UnFollow");
                $this->set("followreqlink",'/profiles/followorunfollow/'.$profile->user->id.'/'.$id.'/1');
                $this->set("hidefollow",1);
            }
            $followstatus = $this->checkiffollow($profile->user->id);
            // friends
            if($status == 1)
            {
                $this->set("friendreqtitle","Unfriend");

                $this->set("friendreqlink",'/profiles/unfriend/'.$profile->user->id.'/'.$id);

                if($followstatus == 0)
                {
                    $this->set("followreqtitle","Follow");
                    $this->set("followreqlink",'/profiles/followorunfollow/'.$profile->user->id.'/'.$id.'/1');
                }
                else
                {
                    $this->set("followreqtitle","UnFollow");
                    $this->set("followreqlink",'/profiles/followorunfollow/'.$profile->user->id.'/'.$id.'/0');
                }



            }
           /* elseif($status == 2)
            {
                $this->set("friendreqtitle","Send Friend Request");
                $this->set("friendreqlink","/visit/");
                $this->set("followreqtitle","UnFollow");
                $this->set("followreqlink",'/profiles/followorunfollow/'.$profile->user->id.'/'.$id.'/1');
            }
            elseif($status == 3)
            {
                $this->set("friendreqtitle","Unfriend");
                $this->set("friendreqlink",'/profiles/unfriend/'.$profile->user->id.'/'.$id);
                $this->set("followreqtitle","UnFollow");
                $this->set("followreqlink",'/profiles/followorunfollow/'.$profile->user->id.'/'.$id.'/1');
            }*/
        }
        else
        {
            $this->set("friendreqtitle","Send Friend Request");
            $this->set("friendreqlink","/profiles/sendfriendrequest/".$profile->user->id."/".$id);
            $this->set("followreqtitle","Follow");
            $this->set("followreqlink",'/profiles/followorunfollow/'.$profile->user->id.'/'.$id.'/0');
            $this->set("hidefollow",1);
        }
        $this->set('profile', $profile);
        $this->set('is_friend', $friend);


    }

    public function checkiffollow($id)
    {

        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $result = $this->loadModel('follow');
         $data = $result->find()->where([
            ['user_id' => $currentuserid,'followed_user' => $id]
            ]
         );

         $followid = 0;
         foreach($data as $row)
         {

            if($row->status == 1){
                $followid = $row->id;
            }
            else
            {
                $followid = 0;
            }
         }
         return $followid;
    }

    public function acceptfriendrequest($id,$profileid)
    {
        $this->autoRender = false;
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
         $result = $this->loadModel('Friends');
         $data = $result->find()->where(
            ['friend_user_id' => $currentuserid,'user_id' => $id]
         );
        $row = $data->first();
        $friendsTable = TableRegistry::get('friends');
        $friends = $friendsTable->get($row->id);
        $friends->status = 1;
        $friendsTable->save($friends);
        $this->friendfollow($id);
        return $this->redirect(['action' => 'viewProfile',$id]);
    }


    public function friendfollow($id)
    {
        // following condition here
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];

        $followWhom = array($currentuserid => $id, $id => $currentuserid);

        $followTable = TableRegistry::get('follow');
        foreach($followWhom as $key => $value)
        {
            $follow = $followTable->newEntity();
            $follow->user_id = $key;
            $follow->followed_user = $value;
            $follow->status = 1;
            $follow->created = date("Y-m-d H:i:s");
            $followTable->save($follow);
        }
         $this->Flash->set("You follow this friend",
                    [
                        'element' => 'success_message'
                    ]);

    }

    public function followorunfollow($id,$profileid,$action)
    {
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $checkiffollow =  $this->checkiffollow($id);
        $followTable = TableRegistry::get('follow');
        if($checkiffollow == 0)
        {
            $data = $followTable->find()->where([
            ['user_id' => $currentuserid,'followed_user' => $id]
            ]
         );

            foreach($data as $row)
            {
                $checkiffollow = $row->id;
            }
        }


        $follow = $followTable->get($checkiffollow);
        if($action == 1)
            $follow->status = 1;
        elseif($action == 0)
            $follow->status = 0;

        $followTable->save($follow);

         $this->Flash->set("You Follow this friend",
                    [
                        'element' => 'success_message'
                    ]);

        return $this->redirect(['action' => 'viewProfile',$id]);

    }


    public function rejectfriendrequest($id,$profileid)
    {
        $this->autoRender = false;
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
         $result = $this->loadModel('Friends');
         $data = $result->find()->where(
            ['friend_user_id' => $currentuserid,'user_id' => $id]
         );

        $row = $data->first();
        $friendsTable = TableRegistry::get('friends');
        $entity = $friendsTable->get($row->id);
        $result = $friendsTable->delete($entity);
        return $this->redirect(['action' => 'viewProfile',$id]);
    }

    public function unfriend($id)
    {
        $this->autoRender = false;
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];

        // remove entry from friends table
         $result = $this->loadModel('Friends');
         $data = $result->find()->where(['OR' => [
            ['user_id' => $currentuserid,'friend_user_id' => $id],
            ['friend_user_id' => $currentuserid,'user_id' => $id]
            ]]
         );
        $row = $data->first();
        $friendsTable = TableRegistry::get('friends');
        $entity = $friendsTable->get($row->id);
        $result = $friendsTable->delete($entity);
        // end
        $this->unfriendUnfollow($id);
        return $this->redirect(['action' => 'view-profile',$id]);

         $this->Flash->set("You unfollow this friend",
                    [
                        'element' => 'success_message'
                    ]);

    }

    public function unfriendUnfollow($id)
    {
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $result = $this->loadModel('follow');
         $data = $result->find()->where(['OR' => [
            ['user_id' => $currentuserid,'followed_user' => $id],
            ['followed_user' => $currentuserid,'user_id' => $id]
            ]]
         );
         // deleting follow entries
         foreach($data as $row)
         {
            $entity = $result->get($row->id);
            $deletedresult = $result->delete($entity);
         }

         $this->Flash->set("The friend is unfollow by you",
                    [
                        'element' => 'success_message'
                    ]);
    }


    public function sendfriendrequest($id)
    {
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $friendsTable = TableRegistry::get('friends');
        $friends = $friendsTable->newEntity();
        $friends->user_id = $currentuserid;
        $friends->friend_user_id = $id;
        $friends->status = 0;
        $friends->created = date("Y-m-d H:i:s");
        if ($friendsTable->save($friends)) {
            $this->Flash->set("Friend Request has been sent.", ['element' => 'success_message']);
        } else {
            $this->Flash->set("Something went wrong, please try again later!", ['element' => 'error_message']);
        }
        $this->redirect(['action' => 'view-profile', $id]);
    }



    public function myaccount()
    {
        if($this->request->getSession()->read('profile_id')){
        $id=$this->request->getSession()->read('profile_id');
        $profile=$this->Profiles->get($id,[
        'contain' => [
        'Users' => ['Countries','States'],
        'Medias'
        ]
        ]);
        $profile->tag=json_decode($profile->tag);
        $profile->skill=json_decode($profile->skill);
        $profile->interest=json_decode($profile->interest);
        //debug($profile);
        // fetching data for ORG DETAILS

        //load components
        $this->loadModel('Genres');
        // end

        // fetch dropdown options
        $performing_right_org = array('ASCAP'=>'ASCAP','BMI'=>'BMI','SESAC'=>'SESAC');
        $union_member = array('ASCAP'=>'ASCAP','BMI'=>'BMI','SESAC'=>'SESAC');
        $member_of_a_union = array('ASCAP'=>'ASCAP','BMI'=>'BMI','SESAC'=>'SESAC');

        $genres_row = $this->Genres->find('all',array('fields'=>array('id','genre')))->toArray();
        $genre = array();

        foreach ($genres_row as $key => $value) {
            $genre[$value->id] = $value->genre;
        }


        // END
        $this->set('profile', $profile);

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

        $states = $this->Profiles->Users->States->find('list');
        $countries = $this->Profiles->Users->Countries->find('list');
        $this->set(compact('states','union_member','member_of_a_union', 'countries','skills','interests','tags','performing_right_org','genre'));
        }
        else{
            $this->Flash->error(__('You cannot edit other profiles'));
        }

    }

     public function saveAccountData($id = null)
    {

        $profile = $this->Profiles->get($id);

        $this->autoRender = false;
        if( $this->request->is(['ajax','post']) ) {
        $data=$this->request->getData();
        //debug(json_encode($data['interests']));
        $profile = $this->Profiles->patchEntity(
            $profile,
            $this->request->getData()
        );

        $profile->interest=json_encode($data['interests']);
        $profile->skill=json_encode($data['skills']);
        $profile->tag=json_encode($data['tags']);
        //debug($profile);

        if($this->Profiles->save($profile)){
        $usersTable = TableRegistry::get('users');
        $users = $usersTable->get($profile->user_id);
        $users->first_name=$data['users']['first_name'];
        $users->last_name=$data['users']['last_name'];
        $users->email=$data['users']['email'];
        $users->username=$data['users']['username'];
        $users->address=$data['users']['address'];
        $users->city=$data['users']['city'];
        $users->zipcode=$data['users']['zipcode'];
        $users->mobie_phone=$data['users']['mobie_phone'];
        $users->state_id=$data['users']['state_id'];
        $users->country_id=$data['users']['country_id'];

        $usersTable->save($users);

        $this->response->body(json_encode('success'));

        $this->Flash->set("Your data has been updated.",
                    [
                        'element' => 'success_message'
                    ]);
    }
    else{
        $this->response->body(json_encode(['failed']));
    }
    }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $profile = $this->Profiles->newEntity();
        if ($this->request->is('post')) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->getData());
            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('The profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profile could not be saved. Please, try again.'));
        }
        $users = $this->Profiles->Users->find('list', ['limit' => 200]);
        $media = $this->Profiles->Media->find('list', ['limit' => 200]);
        $this->set(compact('profile', 'users', 'media'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $profile = $this->Profiles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->getData());
            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('The profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profile could not be saved. Please, try again.'));
        }
        $users = $this->Profiles->Users->find('list', ['limit' => 200]);
        $media = $this->Profiles->Media->find('list', ['limit' => 200]);
        $this->set(compact('profile', 'users', 'media'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $profile = $this->Profiles->get($id);
        if ($this->Profiles->delete($profile)) {
            $this->Flash->success(__('The profile has been deleted.'));
        } else {
            $this->Flash->error(__('The profile could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }




/*    public function viewProfile($id=null){
        $this->loadModel("Myprofile");
        $this->loadModel("MediaMetas");
        $this->loadModel("RadioTracks");
        $user_id = $id;
        $RadioTracks = $this->RadioTracks->find()->where(['active'=>'1'])->order(["id DESC"])->first();
        $userDetails = $this->Myprofile->find()->where(['user_id'=>$user_id])->first();
        $profileDetails = $this->Profiles->find()->where(['user_id'=>$user_id])->first();
        $this->set('userDetails',$userDetails);
        $this->set('RadioTracks',$RadioTracks);
        $this->set('profileDetails',$profileDetails);
    }*/

    public function editMyProfile(){

        $this->loadModel("ArtistInfo");
        $this->loadModel("Myprofile");
        $this->loadModel("MediaMetas");
        $this->loadModel("RadioTracks");
        $this->set('csrf',$this->request->getParam('_csrfToken'));
        $session = $this->getRequest()->getSession();
            // fetch the artist info
            $entryCount = $this->ArtistInfo->find()->where(['user_id'=>$this->Auth->user('id')])->count();

            $progressBarPercentage = 0;
            if($entryCount > 0)
            {
                $totalcount = 0;
                $dataFilled = 0;
                $infoPercentage = $this->ArtistInfo->find()->where(['user_id'=>$this->Auth->user('id')])->first()->toArray();
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


        $profileData = $this->Medias->find()->where(['user_id'=>$this->Auth->user('id'),'type'=>3,'status'=>1])->first();
        $user_id = $this->request->getSession()->read("Auth.User.id");
        $RadioTracks = $this->RadioTracks->find()->where(['active'=>'1'])->order(["id DESC"])->first();
        $userDetails = $this->Myprofile->find()->where(['user_id'=>$user_id])->first();
        $profileDetails = $this->Profiles->find()->where(['user_id'=>$user_id])->first();
        $MediaMetasvideo = $this->MediaMetas->find('list',['keyField'=>'id','valueField'=>'title'])->where(['Medias.user_id'=>$user_id,'Medias.type'=>1,'status'=>1,'is_active'=>1])->contain(['Medias']);
        $MediaMetasAudio = $this->MediaMetas->find('list',['keyField'=>'id','valueField'=>'title'])->where(['Medias.user_id'=>$user_id,'Medias.type'=>2,'status'=>1,'is_active'=>1])->contain(['Medias']);
        $this->set('userDetails',$userDetails);
        $this->set('RadioTracks',$RadioTracks);
        $this->set('profileDetails',$profileDetails);
        $this->set('MediaMetasvideo',$MediaMetasvideo);
        $this->set('MediaMetasAudio',$MediaMetasAudio);
        $this->set('profileData',$profileData);
        $this->set('user_id',$user_id);
        $this->set('disableProgressBar',$disableProgressBar);
        $this->set('progressBarPercentage',$progressBarPercentage);
        $this->set('data',$this->requestAction('/notifications/mynotifications'));
    }


    public function viewProfile($id=null){

        $this->loadModel("ArtistInfo");
        $this->loadModel("Myprofile");
        $this->loadModel("MediaMetas");
        $this->loadModel("RadioTracks");
        $this->loadModel("Friends");
        $this->loadModel("Follow");

        // to fetch buttons
        $FriendsQuery = $this->Friends->find()->where(['OR' => [
            ['user_id' => $this->request->getSession()->read('Auth.User.id'),'friend_user_id' => $id],
            ['friend_user_id' => $this->request->getSession()->read('Auth.User.id'),'user_id' => $id]
        ]])->first();
        $showUnfriend = 0;
        $showUnfollow = 0;
        $showfollow = 0;
        $showFriend = 0;
        $showAcceptReject = 0;
        $friendRequestSent = 0;
        $friendRequestid = 0;
        $followid = 0;
        if($FriendsQuery != null){
            if($FriendsQuery->status == 0){
                if($FriendsQuery->user_id == $this->request->getSession()->read('Auth.User.id'))
                    $friendRequestSent = 1;
                else
                    $showAcceptReject = 1;
            }elseif($FriendsQuery->status == 1){
                $showUnfriend = 1;
            }elseif($FriendsQuery->status == 2){
                $showFriend = 1;
            }elseif($FriendsQuery->status == 3){
                $showUnfriend = 1;
            }
            $friendRequestid = $FriendsQuery->id;
        }
        // for follow
        $FollowQuery = $this->Follow->find()->where([
            'user_id' => $this->request->getSession()->read('Auth.User.id'),'followed_user' => $id
        ])->first();
        if($FollowQuery != null){
            if($FollowQuery->status = 1)
                $showUnfollow = 1;
            else
                $showfollow = 1;
            $followid =$FollowQuery->id;
        }
        // end
        $this->set(compact('showUnfriend','showUnfollow','showfollow','showFriend','friendRequestSent','showAcceptReject','FriendsQuery','friendRequestid','followid'));
        $this->set('csrf',$this->request->getParam('_csrfToken'));
        $session = $this->getRequest()->getSession();
            // fetch the artist info
            $entryCount = $this->ArtistInfo->find()->where(['user_id'=>$id])->count();

            $progressBarPercentage = 0;
            if($entryCount > 0)
            {
                $totalcount = 0;
                $dataFilled = 0;
                $infoPercentage = $this->ArtistInfo->find()->where(['user_id'=>$id])->first()->toArray();
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


        $profileData = $this->Medias->find()->where(['user_id'=>$id,'type'=>3,'status'=>1])->first();
        $user_id = $id;
        $RadioTracks = $this->RadioTracks->find()->where(['active'=>'1'])->order(["id DESC"])->first();
        $userDetails = $this->Myprofile->find()->where(['user_id'=>$user_id])->first();
        $profileDetails = $this->Profiles->find()->where(['user_id'=>$user_id])->first();
        $MediaMetasvideo = $this->MediaMetas->find('list',['keyField'=>'id','valueField'=>'title'])->where(['Medias.user_id'=>$user_id,'Medias.type'=>1,'status'=>1,'is_active'=>1])->contain(['Medias']);
        $MediaMetasAudio = $this->MediaMetas->find('list',['keyField'=>'id','valueField'=>'title'])->where(['Medias.user_id'=>$user_id,'Medias.type'=>2,'status'=>1,'is_active'=>1])->contain(['Medias']);
        $this->set('userDetails',$userDetails);
        $this->set('RadioTracks',$RadioTracks);
        $this->set('profileDetails',$profileDetails);
        $this->set('MediaMetasvideo',$MediaMetasvideo);
        $this->set('MediaMetasAudio',$MediaMetasAudio);
        $this->set('profileData',$profileData);
        $this->set('user_id',$user_id);
        $this->set('disableProgressBar',$disableProgressBar);
        $this->set('progressBarPercentage',$progressBarPercentage);
        $this->set('data',$this->requestAction('/notifications/myOthersNotifications/0/'.$user_id));
    }

    public function changemyprofile()
    {
        $this->loadModel("Myprofile");
        $this->loadModel("MediaMetas");
        $savedid = 0;
        $user_id = $this->request->getSession()->read("Auth.User.id");

        $myprofile = $this->Myprofile->newEntity();
        if ($this->request->is('post')) {
            $verifyCount = $this->Myprofile->find()->where(['user_id'=>$user_id]);
            $getId =$verifyCount;
            if($verifyCount->count() > 0)
            {
                $savedid =$getId->first()->id;
            }
            else{
                $data = [];
                $data['user_id'] =$user_id;
                $myprofile = $this->Myprofile->patchEntity($myprofile, $data);
                if ($saveddata = $this->Myprofile->save($myprofile)) {
                    $this->Flash->success(__('The myprofile has been saved.'));
                }else{
                    debug($myprofile->errors());
                }
                $savedid = $saveddata->id;
            }

            $myprofileupdate = $this->Myprofile->get($savedid, [
            'contain' => []
            ]);

            if(!is_dir('files/images/myprofile/'.$this->request->getSession()->read("Auth.User.id").'/')) {
                mkdir('files/images/myprofile/'.$this->request->getSession()->read("Auth.User.id").'/');
            }

            $updateData = $myprofileupdate;
            if($this->request->getData('file-wall') != null){
                $uploadFile = 'files/images/myprofile/'.$this->request->getSession()->read("Auth.User.id").'/'.$this->request->getData('file-wall.name');

                if(move_uploaded_file($this->request->getData('file-wall.tmp_name'),$uploadFile)){
                    $updateData['wall_img_path'] = '/'.$uploadFile;
                }
            }
            if($this->request->getData('file-photo') != null){
                $uploadFile = 'files/images/myprofile/'.$this->request->getSession()->read("Auth.User.id").'/'.$this->request->getData('file-photo.name');

                if(move_uploaded_file($this->request->getData('file-photo.tmp_name'),$uploadFile)){
                    $updateData['photo_path'] = '/'.$uploadFile;
                }
            }

            if($this->request->getData('form-video') != null){
                    $mediaMetasdetails = $this->MediaMetas->get($this->request->getData('form-video'));
                    $updateData['video'] = $mediaMetasdetails->media_link;
            }

            if($this->request->getData('form-audio') != null){
                    $mediaMetasdetails = $this->MediaMetas->get($this->request->getData('form-audio'));
                    $updateData['music'] = $mediaMetasdetails->media_link;
            }



            $myprofileupdate = $this->Myprofile->patchEntity($myprofileupdate,$updateData->toArray());
            if ($this->Myprofile->save($myprofileupdate)) {
                $this->Flash->success(__('The myprofile has been saved.'));
            }

        }

        return $this->redirect(['action' => 'editMyProfile']);

        }

    public function profileUpdate()
    {
        $id=$this->request->getSession()->read('profile_id');
        $profile=$this->Profiles->get($id,[
        'contain' => [
        'Users' => ['Countries','States'],
        'Medias'
        ]
        ]);

        // for setting blank data
        $defaultData = ['performing_right_org' => '','publisher_with_right_org' => '','member_of_a_union' => '','other_union' => '','music_related_organization' => '','genre' => '','record_label' => '','management_contract' => '','booking_agency_contract' => '','artistName' => '','numberOfMembers' => '','city' => '','state' => '','recordLabel' => '','recordingsTitle1' => '','recordingsLabel1' => '','recordingsDate1' => '','recordingsTitle2' => '','recordingsLabel2' => '','recordingsDate2' => '','recordingsTitle3' => '','recordingsLabel3' => '','recordingsDate3' => '','playLive' => '','homeRecordSoftware' => '','homeRecordHardware' => '','purchaseSoftware' => '','purchaseHardware' => '','purchaseInstruments' => '','producer' => '','history' => '','career' => '','group_plan' => '','signature' => '','date' => ''];
        // end
        $session = $this->getRequest()->getSession();
        $session->write('disableProgressBar', 'true');

        //load components
        $this->loadModel('Genres');
        $this->loadModel('ArtistInfo');
        $this->loadModel('Organisations');
        $this->loadModel('Unions');
        $this->loadModel('GroupPlan');
        // end
        $userCheck = $this->ArtistInfo->find()->where(['user_id'=>$this->request->getSession()->read('Auth.User.id')]);
        $countCheck = $userCheck;
        $count = $userCheck->count();
        $userCheckAdditional = $userCheck;
        if($count != 0)
        {
            $defaultData = $userCheckAdditional->first()->toArray();
        }

        if($this->request->getData())
        {
            // checking if entry is der in table
            if($count > 0){
                $data = array();
                  foreach ($this->request->getData() as $key => $value) {
                    if(($key == 'recordingsDate1' || $key == 'recordingsDate2' || $key == 'recordingsDate3' ) && ($value == ''))
                    {
                        $data[$key] = null;
                    }
                    else
                        $data[$key] = $value;
                }
                $this->ArtistInfo->query()->update()
                        ->set($data)
                        ->where(['id' => $userCheck->first()->id])
                        ->execute();
                    $this->Flash->success(__('The artist info updated Successfully.'));

                    return $this->redirect(['action' => 'myaccount']);
            }
            else{
                   $artistInfo = $this->ArtistInfo->newEntity();
                   $artist_data = $this->request->getData();
                   $artist_data['user_id'] = $this->request->getSession()->read('Auth.User.id');
                   $artistInfo = $this->ArtistInfo->patchEntity($artistInfo, $artist_data);
                    if ($this->ArtistInfo->save($artistInfo)) {
                        $this->Flash->success(__('The artist info has been saved.'));
                        return $this->redirect(['action' => 'myaccount']);
                    }
                    else{
                        debug($artistInfo->errors());
                        $this->Flash->error(__('The artist info could not be saved. Please, try again.'));
                    }
            }
        }

        // fetch dropdown options
        $performing_right_org = $this->Organisations->find('list',['keyField'=>'id','valueField'=>'name']);
        $union_member = $this->Organisations->find('list',['keyField'=>'id','valueField'=>'name']);
        $member_of_a_union = $this->Unions->find('list',['keyField'=>'id','valueField'=>'name']);
        $group_plan = $this->GroupPlan->find('list',['keyField'=>'id','valueField'=>'plan']);
        $genres_row = $this->Genres->find('all',array('fields'=>array('id','genre')))->toArray();
        $genre = array();

        foreach ($genres_row as $key => $value) {
            $genre[$value->id] = $value->genre;
        }
        $states = $this->Profiles->Users->States->find('list');
        $countries = $this->Profiles->Users->Countries->find('list');
        // END
        $this->set('profile', $profile);
        $this->set(compact('states','union_member','member_of_a_union','countries','performing_right_org','genre','group_plan','defaultData'));
    }

    public function uploadProfileImage(){
        $newEntity = $this->Medias->newEntity();
        $profileData = $this->Medias->find()->where(['user_id'=>$this->Auth->user('id'),'type'=>3,'status'=>1])->first();

        $dir = new Folder();
        $dir->create(WWW_ROOT . 'files/userData/'.$this->Auth->user('id').'/profileImg/');
        $folder="files/userData/".$this->Auth->user('id')."/profileImg/";
        $name = time()."profileimg.jpg";

        if(move_uploaded_file($this->request->getData('file-profile-image')['tmp_name'], $folder. $name)){

                if($profileData == null){
                    $data['user_id'] = $this->Auth->user('id');
                    $data['type'] = 3;
                    $data['status'] = 1;
                    $data['name'] = $name;
                    $newEntity = $this->Medias->patchEntity($newEntity,$data);
                    if($this->Medias->save($newEntity)){

                    }
                    else{
                        debug($newEntity->errors());
                        exit;
                    }
                    $this->Flash->success(__("Profile image is Updated"));
                }else{
                    $oldData = $profileData;
                    $profileData->name = $name;
                    $patchEntity = $this->Medias->patchEntity($oldData,$profileData->toArray());
                    $this->Medias->save($patchEntity);
                    $this->Flash->success(__("Profile image is Updated"));
                }
            }
        $this->redirect(['action'=>'edit-my-profile']);
    }

}
