<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Lexora Workspace | Feedback</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./css/suggestion.css">
    <link rel="icon" href="../assets/logo/logo.png" />
</head>
<body>

    <div class="grid-bg"></div>
    <div class="vignette"></div>

    <header class="mobile-header">
        <a href="../teleprompter/teleprompter.php" class="back-btn"><i class="fas fa-chevron-left"></i> Back</a>
        <span class="page-title">Feedback</span>
        <div class="placeholder"></div> </header>

    <div class="app-shell">
        
        <aside class="sidebar">
            <a href="" class="logo-box">
                <i class="fas fa-bolt"></i>
            </a>
            <nav class="nav-stack">
                <a href="../index.php" class="nav-link" data-tooltip="Dashboard"><i class="fas fa-th-large"></i></a>
                <div class="sep"></div>
                <a href="#" class="nav-link active"><i class="fas fa-comment-alt"></i></a>
            </nav>
        </aside>

        <main class="content-area">
            
            <div class="form-wrapper">
                
                <div class="header-section">
                    <h1>Submit Feedback</h1>
                    <p>Help us build the best version of Lexora. Found a bug or have a feature request?</p>
                </div>

                <form id="feedbackForm" class="pro-form">
                    
                    <div class="form-section">
                        <label class="label">Feedback Type</label>
                        <div class="grid-select">
                            <label class="select-option">
                                <input type="radio" name="type" value="feature" checked>
                                <span class="option-box">
                                    <i class="fas fa-lightbulb"></i>
                                    <span>Feature</span>
                                </span>
                            </label>
                            <label class="select-option">
                                <input type="radio" name="type" value="bug">
                                <span class="option-box">
                                    <i class="fas fa-bug"></i>
                                    <span>Bug</span>
                                </span>
                            </label>
                            <label class="select-option">
                                <input type="radio" name="type" value="billing">
                                <span class="option-box">
                                    <i class="fas fa-receipt"></i>
                                    <span>Billing</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="form-section">
                        <label for="subject" class="label">Subject</label>
                        <div class="input-group">
                            <input type="text" id="subject" placeholder="Brief summary..." required>
                        </div>
                    </div>

                    <div class="form-section">
                        <label for="description" class="label">Description</label>
                        <div class="input-group">
                            <textarea id="description" rows="6" placeholder="Please include steps to reproduce or details about the feature..." required></textarea>
                        </div>
                    </div>

                    <div class="form-section">
                        <label class="label">Priority Level</label>
                        <div class="priority-slider">
                            <input type="range" min="1" max="3" value="1" id="priorityRange">
                            <div class="range-labels">
                                <span>Low</span>
                                <span>Medium</span>
                                <span>High</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="../teleprompter/teleprompter.php" class="btn-cancel">Cancel</a>
                        <button type="submit" class="btn-submit">
                            <span class="btn-text">Send Feedback</span>
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>

                </form>

            </div>

            <div id="successModal" class="modal-backdrop hidden">
                <div class="modal-content">
                    <div class="success-icon"><i class="fas fa-check"></i></div>
                    <h3>Feedback Sent</h3>
                    <p>Thank you for contributing to Lexora.</p>
                    <button id="closeModal" class="btn-primary">Return</button>
                </div>
            </div>

        </main>
    </div>

    <script src="./js/suggestion.js"></script>
</body>
</html>