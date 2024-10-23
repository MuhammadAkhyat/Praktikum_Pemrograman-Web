<?php
$host = 'localhost';
$dbname = 'sejarah_db';
$username = 'root';
$password = '';


function connectDB() {
    global $host, $dbname, $username, $password;
    $mysqli = new mysqli($host, $username, $password, $dbname);
    if ($mysqli->connect_error) {
        die("Koneksi database gagal: " . $mysqli->connect_error);
    }
    return $mysqli;
}

function addHistory($mysqli, $title, $description, $timestamp, $image) {
    $stmt = $mysqli->prepare("INSERT INTO history (title, description, time, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $timestamp, $image);
    
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function deleteHistory($mysqli, $id) {
    $stmt = $mysqli->prepare("DELETE FROM history WHERE id = ?");
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function updateHistory($mysqli, $id, $title, $description, $time, $image) {
    $stmt = $mysqli->prepare("UPDATE history SET title = ?, description = ?, time = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $title, $description, $time, $image, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

function getAllHistory($mysqli) {
    $result = $mysqli->query("SELECT * FROM history ORDER BY time DESC");
    
    if (!$result) {
        die("Error in query: " . $mysqli->error);
    }
    
    $history = [];
    while ($row = $result->fetch_assoc()) {
        $history[] = $row;
    }
    return $history;
}

function sanitizeOutput($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

function getHistoryById($mysqli, $id) {
    $stmt = $mysqli->prepare("SELECT * FROM history WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result && $result->num_rows > 0) {
        $history = $result->fetch_assoc();
        $stmt->close();
        return $history;
    }
    
    $stmt->close();
    return null;
}

function generateUniqueFilename($extension) {
    return date('Y-m-d H.i.s') . '.' . $extension;
}

function handleFileUpload($file, $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']) {
    $maxFileSize = 5 * 1024 * 1024; 

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['error' => 'Unggahan file gagal.'];
    }

    if ($file['size'] > $maxFileSize) {
        return ['error' => 'Ukuran file melebihi batas maksimum 5 MB.'];
    }

    $fileInfo = pathinfo($file['name']);
    $extension = strtolower($fileInfo['extension']);

    if (!in_array($extension, $allowedExtensions)) {
        return ['error' => 'Tipe file tidak valid. Tipe yang diizinkan: ' . implode(', ', $allowedExtensions)];
    }

    $newFilename = generateUniqueFilename($extension);
    $uploadPath = 'uploads/' . $newFilename;

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        return ['success' => true, 'filename' => $newFilename, 'path' => $uploadPath];
    } else {
        return ['error' => 'Gagal memindahkan file yang diunggah.'];
    }
}


?>