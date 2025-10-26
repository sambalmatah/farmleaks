// ambil element stu
var keywordstu = document.getElementById("caristu");
var btnCaristu = document.getElementById("btn-caristu");
var containerstu = document.getElementById("container-stu");

// tambahkan event ketika keyword ditulis
keywordstu.addEventListener("keyup", function () {
    // buat object ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            containerstu.innerHTML = xhr.responseText;
        }
    };

    // eksekusi ajax
    xhr.open("GET", "ajax/caristu.php?keywordstu=" + keywordstu.value, true);
    xhr.send();
});
