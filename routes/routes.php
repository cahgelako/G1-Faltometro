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
    'deleteEscola'=> ['controller' => 'TurmaController', 'method' => 'deletar'],

    // Turmas
    'listTurma' => ['controller' => 'TurmaController', 'method' => 'listar'],
    'registerTurma'=> ['controller' => 'TurmaController', 'method' => 'registrar'],
    'editTurma'=> ['controller' => 'TurmaController', 'method' => 'editar'],
    'deleteTurma'=> ['controller' => 'TurmaController', 'method' => 'deletar'],

    // Funcionarios
    'login'    => ['controller' => 'FuncionarioController', 'method' => 'login'],
    'listFunc' => ['controller' => 'FuncionarioController', 'method' => 'listar'],
    'editFunc' => ['controller' => 'FuncionarioController', 'method' => 'editar'],
    'deleteFunc' => ['controller' => 'FuncionarioController', 'method' => 'deletar'],
    'registerFunc' => ['controller' => 'FuncionarioController', 'method' => 'registrar'],

    // Estudantes
    'listEstudante' => ['controller' => 'EstudanteController', 'method' => 'listar'],
    'registerEstudantes' => ['controller' => 'EstudanteController', 'method' => 'registrar'],
    'editEstudante' => ['controller' => 'EstudanteController', 'method' => 'editar'],
    'deleteEstudante' => ['controller' => 'EstudanteController', 'method' => 'deletar'],

    // Matricula
    'listMatricula' => ['controller' => 'MatriculaController', 'method' => 'listar'], 
    'editMatricula' => ['controller' => 'MatriculaController', 'method' => 'editar'], 
    'registerMatricula' => ['controller' => 'MatriculaController', 'method' => 'registrar'], 
    'deleteMatricula' => ['controller' => 'MatriculaController', 'method' => 'deletar'], 

    // Grade
    'listGrade' => ['controller' => 'GradeController', 'method' => 'listar'],
    'editGrade' => ['controller' => 'GradeController', 'method' => 'editar'],
    'registerGrade' => ['controller' => 'GradeController', 'method' => 'registrar'],
    'deleteGrade' => ['controller' => 'GradeController', 'method' => 'deletar'], 

    // Dietas Especiais
    'listDieta' => ['controller' => 'DietaController', 'method' => 'listar'],
    'editDieta' => ['controller' => 'DietaController', 'method' => 'editar'],
    'registerDieta' => ['controller' => 'DietaController', 'method' => 'registrar'],
    'deleteDieta' => ['controller' => 'DietaController', 'method' => 'deletar'],

    // Faltas
    'listFalta' => ['controller' => 'FaltaController', 'method' => 'listar'],
    'editFalta' => ['controller' => 'FaltaController', 'method' => 'editar'],
    'registerFalta' => ['controller' => 'FaltaController', 'method' => 'registrar'],
    'deleteFalta' => ['controller' => 'FaltaController', 'method' => 'delete'],
    'relFalta' => ['controller' => 'FaltaController', 'method' => 'relatorio'],
    'relPDFFalta' => ['controller' => 'FaltaController', 'method' => 'gerarPDF'],

];
