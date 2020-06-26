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

  var str = lines[0]
  var n = str.length

  var rts = opposite(str, n)
  if(rts === str){
    console.log("True")
  }else{
    console.log("False")
  }
  
}

function opposite(str, n){
    var S = ''
  for (i=n-1; i>=0; i--){

    S += str[i]
  }
  return S
}