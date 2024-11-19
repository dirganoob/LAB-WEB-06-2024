// 1

function countEvenNumbers(x,y) {
    let jumlah = 0;
    let array = [];

    for (let i = x; i <= y; i++) {
        if (i % 2 == 0) {
            jumlah++
            array.push(i);
        }
    }
    console.log(`${jumlah}(${array.join(',')})`);
}

