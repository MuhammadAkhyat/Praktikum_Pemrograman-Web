<?php
$host = 'localhost';
$dbname = 'sejarah_db';
$username = 'root';
$password = '';

function registerUser($conn, $username, $email, $password) {
    if (!$conn) {
        throw new Exception("Database connection not established");
    }

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();
    
    if ($result->num_rows > 0) {
        throw new Exception("Email already registered");
    }
    $check->close();

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt->bind_param("sss", $username, $email, $hashed_password);
    
    if (!$stmt->execute()) {
        throw new Exception("Failed to register user: " . $stmt->error);
    }
    
    $stmt->close();
    return true;
}

function loginUser($conn, $email, $password) {
    if (!$conn) {
        throw new Exception("Database connection not established");
    }

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
    }
    
    $stmt->close();
    return false;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function logout() {
    session_unset();
    session_destroy();
}

function searchHistory($mysqli, $query) {
    $search = "%$query%";
    $stmt = $mysqli->prepare("SELECT * FROM history WHERE title LIKE ? OR description LIKE ? ORDER BY time DESC");
    $stmt->bind_param("ss", $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $history = [];
    while ($row = $result->fetch_assoc()) {
        $history[] = $row;
    }
    return $history;
}