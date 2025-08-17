const searchInput = document.getElementById('search');
const deleteInput = document.getElementById('delete');
const updateInput = document.getElementById('update');
function getNumber(number){
    searchInput.value = number;
    deleteInput.value = number;
    updateInput.value = number;
}