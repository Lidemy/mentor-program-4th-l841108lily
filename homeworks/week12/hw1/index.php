<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>留言板</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <style type="text/css">
    .card {
      margin-top: 20px;
    }
  </style>
  <script>
    // 跳脫字元
    function escapeOutput(toOutput){
      return toOutput.replace(/\&/g, '&amp;')
        .replace(/\</g, '&lt;')
        .replace(/\>/g, '&gt;')
        .replace(/\"/g, '&quot;')
        .replace(/\'/g, '&#x27')
        .replace(/\//g, '&#x2F');
    }

    // 顯示留言
    function appendCommentToDOM(container, comment, isPrepend) {
      const html = `
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">${comment.id} ${escapeOutput(comment.nickname)}</h5>
            <p class="card-text">${escapeOutput(comment.content)}</p>
          </div>
        </div>
      `
      // 怎麼顯示
      if (isPrepend) {
        container.prepend(html)
      } else {
        container.append(html)
      }
    }

    function getCommentsAPI(siteKey, before, cb) {
      let url = `http://mentor-program.co/mtr04group5/l841108lily/week12_board/api_comments.php?site_key=${siteKey}`
      if (before) {
        url += "&before=" + before
      }
      $.ajax({
        url,
      }).done(function(data) {
        cb(data)
      });
    }

    const siteKey = "oh"
    const loadMoreButtonHTML = "<button class='btn btn-primary load-more'>載入更多</button>"
    let lastId = null
    let isEnd = false

    $(document).ready(() => {
      const commentDOM = $('.comments')
      getComments()

      $('.comments').on('click', '.load-more', () => {
        getComments()
      })

      $(".add-comment-form").submit(e => {
        e.preventDefault();

        const newCommentData = {
          'site_key': 'oh',
          'nickname': $('input[name=nickname]').val(),
          'content': $('textarea[name=content]').val()
        }

        $.ajax({
          type: 'POST',
          url: 'http://mentor-program.co/mtr04group5/l841108lily/week12_board/api_add_comments.php',
          data: newCommentData
        }).done(function(data) {
          if (!data.ok) {
            alert(data.message)
            return
          }
          $('input[name=nickname]').val('')
          $('textarea[name=content]').val('')
          appendCommentToDOM(commentDOM, newCommentData, true)
        });
      })
    })

    function getComments() {
      const commentDOM = $('.comments')
      $('.load-more').hide()
      if (isEnd) {
        return
      }
      getCommentsAPI(siteKey, lastId, data => {
        if (!data.ok) {
          alert(data.message)
          return
        }

        const comments = data.discussions;
        for (let comment of comments) {
          appendCommentToDOM(commentDOM, comment)
        }
        let length = comments.length
        if (length === 0) {
          isEnd = true
          $('.load-more').hide()
        } else {
          lastId = comments[length - 1].id
          $('.comments').append(loadMoreButtonHTML)
        }
        
      })
    }
  </script>
</head>

<body>
  <div class="container">
    <form class="add-comment-form">
      <div class="form-group">
        <label for="form-nickname">暱稱</label>
        <input name="nickname" type="text" class="form-control" id="form-nickname">
      </div>
      <div class="form-group">
        <label for="content-textarea">留言內容</label>
        <textarea name="content" class="form-control" id="content-textarea" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">送出</button>
    </form>
    <div class="comments">
    </div>
  </div>


</body>
</html>



