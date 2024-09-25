document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('darkModeToggle');
    const body = document.body;
    const hamburger = document.querySelector('.hamburger');
    const nav = document.querySelector('nav');
    const modal = document.getElementById('modal');
    const modalText = document.getElementById('modal-text');
    const closeModal = document.querySelector('.close');
    const popup = document.getElementById("popupBox");
    const closePopup = document.getElementById("closePopup");

    window.onload = function() {
        if (!window.location.pathname.includes('me.html')) {
            alert("Selamat datang di website Sejarah Peradaban Dunia!");
        }
    };

    if (localStorage.getItem('lightMode') === 'enabled') {
        body.classList.add('light-mode');
        toggleButton.textContent = '☀️';
    }

    toggleButton.addEventListener('click', function () {
        body.classList.toggle('light-mode');
        if (body.classList.contains('light-mode')) {
            localStorage.setItem('lightMode', 'enabled');
            toggleButton.textContent = '☀️';
        } else {
            localStorage.setItem('lightMode', null);
            toggleButton.textContent = '🌙';
        }
    });

    hamburger.addEventListener('click', function () {
        nav.classList.toggle('active');
    });

    function showModal(title, content) {
        modalText.innerHTML = `<h2>${title}</h2><p>${content}</p>`;
        modal.style.display = 'block';
    }

    function closeModalFunction() {
        modal.style.display = 'none';
    }

    closeModal.addEventListener('click', closeModalFunction);

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModalFunction();
        }
    });

    document.getElementById('more-mesopotamia').addEventListener('click', function() {
        showModal(
            'Mesopotamia 4000-3500 SM',
            `
            <p>Berarti “antara dua sungai” dalam bahasa Yunani, Mesopotamia (terletak di Irak, Kuwait, dan Suriah modern) dianggap sebagai tempat lahirnya peradaban.</p>
            <p>Kebudayaan yang tumbuh di antara sungai Tigris dan Efrat terkenal dengan kemajuan penting dalam bidang:</p>
            <ul>
                <li>Literasi</li>
                <li>Astronomi</li>
                <li>Pertanian</li>
                <li>Hukum</li>
                <li>Matematika</li>
                <li>Arsitektur</li>
            </ul>
            <p>Mesopotamia juga merupakan rumah bagi kota-kota perkotaan pertama di dunia, termasuk Babilonia, Ashur, dan Akkad.</p>
            <p>Sistem tulisan paku, yang digunakan untuk menyusun Kode Hammurabi, adalah salah satu kemajuan Mesopotamia yang paling terkenal.</p>
            <p>Persia akhirnya menaklukkan Mesopotamia pada tahun 539 SM.</p>
            <p>“Dalam tiga milenium masa kejayaan Mesopotamia kuno, tak terhitung banyaknya kerajaan yang datang dan pergi, dan beberapa kerajaan bangkit dan jatuh karena berbagai alasan,” kata Podany.</p>
            <p>Sejarah Mesopotamia juga mencakup mitos penciptaan yang terkenal, seperti Epic of Gilgamesh, yang memberikan wawasan tentang kepercayaan dan nilai-nilai masyarakat saat itu.</p>
            `
        );
    });
    
    document.getElementById('more-mesir').addEventListener('click', function() {
        showModal(
            'Mesir Kuno',
            `
            <p>Mesir kuno mungkin merupakan peradaban masa lalu yang paling romantis. Mesir kuno berdiri sebagai salah satu kerajaan paling kuat dalam sejarah selama lebih dari 3.000 tahun.</p>
            <p>Terletak di sepanjang Sungai Nil yang subur dan pernah terbentang dari Suriah hingga Sudan, peradaban ini paling terkenal dengan piramida, makam, dan mausoleumnya. Peradaban ini sohor dengan praktik mumifikasi untuk mempersiapkan jenazah ke akhirat.</p>
            <p>Harl, penulis buku Empires of the Steppes: How the Steppe Nomads Forged the Modern World, mengatakan penggunaan tenaga kerja Mesir untuk mengerjakan proyek arsitektur—seperti piramida—tidak ada bandingannya. “Kemampuan mengumpulkan 100.000 orang untuk menyusun piramida besar pada tahun 2600 SM tidak ada di mana pun," katanya.</p>
            <p>Orang Mesir juga terbukti sangat ahli di bidang pertanian dan kedokteran, tambahnya. Mereka juga mengembangkan tradisi seni pahat dan lukisan yang sangat indah.</p>
            <p>Bangsa Mesir kuno juga meninggalkan warisan sistem penulisan dan matematika yang monumental. Hasta, ukuran panjang kira-kira rentang lengan bawah, adalah kunci dalam merancang piramida dan bangunan lainnya.</p>
            <p>Orang-orang Mesir kuno mengembangkan kalender 24 jam sehari dan 365 hari selama ini. Dan mereka mendirikan sistem penulisan bergambar hieroglif, diikuti oleh sistem hieroglif yang menggunakan tinta pada kertas papirus. Peradaban ini berakhir pada tahun 332 SM ketika ditaklukkan oleh Alexander Agung.</p>
            <p>Sejarah Mesir juga termasuk periode dinasti yang panjang, dengan firaun yang menjadi simbol kekuasaan dan keagamaan, seperti Tutankhamun dan Ramses II, yang dikenal karena prestasi mereka dalam pembangunan dan militer.</p>
            `
        );
    });
    
    document.getElementById('more-indus').addEventListener('click', function() {
        showModal(
            'Indus Valley (2500-1900 SM)',
            `
            <p>Di India kuno, tempat agama Hindu didirikan, agama memegang peranan penting bersama dengan tradisi sastra dan arsitektur yang luar biasa. Upanishad, atau teks suci Hindu, memuat gagasan reinkarnasi dan sistem kasta berdasarkan hak kesulungan, yang keduanya bertahan hingga zaman modern.</p>
            <p>Peradaban Lembah Sungai Indus, yang terbentang di kawasan modern India, Pakistan, dan sebagian Afghanistan, sangat mengesankan para arkeolog karena tata kota yang terencana dengan baik. Kota-kotanya seperti Harappa dan Mohenjo-Daro menampilkan jalan-jalan lurus dan sistem drainase yang canggih, serta penggunaan bata yang seragam untuk konstruksi rumah.</p>
            <p>Salah satu aspek yang menarik dari Peradaban Lembah Sungai Indus adalah keteraturan dan keterlibatan yang minim dalam peperangan, berbanding terbalik dengan kebudayaan kuno lainnya yang penuh konflik militer. Mereka juga terkenal dengan keahlian dalam perdagangan, yang dilakukan dengan peradaban lain seperti Mesopotamia.</p>
            <p>Meskipun sistem tulisan Indus belum berhasil sepenuhnya diterjemahkan, peninggalan arkeologis menunjukkan keberadaan budaya yang kaya dengan seni dan kerajinan tangan, termasuk patung-patung, perhiasan, dan keramik yang sangat detail.</p>
            <p>Kehancuran peradaban ini mungkin dipengaruhi oleh pergeseran iklim, perubahan aliran sungai besar, atau serangan bangsa Indo-Arya. Namun, ketidakpastian mengenai akhir dari peradaban ini terus menjadi bahan penelitian para sejarawan.</p>
            `
        );
    });
    
    document.getElementById('more-tiongkok').addEventListener('click', function() {
        showModal(
            'Tiongkok Kuno (2100 SM - 221 SM)',
            `
            <p>Dilindungi oleh Pegunungan Himalaya, Samudera Pasifik dan Gurun Gobi, dan terletak di antara sungai Kuning dan Yangtze, peradaban Tiongkok paling awal berkembang dalam isolasi dari penjajah dan orang asing lainnya selama berabad-abad.</p>
            <p>Untuk menghentikan pasukan Mongol dari utara, mereka membangun penghalang yang dianggap oleh beberapa orang sebagai pendahulu Tembok Besar Tiongkok, yang dibangun kemudian pada tahun 220 SM.</p>
            <p>Secara umum dibagi menjadi empat dinasti—Xia, Shang, Zhou, dan Qin—Tiongkok kuno diperintah oleh kaisar-kaisar yang berurutan. Peradaban ini berjasa mengembangkan sistem desimal, sempoa dan jam matahari, serta mesin cetak, yang memungkinkan penerbitan dan distribusi The Art of War karya Sun Tzu, yang masih relevan lebih dari 2.500 tahun kemudian.</p>
            <p>Seperti orang Mesir, orang Tiongkok kuno mampu memobilisasi penduduk untuk membangun proyek infrastruktur besar-besaran. Pembangunan Kanal Besar era abad ke-5, yang menghubungkan sungai Kuning dan Yangtze, misalnya, memungkinkan sejumlah besar pasukan militer dan barang bergerak ke seluruh negeri.</p>
            <p>“Tiongkok mungkin adalah negara terpusat yang paling sukses dalam sejarah umat manusia,” kata Harl. “Dan pada beberapa titik dalam sejarah umat manusia, tanpa diragukan lagi, Tiongkok merupakan negara dengan peradaban terbesar yang pernah ada di dunia.”</p>
            <p>Sejarah Tiongkok juga meliputi kontribusi penting dalam seni, filosofi, dan ilmu pengetahuan, termasuk pemikiran Confucianisme dan Taoisme yang membentuk budaya Tiongkok hingga saat ini.</p>
            `
        );
    });
    
    document.getElementById('more-peru').addEventListener('click', function() {
        showModal(
            'Peru (200-1532 M)',
            `
            <p>Peru menjadi tempat lahirnya peradaban sejumlah kebudayaan, termasuk Chavín, Paracas, Nazca, Huari, Moche, dan Inca. Para arkeolog telah menemukan bukti metalurgi, keramik, dan praktik medis serta pertanian tingkat lanjut dari kelompok-kelompok ini.</p>
            <p>Salah satu peradaban terbesar di Peru adalah Inca, yang mendirikan Kekaisaran yang luas di sepanjang Pegunungan Andes. Peradaban ini terkenal karena jaringan jalan yang menghubungkan berbagai kota dan desa di pegunungan yang sulit dijangkau, serta teras pertanian yang inovatif untuk mendukung pertanian di lereng curam.</p>
            <p>Selain Machu Picchu, salah satu situs yang paling terkenal dari Inca, terdapat juga Sacsayhuamán, sebuah kompleks benteng batu yang menunjukkan kecanggihan teknik konstruksi Inca dalam menyusun batu-batu besar tanpa menggunakan mortar, namun tetap sangat presisi.</p>
            <p>Sistem ekonomi mereka terorganisir dengan baik melalui pengelolaan komunitas yang disebut 'ayllu'. Orang Inca juga menggunakan kuipu, alat penghitungan berbasis simpul, untuk mencatat data dan informasi ekonomi. Namun, tidak ada sistem tulisan yang berkembang di peradaban ini.</p>
            <p>Sejarah Peru juga meliputi banyak inovasi dalam teknik pertanian, seperti teras pertanian dan sistem irigasi yang kompleks, serta keberadaan pusat-pusat keagamaan yang megah, seperti kuil matahari di Cusco, yang dipandang sebagai pusat spiritual kekaisaran.</p>
            <p>Setelah kedatangan Spanyol pada abad ke-16, peradaban Inca runtuh, sebagian besar akibat penyakit yang dibawa oleh para penjajah dan akibat invasi militer yang dipimpin oleh Francisco Pizarro.</p>
            `
        );
    });
    
    document.getElementById('more-mesoamerica').addEventListener('click', function() {
        showModal(
            'Mesoamerika (1200 SM - 1521 M)',
            `
            <p>Sebagian wilayah Meksiko dan Amerika Tengah saat ini pernah menjadi rumah bagi sejumlah kebudayaan kelompok pribumi, dimulai dari suku Olmec sekitar tahun 1200 SM, diikuti oleh suku Zapotec, Maya, Toltec, dan akhirnya suku Aztec.</p>
            <p>Suku Maya mungkin adalah salah satu peradaban Mesoamerika yang paling maju, terutama dalam astronomi, matematika, dan sistem penulisan hieroglif. Mereka juga dikenal dengan bangunan piramida besar yang mengesankan, seperti yang ada di Chichen Itza dan Tikal.</p>
            <p>Kebudayaan Aztec dikenal karena kekuatan militer dan kemampuan administratif yang canggih. Ibukotanya, Tenochtitlan, dibangun di atas danau dengan sistem kanal dan chinampas (pulau terapung) yang berfungsi sebagai lahan pertanian produktif. Kuil-kuil Aztec didedikasikan untuk dewa-dewa mereka, dan upacara pengorbanan manusia sering dilakukan sebagai bagian dari praktik keagamaan.</p>
            <p>Suku Olmec, sebagai peradaban tertua di kawasan ini, juga dikenal karena seni patung batu besar berupa kepala-kepala raksasa yang hingga kini masih menjadi teka-teki. Olmec juga berperan penting dalam menyebarkan elemen budaya yang kelak diadopsi oleh suku-suku lain di Mesoamerika.</p>
            <p>Peradaban Mesoamerika mengalami penurunan yang signifikan setelah kedatangan penjajah Spanyol. Suku Aztec mengalami kehancuran setelah penaklukan oleh Hernán Cortés pada tahun 1521, yang menandai berakhirnya peradaban pribumi Mesoamerika.</p>
            <p>Sejarah Mesoamerika juga meliputi banyak inovasi dalam seni, arsitektur, dan sistem politik yang canggih, termasuk kalender yang sangat presisi dan tradisi seni yang beragam seperti mural dan patung.</p>
            `
        );
    });
});   

