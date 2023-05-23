const inputTitleEdit =  document.querySelector("#input-title-edit");
const inputIdEdit =  document.querySelector("#input-id-edit");
const inputTextEdit =  document.querySelector("#input-text-edit");
const inputAuthorEdit = document.querySelector("#input-author-edit");
const inputCategoryEdit = document.querySelector("#input-category-edit");

inputTitleEdit.addEventListener('input', (e) => {
    e.target.classList.add('changed');
})

inputTextEdit.addEventListener('input', (e) => {
    e.target.classList.add('changed');
})

inputAuthorEdit.addEventListener('change', (e) => {
    e.target.classList.add('changed');
})
inputCategoryEdit.addEventListener('change', (e) => {
    e.target.classList.add('changed');
})

function toggleEditModal(object) {
    const editModal = document.querySelector("#edit-modal");
    editModal.classList.toggle('hidden');
    if (editModal.classList.contains('hidden')) {
        inputTitleEdit.classList.remove('changed');
        inputTextEdit.classList.remove('changed');
        inputAuthorEdit.classList.remove('changed');
        inputCategoryEdit.classList.remove('changed');
    } else {
        inputIdEdit.value = object.closest('form').elements.id.value;
        inputTitleEdit.value = object.closest('form').elements.title.value;
        inputTextEdit.value = object.closest('form').elements.text.value;
        inputAuthorEdit.value = object.closest('form').elements.authorId.value;
        inputCategoryEdit.value = object.closest('form').elements.categoryId.value;
    }
}