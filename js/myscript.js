if (window.location.search.indexOf("loginerror") != -1) {
  $("#logInModal").modal("show");
}

var inputs = document.querySelectorAll(
  "input[type=text] ,input[type=email], input[type=password], textarea,select"
);
inputs.forEach(input => {
  input.addEventListener("change", function(e) {
    if (e.target.value != "") {
      e.target.parentElement.children[1].classList.add("customclass");
    } else {
      e.target.parentElement.children[1].classList.remove("customclass");
    }
  });
});

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  "use strict";
  window.addEventListener(
    "load",
    function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName("needs-validation");
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener(
          "submit",
          function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add("was-validated");
          },
          false
        );
      });
    },
    false
  );
})();

var upload = document.querySelector("input[type=file]");
if (upload != null) {
  upload.addEventListener("change", function(e) {
    if (upload.files[0]["size"] > 500000) {
      document
        .getElementById("clientSideImageValidation")
        .classList.remove("d-none");
      document.getElementById("save_btn").setAttribute("disabled", "true");
    } else {
      editDisplayImage.src = URL.createObjectURL(upload.files[0]);
      document
        .getElementById("clientSideImageValidation")
        .classList.add("d-none");
      document.getElementById("save_btn").removeAttribute("disabled");
    }
  });
}
