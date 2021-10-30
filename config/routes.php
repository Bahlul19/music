<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));

    $routes->applyMiddleware('csrf');

    $routes->connect('/', ['controller' => 'Users', 'action' => 'main']);

    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    $routes->connect('/news/*', ['controller' => 'Posts', 'action' => 'page']);
    $routes->connect('/ith-news/*', ['controller' => 'Posts', 'action' => 'postdetails']);

    $routes->connect('/search', ['controller' => 'Friends', 'action' => 'viewartist']);
    $routes->connect('/my-timeline', ['controller' => 'Users', 'action' => 'mynotificationsmain']);
    $routes->connect('/news/*', ['controller' => 'News', 'action' => 'blog']);
    $routes->connect('/my-account', ['controller' => 'Profiles', 'action' => 'myaccount']);
    $routes->connect('/friends', ['controller' => 'Friends', 'action' => 'viewfriends']);
    $routes->connect('/friends', ['controller' => 'Friends', 'action' => 'viewfriends']);
    $routes->connect('/requests', ['controller' => 'Friends', 'action' => 'viewfriendrequest']);
    $routes->connect('/change-password', ['controller' => 'Users', 'action' => 'changepassword']);
    $routes->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);
    $routes->connect('/support', ['controller' => 'Feedbacks', 'action' => 'contact']);
    $routes->connect('/signup', ['controller' => 'Users', 'action' => 'signup']);
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
    $routes->connect('/featured-media', ['controller' => 'Medias', 'action' => 'mediaList']);
    $routes->connect('/polls', ['controller' => 'Questions', 'action' => 'pollSystem']);
    $routes->connect('/subscribe', ['controller' => 'Users', 'action' => 'subscribe']);

    $routes->fallbacks(DashedRoute::class);
});


Router::prefix('admin', function ($routes) {
    // All routes here will be prefixed with `/admin`
    // And have the prefix => admin route element added.
     $routes->connect('/', ['controller' => 'Users', 'action' => 'login']);
    $routes->fallbacks(DashedRoute::class);
});