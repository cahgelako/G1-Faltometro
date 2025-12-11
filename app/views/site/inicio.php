
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Faltômetro</title>

    <!-- Favicon-->
    <link rel="icon" href="./img/icon_faltometro.ico" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- Estilo customizado -->
    <style>
        /* ------------ GLOBAL ------------ */
        body {
            background: #fdfdfd;
            color: #333;
            font-family: "Inter", sans-serif;
            scroll-behavior: smooth;
        }

        /* Fade suave ao carregar seções */
        .fade-up {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp .8s ease forwards;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Cards das features */
        .feature-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: .3s;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
        }

        .feature-icon {
            background: #BDE3EF;
            color: #0a4b60;
            width: 58px;
            height: 58px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        /* Team cards */
        .team-member {
            transition: .3s;
        }

        .team-member:hover {
            transform: translateY(-6px);
        }

        .team-member img {
            border: 4px solid #BDE3EF;
            transition: .3s;
        }

        .team-member img:hover {
            border-color: #82c7d8;
        }

        /* Header hero section */
        header {
            background: linear-gradient(135deg, #d9f2fb, #ffffff);
        }

        .hero-img {
            animation: float 4s ease-in-out infinite;
        }

        /* animação “boiando” */
        @keyframes float {
            0% { transform: translateY(0);}
            50% { transform: translateY(-10px);}
            100% { transform: translateY(0);}
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">

        <!-- HERO / HEADER -->
        <header class="py-5 fade-up">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center">

                    <div class="col-lg-8 col-xl-7 col-xxl-6 text-center text-xl-start">
                        <h1 class="display-5 fw-bold text-black mb-3">Faltômetro</h1>
                        <p class="lead text-secondary mb-4">
                            Da frequência à gestão: informação para cuidar do futuro.
                        </p>

                        <a class="btn btn-outline-info px-4 py-2 fw-medium shadow-sm" href="#">
                            <i class="fa-solid fa-book me-2"></i> Manual de Uso
                        </a>
                    </div>

                    <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                        <img class="img-fluid rounded-3 hero-img" src="img/icon_faltometro.ico" alt="Logo" style="width: 60%; height: 60%"/>
                    </div>

                </div>
            </div>
        </header>

        <!-- FEATURES -->
        <section class="py-5 fade-up" id="features">
            <div class="container px-5 my-5">

                <div class="row gx-5 mb-4">
                    <div class="col-lg-4">
                        <h2 class="fw-bold">Uma nova maneira de contabilizar a frequência</h2>
                    </div>

                    <div class="col-lg-8">
                        <div class="row gx-4 gy-4">

                            <!-- Feature 1 -->
                            <div class="col-md-6">
                                <div class="feature-card">
                                    <div class="feature-icon mb-3"><i class="fa-solid fa-square-poll-vertical"></i></div>
                                    <h5 class="fw-bold">Contagem de Faltas</h5>
                                    <p class="text-secondary mb-0">
                                        Registros rápidos, visão organizada e relatórios automáticos que otimizam a gestão escolar.
                                    </p>
                                </div>
                            </div>

                            <!-- Feature 2 -->
                            <div class="col-md-6">
                                <div class="feature-card">
                                    <div class="feature-icon mb-3"><i class="fa-solid fa-pen-to-square"></i></div>
                                    <h5 class="fw-bold">Relatórios Diários</h5>
                                    <p class="text-secondary mb-0">
                                        Informações completas, organizadas e essenciais para decisões eficientes.
                                    </p>
                                </div>
                            </div>

                            <!-- Feature 3 -->
                            <div class="col-md-6">
                                <div class="feature-card">
                                    <div class="feature-icon mb-3"><i class="fa-solid fa-people-roof"></i></div>
                                    <h5 class="fw-bold">Informações dos Estudantes</h5>
                                    <p class="text-secondary mb-0">
                                        Dados claros para um acompanhamento eficiente e apoio à gestão.
                                    </p>
                                </div>
                            </div>

                            <!-- Feature 4 -->
                            <div class="col-md-6">
                                <div class="feature-card">
                                    <div class="feature-icon mb-3"><i class="fa-solid fa-chalkboard"></i></div>
                                    <h5 class="fw-bold">Fácil Manuseio</h5>
                                    <p class="text-secondary mb-0">
                                        Interface intuitiva para professores, coordenadores e equipes.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- TESTIMONIAL -->
        <div class="py-5 bg-light fade-up">
            <div class="container px-5 my-5 text-center">
                <blockquote class="fs-4 fst-italic mb-3">
                    "O que nos torna humanos é a responsabilidade que assumimos por nossas ações."
                </blockquote>
                <span class="fw-bold">Khalil Gibran</span>
                <span class="text-primary">/</span>
                <span>Filósofo libanês-americano</span>
            </div>
        </div>

        <hr class="my-0">

        <!-- TEAM -->
        <section class="py-5 fade-up">
            <div class="container px-5 my-5">

                <div class="text-center mb-5">
                    <h2 class="fw-bold">Conheça o Time</h2>
                    <p class="text-secondary">A equipe por trás da plataforma.</p>
                </div>

                <div class="row gx-5 justify-content-center">

                    <!-- Integrante 1 -->
                    <div class="col-sm-6 col-md-4 col-lg-2 mb-5 text-center">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle mb-3" src="img/logo_faltometro" style="width:120px;height:120px;">
                            <h6 class="fw-bold mb-0">Ana Carolina</h6>
                            <p class="text-secondary small">Desenvolvedora FrontEnd</p>
                        </div>
                    </div>

                    <!-- 2 -->
                    <div class="col-sm-6 col-md-4 col-lg-2 mb-5 text-center">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle mb-3" src="img/logo_novo.php" style="width:120px;height:120px;">
                            <h6 class="fw-bold mb-0">Beatriz Purissimo</h6>
                            <p class="text-secondary small">Desenvolvedora BackEnd</p>
                        </div>
                    </div>

                    <!-- 3 -->
                    <div class="col-sm-6 col-md-4 col-lg-2 mb-5 text-center">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle mb-3" src="assets/img/team/3.jpg" style="width:120px;height:120px;">
                            <h6 class="fw-bold mb-0">Giordana Martins</h6>
                            <p class="text-secondary small">Documentação</p>
                        </div>
                    </div>

                    <!-- 4 -->
                    <div class="col-sm-6 col-md-4 col-lg-2 mb-5 text-center">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle mb-3" src="assets/img/team/3.jpg" style="width:120px;height:120px;">
                            <h6 class="fw-bold mb-0">Matheus Silva</h6>
                            <p class="text-secondary small">Documentação</p>
                        </div>
                    </div>

                    <!-- 5 -->
                    <div class="col-sm-6 col-md-4 col-lg-2 mb-5 text-center">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle mb-3" src="assets/img/team/3.jpg" style="width:120px;height:120px;">
                            <h6 class="fw-bold mb-0">José Piedade</h6>
                            <p class="text-secondary small">Documentação</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
