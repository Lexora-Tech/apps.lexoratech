<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team | Lexora Workspace</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/team.css">
    <link rel="icon" href="assets/logo/logo.png" />
</head>

<body>

    <div class="background-wrapper">
        <div class="mesh-gradient"></div>
        <div class="grid-overlay"></div>
        <div class="gradient-sphere sphere-1"></div>
        <div class="gradient-sphere sphere-2"></div>
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
                    <a href="analytics.php" class="nav-item">
                        <div class="nav-icon-wrapper"><i class="fas fa-chart-bar"></i></div>
                        <span class="nav-label">Analytics</span>
                    </a>
                    <a href="#" class="nav-item active">
                        <div class="nav-icon-wrapper"><i class="fas fa-users"></i></div>
                        <span class="nav-label">Team</span>
                        <div class="nav-glow"></div>
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
                        <div class="avatar"><span>LT</span>
                            <div class="avatar-ring"></div>
                        </div>
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
                            <span class="breadcrumb-item active">Team Directory</span>
                        </div>
                        <h1 class="workspace-title">Our People</h1>
                    </div>
                    <div class="header-right">
                        <div class="search-wrapper">
                            <div class="search-container">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" id="memberSearch" placeholder="Find member..." class="search-input">
                            </div>
                        </div>
                        <button class="header-btn" title="Add Member">
                            <i class="fas fa-user-plus"></i>
                            <div class="btn-glow"></div>
                        </button>
                    </div>
                </div>
            </header>

            <div class="content-area">

                <div class="team-toolbar">
                    <div class="filter-tabs">
                        <button class="tab-btn active" data-filter="all">All Members</button>
                        <button class="tab-btn" data-filter="engineering">Engineering</button>
                        <button class="tab-btn" data-filter="design">Design</button>
                        <button class="tab-btn" data-filter="marketing">Marketing</button>
                    </div>
                    <div class="team-stats">
                        <span class="stat-pill"><i class="fas fa-circle text-green"></i> 12 Online</span>
                        <span class="stat-pill">24 Total</span>
                    </div>
                </div>

                <div class="team-grid">

                    <div class="member-card" data-dept="engineering">
                        <div class="card-glass"></div>
                        <div class="member-header">
                            <div class="avatar-wrapper">
                                <img src="https://i.pravatar.cc/150?u=1" alt="Alex">
                                <span class="status-indicator online"></span>
                            </div>
                            <button class="options-btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="member-info">
                            <h3>Alex Morgan</h3>
                            <span class="role">Senior Developer</span>
                            <div class="dept-badge purple">Engineering</div>
                        </div>
                        <div class="member-stats">
                            <div class="stat">
                                <strong>12</strong>
                                <span>Projects</span>
                            </div>
                            <div class="stat">
                                <strong>98%</strong>
                                <span>Commit Rate</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <button class="icon-btn"><i class="fas fa-envelope"></i></button>
                            <button class="icon-btn"><i class="fab fa-github"></i></button>
                            <a href="#" class="profile-link">View Profile <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="member-card" data-dept="design">
                        <div class="card-glass"></div>
                        <div class="member-header">
                            <div class="avatar-wrapper">
                                <img src="https://i.pravatar.cc/150?u=2" alt="Sarah">
                                <span class="status-indicator busy"></span>
                            </div>
                            <button class="options-btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="member-info">
                            <h3>Sarah Jenkins</h3>
                            <span class="role">Product Designer</span>
                            <div class="dept-badge pink">Design</div>
                        </div>
                        <div class="member-stats">
                            <div class="stat">
                                <strong>8</strong>
                                <span>Projects</span>
                            </div>
                            <div class="stat">
                                <strong>4.9</strong>
                                <span>Rating</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <button class="icon-btn"><i class="fas fa-envelope"></i></button>
                            <button class="icon-btn"><i class="fab fa-dribbble"></i></button>
                            <a href="#" class="profile-link">View Profile <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="member-card" data-dept="engineering">
                        <div class="card-glass"></div>
                        <div class="member-header">
                            <div class="avatar-wrapper">
                                <img src="https://i.pravatar.cc/150?u=3" alt="Michael">
                                <span class="status-indicator online"></span>
                            </div>
                            <button class="options-btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="member-info">
                            <h3>Michael Chen</h3>
                            <span class="role">Backend Engineer</span>
                            <div class="dept-badge purple">Engineering</div>
                        </div>
                        <div class="member-stats">
                            <div class="stat">
                                <strong>15</strong>
                                <span>Projects</span>
                            </div>
                            <div class="stat">
                                <strong>100%</strong>
                                <span>Uptime</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <button class="icon-btn"><i class="fas fa-envelope"></i></button>
                            <button class="icon-btn"><i class="fab fa-github"></i></button>
                            <a href="#" class="profile-link">View Profile <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="member-card" data-dept="marketing">
                        <div class="card-glass"></div>
                        <div class="member-header">
                            <div class="avatar-wrapper">
                                <img src="https://i.pravatar.cc/150?u=4" alt="Emily">
                                <span class="status-indicator offline"></span>
                            </div>
                            <button class="options-btn"><i class="fas fa-ellipsis-v"></i></button>
                        </div>
                        <div class="member-info">
                            <h3>Emily Davis</h3>
                            <span class="role">Marketing Lead</span>
                            <div class="dept-badge orange">Marketing</div>
                        </div>
                        <div class="member-stats">
                            <div class="stat">
                                <strong>5</strong>
                                <span>Campaigns</span>
                            </div>
                            <div class="stat">
                                <strong>12k</strong>
                                <span>Reach</span>
                            </div>
                        </div>
                        <div class="card-actions">
                            <button class="icon-btn"><i class="fas fa-envelope"></i></button>
                            <button class="icon-btn"><i class="fab fa-twitter"></i></button>
                            <a href="#" class="profile-link">View Profile <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>

                    <div class="member-card add-new-card">
                        <div class="add-content">
                            <div class="add-icon"><i class="fas fa-plus"></i></div>
                            <h3>Invite Member</h3>
                            <p>Send an email invitation to join the workspace.</p>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <script src="./js/team.js"></script>
    <script src="./js/index.js"></script>
</body>

</html>

