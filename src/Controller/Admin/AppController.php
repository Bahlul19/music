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
namespace App\Controller\Admin;

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

        $this->loadComponent('RequestHandler',[ 'enableBeforeRedirect' => false ]);
        $this->loadComponent('Flash');

        $this->loadComponent('Auth',[

            //'authorize' => ['Controller'],

            'loginAction' => '/login',
            'loginRedirect' => '/',
            'logoutRedirect' => '/login',

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
    }


    /**
     * BeforeRender hook method.
     *
     * Use this method to add load entities before any views are rendered.
     *
     * @param event $event object of class Event
     *
     * @return void
     */
    public function beforeRender(Event $event)
    {
        $this->viewBuilder()->setTheme('AdminLTE');
        $this->viewBuilder()->setClassName('AdminLTE.AdminLTE');
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['setPassword']);
        $this->loadComponent('Auth');

        if($this->Auth->user())
        {
            $user = $this->Auth->user();

            $uid = $this->Auth->user('id');

            $this->loadModel('UserRoles');

            $query = $this->UserRoles->find('all')
            ->where(['UserRoles.user_id' => $uid])
            ->contain(['Roles'])->toArray();

            $role = $query[0]->role['name'];

            $this->request->getSession()->write('role',$role);

            $this->loadModel('Medias');

            $query = $this->Medias->find('all')
            ->where(['Medias.user_id' => $uid])
            ->where(['Medias.type' => '3'])
            ->toArray();

            $profile_img = $query[0]->name;
            
            $this->request->getSession()->write('profile_img',$profile_img);
            
            $this->set('user', $user);
            $this->set('loggedIn', true);
        }
        else       
        {
            $this->set('loggedIn',false);
        
        }   
       

    }


}
