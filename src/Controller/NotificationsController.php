<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * Notifications Controller
 *
 * @property \App\Model\Table\NotificationsTable $Notifications
 *
 * @method \App\Model\Entity\Notification[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotificationsController extends AppController
{
    public function findFriends()
    {
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $resultFriends = $this->loadModel('Friends');
         $friend = $resultFriends->find('all')->where(['OR' => [
            ['Friends.user_id' => $currentuserid, ['OR' => [
            ['Friends.status' => 1],
            ['Friends.status' => 3]]]],
            ['Friends.friend_user_id' => $currentuserid, ['OR' => [
            ['Friends.status' => 1],
            ['Friends.status' => 3]]]]
        ]]);
         $this->set('friendreqcount', 0);
        $friendsarray = array();
        foreach ($friend as $row) {
            if($row->user_id == $currentuserid)
            {
                $friendsarray[] = $row->friend_user_id;
            }
            else
            {
                $friendsarray[] = $row->user_id;
            }
        }
        return $friendsarray;
    }

    public function findFollow()
    {
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $resultFollow = $this->loadModel('Follow');
        $follow = $resultFollow->find('all')->where(['user_id'=>$currentuserid,'status'=>1]);
        $followarray = array();
        foreach ($follow as $row) {
            $followarray[] = $row->followed_user;
        }
        return $followarray;
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
   /* public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $notifications = $this->paginate($this->Notifications);

        $this->set(compact('notifications'));
    }*/

    /**
     * View method
     *
     * @param string|null $id Notification id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
   /* public function view($id = null)
    {
        $notification = $this->Notifications->get($id, [
            'contain' => ['Users', 'NotificationLikes']
        ]);

        $this->set('notification', $notification);
    }*/

    public function viewAllNotifications($id = null)
    {
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $friends = $this->findFriends();
        $allfollowers = $this->findFollow();
        $friendsandfollowers = array();
        foreach ($friends as $key => $value) {
            if(in_array($value, $allfollowers))
            {
                $friendsandfollowers[] = $value;
            }
        }
        $friends = $friendsandfollowers;
        $friends[] = $currentuserid;
        if(count($friends) == 0)
        {
            $finalArray = array();
            $this->set(compact('finalArray'));
            echo "No Notifications";
            exit;
        }
        $this->set('csrf',$this->request->getParam('_csrfToken'));
        $this->set("paginated",0);
        if($id != null)
        {
            $this->set("paginated",1);
            $this->layout = 'ajax';
            /*$count = $this->Notifications->find()->where(['user_id in' => $friends])->count();
            $limit = $count - ($id * 1);

            $notifications =$this->Notifications->find('all')->where(['user_id in' => $friends,'Notifications.id <' => $limit])->order(['Notifications.id' => 'DESC'])->contain(['Users'=>['Medias']])->limit(1);*/
            $allnotificationsofuser = $this->Notifications->find('all')->where(['user_id in' => $friends])->order(['Notifications.id' => 'DESC'])->toArray();
            $allnotificationsarray = array();
            foreach ($allnotificationsofuser as $key => $value) {
                $allnotificationsarray[] = $value->id;
            }
            /*debug($allnotificationsarray);
            exit;*/
            if(isset($allnotificationsarray[$id * 2]))
                $limit = $allnotificationsarray[$id * 2];
            else
                $limit = 0;

            $notifications =$this->Notifications->find('all')->where(['user_id in' => $friends,'Notifications.id <=' => $limit])->order(['Notifications.id' => 'DESC'])->contain(['Users'=>['Medias']])->limit(2);
        }
        else
        {
           $notifications =$this->Notifications->find('all')->where(['user_id in' => $friends])->order(['Notifications.id' => 'DESC'])->contain(['Users'=>['Medias']])->limit(2);
        }
        $counterArray = array();
        $finalArray = array();
        $counter1 = 0;
        foreach($notifications as $notification)
        {
            $this->loadModel('NotificationLikes');

            // building the final array

            $createdon = $notification->created;
            $now = Time::parse($createdon);
            $finalArray[$counter1]['user_id'] = $notification->user_id;
            $finalArray[$counter1]['type'] = 'notification';
            $finalArray[$counter1]['name'] = $notification->user->first_name.' '.$notification->user->last_name;
            $finalArray[$counter1]['created'] = $notification->created;
            $finalArray[$counter1]['description'] = $notification->notification;
            $finalArray[$counter1]['media_link'] = '';
            $finalArray[$counter1]['title'] = 'News Feed';
            $finalArray[$counter1]['id'] = $notification->id;
            if(isset($notification->user->medias[0]->name))
                $finalArray[$counter1]['profilepic'] = $notification->user->medias[0]->name;
            else
                $finalArray[$counter1]['profilepic'] = '';
            $this->loadModel('NotificationRatings');
            $query = $this->NotificationRatings->find('all')->where(['notification_id' => $notification->id]);
                $counter =0;
                $ratingcounter =0;
                 $ratingsFound = 0;
                foreach ($query as $key) {
                   $counter++;
                   $ratingcounter = $ratingcounter + (float)$key->rating;
                   if($key->user_id == $currentuserid)
                   {
                     $ratingsFound = 1;
                   }
                }

                if($counter != 0)
                    $avg = $ratingcounter/$counter;
                else
                    $avg =0;
            $finalArray[$counter1]['ratings'] = $avg;
            // end
            $alllikes = $this->NotificationLikes->find('all')->where(['notification_id'=>$notification->id]);
            $alllikescounter = 0;
            foreach($alllikes as $alllike)
            {
                $alllikescounter++;
            }
            $finalArray[$counter1]['count'] = $alllikescounter;
            $finalArray[$counter1]['ratingsFound'] = $ratingsFound;
            $counterArray[$notification->id] =  $alllikescounter;

            // Fetching latest 2 comments
            $this->loadModel("NotificationComments");
            $Comments = $this->NotificationComments->find('all')->where(['notification_id'=>$notification->id])->contain(['Users']);
            $Commentsarray = array();
            $Commentscounter = 0;
            foreach($Comments as $allComments)
            {
                $Commentsarray[$Commentscounter]['comment'] = $allComments->comment;
                $Commentsarray[$Commentscounter]['name'] = $allComments->user->first_name.' '.$allComments->user->last_name ;
                $Commentscounter++;
            }
            $finalArray[$counter1]['comments'] = $Commentsarray;
            $counter1++;
        }
        if(count($finalArray) != 0)
        $this->set('lastnotification',$finalArray[($counter1-1)]['id']);


       $this->loadModel("Medias");
        if($id != null)
        {
            $lastidfetch = $this->Medias->find()->where(['user_id in' => $friends,'OR'=>[['type'=>1],'type'=>2]])->order(['Medias.id'=>'DESC'])->limit(1);
            $lastidfetchrow = $lastidfetch->first();
            //debug($this->Medias->find()->where(['user_id in' => $friends,'OR'=>[['type'=>1],'type'=>2]]));
            //echo '</br>'.$count = $this->Medias->find()->where(['user_id in' => $friends,'type'=>1])->count();
            $allreclimit = $this->Medias->find()->where(['user_id in'=>$friends,'OR'=>[['type'=>1],'type'=>2]])->order(['Medias.id' => 'DESC'])->contain(['Users','MediaMetas'])->toArray();
            $allmediaarray = array();
            foreach ($allreclimit as $key => $value) {
               $allmediaarray[] =$value->id;
            }
            if(isset($allmediaarray[$id * 2]))
                $limit = $allmediaarray[$id * 2];
            else
                $limit = 0;
            $mediaResult = $this->Medias->find('all')->where(['user_id in'=>$friends,'OR'=>[['type'=>1],'type'=>2],'Medias.id <=' => $limit,'status'=>1,])->order(['Medias.id' => 'DESC'])->contain(['Users','MediaMetas'])->limit(2);
        }
        else
        {
            $mediaResult = $this->Medias->find('all')->where(['user_id in'=>$friends,'status'=>1,])->order(['Medias.id' => 'DESC'])->contain(['Users','MediaMetas'])->limit(2);
        }
        foreach ($mediaResult as $mediaResults) {

            if($mediaResults->type == 1 || $mediaResults->type == 2)
            {
            $this->loadModel("Users");
            $profileresult = $this->Users->find('all')->contain(['Medias'])->where(['id '=>$mediaResults->user_id]);
            $finalArray[$counter1]['profilepic'] = '';
            foreach ($profileresult as $profileresults) {
                if($profileresults->medias[0]['type']==3)
               $finalArray[$counter1]['profilepic'] = $profileresults->medias[0]['name'];
            }

            $createdon = $mediaResults->created;
            $now = Time::parse($createdon);
            $finalArray[$counter1]['user_id'] = $mediaResults->user_id;
            $finalArray[$counter1]['type'] = 0;
            $finalArray[$counter1]['name'] = $mediaResults->user->first_name.' '.$mediaResults->user->last_name;
            $finalArray[$counter1]['created'] = $mediaResults->created;
            $finalArray[$counter1]['description'] = $mediaResults->media_metas[0]->description;
            $finalArray[$counter1]['media_link'] = $mediaResults->media_metas[0]->media_link;
            $finalArray[$counter1]['title'] = $mediaResults->media_metas[0]->title;
            $finalArray[$counter1]['id'] = $mediaResults->id;
            $this->loadModel('MediaMetas');

            $getmediametas = $this->MediaMetas->find('all')->where(['media_id'=>$mediaResults->id]);

            foreach ($getmediametas as $getmediametass) {
                $ratingcounter = $getmediametass->ratings;
                break;
            }
            $finalArray[$counter1]['ratings'] = $ratingcounter;

            $this->loadModel("Likes");
            $alllikes = $this->Likes->find('all')->where(['media_id'=>$mediaResults->id]);
            $alllikescounter = 0;
            foreach($alllikes as $alllike)
            {
                $alllikescounter++;
            }

            // Fetching latest 2 comments
            $this->loadModel("MediaComments");
            $Comments = $this->MediaComments->find('all')->where(['media_id'=>$mediaResults->id])->contain(['Users']);
            $Commentsarray = array();
            $Commentscounter = 0;
            foreach($Comments as $allComments)
            {
                $Commentsarray[$Commentscounter]['comment'] = $allComments->comment;
                $Commentsarray[$Commentscounter]['name'] = $allComments->user->first_name.' '.$allComments->user->last_name ;
                $Commentscounter++;
            }
            $this->loadModel("Ratings");
            $RatingsCount = $this->Ratings->find('all')->where(['media_id' => $mediaResults->id,'user_id' => $currentuserid])->count();
            $finalArray[$counter1]['count'] = $alllikescounter;
            $finalArray[$counter1]['ratingsFound'] = $RatingsCount;
            $finalArray[$counter1]['comments'] = $Commentsarray;

            $counter1++;
        }
    }
        if(count($finalArray) != 0)
        $this->set('lastmedia',$finalArray[($counter1-1)]['id']);
        // sorting the array according to time it was published
        $sortedArray = array();
        $counter = 0;
        for($j=0;$j<count($finalArray);$j++)
        {
            $createdon = $finalArray[$j]['created'];
            $now = Time::parse($createdon);
            $currenttime = strtotime($now->i18nFormat('yyyy-MM-dd HH:mm:ss'));
            for($i=$j; $i<count($finalArray);$i++)
            {
                $now2 = Time::parse($finalArray[$i]['created']);
                $currenttime2 = strtotime($now2->i18nFormat('yyyy-MM-dd HH:mm:ss'));
                if($currenttime2 > $currenttime)
                {
                    $sortedArray = $finalArray[$counter];
                    $finalArray[$counter] = $finalArray[$i];
                    $finalArray[$i] = $sortedArray;
                    $currenttime = $currenttime2;
                }
            }
            $counter++;
        }
        if(count($finalArray) == 0)
        {
            if($id != null)
            {
                echo 'Sorry, No more Notifications';
                exit;
            }
        }
        $this->set(compact('finalArray'));
        $this->set('mynotifications',0);
    }


    public function mynotifications($id = null)
    {

        $this->set('csrf',$this->request->getParam('_csrfToken'));

        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];
        $friends[] = $currentuserid;
        $this->set("paginated",0);
        if($id != null)
        {
            $this->set("paginated",1);
            $this->layout = 'ajax';
            $allnotificationsofuser = $this->Notifications->find('all')->where(['user_id in' => $friends])->order(['Notifications.id' => 'DESC'])->toArray();
            $allnotifications = array();
            foreach ($allnotificationsofuser as $key => $value) {
                $allnotifications[] = $value->id;
            }
            if(isset($allnotifications[$id * 2]))
                $limit = $allnotifications[$id * 2];
            else
                $limit = 0;

            $notifications =$this->Notifications->find('all')->where(['user_id in' => $friends,'Notifications.id <=' => $limit])->order(['Notifications.id' => 'DESC'])->contain(['Users'=>['Medias']])->limit(2);

        }
        else
        {
           $notifications =$this->Notifications->find('all')->where(['user_id in' => $friends])->order(['Notifications.id' => 'DESC'])->contain(['Users'=>['Medias']])->limit(2);
        }
        $counterArray = array();
        $finalArray = array();
        $counter1 = 0;
        foreach($notifications as $notification)
        {
            $this->loadModel('NotificationLikes');

            // building the final array

            $createdon = $notification->created;
            $now = Time::parse($createdon);
            $finalArray[$counter1]['user_id'] = $notification->user_id;
            $finalArray[$counter1]['type'] = 'notification';
            $finalArray[$counter1]['name'] = $notification->user->first_name.' '.$notification->user->last_name;
            $finalArray[$counter1]['created'] = $notification->created;
            $finalArray[$counter1]['description'] = $notification->notification;
            $finalArray[$counter1]['media_link'] = '';
            $finalArray[$counter1]['title'] = 'News Feed';
            $finalArray[$counter1]['id'] = $notification->id;
            $finalArray[$counter1]['profilepic'] = $notification->user->medias[0]->name;
            $this->loadModel('NotificationRatings');
            $query = $this->NotificationRatings->find('all')->where(['notification_id' => $notification->id]);
                $counter =0;
                $ratingcounter =0;
                $ratingsFound = 0;
                foreach ($query as $key) {
                   $counter++;
                   $ratingcounter = $ratingcounter + (float)$key->rating;
                   if($key->user_id == $currentuserid)
                   {
                     $ratingsFound = 1;
                   }
                }
                if($counter != 0)
                    $avg = $ratingcounter/$counter;
                else
                    $avg =0;
            $finalArray[$counter1]['ratings'] = $avg;
            // end
            $this->loadModel('NotificationLikes');
            $alllikes = $this->NotificationLikes->find('all')->where(['notification_id'=>$notification->id]);
            $alllikescounter = 0;
            foreach($alllikes as $alllike)
            {
                $alllikescounter++;
            }

            $finalArray[$counter1]['count'] = $alllikescounter;
            $finalArray[$counter1]['ratingsFound'] = $ratingsFound;
            $counterArray[$notification->id] =  $alllikescounter;
                        // Fetching latest 2 comments
            $this->loadModel("NotificationComments");
            $Comments = $this->NotificationComments->find('all')->where(['notification_id'=>$notification->id])->contain(['Users']);
            $Commentsarray = array();
            $Commentscounter = 0;
            foreach($Comments as $allComments)
            {
                $Commentsarray[$Commentscounter]['comment'] = $allComments->comment;
                $Commentsarray[$Commentscounter]['name'] = $allComments->user->first_name.' '.$allComments->user->last_name ;
                $Commentscounter++;
            }
            $finalArray[$counter1]['comments'] = $Commentsarray;
            $counter1++;
        }
        if(count($finalArray) != 0)
        $this->set('lastnotification',$finalArray[($counter1-1)]['id']);


       $this->loadModel("Medias");
        if($id != null)
        {
            /*$count = $this->Medias->find()->where(['user_id in' => $friends,'type'=>1])->count();
            $limit = $count - ($id * 1);
            $mediaResult = $this->Medias->find('all')->where(['user_id in'=>$friends,'status'=>1,'Medias.id <' => $limit])->order(['Medias.id' => 'DESC'])->contain(['Users','MediaMetas'])->limit(1);*/
            $lastidfetch = $this->Medias->find()->where(['user_id in' => $friends,'OR'=>[['type'=>1],'type'=>2]])->order(['Medias.id'=>'DESC'])->limit(1);
            $lastidfetchrow = $lastidfetch->first();
            //debug($this->Medias->find()->where(['user_id in' => $friends,'OR'=>[['type'=>1],'type'=>2]]));
            //echo '</br>'.$count = $this->Medias->find()->where(['user_id in' => $friends,'type'=>1])->count();
            $allreclimit = $this->Medias->find()->where(['user_id in'=>$friends,'OR'=>[['type'=>1],'type'=>2]])->order(['Medias.id' => 'DESC'])->contain(['Users','MediaMetas'])->toArray();
            $allmediaarray = array();
            foreach ($allreclimit as $key => $value) {
               $allmediaarray[] =$value->id;
            }
            if(isset($allmediaarray[$id * 2]))
                $limit = $allmediaarray[$id * 2];
            else
                $limit = 0;
            $mediaResult = $this->Medias->find('all')->where(['user_id in'=>$friends,'OR'=>[['type'=>1],'type'=>2],'Medias.id <=' => $limit,'status'=>1,])->order(['Medias.id' => 'DESC'])->contain(['Users','MediaMetas'])->limit(2);
        }
        else
        {
            $mediaResult = $this->Medias->find('all')->where(['user_id in'=>$friends,'status'=>1,])->order(['Medias.id' => 'DESC'])->contain(['Users','MediaMetas'])->limit(2);
        }
        foreach ($mediaResult as $mediaResults) {

            if($mediaResults->type == 1 || $mediaResults->type == 2)
            {
            $this->loadModel("Users");
            $profileresult = $this->Users->find('all')->contain(['Medias'])->where(['id '=>$mediaResults->user_id]);
            $finalArray[$counter1]['profilepic'] = '';
            foreach ($profileresult as $profileresults) {
                if($profileresults->medias[0]['type']==3)
               $finalArray[$counter1]['profilepic'] = $profileresults->medias[0]['name'];
            }

            $createdon = $mediaResults->created;
            $now = Time::parse($createdon);
            $finalArray[$counter1]['user_id'] = $mediaResults->user_id;
            $finalArray[$counter1]['type'] = 0;
            $finalArray[$counter1]['name'] = $mediaResults->user->first_name.' '.$mediaResults->user->last_name;
            $finalArray[$counter1]['created'] = $mediaResults->created;
            $finalArray[$counter1]['description'] = $mediaResults->media_metas[0]->description;
            $finalArray[$counter1]['media_link'] = $mediaResults->media_metas[0]->media_link;
            $finalArray[$counter1]['title'] = $mediaResults->media_metas[0]->title;
            $finalArray[$counter1]['id'] = $mediaResults->id;
            $this->loadModel('MediaMetas');

            $getmediametas = $this->MediaMetas->find('all')->where(['media_id'=>$mediaResults->id]);

            foreach ($getmediametas as $getmediametass) {
                $finalArray[$counter1]['mediameta_id'] = $getmediametass->id;
                $ratingcounter = $getmediametass->ratings;
                break;
            }
            $finalArray[$counter1]['ratings'] = $ratingcounter;
            $this->loadModel("Likes");
            $alllikes = $this->Likes->find('all')->where(['media_id'=>$mediaResults->id]);
            $alllikescounter = 0;
            foreach($alllikes as $alllike)
            {
                $alllikescounter++;
            }

            $this->loadModel("MediaComments");
            $Comments = $this->MediaComments->find('all')->where(['media_id'=>$mediaResults->id])->contain(['Users']);
            $Commentsarray = array();
            $Commentscounter = 0;
            foreach($Comments as $allComments)
            {
                $Commentsarray[$Commentscounter]['comment'] = $allComments->comment;
                $Commentsarray[$Commentscounter]['name'] = $allComments->user->first_name.' '.$allComments->user->last_name ;
                $Commentscounter++;
            }

             $this->loadModel("Ratings");
             $RatingsCount = $this->Ratings->find('all')->where(['media_id' => $mediaResults->id,'user_id' => $currentuserid])->count();

            $finalArray[$counter1]['count'] = $alllikescounter;
            $finalArray[$counter1]['ratingsFound'] = $RatingsCount;
            $finalArray[$counter1]['comments'] = $Commentsarray;

            $counter1++;
        }
    }
        if(count($finalArray) != 0)
        $this->set('lastmedia',$finalArray[($counter1-1)]['id']);
        // sorting the array according to time it was published
        $sortedArray = array();
        $counter = 0;
        for($j=0;$j<count($finalArray);$j++)
        {
            $createdon = $finalArray[$j]['created'];
            $now = Time::parse($createdon);
            $currenttime = strtotime($now->i18nFormat('yyyy-MM-dd HH:mm:ss'));
            for($i=$j; $i<count($finalArray);$i++)
            {
                $now2 = Time::parse($finalArray[$i]['created']);
                $currenttime2 = strtotime($now2->i18nFormat('yyyy-MM-dd HH:mm:ss'));
                if($currenttime2 > $currenttime)
                {
                    $sortedArray = $finalArray[$counter];
                    $finalArray[$counter] = $finalArray[$i];
                    $finalArray[$i] = $sortedArray;
                    $currenttime = $currenttime2;
                }
            }
            $counter++;
        }
        if(count($finalArray) == 0)
        {
            if($id != null)
            {
                echo 'Sorry, No more Notifications';
                exit;
            }
        }

        $this->set(compact('finalArray'));
        $this->set('mynotifications',1);
        $this->set('user_id',$currentuserid);
        $this -> render('/Notifications/view_my_notifications');

    }

    public function myOthersNotifications($id = null,$userid = null)
    {

        $this->set('csrf',$this->request->getParam('_csrfToken'));
        $currentuserid = $userid;
        $friends[] = $currentuserid;
        $this->set("paginated",0);
        if($id != null && $id != 0)
        {
            $this->set("paginated",1);
            $this->layout = 'ajax';
            $allnotificationsofuser = $this->Notifications->find('all')->where(['user_id in' => $friends])->order(['Notifications.id' => 'DESC'])->toArray();
            $allnotifications = array();
            foreach ($allnotificationsofuser as $key => $value) {
                $allnotifications[] = $value->id;
            }
            if(isset($allnotifications[$id * 2]))
                $limit = $allnotifications[$id * 2];
            else
                $limit = 0;

            $notifications =$this->Notifications->find('all')->where(['user_id in' => $friends,'Notifications.id <=' => $limit])->order(['Notifications.id' => 'DESC'])->contain(['Users'=>['Medias']])->limit(2);

        }
        else
        {
           $notifications =$this->Notifications->find('all')->where(['user_id in' => $friends])->order(['Notifications.id' => 'DESC'])->contain(['Users'=>['Medias']])->limit(2);
        }
        $counterArray = array();
        $finalArray = array();
        $counter1 = 0;
        foreach($notifications as $notification)
        {
            // building the final array

            $createdon = $notification->created;
            $now = Time::parse($createdon);
            $finalArray[$counter1]['user_id'] = $notification->user_id;
            $finalArray[$counter1]['type'] = 'notification';
            $finalArray[$counter1]['name'] = $notification->user->first_name.' '.$notification->user->last_name;
            $finalArray[$counter1]['created'] = $notification->created;
            $finalArray[$counter1]['description'] = $notification->notification;
            $finalArray[$counter1]['media_link'] = '';
            $finalArray[$counter1]['title'] = 'News Feed';
            $finalArray[$counter1]['id'] = $notification->id;
            $finalArray[$counter1]['profilepic'] = $notification->user->medias[0]->name;
            $this->loadModel('NotificationRatings');
            $query = $this->NotificationRatings->find('all')->where(['notification_id' => $notification->id]);
                $counter =0;
                $ratingcounter =0;
                $ratingsFound = 0;
                foreach ($query as $key) {
                   $counter++;
                   $ratingcounter = $ratingcounter + (float)$key->rating;
                   if($key->user_id == $currentuserid)
                   {
                     $ratingsFound = 1;
                   }
                }
                if($counter != 0)
                    $avg = $ratingcounter/$counter;
                else
                    $avg =0;
            $finalArray[$counter1]['ratings'] = $avg;
            // end
            $this->loadModel('NotificationLikes');
            $alllikes = $this->NotificationLikes->find('all')->where(['notification_id'=>$notification->id]);
            $alllikescounter = 0;
            foreach($alllikes as $alllike)
            {
                $alllikescounter++;
            }

            $finalArray[$counter1]['count'] = $alllikescounter;
            $finalArray[$counter1]['ratingsFound'] = $ratingsFound;
            $counterArray[$notification->id] =  $alllikescounter;
                        // Fetching latest 2 comments
            $this->loadModel("NotificationComments");
            $Comments = $this->NotificationComments->find('all')->where(['notification_id'=>$notification->id])->contain(['Users']);
            $Commentsarray = array();
            $Commentscounter = 0;
            foreach($Comments as $allComments)
            {
                $Commentsarray[$Commentscounter]['comment'] = $allComments->comment;
                $Commentsarray[$Commentscounter]['name'] = $allComments->user->first_name.' '.$allComments->user->last_name ;
                $Commentscounter++;
            }
            $finalArray[$counter1]['comments'] = $Commentsarray;
            $counter1++;
        }
        if(count($finalArray) != 0)
        $this->set('lastnotification',$finalArray[($counter1-1)]['id']);


       $this->loadModel("Medias");
        if($id != null)
        {
            $lastidfetch = $this->Medias->find()->where(['user_id in' => $friends,'OR'=>[['type'=>1],'type'=>2]])->order(['Medias.id'=>'DESC'])->limit(1);
            $lastidfetchrow = $lastidfetch->first();
            $allreclimit = $this->Medias->find()->where(['user_id in'=>$friends,'OR'=>[['type'=>1],'type'=>2]])->order(['Medias.id' => 'DESC'])->contain(['Users','MediaMetas'])->toArray();
            $allmediaarray = array();
            foreach ($allreclimit as $key => $value) {
               $allmediaarray[] =$value->id;
            }
            if(isset($allmediaarray[$id * 2]))
                $limit = $allmediaarray[$id * 2];
            else
                $limit = 0;
            $mediaResult = $this->Medias->find('all')->where(['user_id in'=>$friends,'OR'=>[['type'=>1],'type'=>2],'Medias.id <=' => $limit,'status'=>1,])->order(['Medias.id' => 'DESC'])->contain(['Users','MediaMetas'])->limit(2);
        }
        else
        {
            $mediaResult = $this->Medias->find('all')->where(['user_id in'=>$friends,'status'=>1,])->order(['Medias.id' => 'DESC'])->contain(['Users','MediaMetas'])->limit(2);
        }
        foreach ($mediaResult as $mediaResults) {

            if($mediaResults->type == 1 || $mediaResults->type == 2)
            {
            $this->loadModel("Users");
            $profileresult = $this->Users->find('all')->contain(['Medias'])->where(['id '=>$mediaResults->user_id]);
            $finalArray[$counter1]['profilepic'] = '';
            foreach ($profileresult as $profileresults) {
                if($profileresults->medias[0]['type']==3)
               $finalArray[$counter1]['profilepic'] = $profileresults->medias[0]['name'];
            }

            $createdon = $mediaResults->created;
            $now = Time::parse($createdon);
            $finalArray[$counter1]['user_id'] = $mediaResults->user_id;
            $finalArray[$counter1]['type'] = 0;
            $finalArray[$counter1]['name'] = $mediaResults->user->first_name.' '.$mediaResults->user->last_name;
            $finalArray[$counter1]['created'] = $mediaResults->created;
            $finalArray[$counter1]['description'] = $mediaResults->media_metas[0]->description;
            $finalArray[$counter1]['media_link'] = $mediaResults->media_metas[0]->media_link;
            $finalArray[$counter1]['title'] = $mediaResults->media_metas[0]->title;
            $finalArray[$counter1]['id'] = $mediaResults->id;
            $this->loadModel('MediaMetas');

            $getmediametas = $this->MediaMetas->find('all')->where(['media_id'=>$mediaResults->id]);

            foreach ($getmediametas as $getmediametass) {
                $finalArray[$counter1]['mediameta_id'] = $getmediametass->id;
                $ratingcounter = $getmediametass->ratings;
                break;
            }
            $finalArray[$counter1]['ratings'] = $ratingcounter;
            $this->loadModel("Likes");
            $alllikes = $this->Likes->find('all')->where(['media_id'=>$mediaResults->id]);
            $alllikescounter = 0;
            foreach($alllikes as $alllike)
            {
                $alllikescounter++;
            }

            $this->loadModel("MediaComments");
            $Comments = $this->MediaComments->find('all')->where(['media_id'=>$mediaResults->id])->contain(['Users']);
            $Commentsarray = array();
            $Commentscounter = 0;
            foreach($Comments as $allComments)
            {
                $Commentsarray[$Commentscounter]['comment'] = $allComments->comment;
                $Commentsarray[$Commentscounter]['name'] = $allComments->user->first_name.' '.$allComments->user->last_name ;
                $Commentscounter++;
            }

             $this->loadModel("Ratings");
             $RatingsCount = $this->Ratings->find('all')->where(['media_id' => $mediaResults->id,'user_id' => $currentuserid])->count();

            $finalArray[$counter1]['count'] = $alllikescounter;
            $finalArray[$counter1]['ratingsFound'] = $RatingsCount;
            $finalArray[$counter1]['comments'] = $Commentsarray;

            $counter1++;
        }
    }
        if(count($finalArray) != 0)
        $this->set('lastmedia',$finalArray[($counter1-1)]['id']);
        // sorting the array according to time it was published
        $sortedArray = array();
        $counter = 0;
        for($j=0;$j<count($finalArray);$j++)
        {
            $createdon = $finalArray[$j]['created'];
            $now = Time::parse($createdon);
            $currenttime = strtotime($now->i18nFormat('yyyy-MM-dd HH:mm:ss'));
            for($i=$j; $i<count($finalArray);$i++)
            {
                $now2 = Time::parse($finalArray[$i]['created']);
                $currenttime2 = strtotime($now2->i18nFormat('yyyy-MM-dd HH:mm:ss'));
                if($currenttime2 > $currenttime)
                {
                    $sortedArray = $finalArray[$counter];
                    $finalArray[$counter] = $finalArray[$i];
                    $finalArray[$i] = $sortedArray;
                    $currenttime = $currenttime2;
                }
            }
            $counter++;
        }
        if(count($finalArray) == 0)
        {
            if($id != null)
            {
                echo 'Sorry, No more Notifications';
                exit;
            }
        }

        $this->set(compact('finalArray'));

        $this->set('user_id',$currentuserid);
        if($currentuserid == $this->Auth->User('id'))
            $this->set('mynotifications',1);
        else
            $this->set('mynotifications',0);
        $this -> render('/Notifications/view_my_notifications');

    }



    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //debug($_POST);exit();
        $notification = $this->Notifications->newEntity();
        if ($this->request->is('post')) {

            $auth = $this->request->getSession()->read('Auth');
            $data['user_id'] = $auth['User']['id'];
            $data['notification'] =  $this->request->getData()['notification'];
            $notification = $this->Notifications->patchEntity($notification, $data);
            if ($this->Notifications->save($notification)) {
                // $this->Flash->set("Post added",
                //         [
                //             'element' => 'success_message'
                //         ]);
                return $this->redirect($this->referer());
            }
            $this->Flash->set("The notification could not be saved. Please, try again.",
                 [
                    'element' => 'error_message'
                 ]);
            return $this->redirect($this->referer());
        }
        $users = $this->Notifications->Users->find('list', ['limit' => 200]);
        $this->set(compact('notification', 'users'));
        $this->view = '/Element/hometopfiles/nfadd';
    }

    /**
     * Edit method
     *
     * @param string|null $id Notification id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
   /* public function edit($id = null)
    {
        $notification = $this->Notifications->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->getData());
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notification could not be saved. Please, try again.'));
        }
        $users = $this->Notifications->Users->find('list', ['limit' => 200]);
        $this->set(compact('notification', 'users'));
    }*/

    /**
     * Delete method
     *
     * @param string|null $id Notification id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {   $this->set('csrf',$this->request->getParam('_csrfToken'));
        $this->request->allowMethod(['post', 'delete']);
        $notification = $this->Notifications->get($id);
        if ($this->Notifications->delete($notification)) {
            $this->Flash->success(__('The notification has been deleted.'));
        } else {
            $this->Flash->error(__('The notification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'mynotifications']);
    }
}
