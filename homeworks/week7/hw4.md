## 什麼是 DOM？
它的全名叫 Document Object Model，中文是檔案物件模型，是將 HTML 中的節點透過樹狀結構所表示出來，利用節點類型分類可以分為 document, element, text, attribute，當所有程式碼都依照 DOM 的規則撰寫，在需要抓取特定節點的時候就會變得比較容易，透過 DOM 的架構直接找出特定節點，或是利用父子關係及兄弟關係都能輕易找到目標。

[參考至此文章](https://ithelp.ithome.com.tw/articles/10202689)

## 事件傳遞機制的順序是什麼；什麼是冒泡，什麼又是捕獲？
當我們透過 DOM 在傳播的時候， target 就是我們要找到的目標節點，在 DOM 樹狀結構中，從 document 到 target 的過程路徑都稱作捕獲階段，從 target 再傳回 document 的過程路徑則是冒泡階段。當我們在做 addEventListener 的時候，可以加在捕獲以及冒泡的階段，如果要加在捕獲，參數就要加上 true，如果要加在冒泡階段，參數則是 false。特別的是，如果在 target 上加入了兩個或以上的 addEventListener 會根據程式執行順序來跑，並不會先執行參數為 true 的。

[參考至此文章](https://blog.techbridge.cc/2017/07/15/javascript-event-propagation/)

## 什麼是 event delegation，為什麼我們需要它？
event delegation 的中文稱作事件代理，當我們想要對每個某種特定節點進行監聽時，會遇到設置過多的 addEventListener 的狀況，所以我們可以透過事件代理，監聽這些特定節點的父節點，基於 DOM 的結構，我們只要監聽父節點，就可以知道所有特定節點的狀況。

## event.preventDefault() 跟 event.stopPropagation() 差在哪裡，可以舉個範例嗎？
event.preventDefault 是取消某個節點的預設狀況，例如取消 submit 的提交動作，並不會影響到事件的傳遞；而 event.stopPropagation 則是讓整個事件傳遞在碰到 event.stopPropagation 的那一刻停止傳遞，例如在按下 submit 的時候後續的冒泡都會停止，此時如果有 addEventListener 加在冒泡階段，就不會進行作動。
