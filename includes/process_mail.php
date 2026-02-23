<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Get Form Data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject_type = htmlspecialchars($_POST['inquiry_type']);
    $message = htmlspecialchars($_POST['message']);

    // 2. Set Your Receiving Email
    $to = "contact@lexoratech.com"; 
    $subject = "New Lexora Inquiry: " . $subject_type;

    // 3. Create Custom HTML Email Template
    $htmlContent = "
    <html>
<head>
    <style>
        /* Base Reset */
        body, table, td, div, p, a {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: #f8fafc;
        }
        body {
            background-color: #09090b;
            margin: 0;
            padding: 40px 20px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }
        /* Container */
        .wrapper {
            width: 100%;
            background-color: #09090b;
        }
        .main-card {
            max-width: 600px;
            margin: 0 auto;
            background-color: #18181b;
            border: 1px solid #27272a;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }
        /* Gradient Header */
        .header {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            padding: 35px 40px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            color: #ffffff;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .header p {
            margin: 8px 0 0 0;
            color: rgba(255, 255, 255, 0.85);
            font-size: 15px;
        }
        /* Body Content */
        .content {
            padding: 40px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-top: 0;
            margin-bottom: 25px;
            color: #ffffff;
            border-bottom: 1px solid #27272a;
            padding-bottom: 15px;
        }
        /* Data Grid */
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .details-table td {
            padding: 14px 0;
            border-bottom: 1px dashed #27272a;
        }
        .details-table tr:last-child td {
            border-bottom: none;
        }
        .label {
            color: #94a3b8;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            width: 35%;
            vertical-align: top;
        }
        .value {
            color: #f8fafc;
            font-size: 15px;
            font-weight: 500;
        }
        .value a {
            color: #6366f1;
            text-decoration: none;
        }
        /* Message Block */
        .message-wrap {
            background-color: #0f0f11;
            border-left: 4px solid #6366f1;
            border-radius: 8px;
            padding: 24px;
            margin-top: 10px;
        }
        .message-label {
            color: #94a3b8;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 12px;
            display: block;
        }
        .message-text {
            color: #e2e8f0;
            font-size: 15px;
            white-space: pre-wrap;
            margin: 0;
        }
        /* Button Area */
        .action-area {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 10px;
        }
        /* Footer */
        .footer {
            padding: 24px 40px;
            background-color: #121214;
            text-align: center;
            border-top: 1px solid #27272a;
        }
        .footer p {
            margin: 0;
            color: #64748b;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class='wrapper'>
        <div class='main-card'>
            
            <div class='header'>
                <h2>Lexora Workspace</h2>
                <p>New Support Request</p>
            </div>

            <div class='content'>
                <p class='greeting'>You have received a new message.</p>
                
                <table class='details-table'>
                    <tr>
                        <td class='label'>Name</td>
                        <td class='value'><strong>$name</strong></td>
                    </tr>
                    <tr>
                        <td class='label'>Email</td>
                        <td class='value'><a href='mailto:$email'>$email</a></td>
                    </tr>
                    <tr>
                        <td class='label'>Inquiry Type</td>
                        <td class='value'>
                            <span style='background-color: #3b82f6; color: #ffffff; padding: 4px 10px; border-radius: 50px; font-size: 12px;'>
                                $subject_type
                            </span>
                        </td>
                    </tr>
                </table>

                <div class='message-wrap'>
                    <span class='message-label'>Message Content</span>
                    <p class='message-text'>$message</p>
                </div>

                <div class='action-area'>
                    <a href='mailto:$email?subject=Re:%20$subject_type' style='background-color: #6366f1; color: #ffffff; text-decoration: none; padding: 14px 32px; border-radius: 8px; font-size: 16px; font-weight: 600; display: inline-block; letter-spacing: 0.5px;'>
                        Reply to $name
                    </a>
                </div>

            </div>

            <div class='footer'>
                <p>This is an automated notification from LexoraTech.</p>
                <p>Clicking the button above will draft a direct response to the user.</p>
            </div>

        </div>
    </div>
</body>
</html>
    ";

    // 4. Set Headers to allow HTML
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Lexora Website <noreply@lexoratech.com>" . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";

    // 5. Send Email and Redirect
    if(mail($to, $subject, $htmlContent, $headers)) {
        header("Location: contact.php?success=true");
        exit;
    } else {
        echo "Error sending message.";
    }
}
?>