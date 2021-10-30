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
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App;

use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;

/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 */
class Application extends BaseApplication
{
    /**
     * {@inheritDoc}
     */
    public function bootstrap()
    {
        $this->addPlugin('ADmad/SocialAuth', ['bootstrap' => true, 'routes' => true]);

        // Call parent to load bootstrap from files.
        parent::bootstrap();

        if (PHP_SAPI === 'cli') {
            try {
                $this->addPlugin('Bake');
            } catch (MissingPluginException $e) {
                // Do not halt if the plugin is missing
            }

            $this->addPlugin('Migrations');
        }

        /*
         * Only try to load DebugKit in development mode
         * Debug Kit should not be installed on a production system
         */
        if (Configure::read('debug')) {
            $this->addPlugin(\DebugKit\Plugin::class);
        }
        $this->addPlugin('AdminLTE');
        $this->addPlugin('ADmad/SocialAuth', ['bootstrap' => true, 'routes' => true]);
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware($middlewareQueue)
    {
        $middlewareQueue
            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(new ErrorHandlerMiddleware(null, Configure::read('Error')))

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime')
            ]))

            // Add routing middleware.
            // Routes collection cache enabled by default, to disable route caching
            // pass null as cacheConfig, example: `new RoutingMiddleware($this)`
            // you might want to disable this cache in case your routing is extremely simple
            ->add(new RoutingMiddleware($this, '_cake_routes_'));

            // Be sure to add SocialAuthMiddleware after RoutingMiddleware
            $middlewareQueue->add(new \ADmad\SocialAuth\Middleware\SocialAuthMiddleware([
                // Request method type use to initiate authentication.
                'requestMethod' => 'POST',
                // Login page URL. In case of auth failure user is redirected to login
                // page with "error" query string var.
                'loginUrl' => '/users/login',
                // URL to redirect to after authentication (string or array).
                'loginRedirect' => '/',
                // Boolean indicating whether user identity should be returned as entity.
                'userEntity' => false,
                // User model.
                'userModel' => 'Users',
                // Social profile model.
                'socialProfileModel' => 'ADmad/SocialAuth.SocialProfiles',
                // Finder type.
                'finder' => 'all',
                // Fields.
                'fields' => [
                    'password' => 'password',
                ],
                // Session key to which to write identity record to.
                'sessionKey' => 'Auth.User',
                // The method in user model which should be called in case of new user.
                // It should return a User entity.
                'getUserCallback' => 'getUser',
                // SocialConnect Auth service's providers config. https://github.com/SocialConnect/auth/blob/master/README.md
                'serviceConfig' => [
                    'provider' => [
                        'facebook' => [
                            'applicationId' => '2195554080758932',
                            'applicationSecret' => '714e257c65eec662a89821d9b16a129d',
                            'scope' => [
                                'https://www.googleapis.com/auth/userinfo.email',
                                'https://www.googleapis.com/auth/userinfo.profile',
                            ],
                        ],
                        'google' => [
                            'applicationId' => '790759925340-rrofr5rrihn979pvfeo25eafmt4smsg7.apps.googleusercontent.com',
                            'applicationSecret' => 'YF5F9N1n_Y1q5oji848YV3B8',
                            'scope' => [
                                'https://www.googleapis.com/auth/userinfo.email',
                                'https://www.googleapis.com/auth/userinfo.profile',
                            ],
                        ],
                        'twitter' => [
                            'applicationId' => 'rJPI0GCawE6BtH6AjsMFTgQHD',
                            'applicationSecret' => 'KtTe1d4HWytuTAG5ZyVZa6QYCGwwnTk6HGcwGxZn8FQjKppuPW',
                            'scope' => [
                                'https://www.googleapis.com/auth/userinfo.email',
                                'https://www.googleapis.com/auth/userinfo.profile',
                            ],
                        ],
                    ],
                ],
                // If you want to use CURL instead of CakePHP's Http Client set this to
                // '\SocialConnect\Common\Http\Client\Curl' or another client instance that
                // SocialConnect/Auth's Service class accepts.
                'httpClient' => '\ADmad\SocialAuth\Http\Client',
                // Whether social connect errors should be logged. Default `true`.
                'logErrors' => true,
            ]));

        return $middlewareQueue;
    }
}
