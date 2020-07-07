/* eslint-disable prefer-arrow-callback */
const request = require('request');
const process = require('process');

const API_ENDPOINT = 'https://lidemy-book-store.herokuapp.com';

function listBook() {
  request.get(
    `${API_ENDPOINT}/books?_limit=20`,
    function (error, response, body) {
      if (error) {
        console.log('失敗，錯誤代碼為：', error);
        return;
      }
      const data = JSON.parse(body);
      for (let l = 0; l < data.length; l += 1) {
        console.log(`${data[l].id} ${data[l].name}`);
      }
    },
  );
}

function readBook(id) {
  request.get(
    `${API_ENDPOINT}/books/${id}`,
    function (error, response, body) {
      if (error) {
        console.log('失敗，錯誤代碼為：', error);
        return;
      }
      const data = JSON.parse(body);
      console.log(data);
    },
  );
}

function deleteBook(id) {
  request.delete(
    `${API_ENDPOINT}/books/${id}`,
    function (error) {
      if (error) {
        console.log('失敗，錯誤代碼為：', error);
        return;
      }
      console.log('刪除成功');
    },
  );
}

function createBook(content) {
  request.post(
    {
      url: `${API_ENDPOINT}/books`,
      form: {
        name: content,
      },
    },
    function (error) {
      if (error) {
        console.log('失敗，錯誤代碼為：', error);
        return;
      }
      console.log('新增成功');
    },
  );
}

function updateBook(id, content) {
  request.patch(
    {
      url: `${API_ENDPOINT}/books/${id}`,
      form: {
        name: content,
      },
    },
    function (error) {
      if (error) {
        console.log('失敗，錯誤代碼為：', error);
        return;
      }
      console.log('更新成功');
    },
  );
}

switch (process.argv[2]) {
  case 'list':
    listBook();
    break;
  case 'read':
    readBook(process.argv[3]);
    break;
  case 'delete':
    deleteBook(process.argv[3]);
    break;
  case 'create':
    createBook(process.argv[3]);
    break;
  case 'update':
    updateBook(process.argv[3], process.argv[4]);
    break;
  default:
    console.log('輸入內容有錯誤');
}
