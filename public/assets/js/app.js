function toggleForm() {
  const selectElement = document.getElementById('kuasa');
  const hiddenForm = document.getElementById('hiddenForm');

  if (selectElement.value == "2") {
    hiddenForm.style.display = "block";
  } else {
    hiddenForm.style.display = "none";
  }
}

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

function downloadFile() {
  const iframe = document.getElementById('fileFrame');
  const src = iframe.src;
  const link = document.createElement('a');
  link.href = src;
  link.download = ''; // Nama file bisa ditentukan di sini
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

function setRating(rating) {
  document.getElementById('ratingValue').value = rating;
  const stars = document.querySelectorAll('.star');
  stars.forEach((star, index) => {
    star.style.color = index < rating ? 'gold' : 'gray';
  });
}