function loadImageFromInput(inputSelector, imageSelector) {
  document.querySelector(inputSelector).addEventListener("change", function () {
    if (this.files && this.files[0]) {
      const img = document.querySelector(imageSelector);
      img.onload = () => {
        URL.revokeObjectURL(img.src); // no longer needed, free memory
      };

      img.src = URL.createObjectURL(this.files[0]); // set src to blob url
    }
  });
}
