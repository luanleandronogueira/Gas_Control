<?php 

function head() {

    print "<meta charset='utf-8'>
    <meta content='width=device-width, initial-scale=1.0' name='viewport'>

    <meta content='' name='description'>
    <meta content='' name='keywords'>
    
    <!-- Favicons -->
    <link href='assets/img/logo_.png' rel='icon'>
    <link href='assets/img/apple-touch-icon.png' rel='apple-touch-icon'>
    
    <!-- Google Fonts -->
    <link href='https://fonts.gstatic.com' rel='preconnect'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i' rel='stylesheet'>
    
    <!-- Vendor CSS Files -->
    <link href='assets/vendor/bootstrap/css/bootstrap.min.css' rel='stylesheet'>
    <link href='assets/vendor/bootstrap-icons/bootstrap-icons.css' rel='stylesheet'>
    <link href='assets/vendor/boxicons/css/boxicons.min.css' rel='stylesheet'>
    <link href='assets/vendor/quill/quill.snow.css' rel='stylesheet'>
    <link href='assets/vendor/quill/quill.bubble.css' rel='stylesheet'>
    <link href='assets/vendor/remixicon/remixicon.css' rel='stylesheet'>
    <link href='assets/vendor/simple-datatables/style.css' rel='stylesheet'>
    
    <!-- Template Main CSS File -->
    <link href='assets/css/style.css' rel='stylesheet'>";
}

function Perfil() {

    print "<li class='nav-item dropdown pe-3'>
    <a class='nav-link nav-profile d-flex align-items-center pe-0' href='#' data-bs-toggle='dropdown'>
         <!-- <img src='assets/img/profile-img.jpg' alt='Profile' class='rounded-circle'> --> 
        <span class='d-none d-md-block dropdown-toggle ps-2'>" . $_SESSION['nome_usuario'] . "</span>
    </a><!-- End Profile Iamge Icon -->

    <ul class='dropdown-menu dropdown-menu-end dropdown-menu-arrow profile'>
        <li class='dropdown-header'>
            <h6>" . $_SESSION['nome_usuario'] . " </h6>
            <span>Usuário</span>
        </li>
        <li>
            <hr class='dropdown-divider'>
        </li>

        <li>
            <a class='dropdown-item d-flex align-items-center' href='perfil.php'>
                <i class='bi bi-person'></i>
                <span>Meu Perfil</span>
            </a>
        </li>
        <li>
            <hr class='dropdown-divider'>
        </li>

        <li>
            <a class='dropdown-item d-flex align-items-center' href='cadastrarUsuario.php'>
                <i class='bi bi-gear'></i>
                <span>Cadastrar Usuário</span>
            </a>
        </li>
        <li>
            <hr class='dropdown-divider'>
        </li>

        <li>
            <a class='dropdown-item d-flex align-items-center' href='controladores/SairSessao.php'>
                <i class='bi bi-box-arrow-right'></i>
                <span>Sair</span>
            </a>
        </li>

        
    </ul><!-- End Profile Dropdown Items -->
</li>";

}

function logoBar(){

    print "<div class='d-flex align-items-center justify-content-between'>
    <a href='dashboard.php' class='logo d-flex align-items-center'>
        <img src='assets/img/logo_.png' alt='' height='300px'>
        <img src='assets/img/medical_control_no.png' alt='' height='300px'>
    </a>
    <i class='bi bi-list toggle-sidebar-btn'></i>
</div>";


}


function sideBar(){

    print "<ul class='sidebar-nav' id='sidebar-nav'>
                <li class='nav-item'>
                    <a class='nav-link collapsed' href='dashboard.php'>
                        <i class='bi bi-grid'></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <ul id='components-nav' class='nav-content collapse' data-bs-parent='#sidebar-nav'></ul>
                </li>

                <li class='nav-item'>
                    <a class='nav-link collapsed' href='cadastraVeiculo.php'>
                        <i class='bx bxs-car'></i>
                        Cadastrar Veículo
                    </a>
                </li>

                <li class='nav-item'>
                    <a class='nav-link collapsed' href='registrarRotas.php'>
                        <i class='bx bx-directions'></i>
                        Registrar Rotas
                    </a>
                </li>

                <li class='nav-item'>
                    <a class='nav-link collapsed' href='relatorios.php'>
                        <i class='bx bx-copy-alt'></i>
                        Relatórios
                    </a>
                </li>

                <li class='nav-item'>
                    <a class='nav-link collapsed' href='controladores/SairSessao.php'>
                        <i class='bi bi-box-arrow-right'></i>
                        Sair
                    </a>
                </li>

                
            </ul>";

}



function sideBarUsuario(){


    print"<ul class='sidebar-nav' id='sidebar-nav'>
                <li class='nav-item'>
                    <a class='nav-link collapsed' href='dashboardUsuario.php'>
                        <i class='bi bi-grid'></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class='nav-item'>
                    <a class='nav-link collapsed' href='saidaMedicamentos.php'>
                        <i class='bx bxs-capsule'></i>
                        <span>Saída de Medicamentos</span>
                    </a>
                </li>

                <li class='nav-item'>
                    <a class='nav-link collapsed' href='SairSessao.php'>
                        <i class='bi bi-box-arrow-right'></i>
                        <span>Sair</span>
                    </a>
                </li>
           
            </ul>";




}

function PerfilUsuario() {

    print "<li class='nav-item dropdown pe-3'>
    <a class='nav-link nav-profile d-flex align-items-center pe-0' href='#' data-bs-toggle='dropdown'>
         <!-- <img src='assets/img/profile-img.jpg' alt='Profile' class='rounded-circle'> --> 
        <span class='d-none d-md-block dropdown-toggle ps-2'>" . $_SESSION['nome_usuario'] . "</span>
    </a><!-- End Profile Iamge Icon -->

    <ul class='dropdown-menu dropdown-menu-end dropdown-menu-arrow profile'>
        <li class='dropdown-header'>
            <h6>" . $_SESSION['nome_usuario'] . " </h6>
            <span>Usuário</span>
        </li>
        <li>
            <hr class='dropdown-divider'>
        </li>

        <li>
            <a class='dropdown-item d-flex align-items-center' href='perfil.php'>
                <i class='bi bi-person'></i>
                <span>Meu Perfil</span>
            </a>
        </li>
        <li>
            <hr class='dropdown-divider'>
        </li>

        <li>
            <a class='dropdown-item d-flex align-items-center' href='SairSessao.php'>
                <i class='bi bi-box-arrow-right'></i>
                <span>Sair</span>
            </a>
        </li>

        
    </ul><!-- End Profile Dropdown Items -->
</li>";

}


?>