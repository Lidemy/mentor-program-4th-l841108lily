/* eslint-disable prefer-arrow-callback */
const request = require('request');
const process = require('process');

const API_ENDPOINT = 'https://restcountries.eu/rest/v2';

// 如果忘記輸入國家，可以跳出提醒
if (!process.argv[2]) {
  console.log('請輸入國家名稱');
}

function searchName(name) {
  request.get(
    `${API_ENDPOINT}/name/${name}`,
    function (error, response, body) {
      if (error) {
        console.log('找不到國家資訊，錯誤代碼為：', error);
        return;
      }
      const data = JSON.parse(body);
      for (let s = 0; s < data.length; s += 1) {
        console.log('============');
        console.log(`國家：${data[s].name}`);
        console.log(`首都：${data[s].capital}`);
        console.log(`貨幣：${data[s].currencies[0].code}`);
        console.log(`國碼：${data[s].callingCodes}`);
      }
    },
  );
}

searchName(process.argv[2]);
