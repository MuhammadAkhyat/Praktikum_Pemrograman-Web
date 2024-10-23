<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'koneksi.php';
require_once 'include/function.php';
require_once 'include/auth_check.php';
require_once 'header.php';

check_login();

$mysqli = connectDB();

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token');
    }

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
                $activity = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
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
                    $image = filter_input(INPUT_POST, 'image_url', FILTER_SANITIZE_URL);
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
                $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
                if ($id) {
                    $entry = getHistoryById($mysqli, $id);
                    if ($entry && !empty($entry['image']) && file_exists($entry['image'])) {
                        unlink($entry['image']);
                    }
                    deleteHistory($mysqli, $id);
                }
                header('Location: timeline.php');
                exit;
                break;

            case 'update':
                $id = filter_input(INPUT_POST, 'update_id', FILTER_VALIDATE_INT);
                $title = filter_input(INPUT_POST, 'update_title', FILTER_SANITIZE_STRING);
                $description = filter_input(INPUT_POST, 'update_description', FILTER_SANITIZE_STRING);
                $time = date('Y-m-d H:i:s');
                
                if ($id) {
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
                        $image = filter_input(INPUT_POST, 'update_image_url', FILTER_SANITIZE_URL);
                    }

                    if (empty($error)) {
                        updateHistory($mysqli, $id, $title, $description, $time, $image);
                    }
                }
                header('Location: timeline.php');
                exit;
                break;
        }
    }
}

$history = getAllHistory($mysqli);
define('ALLOW_ACCESS', true);

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
    <?php echo getNavigation(); ?>
    
    <main>
        <h1>Jelajah Peradaban Dunia</h1>
        <section id="add-history">
            <h2>Tambah Sejarah</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
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
        <section class="history-grid">
    <?php if (empty($history)): ?>
        <div class="history-empty">
            <p>Belum ada data sejarah yang ditambahkan.</p>
        </div>
    <?php else: ?>
        <?php foreach ($history as $item): ?>
            <article class="history-card">
                <?php if (!empty($item['image'])): ?>
                    <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                <?php endif; ?>
                <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                <p><?php echo htmlspecialchars($item['description']); ?></p>
                <p class="timestamp"><?php echo date('d M Y H:i', strtotime($item['timestamp'])); ?></p>
                <div class="history-actions">
                    <button onclick="editHistory(<?php echo $item['id']; ?>, 
                        '<?php echo addslashes($item['title']); ?>', 
                        '<?php echo addslashes($item['description']); ?>', 
                        '<?php echo addslashes($item['image']); ?>')" 
                        class="edit-btn">Edit</button>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                        <button type="submit" class="delete-btn" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </div>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
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