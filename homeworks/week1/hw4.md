## 跟你朋友介紹 Git

Git 其實就是一種版本控制的方法，如果只是單純的紀錄笑話，那麼我們就講講常見的指令用法：

* 首先先在需要進行版本控制的資料夾做初始化`git init`
* 可以隨時查看目前版本控制的狀態`git status`
* 當今天寫完笑話時，可以使用 add 把它加入版本控制進行追蹤`git add + 檔案名稱`
* 最後可以將這些新增、修改的動作加入註解`git commit`
* 在這邊需要重新釐清 add 和 commit 的關係：
 1. `git add`是將檔案加入版本控制（可以想像成把東西放入資料夾暫存）
 2. `git commit`是新建版本（把資料夾命名）


另外，我再附上其他常見的指令供你參考：

* `git add .`將所有檔案加入版控  
* `git rm —cashed + 檔案名稱` 取消該檔案的版控  
* `git commit -m` 新建一個版控，直接輸入文字  
* `git log` 查看歷史資料  
* `git log —oneline` 查看歷史資料，簡短地顯示  
* `git checkout + 版本commit` 回到該版本的檔案  
* `git checkout master` 回到最新commit版本  
* `git diff` 看這次與上次之間改了什麼  
