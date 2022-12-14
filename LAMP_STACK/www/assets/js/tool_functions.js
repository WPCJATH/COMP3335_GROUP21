
/*

var needsValidation = document.querySelectorAll('.needs-validation')

Array.prototype.slice.call(needsValidation)
    .forEach(function(form) {
        form.addEventListener('onsubmit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
*/
function customAlert(msg, elementId="insert"){
    let msg_bar = document.getElementById("alert_msg");
    if (msg_bar!==null)
        msg_bar.parentElement.removeChild(msg_bar);
    document.getElementById(elementId).insertAdjacentHTML('afterend',
        `<div id="alert_msg" class='alert alert-info'> ${msg}</div>`);
}
