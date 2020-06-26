//給定一字串，把第一個字轉成大寫之後「回傳」，若第一個字不是英文字母則忽略

function capitalize(str) {
  
  str = str[0].toUpperCase() + str.slice(1)

  return str
}

console.log(capitalize('nike'))
console.log(capitalize('Nike'))
console.log(capitalize(',hello'))
