## 什麼是 Ajax？
全名稱為 Asynchronous JavaScript and XML，維基百科上的中文翻譯成「非同步的JavaScript與XML技術」，主要用途為利用 JavaScript 程式產生連結去訪問後台的程式，並回傳 XML 或 JSON 等格式的資料。


## 用 Ajax 與我們用表單送出資料的差別在哪？
用表單送出的話需要重新整理頁面，但是許多功能其實只需要動態改變頁面的內容，所以採用 Ajax 就可以避免到每按一個按鈕都需要重新整理頁面的狀況

## JSONP 是什麼？
全名稱為 JSON with Padding，因為同源政策 (Same Origin Policy) 的關係，A 網域會被限制存取  B 網域的資料，然而有先標籤不再限制範圍，如 img 和 script，所以 JSONP 就是利用 HTML 中的 script 元素抓取資料的一種方法。


## 要如何存取跨網域的 API？
第一種方法叫做跨來源資源共享(Cross-Origin Resource Sharing, CORS)，白話文就是：「如果我想要在不同網域間存取資料，我應該要遵守的規範」，而實際的做法是在 header 中設定 Access-Control-Allow-Origin。

第二種方式就是利用 JSONP 來進行存取。

## 為什麼我們在第四週時沒碰到跨網域的問題，這週卻碰到了？
因為第四週的時候我們是利用終端機的 node.js 發出 request，此時不會有安全性的疑慮，但是第八週我們透過瀏覽器發出 request 就會需要遵守瀏覽器在安全考量上的規範，也就是 Same Origin Policy 和 CORS。

