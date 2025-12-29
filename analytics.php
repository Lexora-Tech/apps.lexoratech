<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics | Lexora Workspace</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/index.css"> <link rel="stylesheet" href="./css/analytics.css"> <link rel="icon" href="assets/logo/logo.png" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="background-wrapper">
        <div class="mesh-gradient"></div>
        <div class="grid-overlay"></div>
    </div>

    <button class="mobile-menu-toggle" id="mobileMenuToggle"><i class="fas fa-bars"></i></button>

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
                    </a>
                    <a href="projects.php" class="nav-item">
                        <div class="nav-icon-wrapper"><i class="fas fa-folder-open"></i></div>
                        <span class="nav-label">Projects</span>
                    </a>
                    <a href="#" class="nav-item active">
                        <div class="nav-icon-wrapper"><i class="fas fa-chart-bar"></i></div>
                        <span class="nav-label">Analytics</span>
                        <div class="nav-glow"></div>
                    </a>
                    <a href="team.php" class="nav-item">
                        <div class="nav-icon-wrapper"><i class="fas fa-users"></i></div>
                        <span class="nav-label">Team</span>
                    </a>
                </nav>

                <div class="sidebar-spacer"></div>

                <div class="sidebar-footer">
                    <a href="settings.php" class="nav-item">
                        <div class="nav-icon-wrapper"><i class="fas fa-cog"></i></div>
                        <span class="nav-label">Settings</span>
                    </a>
                    <div class="divider-line"></div>
                    <div class="user-profile">
                        <div class="avatar"><span>LT</span><div class="avatar-ring"></div></div>
                        <div class="user-info"><span class="user-name">Lexora</span><span class="user-role">Admin</span></div>
                    </div>
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
                            <span class="breadcrumb-item active">Analytics</span>
                        </div>
                        <h1 class="workspace-title">Data Overview</h1>
                    </div>
                    <div class="header-right">
                        <div class="date-range-picker">
                            <i class="far fa-calendar-alt"></i>
                            <span>Last 30 Days</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <button class="header-btn" title="Download Report">
                            <i class="fas fa-download"></i>
                            <div class="btn-glow"></div>
                        </button>
                    </div>
                </div>
            </header>

            <div class="content-area">

                <section class="kpi-grid">
                    <div class="kpi-card">
                        <div class="kpi-header">
                            <div class="icon-box purple"><i class="fas fa-eye"></i></div>
                            <span class="trend up">+12.5% <i class="fas fa-arrow-up"></i></span>
                        </div>
                        <div class="kpi-body">
                            <h3>Total Views</h3>
                            <span class="value counter" data-target="45231">0</span>
                        </div>
                        <div class="kpi-chart-mini">
                            <canvas id="miniChart1"></canvas>
                        </div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-header">
                            <div class="icon-box blue"><i class="fas fa-users"></i></div>
                            <span class="trend up">+5.2% <i class="fas fa-arrow-up"></i></span>
                        </div>
                        <div class="kpi-body">
                            <h3>Active Users</h3>
                            <span class="value counter" data-target="1240">0</span>
                        </div>
                        <div class="kpi-chart-mini">
                            <canvas id="miniChart2"></canvas>
                        </div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-header">
                            <div class="icon-box green"><i class="fas fa-check-circle"></i></div>
                            <span class="trend down">-2.1% <i class="fas fa-arrow-down"></i></span>
                        </div>
                        <div class="kpi-body">
                            <h3>Conversions</h3>
                            <span class="value counter" data-target="892">0</span>
                        </div>
                        <div class="kpi-chart-mini">
                            <canvas id="miniChart3"></canvas>
                        </div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-header">
                            <div class="icon-box orange"><i class="fas fa-dollar-sign"></i></div>
                            <span class="trend up">+8.4% <i class="fas fa-arrow-up"></i></span>
                        </div>
                        <div class="kpi-body">
                            <h3>Revenue</h3>
                            <span class="value">$<span class="counter" data-target="12500">0</span></span>
                        </div>
                        <div class="kpi-chart-mini">
                            <canvas id="miniChart4"></canvas>
                        </div>
                    </div>
                </section>

                <section class="charts-section">
                    
                    <div class="chart-card large">
                        <div class="card-header">
                            <h3>Traffic Overview</h3>
                            <div class="card-actions">
                                <button class="chart-tab active">Traffic</button>
                                <button class="chart-tab">Sessions</button>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="mainTrafficChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-card small">
                        <div class="card-header">
                            <h3>Device Usage</h3>
                            <button class="more-btn"><i class="fas fa-ellipsis-h"></i></button>
                        </div>
                        <div class="chart-wrapper doughnut-wrapper">
                            <canvas id="deviceChart"></canvas>
                            <div class="doughnut-center">
                                <span>Total</span>
                                <strong>100%</strong>
                            </div>
                        </div>
                        <div class="chart-legend">
                            <div class="legend-item"><span class="dot purple"></span> Desktop (65%)</div>
                            <div class="legend-item"><span class="dot blue"></span> Mobile (25%)</div>
                            <div class="legend-item"><span class="dot green"></span> Tablet (10%)</div>
                        </div>
                    </div>

                </section>

                <section class="table-section">
                    <div class="table-card">
                        <div class="card-header">
                            <h3>Recent Activity</h3>
                            <button class="view-all-btn">View All</button>
                        </div>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Action</th>
                                        <th>Project</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="user-cell">
                                                <img src="https://i.pravatar.cc/150?u=1" alt="">
                                                <span>Alex Morgan</span>
                                            </div>
                                        </td>
                                        <td>Updated Homepage</td>
                                        <td>Lexora Web</td>
                                        <td>2 mins ago</td>
                                        <td><span class="status-pill success">Success</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="user-cell">
                                                <img src="https://i.pravatar.cc/150?u=2" alt="">
                                                <span>Sarah Jenkins</span>
                                            </div>
                                        </td>
                                        <td>Deployed API v2</td>
                                        <td>Backend Ops</td>
                                        <td>15 mins ago</td>
                                        <td><span class="status-pill warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="user-cell">
                                                <img src="https://i.pravatar.cc/150?u=3" alt="">
                                                <span>Michael Chen</span>
                                            </div>
                                        </td>
                                        <td>Fixed Login Bug</td>
                                        <td>Mobile App</td>
                                        <td>1 hour ago</td>
                                        <td><span class="status-pill success">Success</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div>
        </main>
    </div>

    <script src="./js/analytics.js"></script>
    <script src="./js/index.js"></script> </body>
</html>