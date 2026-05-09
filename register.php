<?php
// Configuration
$host = '127.0.0.1';
$db   = 'LINK';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Process Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $fullname = trim($_POST['full_name']);
    $email    = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $userType = $_POST['userType']; // 'customer' or 'provider'

    // Simple Validation
    if (empty($fullname) || empty($email) || empty($password)) {
        die("Please fill in all required fields.");
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            die("Email is already registered.");
        }

        // Insert new user
        $sql = "INSERT INTO users (full_name, email, password, user_type) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$fullname, $email, $hashedPassword, $userType])) {
            // Success! Redirect to login page
            header("Location: login.html?status=success");
            exit();
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>