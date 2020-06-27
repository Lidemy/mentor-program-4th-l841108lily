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

function Factor(n) {
  if (n === 1) return 'Composite';
  for (let i = 2; i <= Math.sqrt(n); i += 1) {
    if (n % i === 0) {
      return 'Composite';
    }
  }
  return 'Prime';
}

function solve(imput) {
  for (let i = 1; i < imput.length; i += 1) {
    console.log(Factor(Number(lines[i])));
  }
}
