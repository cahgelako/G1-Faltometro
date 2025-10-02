<?php
$routes = [

    // Site (revisar)
    'sobre'    => ['controller' => 'SiteController', 'method' => 'sobre'],
    'contato'  => ['controller' => 'SiteController', 'method' => 'contato'],
    'inicio'   => ['controller' => 'SiteController', 'method' => 'inicio'],
    'logout'   => ['controller' => 'FuncionarioController', 'method' => 'logout'],

    // Escolas
    'listEscola' => ['controller' => 'EscolaController', 'method' => 'listar'],
    'registerEs' => ['controller' => 'EscolaController', 'method' => 'registrar'],
    'editEscola' => ['controller' => 'EscolaController', 'method' => 'editar'],

    // Turmas
    'listTurma' => ['controller' => 'TurmaController', 'method' => 'listar'],
    'registerTurma'=> ['controller' => 'TurmaController', 'method' => 'registrar'],
    'editTurma'=> ['controller'=> 'TurmaController', 'method'=> 'editar'],

    // Funcionarios
    'login'    => ['controller' => 'FuncionarioController', 'method' => 'login'],
    'listFunc' => ['controller' => 'FuncionarioController', 'method' => 'listar'],
    'editFunc' => ['controller' => 'FuncionarioController', 'method' => 'editar'],
    'deleteFunc' => ['controller' => 'FuncionarioController', 'method' => 'deletar'],
    'registrarFunc' => ['controller' => 'FuncionarioController', 'method' => 'registrar'],
];
