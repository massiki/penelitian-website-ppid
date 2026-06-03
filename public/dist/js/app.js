function inputPhone() {
  document.getElementById('phone').addEventListener('input', function (event) {
    // Membatasi input hanya angka
    this.value = this.value.replace(/[^0-9]/g, '');

    // Membatasi maksimal 16 karakter
    if (this.value.length > 13) {
      this.value = this.value.slice(0, 13);
    }
  });
}

function inputNik() {
  document.getElementById('nik').addEventListener('input', function (event) {
    // Membatasi input hanya angka
    this.value = this.value.replace(/[^0-9]/g, '');

    // Membatasi maksimal 16 karakter
    if (this.value.length > 16) {
      this.value = this.value.slice(0, 16);
    }
  });
}

function inputNip() {
  document.getElementById('nip').addEventListener('input', function (event) {
    // Membatasi input hanya angka
    this.value = this.value.replace(/[^0-9]/g, '');

    // Membatasi maksimal 16 karakter
    if (this.value.length > 13) {
      this.value = this.value.slice(0, 13);
    }
  });
}

// ubah foto ketika di update dan ifrmae
const imageInput = document.getElementById('imageInput');
const previewImage = document.getElementById('previewImage');

imageInput.addEventListener('change', function (event) {
  console.log(event.target.files[0])
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();

    reader.onload = function (e) {
      previewImage.src = e.target.result;
    };

    reader.readAsDataURL(file);
  }
});

function showIframe() {
  document.getElementById('iframeContainer').style.display = 'block';
}

// show password
function showPassword() {
  document.getElementById('lihatpassword').addEventListener('change', function() {
    let passwordInput = document.getElementById('password');
    if (this.checked) {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }
  });
}
