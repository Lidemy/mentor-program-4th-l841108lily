/* eslint-disable quote-props */
const request = require('request');

const options = {
  url: 'https://api.twitch.tv/kraken/games/top',
  headers: {
    'Accept': 'application/vnd.twitchtv.v5+json',
    'Client-ID': 'l6lkkque775589mak7t7iti12r5fxe',
  },
};

function searchTopGame(error, response, body) {
  if (error) {
    console.log('失敗，錯誤代碼為：', error);
    return;
  }
  const data = JSON.parse(body);
  for (let i = 0; i < data.top.length; i += 1) {
    console.log(`${data.top[i].viewers} ${data.top[i].game.name}`);
  }
}

request(options, searchTopGame);
