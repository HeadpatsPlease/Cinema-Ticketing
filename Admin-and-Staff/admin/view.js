const searchInput = document.getElementById('search');
const deleteInput = document.getElementById('delete');
function getNumber(number){
    searchInput.value = number;
    deleteInput.value = number;
}