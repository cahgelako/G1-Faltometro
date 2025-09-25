<?php
$routes = [

    // Site (revisar)
    'home'        => ['controller' => 'SiteController', 'method' => 'index'],
    'sobre'       => ['controller' => 'SiteController', 'method' => 'sobre'],
    'contato'     => ['controller' => 'SiteController', 'method' => 'contato'],
    'dashboard'   => ['controller' => 'SiteController', 'method' => 'dashboard'],
    'logout'      => ['controller' => 'UserController', 'method' => 'logout'],

    // Escolas
    'listEscola' => ['controller' => 'EscolaController', 'method' => 'listar'],
    'registerEs' => ['controller' => 'EscolaController', 'method' => 'registrar'],
    'editEscola' => ['controller' => 'EscolaController', 'method' => 'editar']
];
