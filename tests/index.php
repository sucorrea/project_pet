<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>AllPet | Agenda</title>
    <link href="../vendor/fontawesome-free/fontawesome-free-6.4.0-web/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="../vendor/fontawesome-free/css/style-allpet.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="../css/sb-admin-2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../agenda/main.min.js"></script>
    <script src="../agenda/pt-br.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var calendarEl = document.getElementById("calendar");
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: "dayGridMonth",
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay",
                },
                locale: "pt-br",
                buttonText: {
                    today: "Hoje",
                    dayGridMonth: "Mês",
                    timeGridWeek: "Semana",
                    timeGridDay: "Dia",
                },
                events: [
                    // Add more events...
                ],
                eventContent: function(info) {
                    var title = info.event.title;
                    var funcionario = info.event.extendedProps.funcionario;
                    var tutor = info.event.extendedProps.tutor;
                    var pet = info.event.extendedProps.pet;
                    var servico = info.event.extendedProps.servico;

                    var content = document.createElement("button");
                    content.classList.add("light-blue");
                    content.setAttribute("data-bs-target", "#exampleModal2");
                    content.setAttribute("data-bs-toggle", "modal");
                    content.innerHTML =
                        '<span class="fc-title">' +
                        title +
                        "</span>" +
                        '<div class="fc-description">' +
                        "<strong>Func.:</strong> " +
                        funcionario +
                        "<br>" +
                        "<strong>Tut.:</strong> " +
                        tutor +
                        "<br>" +
                        "<strong>Pet:</strong> " +
                        pet +
                        "<br>" +
                        "<strong>Ser.:</strong> " +
                        servico +
                        "</div>";

                    return {
                        domNodes: [content],
                    };
                },
            });

            calendar.render();
            var toolbar = calendarEl.querySelectorAll(".fc-button");
            toolbar.forEach((toolbar) => {
                toolbar.classList.add("blue-color");
            });
        });
    </script>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion fixed-top" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./index.php">
                <div class="sidebar-brand-icon">
                    <img src="../icon-allpet.svg" alt="Dog" />
                </div>
                <div class="sidebar-brand-text fs-6 mx-1">ALLPET</div>
            </a>
            <hr class="sidebar-divider my-0" />
            <li class="nav-item active">
                <a class="nav-link" href="./index.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>
            <hr class="sidebar-divider" />
            <li class="nav-item">
                <div class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFuncionarios" aria-expanded="true" aria-controls="collapseFuncionarios">
                    <a class="text-reset text-decoration-none" href="./confuncionario.php">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Funcionário</span>
                    </a>
                </div>
                <div id="collapseFuncionarios" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="./addfuncionario.html">Adicionar Funcionário</a>
                        <a class="collapse-item" href="./confuncionario.php">Consultar Funcionário</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                    <a class="text-reset text-decoration-none" href="./conservico.html">
                        <i class="fas fa-fw fa-file-alt"></i>
                        <span>Serviços</span>
                    </a>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="./addservico.html">Adicionar Serviços</a>
                        <a class="collapse-item" href="./conservico.html">Consultar Serviços</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                    <a class="text-reset text-decoration-none" href="./contutor.html">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Tutores</span>
                    </a>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="./addtutor.html">Adicionar Tutor</a>
                        <a class="collapse-item" href="./contutor.html">Consultar Tutor</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <div class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAgenda" aria-expanded="true" aria-controls="collapseAgenda">
                    <a class="text-reset text-decoration-none" href="#">
                        <i class="fas fa-fw fa-calendar"></i>
                        <span>Pet</span>
                    </a>
                </div>
                <div id="collapseAgenda" class="collapse" aria-labelledby="headingPets" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="./addpet.html">Adicionar Pet</a>
                        <a class="collapse-item" href="./conpet.html">Consultar Pet</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider" />
            <div class="
        <?php echo (($_SESSION["id_funcao"] == 1)) ? '' : 'd-none'; ?>">
                <div class="sidebar-heading">Outros</div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="true" aria-controls="collapseSettings">
                        <i class="fa fa-print" aria-hidden="true"></i>
                        <span>Relatórios</span>
                    </a>
                    <div id="collapseSettings" class="collapse" aria-labelledby="headingSettings" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Opções</h6>
                            <a class="collapse-item" href="alterar">Relatório Financeiro</a>
                            <a class="collapse-item" href="alterar">Relatório Funcionário</a>
                            <a class="collapse-item" href="alterar">Relatório Pet</a>
                            <a class="collapse-item" href="alterar">Relatório Serviço</a>
                            <a class="collapse-item" href="alterar">Relatório Tutor</a>
                        </div>
                    </div>
                </li>
        </ul>

        <hr class="sidebar-divider d-none d-md-block" />
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow fixed-top margin-l">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar..." aria-label="Search" aria-describedby="basic-addon2" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="d-flex flex-column">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($_SESSION["nome"]); ?></span>
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                        Função:
                                        <?php echo htmlspecialchars($_SESSION["funcao"]); ?></span>
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Departamento:
                                        <?php echo htmlspecialchars($_SESSION["departamento"]); ?></span>
                                </div>
                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg" />
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configurações
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Log de Atividades
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="card shadow container w-75 margin-b margin-t" id="card">
                    <div class="container-fluid mt-5 mb-5">
                        <div class="d-flex justify-content-between">
                            <h4 class="fs-1">Agenda</h4>
                            <button type="button" class="btn btn-primary" title="Agendar" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-fw fa-plus"></i>
                            </button>
                        </div>
                        <div id="card">
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg custom-dialog">
                                    <div class="modal-content p-3">
                                        <div class="mt-3">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="Agenda-tab" data-bs-toggle="tab" href="#Agenda" role="tab" aria-controls="Agenda" aria-selected="true">Agenda</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="Agenda" role="tabpanel" aria-labelledby="Agenda-tab">
                                                <div class="container mt-5">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="tutor" class="form-label"><b>Tutor</b></label>
                                                            <select class="form-control" name="tutor">
                                                                <option value="Flávio Eduardo de Oliveira">
                                                                    Flávio Eduardo de Oliveira
                                                                </option>
                                                                <option value="Gabriel Paduleto">
                                                                    Gabriel Paduleto
                                                                </option>
                                                                <option value="Helio Neves">
                                                                    Helio Neves
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="funcao" class="form-label"><b>Pet</b></label>
                                                            <select class="form-control" name="pet">
                                                                <option value="Bob">Bob</option>
                                                                <option value="Doguinho">Doguinho</option>
                                                                <option value="Mrley">Marley</option>
                                                                <option value="Scooby">Scooby</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="tutor" class="form-label"><b></b>Funcionário</label>
                                                            <select class="form-control" name="funcionario">
                                                                <option value="Alan Silva">Alan Silva</option>
                                                                <option value="Brenda Gimenes">
                                                                    Brenda Gimenes
                                                                </option>
                                                                <option value="Bruno Pereira">
                                                                    Bruno Pereira
                                                                </option>
                                                                <option value="Carlos Gomes de Souza">
                                                                    Carlos Gomes de Souza
                                                                </option>
                                                                <option value="Caroline Benedita dos Santos">
                                                                    Caroline Benedita dos Santos
                                                                </option>
                                                                <option value="Daniele de Souza dos Santos">
                                                                    Daniele de Souza dos Santos
                                                                </option>
                                                                <option value="Eduardo Augusto Pereira">
                                                                    Eduardo Augusto Pereira
                                                                </option>
                                                                <option value="Felipe Botello de Andradina Silva">
                                                                    Felipe Botello de Andradina Silva
                                                                </option>
                                                                <option value="José da Silva">
                                                                    José da Silva
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="funcao" class="form-label"><b>Serviço</b></label>
                                                            <select class="form-control" name="servico">
                                                                <option value="Banho">Banho</option>
                                                                <option value="Tosa">Tosa</option>
                                                                <option value="Banho e Tosa">
                                                                    Banho e Tosa
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="data_agenda" class="form-label"><b>Data</b></label>
                                                            <input type="date" class="form-control" id="data_agenda" name="data_agenda" />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="hora" class="form-label"><b>Horário</b></label>
                                                            <input type="number" class="form-control" id="hora" name="hora" placeholder="Digite o horário" />
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="status" class="form-label"><b>Status</b></label>
                                                            <select class="form-control" name="status">
                                                                <option value="ativo">Ativo</option>
                                                                <option value="desativo">Inativo</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="hora" class="form-label"><b>Recebimento</b></label>
                                                            <input type="text" class="form-control" id="recebi" name="recebi" placeholder="Digite o aqui" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="hora" class="form-label"><b>Relatório Serviço</b></label>
                                                            <textarea type="text" class="form-control" id="rel_serv" name="rel_serv" placeholder="Digite aqui"></textarea>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class="container mt-4 mb-5">
                                                        <div class="d-flex justify-content-between">
                                                            <button type="button" class="btn btn-primary btn-circle" title="Voltar">
                                                                <i class="fas fa-fw fa-chevron-left"></i>
                                                            </button>
                                                            <div class="ml-auto">
                                                                <a href="contutor2.html" class="btn btn-success btn-circle" title="Salvar"><i class="fas fa-fw fa-chevron-down"></i></a>
                                                                <a href="contutor2.html" class="btn btn-danger btn-circle" title="Cancelar"><i class="fas fa-fw fa-xmark"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="card">
                            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg custom-dialog">
                                    <div class="modal-content p-3">
                                        <div class="mt-3">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="Agenda2-tab" data-bs-toggle="tab" href="#Agenda2" role="tab" aria-controls="Agenda2" aria-selected="true">Agenda</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="Agenda2" role="tabpanel" aria-labelledby="Agenda2-tab">
                                                <div class="container mt-5">
                                                    <div class="row">
                                                        <div class="col-4 mb-3">
                                                            <label for="tutor" class="form-label">Tutor</label>
                                                            <p>Prayer</p>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="funcao" class="form-label">Pet</label>
                                                            <p>Scooby</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4 mb-3">
                                                            <label for="tutor" class="form-label">Funcionário</label>
                                                            <p>John Kennedy</p>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="funcao" class="form-label">Serviço</label>
                                                            <p>Tosa</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="data_agenda" class="form-label">Data</label>
                                                            <p>2023-06-08</p>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="hora" class="form-label">Horário</label>
                                                            <p>10:00:00AM</p>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <label for="status" class="form-label">Status</label>
                                                            <p>Ativo</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="hora" class="form-label">Recebimento</label>
                                                            <p>R$300.00</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="hora" class="form-label">Relatório Serviço</label>
                                                            <p>
                                                                Ele saiu pulando aqui me ajudaaa, help me
                                                                please, oh my gosh.
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <div class="container mt-4 mb-5">
                                                        <div class="d-flex justify-content-between">
                                                            <button type="button" class="btn btn-primary btn-circle" title="Voltar">
                                                                <i class="fas fa-fw fa-chevron-left"></i>
                                                            </button>
                                                            <div class="ml-auto">
                                                                <a href="contutor2.html" class="btn btn-success btn-circle" title="Salvar"><i class="fas fa-fw fa-chevron-down"></i></a>
                                                                <a href="contutor2.html" class="btn btn-danger btn-circle" title="Cancelar"><i class="fas fa-fw fa-xmark"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="sticky-footer bg-white margin-l">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2021</span>
                </div>
            </div>
        </footer>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Pronto para sair?
                        </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Selcione "Sair" abaixo se você estiver pronto para sair da sessão.
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">
                            Cancelar
                        </button>
                        <a class="btn btn-primary <?php session_reset(); ?>" href="login.php">Sair</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Activate tab functionality
        var tab = new bootstrap.Tab(document.getElementById("pessoa-tab"));
        tab.show();
        // Get reference to the calendar container element
    </script>
    <script src="../js/allpet.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>
</body>

</html>