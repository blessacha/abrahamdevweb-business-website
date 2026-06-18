document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("form1");
    form.onsubmit = function(event) {
        event.preventDefault(); // Prevent the default form submit

        var formData = new FormData(form);

        fetch("...", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                form.reset(); // Reset the form if email sent successfully
            }
        })
        .catch(error => {
            alert("An error occurred while submitting the form, Please try again.");
        });
    };
});