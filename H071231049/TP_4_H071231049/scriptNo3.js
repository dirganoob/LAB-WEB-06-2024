const readline = require('readline');

const rl = readline.createInterface({
    input: process.stdin,
    output: process.stdout
});

function menghitungHari() {
    rl.question("Masukkan Hari : " ,(hari) => {
        rl.question("Masukkan jumlah hari yang ingin di cek: ", (cekHari)=>{
            cekHari = parseInt(cekHari);
            const arrayHari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']
            const hariH = arrayHari.indexOf(hari);
            const sisaHari = cekHari % 7;
            const hasil = (sisaHari + hariH) % 7
    
            console.log(`${cekHari} Hari kedepan adalah hari ${arrayHari[hasil]}`)
            rl.close();

        })
    });
}

menghitungHari()