document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('darkModeToggle');
    const body = document.body;
    const hamburger = document.querySelector('.hamburger');
    const nav = document.querySelector('nav');
    const modal = document.getElementById('modal');
    const modalText = document.getElementById('modal-text');
    const closeModal = document.querySelector('.close');
    const contactForm = document.querySelector('.contact-section form');
    const formResult = document.getElementById('formResult');

    window.onload = function() {
        if (!window.location.pathname.includes('me.php')) {
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

    const moreInfoButtons = [
        { id: 'more-mesopotamia', title: 'Mesopotamia 4000-3500 SM' },
        { id: 'more-mesir', title: 'Mesir Kuno' },
        { id: 'more-indus', title: 'Indus Valley (2500-1900 SM)' },
        { id: 'more-tiongkok', title: 'Tiongkok Kuno (2100 SM - 221 SM)' },
        { id: 'more-peru', title: 'Peru (200-1532 M)' },
        { id: 'more-mesoamerica', title: 'Mesoamerika (1200 SM - 1521 M)' }
    ];

    moreInfoButtons.forEach(button => {
        document.getElementById(button.id).addEventListener('click', function() {
            showModal(button.title, `Content for ${button.title}`);
        });
    });

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;

            document.getElementById('resultName').textContent = name;
            document.getElementById('resultEmail').textContent = email;
            document.getElementById('resultMessage').textContent = message;

            formResult.style.display = 'block';
            contactForm.reset();
        });
    }
});