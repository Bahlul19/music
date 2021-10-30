<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('default_new');

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');

        $this->loadComponent('Auth',[

            'authenticate' => [
                'Form' => [
                'fields' => [
                'username' => 'email',
                'password' => 'password'
                ]
            ]
        ],
            'loginAction' => [
                'controller' => 'users',
                'action' => 'login'
            ],

            'storage' => 'Session'
        ]);

        $this->Auth->allow('main', 'login');
    }

    /*
    Allow access without login
    */

    public function beforeRender(Event $event)
    {
        $this->set('auth',$this->request->getSession()->read('Auth')) ;
    }

    public function beforeFilter(Event $event)
    {

        $this->Auth->allow(['forgotPassword','resetPassword','signup','displaypage', 'page', 'stateDropdown','contact', 'postdetails','chat', 'setPassword','mainpage']);

        $this->loadComponent('Auth');
        if($this->Auth->user())
        {
            $user = $this->Auth->user();

            $this->loadModel('Profiles');
            $getProfile = $this->Profiles->find('all')
            ->where(['Profiles.user_id' => $this->Auth->user('id')])->toArray();
            $profile_id = $getProfile[0]->id;
            $this->request->getSession()->write('profile_id',$profile_id);

            $this->loadModel('UserRoles');
            $getrole = $this->UserRoles->find('all')
            ->where(['UserRoles.user_id' => $this->Auth->user('id')])
            ->contain(['Roles'])->toArray();
            $role = $getrole[0]->role['name'];
            $this->request->getSession()->write('role',$role);

            $this->loadModel('Medias');
            $query = $this->Medias->find('all')->where(['Medias.user_id' => $this->Auth->user('id')])->where(['Medias.type' => '3'])->toArray();
            if($query != null){
                $profile_img = $query[0]->name;
                $this->request->getSession()->write('profile_img',$profile_img);
            }
            else{
                $this->request->getSession()->write('profile_img','');
            }

            $this->set('user', $user);
            $this->set('loggedIn', true);
        }
        else{
            $this->set('loggedIn',false);
        }
    }


}
