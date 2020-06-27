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
  const [N, M] = imput[0].split(' ');
  for (let i = Number(N); i <= Number(M); i += 1) {
    // 計算幾位數
    const iStr = String(i);
    const len = iStr.length;
    let ans = 0;
    // 每位數次方後相加
    for (let j = 1; j <= len; j += 1) {
      ans += iStr[j - 1] ** len;
    }

    // 判斷是不是相同
    if (ans === i) {
      console.log(i);
    }
  }
}
