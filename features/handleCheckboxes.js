const handleCheckboxes = (function () {
  let checkboxAll;
  let checkboxes;
  const actionBtns = [];
  let submitBtn;
  let checkedQuantity = 0;

  return {
    setCheckboxAllElement(selector) {
      checkboxAll = document.querySelector(selector);
    },
    setCheckboxElements(selector) {
      checkboxes = document.querySelectorAll(selector);
    },
    setDeleteBtn(selector) {
      actionBtns.push(document.querySelector(selector));
    },
    setSubmitBtn(selector) {
      submitBtn = document.querySelector(selector);
    },
    setCheckedQuantity() {
      checkedQuantity = checkboxes.length;
    },
    start() {
      checkboxAll.addEventListener("change", function () {
        checkboxes.forEach((checkbox) => {
          checkbox.checked = this.checked;
        });

        if (this.checked) {
          checkedQuantity = checkboxes.length;
        } else {
          checkedQuantity = 0;
        }

        handleCheckboxes.activeDeleteBtn();
        handleCheckboxes.activeSubmitBtn();
      });

      checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
          if (!this.checked) {
            checkedQuantity--;
          } else {
            checkedQuantity++;
          }

          handleCheckboxes.activeDeleteBtn();
          handleCheckboxes.activeSubmitBtn();
          handleCheckboxes.handleCheckboxAll();
        });
      });
    },
    activeDeleteBtn() {
      actionBtns.forEach((actionBtn) => {
        if (checkedQuantity > 0) {
          actionBtn?.classList.remove("disabled");
        } else {
          actionBtn?.classList.add("disabled");
        }
      });
    },
    handleCheckboxAll() {
      if (checkedQuantity === checkboxes.length) {
        checkboxAll.checked = true;
      } else {
        checkboxAll.checked = false;
      }
    },
    activeSubmitBtn() {
      if (checkedQuantity > 0) {
        submitBtn?.classList.remove("disabled");
      } else {
        submitBtn?.classList.add("disabled");
      }
    },
  };
})();
