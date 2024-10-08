<?php
    require 'koneksi.php';

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
    }

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
        <header>
            <nav>
                <a href="index.php" class="active">Home</a>
                <a href="me.php">About Me</a>
                <a href="timeline.php">Timeline</a>
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

        <main>
            <h1>Jelajah Peradaban Dunia</h1>
            <div class="timeline">
                <div class="timeline-points">
                    <div class="timeline-point">
                        <img src="image/mesopotomia.jpg" alt="Peradaban Mesopotamia" class="timeline-image">
                        <div class="point-description">Mesopotamia</div>
                    </div>
                    <div class="timeline-point">
                        <img src="image/mesir.jpeg" alt="Peradaban Mesir Kuno" class="timeline-image">
                        <div class="point-description">Mesir Kuno</div>
                    </div>
                    <div class="timeline-point">
                        <img src="image/indus.jpg" alt="Peradaban Lembah Indus" class="timeline-image">
                        <div class="point-description">Indus Valley</div>
                    </div>
                    <div class="timeline-point">
                        <img src="image/tiongkok.jpeg" alt="Peradaban Tiongkok Kuno" class="timeline-image">
                        <div class="point-description">Tiongkok Kuno</div>
                    </div>
                    <div class="timeline-point">
                        <img src="image/peru.jpg" alt="Peradaban Peru Kuno" class="timeline-image">
                        <div class="point-description">Peru</div>
                    </div>
                    <div class="timeline-point">
                        <img src="image/mesoamerica.jpg" alt="Peradaban Mesoamerika Kuno" class="timeline-image">
                        <div class="point-description">Mesoamerika Kuno</div>
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
        </main>
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
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