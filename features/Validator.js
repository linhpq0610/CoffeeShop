const formValidator = (function () {
  let form;
  const FIELDS = {};
  let shouldSubmit = true;
  const CONSTRAINTS = {
    name: {
      presence: {
        allowEmpty: false,
        message: "Vui lòng nhập tên",
      },
      format: {
        pattern:
          /^[a-zA-Z\sàáạãảăắằẵặấầẩẫậđèéẹẻẽêếềểễệìíịỉĩòóọỏõôốồổỗộơớờởỡợùúụủũưứừửữựỳýỵỷỹ]+$/,
        message: "Vui lòng không nhập gì ngoài alphabet và ký tự trắng",
      },
    },
    email: {
      presence: {
        allowEmpty: false,
        message: "Vui lòng nhập email",
      },
      email: {
        message: "Email không hợp lệ",
      },
    },
    password: {
      presence: {
        allowEmpty: false,
        message: "Vui lòng nhập mật khẩu",
      },
      length: {
        minimum: 8,
        tooShort: "Vui lòng nhập ít nhất 8 ký tự",
      },
    },
    confirmPassword: {
      equality: {
        attribute: "password",
        message: "Vui lòng nhập trùng khớp với mật khẩu trên",
      },
      presence: {
        allowEmpty: false,
        message: "Vui lòng nhập xác nhận mật khẩu",
      },
    },
  };

  function handleValidateConfirmPassword() {
    let errors = validate(
      {
        confirmPassword: FIELDS.confirmPassword.value,
        password: FIELDS.password.value,
      },
      CONSTRAINTS
    );
    return errors;
  }

  function handleValidateField(fieldName, field, fieldMessage) {
    let errors;
    if (fieldName != "confirmPassword") {
      errors = validate({ [fieldName]: field.value }, CONSTRAINTS);
    } else {
      errors = handleValidateConfirmPassword();
    }

    if (errors[fieldName]) {
      // Origin: fieldName + message
      // Example: Email Vui lòng nhập email
      fieldMessage.textContent = errors[fieldName][0].substring(
        fieldName.length + 1
      );
      shouldSubmit = false;
    }
  }

  function getFieldMessage(field) {
    if (field.parentNode.querySelector(".field-message")) {
      return field.parentNode.querySelector(".field-message");
    }

    return getFieldMessage(field.parentNode);
  }

  function validateField(fieldName, field) {
    let fieldMessage = getFieldMessage(field);
    field.onblur = function () {
      handleValidateField(fieldName, field, fieldMessage);
    };
    field.onfocus = function () {
      fieldMessage.textContent = "";
    };
  }

  function validateForm(fields) {
    for (let fieldName in fields) {
      let field = fields[fieldName];
      validateField(fieldName, field);
    }
  }

  return {
    setForm(selector) {
      form = document.querySelector(selector);
    },
    getForm() {
      return form;
    },
    addField(filedName, field) {
      FIELDS[filedName] = field;
    },
    start() {
      validateForm(FIELDS);

      form.onsubmit = (e) => {
        e.preventDefault();
        for (let fieldName in FIELDS) {
          let field = FIELDS[fieldName];
          let fieldMessage = getFieldMessage(field);
          handleValidateField(fieldName, field, fieldMessage);
        }
        if (shouldSubmit) {
          form.submit();
        }
        shouldSubmit = true;
      };
    },
    addConstraint(newConstraint) {
      Object.assign(CONSTRAINTS, newConstraint);
    },
  };
})();
