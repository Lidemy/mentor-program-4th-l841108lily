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

function opposite(str, n) {
  let S = '';
  for (let i = n - 1; i >= 0; i -= 1) {
    S += str[i];
  }
  return S;
}

function solve(imput) {
  const str = imput[0];
  const n = str.length;
  const rts = opposite(str, n);
  if (rts === str) {
    console.log('True');
  } else {
    console.log('False');
  }
}
