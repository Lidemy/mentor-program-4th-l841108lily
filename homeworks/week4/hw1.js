/* eslint-disable prefer-arrow-callback */
/* eslint-disable no-shadow */
const request = require('request');
// 記錄一下下一行是 hw2 寫完之後感覺這種模組化很需要，才加上的。
const API_ENDPOINT = 'https://lidemy-book-store.herokuapp.com';

request.get(
  API_ENDPOINT`/books?_limit=10`,
  function (error, response, body) {
    if (error) {
      console.log('失敗，錯誤代碼為：', error);
      return;
    }
    let data;
    try {
      data = JSON.parse(body);
    } catch (error) {
      console.log('JSON轉物件錯誤，錯誤代碼為：', error);
      return;
    }
    for (let i = 0; i < data.length; i += 1) {
      console.log(`${data[i].id} ${data[i].name}`);
    }
  },
);
