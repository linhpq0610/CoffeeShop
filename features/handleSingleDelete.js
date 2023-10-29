const handleSingleDelete = (function () {
  let checkbox;
  let deleteModal;
  let deleteModalDialog;

  return {
    setCheckbox(id) {
      checkbox = document.querySelector(`input[value="${id}"]`);
    },
    setDeleteModal(selector) {
      deleteModal = document.querySelector(selector);
    },
    setDeleteModalDialog(selector) {
      deleteModalDialog = deleteModal.querySelector(selector);
    },
    start(id) {
      this.setCheckbox(id);

      deleteModalDialog.addEventListener("transitionstart", function () {
        checkbox.checked = deleteModal.classList.contains("show");
      });
    },
  };
})();
