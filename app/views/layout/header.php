<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../img/icon_faltometro.ico" >
    <title>Faltômetro</title>
    <link rel="stylesheet" href="../../../css/custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <!-- Esquerda: logo + nome -->
            <?php if (isset($_SESSION['logged'])): ?> 
                <a class="navbar-brand d-flex align-items-center" href="./home"></a>
                    <img src="../../../img/logo_faltometro.png" alt="Logo" class="me-2"  style="width: 70px; height: 100px;">
                    <h3 class="text-white">Faltômetro</h3>
                </a>
               <?php else: ?>
               
               <?php endif; ?>

               <!-- Botão hamburguer para dispositivos móveis -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if (!isset($_SESSION['logged'])): ?>

                        <?php 
                            switch ($_SESSION['tipo_acesso'] ) {
                                case '1':?>
                                 <li class="nav-item"><a class="nav-link" href="./home">Início</a></li>
                                    <li class="nav-item"><a class="nav-link" href="./conta">Conta</a></li>
                                    <li class="nav-item"><a class="nav-link" href="./faltas">Faltas</a></li>
                                    <li class="nav-item"><a class="nav-link" href="./relatorios">Relatórios</a></li>
                                    <li class="nav-item"><a class="nav-link" href="./logout">Sair</a></li>  
                                    <?php break;

                                case '2':?>
                                    <li class="nav-item"><a class="nav-link" href="./home">Início</a></li>
                                    <li class="nav-item"><a class="nav-link" href="./conta">Conta</a></li>
                                    <li class="nav-item"><a class="nav-link" href="./relatorios">Relatórios</a></li>
                                    <li class="nav-item"><a class="nav-link" href="./logout">Sair</a></li>    

                                   <?php break; 
                                   
                                case '3':?>  
                                    <li class="nav-item"><a class="nav-link" href="./home">Início</a></li>
                                    <li class="nav-item"><a class="nav-link" href="./conta">Conta</a></li>
                                    <li class="nav-item"><a class="nav-link" href="./relatorios">Relatórios</a></li>
                                    <li class="nav-item"><a class="nav-link" href="./logout">Sair</a></li>    

                                
                                <?php break;

                                case '4':?>
                                 <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="cadastrosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastros</a>
                            <ul class="dropdown-menu" aria-labelledby="cadastrosDropdown">
                                <li><a class="dropdown-item" href="./listFunc">Funcionários</a></li>
                                <li><a class="dropdown-item" href="./listAluno">Alunos</a></li>
                                <li><a class="dropdown-item" href="./listEscola">Escolas</a></li>
                                <li><a class="dropdown-item" href="./listTurma">Turmas</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="./listGrade">Grade Curricular</a></li>
                                <li><a class="dropdown-item" href="./listMatricula">Matrícula</a></li>
                                <li><a class="dropdown-item" href="./listTurmaExtra">Turmas Extracurriculares</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="./listControle">Relatórios</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="./logout">Sair</a></li>    
                                <?php break;
                            }
                            ?>
                   <?php endif; ?>
                </ul>

            </div>