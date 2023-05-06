const buttonSearch = document.querySelector('#button-search');
const inputSearch = document.querySelector('#input-search');
const form = document.querySelector('#form-search');
const cancelSearch = document.querySelector('#cancel-search');
buttonSearch.addEventListener('click', () => {
    let value = inputSearch.value.trim();
    if (value ==='' || value===undefined) {
        alert("Пустая строка поиска");
    } else {
        form.submit();
    }
})

cancelSearch.addEventListener('click', () => {
    window.location='/';
})