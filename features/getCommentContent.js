const getCommentContent = (function () {
  let commentModalBody;
  return {
    setCommentModalBody(selector) {
      commentModalBody = document.querySelector(selector);
    },
    start(contentEle) {
      commentModalBody.textContent = contentEle.textContent;
    },
  };
})();
