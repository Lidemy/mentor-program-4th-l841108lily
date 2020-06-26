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
  for(let i=1;i<=Number(lines[0]); i++){
    let [a, b, k] = lines[i].split(' ')
    console.log(compare(a, b, k))
  }
}

function compare(a, b, k) {
  if(a === b) return 'DRAW' 
  if(k == -1){
    var temp = a
    a = b
    b = temp
  }
  const aLength = a.length
  const bLength = b.length

  if(aLength != bLength){
    return aLength > bLength ? 'A' : 'B' 
  }
  return a > b ? 'A' : 'B'
}
