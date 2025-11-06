<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/icon_faltometro.ico">
    <title>Faltômetro</title>
    <link rel="stylesheet" href="css/custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-light" style="background-color:#F0F8FF;">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="inicio">
                <img class="w-25 h-50" src="img/logo_faltometro2.png" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">

                    <?php
                    require_once 'app/core/auth.php';
                    if (isset($_SESSION['logged'])): ?>

                        <?php
                        //  echo "<pre>";
                        //  echo var_dump($_SESSION);
                        //  echo "</pre>"; 
                        switch ($_SESSION['func_tipo_acesso']) {
                            case '1': ?>
                                <li class="nav-item"><a class="nav-link text-black" href="./home">Início</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="./conta">Conta</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="./listFrenqTu">Frequência</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="./logout">Sair</a></li>
                            <?php break;

                            case '2': ?>
                                <li class="nav-item"><a class="nav-link text-black" href="./home">Início</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="./conta">Conta</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="./relatorios">Relatórios</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="./logout">Sair</a></li>

                            <?php break;

                            case '3': ?>
                                <li class="nav-item"><a class="nav-link text-black" href="./home">Início</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="./conta">Conta</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="./relatorios">Relatórios</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="./logout">Sair</a></li>


                            <?php break;

                            case '4': ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-black" href="#" id="cadastrosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastros</a>
                                    <ul class="dropdown-menu" aria-labelledby="cadastrosDropdown">
                                        <li><a class="dropdown-item text-black" href="./listFunc">Funcionários</a></li>
                                        <li><a class="dropdown-item text-black" href="./listEstudante">Alunos</a></li>
                                        <li><a class="dropdown-item text-black" href="./listEscola">Escolas</a></li>
                                        <li><a class="dropdown-item text-black" href="./listTurma">Turmas</a></li>
                                        <li><a class="dropdown-item text-black" href="./listClasse">Classes</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-black" href="./listDieta">Dietas Especiais</a></li>
                                        <li><a class="dropdown-item text-black" href="./listProjeto">Turmas Extracurriculares</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-black" href="./listMatricula">Matrícula</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-black" href="./listRelatorio">Relatórios</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-black" href="#" id="cadastrosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Funcionalidades</a>
                                    <ul class="dropdown-menu" aria-labelledby="cadastrosDropdown">
                                        <li><a class="dropdown-item text-black" href="./listAtriDieta">Atribuição de Dietas</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-black" href="./listAtriExtras">Atribuição de Extracurriculares</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link text-black" href="./logout">Sair</a></li>
                        <?php break;
                        }
                        ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

    </nav>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="assets/jquery-3.7.1.min.js"></script>