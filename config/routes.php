<?php

namespace Symfony\Component\Routing\Loader\Configurator;

use App\Interfaces\Web\Controller\TaskController;

return function (RouteConfigurator $routes) {
      $routes->add('createTask', '/createTask')
          ->controller([new TaskController(), 'createTask'])
          ->options([
              'utf-8' => true
      ]);

    $createTaskRoute = new Route(
        'createTask',
        array('_controller' => [new TaskController(), 'createTask'])
    );

    $homeRoot = new Route(
        '/',
        array('_controller' => [new TaskController(), 'home'])
    );
};
