<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
    exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css"/>
    <link rel="stylesheet" href="assets/tasks.css">
    <title>Tasks - WorkBY</title>
</head>
<body>
    <div class="right-taskbar">
        <div class="logo">
            <i class="bx bx-business"></i>
            <span class="logo-nome">WorkBY</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="inicial.php">
                    <i class="bx bx-grid"></i>
                    <span class="link-nome">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-nome" href="#">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <a href="categorias.php">
                    <i class="bx bx-album-covers"></i>
                    <span class="link-nome">Categorias</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-nome" href="#">Categorias</a></li>
                </ul>
            </li>
            <li class="selected">
                <a href="#">
                    <i class="bx bx-check"></i>
                    <span class="link-nome">Tasks</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a href="#">Tasks</a></li>
                </ul>
            </li>
            <li>
                <a href="importante.php">
                    <i class="bx bx-cog"></i>
                    <span class="link-nome">Configurações</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a href="#">Configurações</a></li>
                </ul>
            </li>
            <li>
                <div class="details-perfil">
                    <div class="perfil-content">
                        <img src="images/foto-perfil.jpg" alt="">
                    </div>
                    <div class="nome-job">
                        <div class="nome-perfil"><?= $_SESSION['usuario'] ?></div>
                        <div class="funcao">Suporte</div>
                    </div>
                    <a href="logout.php"><i class="bx bx-arrow-out-left-square-half"></i></a>
                </div>
            </li>
        </ul>
    </div>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
        <section class="home-section">
            <div class="home-content">
                <i class="bx bx-menu"></i>
                <span class="text"></span>
            </div>
    </div>



    <script src="assets/inicial.js">
    </script>
</body>
</html>