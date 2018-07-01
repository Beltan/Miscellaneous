/*
This code returns all the numbers that satisfy a^3 + b^3 = c^3 + d^3.
Where a != b != c != d < N.
I tried my best to make it efficient and not use brute force.
*/
const N = 5000;
var table = [];

// Computes a^3 + b^3, which is also c^3 + d^3.
for (var a = 1; a < N + 1; a++) {
    for (var b = a; b < N + 1; b++) {
        var result = Math.pow(a, 3) + Math.pow(b, 3);
        table.push({a, b, result});
    }
}

// Function used to sort
function compareValues(key) {
    return function(a, b) {

    const varA = a[key];
    const varB = b[key];

    let comparison = 0;
    if (varA > varB) {
        comparison = 1;
    } else if (varA < varB) {
        comparison = -1;
    }
    return comparison;
};
}

// It could be more efficient since we know that the previous table is already sorted in some way
var table = table.sort(compareValues("result"));

// Output
for (var n = 0; n < table.length; n++) {
    if (n === table.length - 1) {
        break;
    }
    if (table[n].result === table[n + 1].result) {
        console.log(table[n].a + "^3 + " + table[n].b + "^3 = " + table[n + 1].a + "^3 + " + table[n + 1].b + "^3 = " + table[n].result);
    }
}