## 請以自己的話解釋 API 是什麼
API 是一種溝通的方式，當我想要使用別人開發的**神作**之中的**某種功能**，我就需要一個管道跟他說「我需要你的某某功能」，而他不可能把所有**神作**裡面的機密都給我看，只會借給我我需要、他也願意出借的東西，而 API 就是這個借東西的管道。舉一個最常見的東西，很多遊戲都可以選擇「使用 Facebook 登入」，為什麼大家都可以用 Facebook 登入呢？就是因為大家都跟 Facebook 借**登入的功能**，而且 Facebook 也願意把這個功能借給大家，至於怎麼借，並不是寫信給 Facebook 跟他說，而是找到 Facebook 開放大家串連的 API。


## 請找出三個課程沒教的 HTTP status code 並簡單介紹

`401 Unauthorized` 需要被授權的資格條件才可以收到 response，在這邊不一定代表發出 request 的人資格不符，而是 server 不曉得發出 request 的人資格狀態為何。另外，有些 server 網站的狀態碼會直接顯示 401，有可能代表該特定位址被拒絕存取網站。

`403 Forbidden` 一種可能性為發出 request 的人沒有被授權，所以不會收到 response；另一種則是與身份驗證無關，是因為這個 request 不應該被重複提交。

`409 Conflict` 表示 request 與 server 目前的狀態衝突，所以不會收到 response。例如多個項目同步更新，因產生衝突而無法處理 response。

## 假設你現在是個餐廳平台，需要提供 API 給別人串接並提供基本的 CRUD 功能，包括：回傳所有餐廳資料、回傳單一餐廳資料、刪除餐廳、新增餐廳、更改餐廳，你的 API 會長什麼樣子？請提供一份 API 文件。

Base URL: https://lidemy-restaurant-management.com

| 說明           | Method        | Path  | 參數 | 範例 |
| ------------- |:-------------:| -----:| -----:| -----:|
| 回傳所有餐廳資料 | GET | /restaurants     | _limit:限制回傳資料數量 | /restaurants?_limit=5 |
| 回傳單一餐廳資料 | GET | /restaurants/:id | 無 | /restaurants/5 |
| 刪除餐廳 | DELETE     | /restaurants/:id | 無 | 無 |
| 新增餐廳 | POST       | /restaurants     | name: 餐廳名稱 | 無 |
| 更改餐廳 | PATCH      | /restaurants/:id | name: 餐廳名稱 | 無 |
