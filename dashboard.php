<?php
session_start();

// Check if the user is actually logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, kick them back to the login page
    header("Location: login.html");
    exit();
}

// Get user data from the session (stored during login)
$userName = $_SESSION['user_name'];
$userType = $_SESSION['user_type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account - Link Building</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f4f7fe; padding: 50px; }
        .account-card {
            background: white;
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            text-align: center;
        }
        .user-avatar { font-size: 50px; color: #2d5db1; margin-bottom: 20px; }
        .badge {
            display: inline-block;
            padding: 5px 15px;
            background: #e1ecff;
            color: #2d5db1;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .logout-btn {
            margin-top: 20px;
            display: inline-block;
            color: #ff4d4d;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="account-card">
        <div class="user-avatar">
            <i class="fas fa-user-circle"></i>
        </div>
        <h1>Welcome, <?php echo htmlspecialchars($userName); ?>!</h1>
        <p>You are logged in as a <span class="badge"><?php echo htmlspecialchars($userType); ?></span></p>
        
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        
        <div class="account-actions">
            <p>This is your private account dashboard.</p>
            <?php if($userType == 'provider'): ?>
                <button style="padding: 10px; background: #2d5db1; color: white; border: none; border-radius: 5px;">Post a Service</button>
            <?php else: ?>
                <button style="padding: 10px; background: #28a745; color: white; border: none; border-radius: 5px;">Browse Professionals</button>
            <?php endif; ?>
        </div>

        <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

</body>
</html>