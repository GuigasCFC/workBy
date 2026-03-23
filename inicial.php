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
    <link rel="stylesheet" href="assets/inicial.css">
    <title>Pagina Inicial - WorkBY</title>
</head>
<body>
    <div class="right-taskbar">
        <div class="logo">
            <i class="bx bx-business"></i>
            <span class="logo-nome">WorkBY</span>
        </div>
        <ul class="nav-links">
            <li class="selected">
                <a href="#">
                    <i class="bx bx-grid"></i>
                    <span class="link-nome">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link-nome" href="#">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class="bx bx-album-covers"></i>
                        <span class="link-nome">Categorias</span>
                    </a>
                    <i class="bx bx-chevron-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link-nome" href="#">Categorias</a></li>
                    <li><a href="#">Designadas a mim</a></li>
                    <li><a href="#">Concluídas</a></li>
                    <li><a href="#">Atrasadas</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-check"></i>
                    <span class="link-nome">Tasks</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a href="#">Tasks</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-alert-triangle"></i>
                    <span class="link-nome">Importante</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a href="#">Importante</a></li>
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
        <section>
            <div class="container">
                <div class="progress-icon">
                    <div class="chart" data-size="180" data-value="30" data-arrow="up"></div>
                </div>
                <div class="text-progress">
                    <h1>Atividades</h1>
                    <p>Sua atividades estão acima do esperado, continue assim!</p>
                    <div class="badges-container">
                        <div class="badge-wrap">
                            <div class="wb-badge badge-teal">&#9733; Meta batida</div>
                            <div class="badge-tooltip">Completou 88% das metas esta semana</div>
                        </div>
                        <div class="badge-wrap">
                            <div class="wb-badge badge-purple">&#9889; 7 dias seguidos</div>
                            <div class="badge-tooltip">Ativo por 7 dias consecutivos</div>
                        </div>
                        <div class="badge-wrap">
                            <div class="wb-badge badge-amber">&#9650; Top da semana</div>
                            <div class="badge-tooltip">Entre os 10% melhores da equipe</div>
                        </div>
                        <div class="badge-wrap">
                            <div class="wb-badge badge-locked">&#128274; Mestre do mês</div>
                            <div class="badge-tooltip">Complete 30 dias seguidos para desbloquear</div>
                        </div>
                    </div>
                </div>
                <div class="xp-container">
                    <div class="xp-nivel">8</div>
                    <div class="xp-info">
                        <div class="xp-header">
                            <span class="xp-text">Nível 8</span>
                            <span class="xp-xp">1.240 / 1.500 XP</span>
                        </div>
                        <div class="xp-bar-bg">
                            <div class="xp-bar-fill" style="width: 72%;"></div>
                        </div>
                        <div class="xp-next">Próximo nível em 260 XP</div>
                    </div>
                </div>
            </div>
        </section>
        <div class="tasks-geral">
            <div class="tasks">
            <div class="text-tasks">
                <h1>Suas tasks</h1>
                <p>5 tarefas</p>
            </div>
            <hr class="task-divisor">
            <div class="tarefas">
                <div class="task-item">
                    <div class="task-avatar" style="background:#1e3a5f;color:#60a5fa;">AM</div>
                    <div class="task-info">
                        <div class="task-nome">Revisar relatório</div>
                        <div class="task-due">Vence hoje</div>
                    </div>
                </div>
                <div class="task-item">
                    <div class="task-avatar" style="background:#1f3320;color:#4ade80;">JS</div>
                    <div class="task-info">
                        <div class="task-nome">Atualizar dashboard</div>
                        <div class="task-due">Amanhã</div>
                    </div>
                </div>
                <div class="task-item">
                    <div class="task-avatar" style="background:#3b1f3f;color:#c084fc;">KL</div>
                    <div class="task-info">
                        <div class="task-nome">Reunião com equipe</div>
                        <div class="task-due">18 mar</div>
                    </div>
                    </div>
                <div class="task-item">
                    <div class="task-avatar" style="background:#3f2010;color:#fb923c;">PT</div>
                    <div class="task-info">
                        <div class="task-nome">Documentar API</div>
                        <div class="task-due">20 mar</div>
                    </div>
                </div>
                <div class="task-item">
                    <div class="task-avatar" style="background:#1a2a3a;color:#38bdf8;">GH</div>
                    <div class="task-info">
                        <div class="task-nome">Deploy em staging</div>
                        <div class="task-due">22 mar</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="att-recent">
            <div class="text-tasks">
                <h1>Atividades recentes</h1>
                <p>Hoje</p>
            </div>
            <hr class="task-divisor">
            <div class="stats-row">
                <div class="stat-box">
                    <div class="stat-num" style="color:#4ade80;">12</div>
                    <div class="stat-lbl">Concluídas</div>
                </div>
                <div class="stat-box">
                    <div class="stat-num" style="color:#f87171;">3</div>
                    <div class="stat-lbl">Atrasadas</div>
                </div>
                <div class="stat-box">
                    <div class="stat-num" style="color:#fbbf24;">7</div>
                    <div class="stat-lbl">Em andamento</div>
                </div>
            </div>
            <hr class="task-divisor">
            <div class="feed">
                <div class="feed-item">
                    <div class="feed-dot" style="background:#4ade80;"></div>
                    <div>
                        <div class="feed-text"><span class="feed-nome">João</span> concluiu "Revisar relatório"</div>
                        <div class="feed-time">há 5 min</div>
                    </div>
                </div>
                <div class="feed-item">
                    <div class="feed-dot" style="background:#60a5fa;"></div>
                    <div>
                        <div class="feed-text"><span class="feed-nome">Ana</span> criou nova tarefa "Deploy v2"</div>
                        <div class="feed-time">há 22 min</div>
                    </div>
                </div>
                <div class="feed-item">
                    <div class="feed-dot" style="background:#f87171;"></div>
                    <div>
                        <div class="feed-text"><span class="feed-nome">Pedro</span> atrasou "Documentar API"</div>
                        <div class="feed-time">há 1h</div>
                    </div>
                </div>
                <div class="feed-item">
                    <div class="feed-dot" style="background:#c084fc;"></div>
                    <div>
                        <div class="feed-text"><span class="feed-nome">Karen</span> comentou em "Reunião"</div>
                        <div class="feed-time">há 2h</div>
                    </div>
                </div>
                <div class="feed-item">
                    <div class="feed-dot" style="background:#fbbf24;"></div>
                    <div>
                        <div class="feed-text"><span class="feed-nome">Gui</span> subiu de nível 7 → 8</div>
                        <div class="feed-time">hoje cedo</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    
    
    <script src="assets/inicial.js"></script>
</body>
</html>