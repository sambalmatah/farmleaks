// ambil element den yang dibutuhkan
var keywordden = document.getElementById("cariden");
var btnCariden = document.getElementById("btn-cariden");
var containerden = document.getElementById("container-den");

// tambahkan event ketika keyword ditulis
keywordden.addEventListener("keyup", function () {
    // buat object ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            containerden.innerHTML = xhr.responseText;
        }
    };

    // eksekusi ajax
    xhr.open("GET", "ajax/cariden.php?keywordden=" + keywordden.value, true);
    xhr.send();
});
