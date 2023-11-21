const handleSingleRestore = (function () {
  let checkbox;
  let restoreModal;
  let restoreModalDialog;

  return {
    setCheckbox(id) {
      checkbox = document.querySelector(`input[value="${id}"]`);
    },
    setRestoreModal(selector) {
      restoreModal = document.querySelector(selector);
    },
    setRestoreModalDialog(selector) {
      restoreModalDialog = restoreModal.querySelector(selector);
    },
    start(id) {
      this.setCheckbox(id);

      restoreModalDialog.addEventListener("transitionstart", function () {
        checkbox.checked = restoreModal.classList.contains("show");
      });
    },
  };
})();
