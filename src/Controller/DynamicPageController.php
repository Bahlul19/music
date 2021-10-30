<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

/**
 * Profiles Controller
 *
 * @property \App\Model\Table\ProfilesTable $Profiles
 *
 * @method \App\Model\Entity\Profile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DynamicPageController extends AppController
{

    public function displaypage($slug)
    {
        $this->loadModel('RadioTracks');
        $RadioTracks = $this->RadioTracks->find()->where(['active'=>'1'])->order(["id DESC"])->first();
        $pagefound = false;
        $this->set("pageTitle",'');
        $this->set("pageContent",'');
        $result = $this->loadModel('Posts');
        $data = $result->find()->where(['slug' => $slug,'status' => 1,'content_type' => 0]);
        foreach( $data as $row)
        {
           $pagefound = true;
           $this->set("pageTitle",$row->title);
           $this->set("pageContent",$row->content);
        }

        // For page not found
        if($pagefound == false)
        {
            $content = '<center><h1>Page Not Found</h1></center>';
            $this->set("pageContent",$content);
        }
        $this->set('RadioTracks',$RadioTracks);
    }

    public function closeProgressBarSetSession(){
        $this->layout = 'ajax';
        $session = $this->getRequest()->getSession();
        $session->write('disableProgressBar', 'true');
        $this->render(false);
    }

    public function searchFriends($name)
    {
        $this->layout = 'ajax';
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
        if(count($friendsarray) != 0)
        {
             $result = $this->loadModel('Users');
             $data = $result->find('all')->where(
                ['Users.id IN' => $friendsarray,['OR' => [
            ['Users.first_name LIKE' => '%'.$name.'%'],
            ['Users.last_name LIKE' => '%'.$name.'%']]]]
             )->contain(['Profiles','Medias']);
             $this->set('friendreqcount',count($friendsarray));
             $this->set('friend', $data);

        }
        $this -> render('/Friends/searchFriends');
    }

    public function searchArtists($name = null)
    {

        $this->layout = 'ajax';
        $this->loadModel('Medias');
        $userImgArray = array();
        $val = $this->request->getSession()->read('Auth');
        $currentuserid = $val['User']['id'];

            $result = $this->loadModel('Users');
            $data = $result->find('all')->where(
                    ['Users.id NOT IN' => $currentuserid,['OR' => [
                ['Users.first_name LIKE' => '%'.$name.'%'],
                ['Users.last_name LIKE' => '%'.$name.'%'],
                ['Users.city LIKE' => '%'.$name.'%']
            ]]]
                 )->contain(['Profiles','Medias']);
            $userDataArray = array();
            foreach ($data as $usersData) {
                $userDataArray[] = $usersData->id;
            }
            $userImg = $this->Medias->find()->where(['user_id IN '=>$userDataArray,'type'=>'3']);

            foreach ($userImg as $key => $value) {
                $userImgArray[$value->user_id] =  $value->name;
            }
            $userDataArray[] = $currentuserid;
            // skills
            $this->loadModel('Skills');
            $Intresult = $this->Skills->find('all')->where(['skill LIKE '=> '%'.$name.'%']);

            $interestArray = array();
            $data1 = array();
            foreach ($Intresult as $key) {
                $data1 = $result->find('all')->where(
                    ['Users.id NOT IN' => $userDataArray,'Profiles.skill LIKE' => '%"'.$key->id.'"%']
                 )->contain(['Profiles','Medias']);
                foreach ($data1 as $data1key) {
                     $userDataArray[] = $data1key->id;
                }
            }

        $this->set('friend', $data);
        $this->set('userImgArray', $userImgArray);
        $this->set('friendwithskill', $data1);
        $this -> render('/Friends/searchArtists');
    }



    public function searchArtistsFilter($name = null,$artist = null){
    $this->layout = 'ajax';
    $val = $this->request->getSession()->read('Auth');
    $currentuserid = $val['User']['id'];
    $displayArray = array();
       if($artist == 'Songs' || $artist == 'Videos') // Search By Songs and Video
        {
            if($artist == 'Videos')
            {
                $mediatype = 1;
            }
            else
            {
                 $mediatype = 2;
            }
            $this->loadModel('MediaMetas');
            $data = $this->MediaMetas->find('all')->contain(['Medias'=>['Users']])->where(
                    ['Users.id NOT IN' => $currentuserid,
                'Medias.type' => $mediatype,'MediaMetas.title LIKE '=>'%'.$name.'%']
                 );
            // fetching users with media types 1 and 2 with the title
            foreach($data as $row)
            {
                $displayArray[] = $this->fetchUserDetails($row->media->user->id);
            }
            // end
        }
        elseif($artist == 'State' || $artist == 'Country') // Seach By State and Country
        {
            if($artist == 'State')
            {
              $table = 'States';
            }
            else
            {
                $table = 'Countries';
            }
            $this->loadModel('Users');
            $data = $this->Users->find('all')->contain([$table])->where(
                    ['Users.id NOT IN' => $currentuserid,
                $table.'.name LIKE '=>'%'.$name.'%']
                 );
            // fetching users with state title
            foreach($data as $row)
            {
                $displayArray[] = $this->fetchUserDetails($row->id);
            }
            // end
        }
        else // Seach By State and Country
        {
            $this->loadModel('Users');
            $data = $this->Users->find('all')->where(
                    ['Users.id NOT IN' => $currentuserid,
                'created LIKE '=>'%'.$name.'%']
                 );
            // fetching users with Created date/time
            foreach($data as $row)
            {
                $displayArray[] = $this->fetchUserDetails($row->id);
            }
            // end
        }
        $this->set('list', $displayArray);
        $this -> render('/Friends/searchArtistsFilter');
    }

    private function fetchUserDetails($user)
    {
        $this->loadModel("Users");
        $result = $this->Users->find('all')->where(['Users.id'=>$user])->contain(['Profiles','Medias']);
        foreach ($result as $row) {
            $dataArray['id'] = $row->id;
            $dataArray['name'] = $row->first_name.' '.$row->last_name;

            if(isset($row->medias[0]->name))
                $dataArray['image'] = $row->medias[0]->name;
            else
                $dataArray['image'] = '';

            $dataArray['mobile'] = $row->mobie_phone;
            $dataArray['address'] = $row->address;
            $dataArray['email'] = $row->email;
            $dataArray['profileid'] = $row->profile->id;;

        }

        return $dataArray;

    }

}
