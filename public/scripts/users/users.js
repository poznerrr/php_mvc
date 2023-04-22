const inputNameEdit =  document.querySelector("#input-name-edit");
const inputIdEdit =  document.querySelector("#input-id-edit");
inputNameEdit.addEventListener('input', (e) => {
    e.target.classList.add('changed');
})
function toggleEditModal(object) {
    const editModal = document.querySelector("#edit-modal");
    editModal.classList.toggle('hidden');
    inputNameEdit.value = object.closest('form').elements.name.value;
    inputIdEdit.value = object.closest('form').elements.id.value;
}