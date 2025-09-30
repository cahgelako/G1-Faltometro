<?php
$routes = [

    // Site (revisar)
    'sobre'    => ['controller' => 'SiteController', 'method' => 'sobre'],
    'contato'  => ['controller' => 'SiteController', 'method' => 'contato'],
    'inicio'   => ['controller' => 'SiteController', 'method' => 'inicio'],
    'logout'   => ['controller' => 'UserController', 'method' => 'logout'],
    'login'   => ['controller' => 'UserController', 'method' => 'logout'],

    // Escolas
    'listEscola' => ['controller' => 'EscolaController', 'method' => 'listar'],
    'registerEs' => ['controller' => 'EscolaController', 'method' => 'registrar'],
    'editEscola' => ['controller' => 'EscolaController', 'method' => 'editar'],

    // Turmas
    'listTurma' => ['controller' => 'TurmaController', 'method' => 'listar'],
    'registerTu'=> ['controller' => 'TurmaController', 'method' => 'registrar']
];
