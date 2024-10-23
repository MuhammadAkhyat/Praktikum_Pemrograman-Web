<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'koneksi.php';
require_once 'header.php';
require_once 'include/auth_check.php';
check_login();

define('ALLOW_ACCESS', true);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sejarah Dunia - Timeline</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php echo getNavigation(); ?>

    <main>
        <h1>Jelajah Peradaban Dunia</h1>
        <div class="timeline">
            <div class="timeline-points">
                <div class="timeline-point">
                    <img src="image/mesopotomia.jpg" alt="Mesopotamia" class="timeline-image">
                    <div class="point-description">Mesopotamia</div>
                </div>
                <div class="timeline-point">
                    <img src="image/mesir.jpeg" alt="Mesir Kuno" class="timeline-image">
                    <div class="point-description">Mesir Kuno</div>
                </div>
                <div class="timeline-point">
                    <img src="image/indus.jpg" alt="Indus Valley" class="timeline-image">
                    <div class="point-description">Indus Valley</div>
                </div>
                <div class="timeline-point">
                    <img src="image/tiongkok.jpeg" alt="Tiongkok Kuno" class="timeline-image">
                    <div class="point-description">Tiongkok Kuno</div>
                </div>
                <div class="timeline-point">
                    <img src="image/peru.jpg" alt="Peru" class="timeline-image">
                    <div class="point-description">Peru</div>
                </div>
                <div class="timeline-point">
                    <img src="image/mesoamerica.jpg" alt="Mesoamerika Kuno" class="timeline-image">
                    <div class="point-description">Mesoamerika Kuno</div>
                </div>
            </div>
        </div>
        </div>

        <div class="info-cards">
            <div class="card">
                <h2>Mesopotamia</h2>
                <img src="image/mesopotomia.jpg" alt="Mesopotamia" class="card-image">
                <p>Peradaban pertama yang dikenal, berkembang di wilayah Irak modern, terkenal dengan sistem tulisan, hukum, dan arsitektur.</p>
                <button id="more-mesopotamia">More</button>
            </div>
            <div class="card">
                <h2>Mesir Kuno</h2>
                <img src="image/mesir.jpeg" alt="Mesir Kuno" class="card-image">
                <p>Terkenal dengan piramidanya dan sistem pemerintahan yang terorganisir, berfokus pada kehidupan setelah mati dan dewa-dewa.</p>
                <button id="more-mesir">More</button>
            </div>
            <div class="card">
                <h2>Indus Valley</h2>
                <img src="image/indus.jpg" alt="Indus Valley" class="card-image">
                <p>Peradaban yang berkembang di lembah sungai Indus, dikenal dengan kota-kota terencana dan sistem drainase yang canggih.</p>
                <button id="more-indus">More</button>
            </div>
            <div class="card">
                <h2>Tiongkok Kuno</h2>
                <img src="image/tiongkok.jpeg" alt="Tiongkok Kuno" class="card-image">
                <p>Peradaban yang kaya dengan kontribusi dalam filosofi, seni, dan teknologi, termasuk penemuan kertas dan kompas.</p>
                <button id="more-tiongkok">More</button>
            </div>
            <div class="card">
                <h2>Peru</h2>
                <img src="image/peru.jpg" alt="Peru" class="card-image">
                <p>Peradaban Mesoamerika awal yang dikenal dengan kepala batu raksasa dan sistem pertanian yang inovatif.</p>
                <button id="more-peru">More</button>
            </div>
            <div class="card">
                <h2>Mesoamerika Kuno</h2>
                <img src="image/mesoamerica.jpg" alt="Mesoamerika Kuno" class="card-image">
                <p>Peradaban yang memengaruhi banyak aspek budaya modern, termasuk filsafat, seni, dan sistem pemerintahan demokratis.</p>
                <button id="more-mesoamerica">More</button>
            </div>
        </div>
        </div>
    </main>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close"></span>
            <div id="modal-text"></div>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Sejarah Peradaban Dunia.</p>
        </div>
    </footer>

    <script src="script/script.js"></script>
</body>
</html>
    </main>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close"></span>
            <div id="modal-text"></div>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Sejarah Peradaban Dunia.</p>
        </div>
    </footer>

    <script src="script/script.js"></script>
</body>
</html>