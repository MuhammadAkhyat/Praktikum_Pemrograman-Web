<?php
$name = $email = $message = "";
$nameErr = $emailErr = $messageErr = "";
$formSubmitted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Nama diperlukan";
    } else {
        $name = test_input($_POST["name"]);
    }
    
    if (empty($_POST["email"])) {
        $emailErr = "Email diperlukan";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format email tidak valid";
        }
    }
    
    if (empty($_POST["message"])) {
        $messageErr = "Pesan diperlukan";
    } else {
        $message = test_input($_POST["message"]);
    }
    
    if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
        $formSubmitted = true;
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me - Sejarah Dunia Timeline</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.html">Home</a>
            <a href="me.php" class="active">About Me</a>
        </nav>
        <div class="user-actions">
            <button id="darkModeToggle">🌙</button>
        </div>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>

    <main class="about-page">
        <h1>Tentang Saya</h1>
        <div class="about-content">
            <img src="4x6.jpeg" alt="Muhammad Akhyat Tariq Razan" class="foto-saya">
            <div class="about-text">
                <h2>Halo !</h2>
                <p>Saya Muhammad Akhyat Tariq Razan, seorang mahasiswa di Universitas Mulawarman, Fakultas Teknik, Program Studi Informatika.</p>
                <p>Saya memiliki ketertarikan yang besar dalam dunia teknologi dan sejarah peradaban dunia. Saya menggabungkan keduanya dalam proyek ini, yang menghadirkan timeline sejarah interaktif.</p>
                
                <div class="biodata-section">
                    <h3>Biodata</h3>
                    <div class="biodata-grid">
                        <div><strong>Nama Lengkap:</strong> Muhammad Akhyat Tariq Razan</div>
                        <div><strong>TTL:</strong> Bontang, 08 Maret 2005</div>
                        <div><strong>Pendidikan:</strong> Universitas Mulawarman, Teknik Informatika</div>
                        <div><strong>Minat:</strong> Teknologi, Pemrograman, Sejarah Dunia</div>
                    </div>
                </div>
    
                <div class="skills-section">
                    <h3>Keterampilan</h3>
                    <ul class="skills-list">
                        <li>HTML <span class="skill-level">★★★☆☆</span></li>
                        <li>CSS <span class="skill-level">★★★☆☆</span></li>
                        <li>JavaScript <span class="skill-level">★★★☆☆</span></li>
                        <li>Python <span class="skill-level">★★★★☆</span></li>
                        <li>PHP <span class="skill-level">★★★☆☆</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="contact-section">
            <h2>Hubungi Saya</h2>
            <?php if (!$formSubmitted): ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name);?>">
                    <span class="error"><?php echo $nameErr;?></span>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email);?>">
                    <span class="error"><?php echo $emailErr;?></span>

                    <label for="message">Pesan:</label>
                    <textarea id="message" name="message" rows="4"><?php echo htmlspecialchars($message);?></textarea>
                    <span class="error"><?php echo $messageErr;?></span>

                    <button type="submit" class="small-button">Kirim Pesan</button>
                </form>
            <?php else: ?>
                <div id="formResult">
                    <h3>Terima kasih! Pesan Anda telah diterima:</h3>
                    <p><strong>Nama:</strong> <?php echo htmlspecialchars($name); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                    <p><strong>Pesan:</strong> <?php echo htmlspecialchars($message); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Muhammad Akhyat Tariq Razan - Sejarah Peradaban Dunia</p>
        </div>
    </footer>
</body>
</html>