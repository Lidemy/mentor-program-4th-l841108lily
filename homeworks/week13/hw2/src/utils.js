export function appendStyle(cssTemplate) {
  const styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  styleElement.appendChild(document.createTextNode(cssTemplate))
  document.head.appendChild(styleElement)
}

// 跳脫字元
export function escapeOutput(toOutput){
  return toOutput.replace(/\&/g, '&amp;')
    .replace(/\</g, '&lt;')
    .replace(/\>/g, '&gt;')
    .replace(/\"/g, '&quot;')
    .replace(/\'/g, '&#x27')
    .replace(/\//g, '&#x2F');
}

// 顯示留言
export function appendCommentToDOM(container, comment, isPrepend) {
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