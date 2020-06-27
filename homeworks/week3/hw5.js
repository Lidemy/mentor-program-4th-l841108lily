/* eslint-disable no-param-reassign */

const readline = require('readline');

const lines = [];
const rl = readline.createInterface({
  input: process.stdin,
});

rl.on('line', (line) => {
  lines.push(line);
});

rl.on('close', () => {
  // eslint-disable-next-line
  solve(lines);
});

function compare(a, b, k) {
  if (a === b) return 'DRAW';
  if (k === -1) {
    const temp = a;
    a = b;
    b = temp;
  }
  const aLength = a.length;
  const bLength = b.length;

  if (aLength !== bLength) {
    return aLength > bLength ? 'A' : 'B';
  }
  return a > b ? 'A' : 'B';
}

function solve(imput) {
  for (let i = 1; i <= Number(imput[0]); i += 1) {
    const [a, b, k] = imput[i].split(' ');
    console.log(compare(a, b, k));
  }
}
