document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('darkModeToggle');
    const body = document.body;

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

    window.editEntry = function(id, title, description, image) {
        document.getElementById('update_id').value = id;
        document.getElementById('update_title').value = title;
        document.getElementById('update_description').value = description;
        document.getElementById('update_image_url').value = image;
        document.getElementById('current_image').src = image;
        document.getElementById('current_image').style.display = 'block';
        document.getElementById('update-history').style.display = 'block';
        document.getElementById('add-history').style.display = 'none';
    }

    window.deleteEntry = function(id) {
        if (confirm("Apakah Anda yakin ingin menghapus entri ini?")) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '';

            let actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = 'delete';
            form.appendChild(actionInput);

            let idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'id';
            idInput.value = id;
            form.appendChild(idInput);

            document.body.appendChild(form);
            form.submit();
        }
    }

    window.cancelEdit = function() {
        document.getElementById('update-history').style.display = 'none';
        document.getElementById('add-history').style.display = 'block';
        document.getElementById('updateForm').reset();
    }
});