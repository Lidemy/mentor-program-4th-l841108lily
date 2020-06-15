## 一、寫作業流程
### 本地端
1. 開新的 branch 並切換 `git checkout -b week1`
2. 撰寫作業
3. 確認狀態 `git status`
4. 進行 commit `git commit -am "week1 完成"`

---

## 二、交作業流程

### `確認是否檢查作業、確認是否看過自我檢討`
--
### Github 端
1. 將本地檔案上傳至 Github  
`git push origin week1`
2. 打開 Github，點選 `Pull requests`
3. 點選綠色按鈕 `Compare & pull request`
4. 確認修改內容，撰寫 Commit
5. 點選 `Create pull request`  


### Lidemy 端
1. 點選 `新增作業`
2. 選擇第幾週，並貼上PR連結， `需注意連結位置要在 Pull requests頁面`

---
## 三、同步回本地流程
1. 切換回 master `git checkout master`
2. 將 Github 下載回本地 `git pull origin master`
3. 將本地的 branch 刪除 `git branch  -d week1`