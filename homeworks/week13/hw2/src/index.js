import { getComments, addComments} from  "./api";
import { appendCommentToDOM, appendStyle} from  "./utils";
import {cssTemplate, getLoadMoreButton, getForm} from "./templates";
import $ from "jquery";

export function init(options) {
  let siteKey = "";
  let apiURL = "";
  let containerElement = null;
  let commentDOM = null;
  let lastId = null;
  let isEnd = false;
  let loadMoreClassName;
  let commentsClassName;
  let commentsSelector;
  let formClassName;
  let formSelector;

  siteKey = options.siteKey;
  apiURL = options.apiURL;

  loadMoreClassName = `${siteKey}-load-more`;
  commentsClassName = `${siteKey}-comments`;
  commentsSelector = '.' + commentsClassName;
  formClassName = `${siteKey}-add-comment-form`;
  formSelector = '.' + formClassName;

  containerElement = $(options.containerSelector);
  containerElement.append(getForm(formClassName, commentsClassName));
  appendStyle(cssTemplate);

  commentDOM = $(commentsSelector);
  getNewComments();

  $(commentsSelector).on('click', loadMoreClassName, () => {
    getNewComments();
  })

  $(formSelector).submit(e => {
    e.preventDefault();
    const nicknameDOM = $(`${formSelector} input[name=nickname]`);
    const contentDOM = $(`${formSelector} textarea[name=content]`);
    const newCommentData = {
      site_key: siteKey,
      nickname: nicknameDOM.val(),
      content: contentDOM.val(),
    };
    addComments(apiURL, siteKey, newCommentData, data => {
      if (!data.ok) {
        alert(data.message);
        return;
      }
      nicknameDOM.val('');
      contentDOM.val('');
      appendCommentToDOM(commentDOM, newCommentData, true);
    })
  })

  function getNewComments() {
    const commentDOM = $(commentsSelector);
    $(loadMoreClassName).hide();
    if (isEnd) {
      return;
    }
    getComments(apiURL, siteKey, lastId, data => {
      if (!data.ok) {
        alert(data.message);
        return;
      }

      const comments = data.discussions;
      for (let comment of comments) {
        appendCommentToDOM(commentDOM, comment);
      }
      let length = comments.length
      if (length === 0) {
        isEnd = true;
        $(loadMoreClassName).hide();
      } else {
        lastId = comments[length - 1].id;
        const loadMoreButtonHTML = getLoadMoreButton(loadMoreClassName);
        $(commentsSelector).append(loadMoreButtonHTML);
      }
      
    })
  }
}
