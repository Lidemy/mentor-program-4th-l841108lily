import $ from "jquery"

export function getComments(apiURL, siteKey, before, cb) {
  let url = `${apiURL}/api_comments.php?site_key=${siteKey}`
  if (before) {
    url += "&before=" + before
  }
  $.ajax({
    url,
  }).done(function(data) {
    cb(data)
  });
}

export function addComments(apiURL, siteKey, data, cb) {
  $.ajax({
    type: 'POST',
    url: `${apiURL}/api_add_comments.php`,
    data
  }).done(function(data) {
    cb(data)
  });
}