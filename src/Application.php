<?php

declare(strict_types=1);

namespace App;

use App\Application\AuthenticationServiceProvider;
use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Datasource\FactoryLocator;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;

class Application extends BaseApplication
{
    public function bootstrap(): void
    {
        // Call parent to load bootstrap from files.
        parent::bootstrap();

        // Load Authentication plugin
        $this->addPlugin('Authentication');
    }

    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue
            // Error handling
            ->add(new ErrorHandlerMiddleware(Configure::read('Error'), $this))

            // Asset handling
            ->add(new AssetMiddleware(['cacheTime' => Configure::read('Asset.cacheTime')]))

            // Routing
            ->add(new RoutingMiddleware($this))

            // Body parsing
            ->add(new BodyParserMiddleware())

            // CSRF protection
            ->add(new CsrfProtectionMiddleware(['httponly' => true]))

            // Add Authentication Middleware (NEW)
            ->add(new \Authentication\Middleware\AuthenticationMiddleware(new AuthenticationServiceProvider()));

        return $middlewareQueue;
    }

    public function services(ContainerInterface $container): void
    {
        // Register services here
    }
}
