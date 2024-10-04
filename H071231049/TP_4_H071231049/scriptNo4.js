const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

const angkaKomputer = Math.floor(Math.random() * 100) + 1;
let totalTebakan = 0;  

console.log("Tebak angka antara 1 hingga 100!");


function tebakAngka() {
    rl.question('Masukkan salah satu dari angka 1 sampai 100: ', (inputAngka) => {
        totalTebakan++;
        inputAngka = parseInt(inputAngka); 


        if (isNaN(inputAngka)) {
            console.log('Harap masukkan angka yang valid!');
            tebakAngka();
        } else {
            if (inputAngka > angkaKomputer) {
                console.log('Terlalu tinggi! Coba lagi.');
                tebakAngka();
            } else if (inputAngka < angkaKomputer) {
                console.log('Terlalu rendah! Coba lagi.');
                tebakAngka();
            } else {
                console.log(`Selamat! kamu berhasil menebak angka ${angkaKomputer} dengan benar.`);
                console.log(`Sebanyak ${totalTebakan}x percobaan.`);
                rl.close();
            }
        }
    });
}
tebakAngka();
