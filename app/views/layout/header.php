<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/img/icon_faltometro.ico">
    <title>Faltômetro</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">

    <style>
        /* 1. CORREÇÃO DO FUNDO PRETO: Define o fundo do corpo como branco. */
        body {
            background-color: #ffffff;
            /* Fundo branco garantido */
        }
    </style>
</head>

<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-light border-bottom shadow-sm sticky-top" style="background-color: #BDE3EF;"> -->
    <nav class="navbar navbar-expand-lg navbar-light border-bottom shadow-sm" style="background-color: #BDE3EF; position: fixed; top: 0; left: 0; width: 100%; z-index: 1050;">
        <div class="container">

            <a class="navbar-brand d-flex align-items-center" href="inicio">
                <img src="img/logo_faltometro2.png" alt="Faltômetro Logo" style="height: 40px; width: auto;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">

                    <?php
                    require_once 'app/core/auth.php';
                    if (isset($_SESSION['logged'])): ?>

                        <?php
                        // Simulação de nome de usuário para o dropdown
                        $userName = $_SESSION['func_nome'] ?? 'Usuário';

                        switch ($_SESSION['func_tipo_acesso']) {
                            case '1': // Professor
                        ?>
                                <li class="nav-item"><a class="nav-link text-dark fw-medium" href="./inicio"><i class="fas fa-home me-1"></i> Início</a></li>
                                <li class="nav-item"><a class="nav-link text-dark fw-medium" href="./listFrenqTu"><i class="fas fa-calendar-check me-1"></i> Frequência</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-dark fw-medium" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user-circle me-1"></i> <?= $userName ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" href="./conta"><i class="fas fa-cog me-2"></i> Minha Conta</a></li>
                                        <!-- <?php if ($_SESSION['func_tipo_acesso'] != '1'): // Nutricionista e Coordenação têm relatórios 
                                                ?>
                                            <li><a class="dropdown-item" href="./relatorios"><i class="fas fa-chart-bar me-2"></i> Relatórios</a></li>
                                        <?php endif; ?> -->
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-danger" href="./logout"><i class="fas fa-sign-out-alt me-2"></i> Sair</a></li>
                                    </ul>
                                </li>
                            <?php break;

                            case '2': // Nutricionista
                            ?>
                                <li class="nav-item"><a class="nav-link text-dark fw-medium" href="./relFrenqNutri"><i class="fas fa-home me-1"></i>Relatórios</a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-dark fw-medium" href="#" id="adminUserDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user-shield me-1"></i> Nutricionista
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminUserDropdown">
                                        <li><a class="dropdown-item" href="./conta"><i class="fas fa-cog me-2"></i> Minha Conta</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-danger" href="./logout"><i class="fas fa-sign-out-alt me-2"></i> Sair</a></li>
                                    </ul>
                                </li>
                            <?php break;
                            case '3': // Coordenação
                            ?>
                                <li class="nav-item"><a class="nav-link text-dark fw-medium" href="./inicio"><i class="fas fa-home me-1"></i> Início</a></li>
                                <li class="nav-item"><a class="nav-link text-dark fw-medium" href="./relFrenqCo"><i class="fas fa-chart-bar me-2"></i> Relatórios</a></li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-dark fw-medium" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user-circle me-1"></i> <?= $userName ?>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" href="./conta"><i class="fas fa-cog me-2"></i> Minha Conta</a></li>
                                        <?php if ($_SESSION['func_tipo_acesso'] != '1'): // Nutricionista e Coordenação têm relatórios 
                                        ?>
                                        <?php endif; ?>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-danger" href="./logout"><i class="fas fa-sign-out-alt me-2"></i> Sair</a></li>
                                    </ul>
                                </li>
                            <?php break;

                            case '4': // Administrador
                            ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-dark fw-medium" href="#" id="cadastrosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user-plus me-1"></i> Cadastros</a>
                                    <ul class="dropdown-menu" aria-labelledby="cadastrosDropdown">
                                        <li>
                                            <h6 class="dropdown-header">Pessoas e Estrutura</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="./listFunc">Funcionários</a></li>
                                        <li><a class="dropdown-item" href="./listEstudante">Alunos</a></li>
                                        <li><a class="dropdown-item" href="./listEscola">Escolas</a></li>
                                        <li><a class="dropdown-item" href="./listTurma">Turmas</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <h6 class="dropdown-header">Especiais</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="./listDieta">Dietas Especiais</a></li>
                                        <li><a class="dropdown-item" href="./listProjeto">Turmas Extracurriculares</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-dark fw-medium" href="#" id="relatoriosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-chart-line me-1"></i> Relatórios</a>
                                    <ul class="dropdown-menu" aria-labelledby="relatoriosDropdown">
                                        <li><a class="dropdown-item" href="./relFrenqCo"><i class="fas fa-user-secret me-2"></i> Relatórios da Coordenação</a></li>
                                           <li><a class="dropdown-item" href="./relFrenqNutri"><i class="fas fa-cutlery me-2"></i> Relatórios do Nutricionista</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-dark fw-medium" href="#" id="funcionalidadesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-tools me-1"></i> Funcionalidades</a>
                                    <ul class="dropdown-menu" aria-labelledby="funcionalidadesDropdown">
                                        <li><a class="dropdown-item" href="./listAtriDieta">Atribuição de Dietas</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-dark fw-medium" href="#" id="adminUserDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user-shield me-1"></i> Admin
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminUserDropdown">
                                        <li><a class="dropdown-item" href="./conta"><i class="fas fa-cog me-2"></i> Minha Conta</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-danger" href="./logout"><i class="fas fa-sign-out-alt me-2"></i> Sair</a></li>
                                    </ul>
                                </li>

                        <?php break;
                        }
                        ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div style="height: 60px;"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="assets/jquery-3.7.1.min.js"></script>
</body>

</html>