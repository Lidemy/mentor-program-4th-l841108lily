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

function solve(imput) {
  const n = imput[0];
  if (n < 1 || n > 30) {
    console.log('n is not in the range.');
  } else {
    for (let i = 1; i <= n; i += 1) {
      let str = '';
      for (let j = 1; j <= i; j += 1) {
        str += '*';
      }
      console.log(str);
    }
  }
}
