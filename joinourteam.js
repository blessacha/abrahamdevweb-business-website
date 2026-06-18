// Function to handle form submission via AJAX
function submitForm(event) {
    event.preventDefault(); // Prevent default form submission

    var form = document.getElementById('form3');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'submit_form.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = xhr.responseText;
            alert(response);
            if (response.includes("successfully")) {
                form.reset(); // Clear form fields on successful submission
            }
        } else {
            alert('Error submitting form. Please try again later.');
        }
    };
    xhr.onerror = function () {
        alert('Error submitting form. Please try again later.');
    };
    xhr.send(formData);
}

// Attach form submission function to form submit event
document.getElementById('form3').addEventListener('submit', submitForm);
