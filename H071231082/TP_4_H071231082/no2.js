var x = parseFloat(prompt("masukkan harga barang"));
var y = prompt("masukkan jenis barang");
var harga;

let diskon = 0;
switch(y) {
    case "elektronik":
        diskon = 10;
        break;
    case "pakaian":
        diskon = 20;
        break;
    case "makanan":
        diskon = 5;
        break;
    default:
        diskon = 0;
        break;
}

let hargaDiskon = x - (x * (diskon / 100));

console.log("harga awal: " + x);
console.log("diskon: " + diskon + "%");
console.log("harga akhir: " + hargaDiskon);
