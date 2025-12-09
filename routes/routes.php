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
    'desativarEscola'=> ['controller' => 'EscolaController', 'method' => 'desativar'],
    'ativarEscola'=> ['controller' => 'EscolaController', 'method' => 'ativar'],

    // Turmas
    'listTurma' => ['controller' => 'TurmaController', 'method' => 'listar'],
    'registerTurma'=> ['controller' => 'TurmaController', 'method' => 'registrar'],
    'editTurma'=> ['controller' => 'TurmaController', 'method' => 'editar'],
    'desativarTurma' => ['controller' => 'TurmaController', 'method' => 'desativar'], 
    'ativarTurma' => ['controller' => 'TurmaController', 'method' => 'ativar'], 

    // Funcionarios
    'login'    => ['controller' => 'FuncionarioController', 'method' => 'login'],
    'listFunc' => ['controller' => 'FuncionarioController', 'method' => 'listar'],
    'editFunc' => ['controller' => 'FuncionarioController', 'method' => 'editar'],
    'desativarFunc' => ['controller' => 'FuncionarioController', 'method' => 'desativar'],
    'ativarFunc' => ['controller' => 'FuncionarioController', 'method' => 'ativar'],
    'registrarFunc' => ['controller' => 'FuncionarioController', 'method' => 'registrar'],
    'conta' => ['controller' => 'FuncionarioController', 'method' => 'perfil'],

    // Estudantes
    'listEstudante' => ['controller' => 'EstudanteController', 'method' => 'listar'],
    'registerEstudantes' => ['controller' => 'EstudanteController', 'method' => 'registrar'],
    'editEstudante' => ['controller' => 'EstudanteController', 'method' => 'editar'],
    'desativarEstudante' => ['controller' => 'EstudanteController', 'method' => 'desativar'],
    'ativarEstudante' => ['controller' => 'EstudanteController', 'method' => 'ativar'],
    'viewEstudante' => ['controller' => 'EstudanteController', 'method' => 'visualizar_estudante'],

    // Matricula
    'listMatricula' => ['controller' => 'MatriculaController', 'method' => 'listar'], 
    'editAlunoTurma' => ['controller' => 'MatriculaController', 'method' => 'editar'], 
    'registerMatricula' => ['controller' => 'MatriculaController', 'method' => 'registrar'], 
    'desativarMatricula' => ['controller' => 'MatriculaController', 'method' => 'desativar'], 
    'ativarMatricula' => ['controller' => 'MatriculaController', 'method' => 'ativar'], 
    // 'editAlunoClasse' => ['controller' => 'MatriculaController', 'method' => 'ativar'], 

    // Dietas Especiais
    'listDieta' => ['controller' => 'DietaEspecialController', 'method' => 'listar'],
    'editDieta' => ['controller' => 'DietaEspecialController', 'method' => 'editar'],
    'registerDieta' => ['controller' => 'DietaEspecialController', 'method' => 'registrar'],
    'deletedieta' => ['controller' => 'DietaEspecialController', 'method' => 'deletar'],

    // Frequencia
    'listFrenqTu' => ['controller' => 'FrequenciaController', 'method' => 'listar_turmas'],
    'editFrenq' => ['controller' => 'FrequenciaController', 'method' => 'editar'],
    'registerFrenqAluno' => ['controller' => 'FrequenciaController', 'method' => 'registrar'],
    'deleteFalta' => ['controller' => 'FrequenciaController', 'method' => 'delete'],
    'relFalta' => ['controller' => 'FrequenciaController', 'method' => 'relatorio'],
    'pdfRelFrenqCo' => ['controller' => 'FrequenciaController', 'method' => 'gerar_pdf_dia_coordenacao'],
    'confirmFrenq' => ['controller' => 'FrequenciaController', 'method' => 'registrar'],
    'relFrenqNutri' => ['controller' => 'FrequenciaController', 'method' => 'relatorio_nutri'],
    'relFrenqCo' => ['controller' => 'FrequenciaController', 'method' => 'relatorio_coordenacao'],
    
    // Projetos Especiais
    'listProjeto' => ['controller' => 'ProjetoController', 'method' => 'listar'],
    'editProjeto' => ['controller' => 'ProjetoController', 'method' => 'editar'],
    'registerProjeto' => ['controller' => 'ProjetoController', 'method' => 'registrar'],
    'desativarProjeto' => ['controller' => 'ProjetoController', 'method' => 'desativar'],
    'ativarProjeto' => ['controller' => 'ProjetoController', 'method' => 'ativar'],
    'viewProjeto' => ['controller' => 'ProjetoController', 'method' => 'visualizar'],
    
    // Matricula Projetos
    'editAlunoProjeto' => ['controller' => 'MatriculaProjetoController', 'method' => 'editar'],
    'listAtriExtras' => ['controller' => 'MatriculaProjetoController', 'method' => 'listar'],
    /* 'editAtriExtras' => ['controller' => 'MatriculaProjetoController', 'method' => 'editar'], */
    'registerAtriExtras' => ['controller' => 'MatriculaProjetoController', 'method' => 'registrar'],
    'deleteMatProjeto' => ['controller' => 'MatriculaProjetoController', 'method' => 'deletar'],
    
    // Dietas por Estudante
    'listAtriDieta' => ['controller' => 'DietaEstudanteController', 'method' => 'listar'],
    'editAtriDieta' => ['controller' => 'DietaEstudanteController', 'method' => 'editar'],
    'registerAtriDieta' => ['controller' => 'DietaEstudanteController', 'method' => 'registrar'],
    'deletarDietaEstudante' => ['controller' => 'DietaEstudanteController', 'method' => 'deletar'],
    
    // Relatórios
    'listRelTu' => ['controller' => 'FrequenciaController', 'method' => 'listar_turmas'],
    'listRelFrenCo' => ['controller' => 'FrequenciaController', 'method' => 'filtro'],
    'escolhaRel' => ['controller' => 'FrequenciaController', 'method' => 'relatorio'],

];
