function validateAndSubmit(isRegister) {
    // Validasi input
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    if (isRegister) {
        var email = document.getElementById('email').value;

        if (username.trim() === '' || password.trim() === '' || email.trim() === '') {
            alert('Semua kolom harus diisi.');
            return;
        }

        // Validasi email menggunakan regular expression sederhana
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Format email tidak valid.');
            return;
        }
    } else {
        if (username.trim() === '' || password.trim() === '') {
            alert('Username dan Password harus diisi.');
            return;
        }
    }

    // Kirim data ke server (Anda perlu menggantinya dengan logika sesuai kebutuhan)
    var formData = new FormData();
    formData.append('username', username);
    formData.append('password', password);

    if (isRegister) {
        formData.append('email', email);
        // Jika ini halaman registrasi, tambahkan data email ke FormData
    }

    // Tentukan URL endpoint berdasarkan halaman
    var endpoint = isRegister ? 'register.php' : 'login.php';

    // Ajax request atau fetch API dapat digunakan untuk mengirim data ke server
    // Contoh fetch API:
    fetch(endpoint, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Handle response dari server
        console.log(data);
        // Redirect atau tampilkan pesan sesuai kebutuhan
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
