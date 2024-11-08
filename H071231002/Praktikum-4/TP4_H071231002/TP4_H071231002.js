// console.log("nomor 1");
// function countEvenNumbers(start, end) {
//     let hasil = [];
//     for (let i = start; i <= end; i++) {
//         if (i % 2 === 0) {
//             hasil.push(i);
//         }
//     }
//     let count = hasil.length; 
//     console.log(`${count}, (${hasil.join(',')})`);
    
// }
// countEvenNumbers(1,10)





// console.log("nomor 2");
// let harga = prompt("Masukkan harga barang: ");
// let jenis = prompt("Masukkan jenis barang (Elektronik, Pakaian, Makanan, Lainnya) : ").toLowerCase();
// let diskon = 0;

// if (jenis === "elektronik"){
//     diskon = 0.1;
//     setelahDiskon = harga - (harga * diskon);
// } else if (jenis === "pakaian"){
//     diskon = 0.2;
//     setelahDiskon = harga - (harga * diskon);
// } else if (jenis === "makanan") {
//     diskon = 0.05;
//     setelahDiskon = harga - (harga * diskon);
// } else {
//     console.log("Tidak ada diskon");
// }

// console.log("Harga awal : Rp. ", + harga);
// console.log("Diskon : ", diskon*100 + "%");
// console.log("Harga setelah diskon : Rp.", + setelahDiskon);





// // Nomor 3
// console.log("Nomor 3");

// let nama = prompt("masukkan hari awal: ").toLowerCase();
// let hari = parseInt(prompt("anda ingin mengecek berapa hari kedepan: "));

// function cari(nama, hari) {
//     let namaHari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
//     let indeks = namaHari.indexOf(nama);

//     if (indeks === -1) {
//         console.log("Anda salah memasukkan nama hari");
//         return;
//     }

//     let hariSelanjutnya = (indeks + hari % 7) % 7;
//     let hasil = namaHari[hariSelanjutnya]
//     console.log(`${hari} hari setelah ${nama} adalah ${hasil}.`);


// }
// cari(nama, hari);



// Nomor 4
// console.log("Nomor 4");
// let angka = 1 + Math.floor(Math.random() * 100); 
// let percobaan = 0;
// let tebakan = parseInt(prompt("Masukkan salah satu angka dari 1 sampai 100: "));

// function memeriksa(tebakan, angka) {
//     percobaan++; 
//     if (tebakan < angka) {
//         console.log("Terlalu rendah! Coba Lagi");
//         return false; 
//     } else if (tebakan > angka) {
//         console.log("Terlalu tinggi! Coba Lagi");
//         return false; 
//     } else {
//         console.log(`Tebakan Anda benar! Anda telah mencoba ${percobaan} kali.`);
//         return true;
//     }
// }

// while (!memeriksa(tebakan, angka)) {
//     tebakan = parseInt(prompt("Masukkan salah satu angka dari 1 sampai 100: "));
// }


