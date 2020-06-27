function join(arr, concatStr) {
  var ansArr = arr[0]
  for(i=1; i<=arr.length-1; i++){
    ansArr += concatStr
    ansArr += arr[i]
  }
  return ansArr
}

function repeat(str, times) {
  var ansStr = ''
  for(j=1; j<=times; j++){
    ansStr += str
  }
  return ansStr
}

console.log(join(['a'], '!'))
console.log(join([1,2,3], ''))
console.log(join(["a", "b", "c"], '!'))
console.log(join(["a", 1, "b", 2, "c", 3], ','))
console.log(join(["aaa", "bb", "c", "dddd"], ',,'))

console.log(repeat('a', 5))
console.log(repeat('yoyo', 2))