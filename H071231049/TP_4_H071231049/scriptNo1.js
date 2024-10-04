function countEvenNumbers(start, end) {
    let angka = []

    if (start % 2 == 0) {
        angka.push(start)
        start += 2;
        while (start <= end) {
            angka.push(start)
            start += 2;
        }
    } else {
        start += 1;
        while (start <= end) {
            angka.push(start)
            start += 2;
        }
    }

    let output = `(${angka.join(', ')})`;
    console.log("Output = " + angka.length + output)
}

countEvenNumbers(1, 10)