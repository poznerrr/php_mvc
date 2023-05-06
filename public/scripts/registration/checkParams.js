function validate() {
    let password = document.querySelector('#password');
    let confirm = document.querySelector('#confirm-password');
    if (password.value !== confirm.value) {
        alert ('Password and confirmation do not match !');
        return false;
    }
    return true;
}