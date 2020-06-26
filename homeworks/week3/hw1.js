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
  var n = lines[0]
  if(n<1 || n>30){
    console.log('n is not in the range.')
  }else{
    for(let i=1; i<=n; i++){
      var str = ''
      for(let j=1; j<=i; j++){
        str += '*'
      }
      console.log(str)
    }
  }
}

