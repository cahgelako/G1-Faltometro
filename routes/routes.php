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
    'deleteEscola'=> ['controller' => 'EscolaController', 'method' => 'deletar'],

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
    'registrarFunc' => ['controller' => 'FuncionarioController', 'method' => 'registrar'],

    // Estudantes
    'listEstudante' => ['controller' => 'EstudanteController', 'method' => 'listar'],
    'registerEstudantes' => ['controller' => 'EstudanteController', 'method' => 'registrar'],
    'editEstudante' => ['controller' => 'EstudanteController', 'method' => 'editar'],
    'deleteEstudante' => ['controller' => 'EstudanteController', 'method' => 'deletar'],
    'viewEstudante' => ['controller' => 'EstudanteController', 'method' => 'visualizar_estudante'],

    // Matricula
    'listMatricula' => ['controller' => 'MatriculaController', 'method' => 'listar'], 
    'editMatricula' => ['controller' => 'MatriculaController', 'method' => 'editar'], 
    'registerMatricula' => ['controller' => 'MatriculaController', 'method' => 'registrar'], 
    'deleteMatricula' => ['controller' => 'MatriculaController', 'method' => 'deletar'], 

    // Classe
    'listClasse' => ['controller' => 'ClasseController', 'method' => 'listar'],
    'editClasse' => ['controller' => 'ClasseController', 'method' => 'editar'],
    'registerClasse' => ['controller' => 'ClasseController', 'method' => 'registrar'],
    'deleteClasse' => ['controller' => 'ClasseController', 'method' => 'deletar'], 

    // Dietas Especiais
    'listDieta' => ['controller' => 'DietaEspecialController', 'method' => 'listar'],
    'editDieta' => ['controller' => 'DietaEspecialController', 'method' => 'editar'],
    'registerDieta' => ['controller' => 'DietaEspecialController', 'method' => 'registrar'],
    'deletedieta' => ['controller' => 'DietaEspecialController', 'method' => 'deletar'],

    // Faltas
    'listFalta' => ['controller' => 'FaltaController', 'method' => 'listar'],
    'editFalta' => ['controller' => 'FaltaController', 'method' => 'editar'],
    'registerFalta' => ['controller' => 'FaltaController', 'method' => 'registrar'],
    'deleteFalta' => ['controller' => 'FaltaController', 'method' => 'delete'],
    'relFalta' => ['controller' => 'FaltaController', 'method' => 'relatorio'],
    'relPDFFalta' => ['controller' => 'FaltaController', 'method' => 'gerarPDF'],

    // Projetos Especiais
    'listProjeto' => ['controller' => 'ProjetoController', 'method' => 'listar'],
    'editProjeto' => ['controller' => 'ProjetoController', 'method' => 'editar'],
    'registerProjeto' => ['controller' => 'ProjetoController', 'method' => 'registrar'],
    'deleteProjeto' => ['controller' => 'ProjetoController', 'method' => 'deletar'],
    'viewProjeto' => ['controller' => 'ProjetoController', 'method' => 'visualizar'],

      // Matricula Projetos
    'listMatProjeto' => ['controller' => 'MatriculaController', 'method' => 'listar'],
    'editMatProjeto' => ['controller' => 'MatriculaController', 'method' => 'editar'],
    'registerMatProjeto' => ['controller' => 'MatriculaController', 'method' => 'registrar'],
    'deleteMatProjeto' => ['controller' => 'MatriculaController', 'method' => 'deletar'],

    // Dietas por Estudante
    'listDietaEstudante' => ['controller' => 'DietaEstudanteController', 'method' => 'listar'],
    'editDietaEstudante' => ['controller' => 'DietaEstudanteController', 'method' => 'editar'],
    'registerDietaEstudante' => ['controller' => 'DietaEstudanteController', 'method' => 'registrar'],
    'deleteDietaEstudante' => ['controller' => 'DietaEstudanteController', 'method' => 'deletar'],


];
