let hari = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"];

function predict(x, y, z) {
    let predictDay = (z + y) % 7; 
    console.log(`${y} hari setelah hari ${x} : ${hari[predictDay]}`);
}

let x = prompt("hari sekarang : ").toLowerCase();
let y = parseInt(prompt("jumlah prediksi hari : "));
let z = hari.findIndex(day => day === x); 



predict(x, y, z);

