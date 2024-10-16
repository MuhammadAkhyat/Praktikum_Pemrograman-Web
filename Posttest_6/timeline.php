<?php
require_once 'koneksi.php';
require_once 'function.php';
$mysqli = connectDB();

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $title = $_POST['title'] ?? '';
                $activity = $_POST['description'] ?? '';
                $timestamp = date('Y-m-d H:i:s');
                $image = '';

                if (!empty($_FILES['image']['name'])) {
                    $uploadResult = handleFileUpload($_FILES['image']);
                    if (isset($uploadResult['error'])) {
                        $error = $uploadResult['error'];
                    } else {
                        $image = $uploadResult['path'];
                    }
                } elseif (!empty($_POST['image_url'])) {
                    $image = $_POST['image_url'];
                }

                if (!empty($activity) && !empty($title) && empty($error)) {
                    if (addHistory($mysqli, $title, $activity, $timestamp, $image)) {
                        header('Location: timeline.php');
                        exit;
                    } else {
                        $error = "Gagal menambahkan history.";
                    }
                } elseif (empty($error)) {
                    $error = "Judul dan deskripsi harus diisi.";
                }
                break;

            case 'delete':
                $id = $_POST['id'];
                $entry = getHistoryById($mysqli, $id);
                if ($entry && !empty($entry['image']) && file_exists($entry['image'])) {
                    unlink($entry['image']);
                }
                deleteHistory($mysqli, $id);
                header('Location: timeline.php');
                exit;
                break;

            case 'update':
                $id = $_POST['update_id'];
                $title = $_POST['update_title'];
                $description = $_POST['update_description'];
                $time = date('Y-m-d H:i:s');
                $oldEntry = getHistoryById($mysqli, $id);
                $image = $oldEntry['image'];

                if (!empty($_FILES['update_image']['name'])) {
                    $uploadResult = handleFileUpload($_FILES['update_image']);
                    if (isset($uploadResult['error'])) {
                        $error = $uploadResult['error'];
                    } else {
                        if (!empty($oldEntry['image']) && file_exists($oldEntry['image'])) {
                            unlink($oldEntry['image']);
                        }
                        $image = $uploadResult['path'];
                    }
                } elseif (!empty($_POST['update_image_url'])) {
                    if (!empty($oldEntry['image']) && file_exists($oldEntry['image'])) {
                        unlink($oldEntry['image']);
                    }
                    $image = $_POST['update_image_url'];
                }

                if (empty($error)) {
                    updateHistory($mysqli, $id, $title, $description, $time, $image);
                    header('Location: timeline.php');
                    exit;
                }
                break;
        }
    }
}

$history = getAllHistory($mysqli);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sejarah Dunia - Timeline</title>
    <link rel="stylesheet" href="styles/timeline.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Home</a>
            <a href="me.php">About Me</a>
            <a href="timeline.php" class="active">Timeline</a>
        </nav>
        <div class="user-actions">
            <button id="darkModeToggle">🌙</button>
        </div>
    </header>
    <main>
        <h1>Jelajah Peradaban Dunia</h1>
        <section id="add-history">
            <h2>Tambah Sejarah</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                <input type="text" name="title" placeholder="Judul" required>
                <textarea name="description" placeholder="Deskripsi" required></textarea>
                <input type="file" name="image" accept="image/*">
                <p>Atau</p>
                <input type="url" name="image_url" placeholder="Link Gambar">
                <button type="submit">Kirim</button>
            </form>
            <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        </section>
        <section id="history-data">
            <h2>Data Sejarah</h2>
            <div class="history-grid">
                <?php foreach ($history as $entry): ?>
                    <div class="history-card">
                        <img src="<?php echo sanitizeOutput($entry['image']); ?>" alt="<?php echo sanitizeOutput($entry['title']); ?>" onerror="this.src='placeholder.jpg';" style="max-width: 100%; height: auto; max-height: 200px; object-fit: cover;">
                        <h3><?php echo sanitizeOutput($entry['title']); ?></h3>
                        <p><?php echo sanitizeOutput($entry['description']); ?></p>
                        <button onclick="editEntry(<?php echo $entry['id']; ?>, '<?php echo addslashes(sanitizeOutput($entry['title'])); ?>', '<?php echo addslashes(sanitizeOutput($entry['description'])); ?>', '<?php echo sanitizeOutput($entry['image']); ?>')">Ubah</button>
                        <button onclick="deleteEntry(<?php echo $entry['id']; ?>)">Hapus</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section id="update-history" style="display:none;">
            <h2>Update Sejarah</h2>
            <form id="updateForm" method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="update_id" id="update_id">
                <input type="text" name="update_title" id="update_title" placeholder="Judul" required>
                <textarea name="update_description" id="update_description" placeholder="Deskripsi" required></textarea>
                <input type="file" name="update_image" accept="image/*">
                <p>Atau</p>
                <input type="url" name="update_image_url" id="update_image_url" placeholder="Link Gambar">
                <img id="current_image" src="" alt="Current Image" style="max-width: 200px; display: none;">
                <button type="submit">Update</button>
                <button type="button" onclick="cancelEdit()">Batal</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Sejarah Peradaban Dunia.</p>
    </footer>
    <script src="script/timeline.js"></script>
</body>
</html>

<?php
$mysqli->close();
?>