## 請說明雜湊跟加密的差別在哪裡，為什麼密碼要雜湊過後才存入資料庫
[請客倌參閱這邊](https://l841108lily.coderbridge.io/2020/09/20/be101/)

## `include`、`require`、`include_once`、`require_once` 的差別

### 首先先比較 include 和 require 之間的差別：
require適合用來引入靜態的內容，而include則適合用來引入動態的程式碼。
include在執行時，如果include進來的檔案發生錯誤的話，會顯示警告，不會立刻停止；
而require 則是會顯示錯誤，立刻終止程式，不再往下執行。
include可以用在迴圈；require不行。
### 再來比較有 once 和沒有 once 的差別：
使用方法跟require、include一樣，差別在於在引入檔案前，會先檢查檔案是否已經在其他地方被引入過了，若有，就不會再重複引入。

[此題參考這邊](http://syunguo.blogspot.com/2013/04/phpinclude-require.html)

## 請說明 SQL Injection 的攻擊原理以及防範方法

[歡迎光臨這邊請](https://l841108lily.coderbridge.io/2020/09/21/be101-3/)


##  請說明 XSS 的攻擊原理以及防範方法

[請客倌到裡面坐坐](https://l841108lily.coderbridge.io/2020/09/21/be101-2/)
## 請說明 CSRF 的攻擊原理以及防範方法

CSRF 全名稱為 Cross-site request forgery，也就是跨站請求偽造攻擊，現在的網頁基本上都是使用 cookie 或者 session 機制進行身份驗證，CSRF 就是根據這個機制進行的攻擊，當你在擁有網站驗證的 cookie 時，進入了惡意網站，惡意網站會存取你的 cookie，竊取你的身份在該網站進行動作，但這種攻擊目前已經有相對應得防範方法，可以分為`檢查 referer 欄位`以及`加入驗證 token`，檢查 referer欄位就是除了目標網站以外的請求一概不接收，便可以杜絕惡意網站的任何請求；加入驗證 token 則是當使用者可以提出一個唯一且保密的 token，攻擊者拿不到這個 token，自然而然就沒辦法竊取身份。其實這樣的攻擊方式已經非常常見，只要在設計網頁功能時記得確定有開啟 CSRF 防護，就不需要太擔心。

[這題是參考這邊喔](https://medium.com/@Tommmmm/csrf-%E6%94%BB%E6%93%8A%E5%8E%9F%E7%90%86-d0f2a51810ca)