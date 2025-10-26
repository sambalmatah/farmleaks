// ambil elemen cat yang dibutuhkan
var keywordcat = document.getElementById("caricat");
var btnCaricat = document.getElementById("btn-caricat");
var containercat = document.getElementById("container-cat");

// tambahkan event ketika keyword ditulis
keywordcat.addEventListener("keyup", function () {
    // buat object ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            containercat.innerHTML = xhr.responseText;
        }
    };

    // eksekusi ajax
    xhr.open("GET", "ajax/caricat.php?keywordcat=" + keywordcat.value, true);
    xhr.send();
});
