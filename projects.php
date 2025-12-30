<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects | Lexora Workspace</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/projects.css">
    <link rel="icon" href="assets/logo/logo.png" />
</head>

<body>

    <div class="background-wrapper">
        <div class="mesh-gradient"></div>
        <div class="grid-overlay"></div>
        <div class="gradient-sphere sphere-1"></div>
        <div class="gradient-sphere sphere-2"></div>
    </div>

    <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
        <i class="fas fa-bars"></i>
    </button>

    <div class="app-container">

        <aside class="sidebar" id="sidebar">
            <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
            <div class="sidebar-content">
                <div class="sidebar-header">
                    <div class="logo-container" style="margin-left: 70px; margin-top: -14px;">
                        <img src="./assets/logo/logo2.png" alt="Lexora Logo" class="logo-img">
                        <div class="logo-glow"></div>
                    </div>
                    <button class="close-sidebar" id="closeSidebar"><i class="fas fa-times"></i></button>
                </div>

                <nav class="nav-menu">
                    <a href="index.php" class="nav-item">
                        <div class="nav-icon-wrapper"><i class="fas fa-th-large"></i></div>
                        <span class="nav-label">Dashboard</span>
                        <div class="nav-glow"></div>
                    </a>
                    <a href="projects.php" class="nav-item active">
                        <div class="nav-icon-wrapper"><i class="fas fa-folder-open"></i></div>
                        <span class="nav-label">Projects</span>
                        <div class="nav-glow"></div>
                    </a>
                   <!--  <a href="analytics.php" class="nav-item">
                        <div class="nav-icon-wrapper"><i class="fas fa-chart-bar"></i></div>
                        <span class="nav-label">Analytics</span>
                        <div class="nav-glow"></div>
                    </a>
                    <a href="team.php" class="nav-item">
                        <div class="nav-icon-wrapper"><i class="fas fa-users"></i></div>
                        <span class="nav-label">Team</span>
                        <div class="nav-glow"></div>
                    </a> -->
                </nav>

                <div class="sidebar-spacer"></div>

                <div class="sidebar-footer">
                   <!--  <a href="settings.php" class="nav-item">
                        <div class="nav-icon-wrapper"><i class="fas fa-cog"></i></div>
                        <span class="nav-label">Settings</span>
                        <div class="nav-glow"></div>
                    </a> -->
                    <div class="divider-line"></div>
                    <a href="https://lexoratech.com" class="nav-item external-link" data-tooltip="Visit Website" target="_blank">
                        <div class="nav-icon-wrapper"><i class="fas fa-external-link-alt"></i></div>
                        <span class="nav-label">Website</span>
                        <div class="nav-glow"></div>
                    </a>
                  <!--   <div class="user-profile">
                        <div class="avatar">
                            <span>LT</span>
                            <div class="avatar-ring"></div>
                        </div>
                        <div class="user-info">
                            <span class="user-name">Lexora</span>
                        </div>
                        <i class="fas fa-chevron-right user-arrow"></i>
                    </div> -->
                </div>
            </div>
        </aside>

        <main class="main-area">

            <header class="top-header">
                <div class="header-glass"></div>
                <div class="header-content">
                    <div class="header-left">
                        <div class="breadcrumb">
                            <span class="breadcrumb-item">Workspace</span>
                            <i class="fas fa-chevron-right breadcrumb-separator"></i>
                            <span class="breadcrumb-item active">Projects</span>
                        </div>
                        <h1 class="workspace-title">Project Manager</h1>
                    </div>
                    <div class="header-right">
                        <div class="search-wrapper">
                            <div class="search-container">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" id="projectSearch" placeholder="Search projects..." class="search-input">
                            </div>
                        </div>
                        <button class="header-btn" id="newProjectBtn" title="New Project">
                            <i class="fas fa-plus"></i>
                            <div class="btn-glow"></div>
                        </button>
                    </div>
                </div>
            </header>

            <div class="content-area">

                <section class="stats-grid">
                    <div class="stat-box">
                        <div class="stat-icon purple-bg"><i class="fas fa-rocket"></i></div>
                        <div class="stat-info">
                            <span class="stat-num">12</span>
                            <span class="stat-lbl">Active</span>
                        </div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-icon green-bg"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-info">
                            <span class="stat-num">24</span>
                            <span class="stat-lbl">Completed</span>
                        </div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-icon orange-bg"><i class="fas fa-clock"></i></div>
                        <div class="stat-info">
                            <span class="stat-num">5</span>
                            <span class="stat-lbl">Pending</span>
                        </div>
                    </div>
                </section>

                <div class="filter-bar">
                    <button class="filter-tab active" data-filter="all">All Projects</button>
                    <button class="filter-tab" data-filter="in-progress">In Progress</button>
                    <button class="filter-tab" data-filter="completed">Done</button>
                    <button class="filter-tab" data-filter="on-hold">On Hold</button>
                </div>

                <div class="projects-grid" id="projectsContainer">

                    <div class="project-card" data-status="in-progress">
                        <div class="card-glass"></div>
                        <div class="card-top">
                            <div class="p-icon pink-gradient"><i class="fas fa-layer-group"></i></div>
                            <span class="status-pill active">In Progress</span>
                        </div>
                        <div class="card-body">
                            <h3>Lexora Dashboard V2</h3>
                            <p>Redesigning the main dashboard with glassmorphism and bento grids.</p>
                            <div class="meta-tags">
                                <span class="tag">UI/UX</span>
                                <span class="tag">Frontend</span>
                            </div>
                            <div class="progress-wrapper">
                                <div class="progress-labels"><span>Progress</span><span>75%</span></div>
                                <div class="progress-track">
                                    <div class="progress-fill pink-fill" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="team-avatars">
                                <img src="https://i.pravatar.cc/150?u=1" alt="">
                                <img src="https://i.pravatar.cc/150?u=2" alt="">
                                <span class="more-count">+2</span>
                            </div>
                            <div class="due-date"><i class="far fa-clock"></i> 2 Days Left</div>
                        </div>
                    </div>

                    <div class="project-card" data-status="in-progress">
                        <div class="card-glass"></div>
                        <div class="card-top">
                            <div class="p-icon blue-gradient"><i class="fas fa-mobile-alt"></i></div>
                            <span class="status-pill active">In Progress</span>
                        </div>
                        <div class="card-body">
                            <h3>Mobile App MVP</h3>
                            <p>Native iOS and Android application for remote management.</p>
                            <div class="meta-tags"><span class="tag">Mobile</span><span class="tag">Flutter</span></div>
                            <div class="progress-wrapper">
                                <div class="progress-labels"><span>Progress</span><span>40%</span></div>
                                <div class="progress-track">
                                    <div class="progress-fill blue-fill" style="width: 40%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="team-avatars"><img src="https://i.pravatar.cc/150?u=3" alt=""></div>
                            <div class="due-date warning">Nov 12</div>
                        </div>
                    </div>

                    <div class="project-card" data-status="completed">
                        <div class="card-glass"></div>
                        <div class="card-top">
                            <div class="p-icon green-gradient"><i class="fas fa-server"></i></div>
                            <span class="status-pill done">Completed</span>
                        </div>
                        <div class="card-body">
                            <h3>Server Migration</h3>
                            <p>Successfully migrated all legacy databases to PostgreSQL.</p>
                            <div class="meta-tags"><span class="tag">DevOps</span></div>
                            <div class="progress-wrapper">
                                <div class="progress-labels"><span>Progress</span><span>100%</span></div>
                                <div class="progress-track">
                                    <div class="progress-fill green-fill" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="team-avatars">
                                <img src="https://i.pravatar.cc/150?u=4" alt="">
                                <img src="https://i.pravatar.cc/150?u=5" alt="">
                            </div>
                            <div class="due-date"><i class="fas fa-check"></i> Done</div>
                        </div>
                    </div>

                    <div class="project-card" data-status="on-hold">
                        <div class="card-glass"></div>
                        <div class="card-top">
                            <div class="p-icon orange-gradient"><i class="fas fa-paint-brush"></i></div>
                            <span class="status-pill hold">On Hold</span>
                        </div>
                        <div class="card-body">
                            <h3>Brand Refresh</h3>
                            <p>New logo, typography, and color palette guidelines.</p>
                            <div class="meta-tags"><span class="tag">Design</span></div>
                            <div class="progress-wrapper">
                                <div class="progress-labels"><span>Progress</span><span>20%</span></div>
                                <div class="progress-track">
                                    <div class="progress-fill orange-fill" style="width: 20%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="team-avatars"><img src="https://i.pravatar.cc/150?u=6" alt=""></div>
                            <div class="due-date">Paused</div>
                        </div>
                    </div>

                </div>
            </div>

            <?php include 'footer.php'; ?>

        </main>

    </div>

    <script src="./js/projects.js"></script>
    <script src="./js/index.js"></script>
</body>

</html>