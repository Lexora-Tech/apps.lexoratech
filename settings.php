<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | Lexora Workspace</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/settings.css">
    <link rel="icon" href="assets/logo/logo.png" />
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
                    <a href="analytics.php" class="nav-item">
                        <div class="nav-icon-wrapper"><i class="fas fa-chart-bar"></i></div>
                        <span class="nav-label">Analytics</span>
                    </a>
                    <a href="team.php" class="nav-item">
                        <div class="nav-icon-wrapper"><i class="fas fa-users"></i></div>
                        <span class="nav-label">Team</span>
                    </a>
                </nav>

                <div class="sidebar-spacer"></div>

                <div class="sidebar-footer">
                    <a href="#" class="nav-item active">
                        <div class="nav-icon-wrapper"><i class="fas fa-cog"></i></div>
                        <span class="nav-label">Settings</span>
                        <div class="nav-glow"></div>
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
                            <span class="breadcrumb-item active">Settings</span>
                        </div>
                        <h1 class="workspace-title">Preferences</h1>
                    </div>
                    <div class="header-right">
                        <button class="btn-secondary" id="discardBtn">Discard</button>
                        <button class="btn-primary" id="saveBtn">
                            <i class="fas fa-save"></i>
                            <span>Save Changes</span>
                        </button>
                    </div>
                </div>
            </header>

            <div class="content-area settings-layout">

                <aside class="settings-nav">
                    <div class="nav-group">
                        <span class="group-label">Account</span>
                        <button class="set-link active" data-tab="profile"><i class="far fa-user"></i> Profile</button>
                        <button class="set-link" data-tab="security"><i class="fas fa-shield-alt"></i> Security</button>
                        <button class="set-link" data-tab="billing"><i class="far fa-credit-card"></i> Billing</button>
                    </div>
                    <div class="nav-group">
                        <span class="group-label">System</span>
                        <button class="set-link" data-tab="notifications"><i class="far fa-bell"></i> Notifications</button>
                        <button class="set-link" data-tab="integrations"><i class="fas fa-plug"></i> Integrations</button>
                    </div>
                </aside>

                <div class="settings-content">

                    <div class="setting-panel active" id="profile">
                        <div class="panel-header">
                            <h2>Public Profile</h2>
                            <p>Manage how you appear to other team members.</p>
                        </div>

                        <div class="form-section">
                            <div class="avatar-upload">
                                <div class="avatar-preview">
                                    <img src="./assets/logo/logo.png" id="avatarImg" alt="Avatar">
                                    <div class="avatar-overlay">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                    <input type="file" id="avatarInput" hidden accept="image/*">
                                </div>
                                <div class="upload-text">
                                    <h4>Profile Photo</h4>
                                    <p>Recommended 400x400px. JPG or PNG.</p>
                                    <button class="btn-small" onclick="document.getElementById('avatarInput').click()">Upload New</button>
                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="input-group full">
                                    <label>Display Name</label>
                                    <input type="text" value="Lexora Admin" class="form-input">
                                </div>
                                <div class="input-group">
                                    <label>Username</label>
                                    <input type="text" value="@lexora" class="form-input">
                                </div>
                                <div class="input-group">
                                    <label>Email Address</label>
                                    <input type="email" value="admin@lexoratech.com" class="form-input">
                                </div>
                                <div class="input-group full">
                                    <label>Bio</label>
                                    <textarea class="form-input" rows="3">Building the future of creative tools.</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="setting-panel" id="security">
                        <div class="panel-header">
                            <h2>Security & Login</h2>
                            <p>Manage your password and 2-step verification preferences.</p>
                        </div>

                        <div class="form-section">
                            <div class="toggle-row">
                                <div class="toggle-info">
                                    <h4>Two-Factor Authentication</h4>
                                    <p>Add an extra layer of security to your account.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <div class="divider"></div>

                            <div class="input-group full">
                                <label>Current Password</label>
                                <input type="password" placeholder="••••••••" class="form-input">
                            </div>
                            <div class="form-grid">
                                <div class="input-group">
                                    <label>New Password</label>
                                    <input type="password" class="form-input">
                                </div>
                                <div class="input-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-input">
                                </div>
                            </div>
                            <button class="btn-secondary" style="margin-top: 15px;">Update Password</button>
                        </div>

                        <div class="danger-zone">
                            <h3>Danger Zone</h3>
                            <div class="danger-row">
                                <div class="danger-info">
                                    <h4>Delete Account</h4>
                                    <p>Permanently remove your account and all of its contents.</p>
                                </div>
                                <button class="btn-danger">Delete Account</button>
                            </div>
                        </div>
                    </div>

                    <div class="setting-panel" id="notifications">
                        <div class="panel-header">
                            <h2>Notifications</h2>
                            <p>Choose what we get in touch about.</p>
                        </div>

                        <div class="form-section">
                            <div class="toggle-row">
                                <div class="toggle-info">
                                    <h4>Email Updates</h4>
                                    <p>Receive weekly digest and feature updates.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="divider"></div>
                            <div class="toggle-row">
                                <div class="toggle-info">
                                    <h4>Project Activity</h4>
                                    <p>Notify me when a team member updates a project.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="divider"></div>
                            <div class="toggle-row">
                                <div class="toggle-info">
                                    <h4>Security Alerts</h4>
                                    <p>Notify me about unusual login activity.</p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <script src="./js/settings.js"></script>
    <script src="./js/index.js"></script>
</body>

</html>