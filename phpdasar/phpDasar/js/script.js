const keyword = document.getElementById("keyword");
//const search = document.getElementById("search");
const container = document.getElementById("container");

// Tambahkan event ketika keyword ditulis
keyword.addEventListener("keyup", () => {

    // Buat Object AJAX
    let xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function() {
        if( xhr.readyState == 4 && xhr.status == 200) {
           container.innerHTML = xhr.responseText;

        }
    }
    xhr.open('GET', `ajax/mahasiswa.php?keyword=${keyword.value}`, true );
    xhr.send();
});
