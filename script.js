const checkbox = document.querySelector("#checkbox");
// here we detect mode dark
if (window.matchMedia("(prefers-color-scheme: dark))").matches) {
  checkbox.setAttribute("checked", true);
}

// here register and un-register classes
checkbox.addEventListener("change", function () {
  if (this.checked) {
    document.body.classList.add("is-dark-mode");
    document.body.classList.remove("is-light-mode");
  } else {
    document.body.classList.add("is-light-mode");
    document.body.classList.remove("is-dark-mode");
  }
});