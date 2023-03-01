<?php
/**
 * optional params for
 * MainController | ExceptController
 */

use App\Framework\Container\Container;
use App\Framework\Database\DotEnv;

return [
    \App\Controller\MainController::class => static function (Container $container) {
        return new \App\Controller\MainController(
            $container->get(\App\Framework\View\View::class)
        );
    },
    \App\Controller\PostController::class => static function (Container $container) {
        return new \App\Controller\PostController(
            $container->get(\App\Framework\View\View::class),
            $container->get(\PDO::class),
            $container->get(\App\Framework\Database\Query::class),
            $container->get(\App\Framework\Database\EntityManager::class),
            $container->get(\App\Framework\Repository\PostRepository::class)
        );
    },
    \App\Controller\UserController::class => function (Container $container) {
        return new \App\Controller\UserController(
            $container->get(\App\Framework\View\View::class)
        );
    },
    \App\Controller\ContactController::class => function (Container $container) {
        return new \App\Controller\ContactController(
            $container->get(\App\Framework\View\View::class)
        );
    },
    \App\Controller\AuthController::class => function (Container $container) {
        return new \App\Controller\AuthController(
            $container->get(\App\Framework\View\View::class)
        );
    },
    \App\Framework\Router\ControllerResolver::class => static function (Container $container) {
        return new \App\Framework\Router\ControllerResolver($container);
    },
    \App\Controller\ExceptionController::class => function (Container $container) {
        return new \App\Controller\ExceptionController(
            $container->get(\App\Framework\View\View::class
            )
        );
    },
    \App\Framework\View\View::class => static function () {
        return new \App\Framework\View\View(TEMPLATE_DIRECTORY
        );
    },
    \App\Framework\Database\Query::class => static function (Container $container) {
        return new \App\Framework\Database\Query();
    },
    \PDO::class => static function () {
        //TODO

        $connection = new DotEnv(ENV_PATH);
        $credential = $connection->load()->getCredentials();
        // return new \PDO($, $credential['dns'], $credential['password']);
        return new \PDO(dsn, username, password
        );
    },
    \App\Framework\Database\EntityManager::class => static function (Container $container) {
        return new \App\Framework\Database\EntityManager(
            $container->get(\PDO::class),
        );
    },
    \App\Framework\Repository\PostRepository::class => static function (Container $container) {
        return new \App\Framework\Repository\PostRepository(
            $container->get(\PDO::class)
        );
    },
    'paramResolver' => static function (Container $container) {
        return (new \App\Framework\Router\Request())->getParam();
    }
];
