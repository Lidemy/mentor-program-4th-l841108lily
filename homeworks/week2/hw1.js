//給定 n（1<=n<=30），依照規律「印出」正確圖形

function printStars(n) {

  if(n<1 || n>30) {
    console.log('n is not in the range.')
  }else{
    for(i=1; i<=n; i++){
    console.log('*')
    }
  }
}

printStars(31)
//printStars(3)
//printStars(6)