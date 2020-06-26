var readline = require('readline');

var lines = []
var rl = readline.createInterface({
  input: process.stdin
});

rl.on('line', function (line) {
  lines.push(line)
});

rl.on('close', function() {
  solve(lines)
})

function solve(lines) {
  var [N, M]= lines[0].split(' ')
 
  for(let i=Number(N); i<=Number(M); i++){

    //計算幾位數
    let iStr = String(i)
    let len = iStr.length
    var ans = 0
    //每位數次方後相加
    for(let j=1; j<=len; j++){
      ans += Math.pow(iStr[j-1], len)
    }

    //判斷是不是相同
    if (ans === i){
      console.log(i)
    }
  }
}