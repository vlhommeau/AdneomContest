$(document).ready(function() {
    localStorage.setItem('champSelected', '');
});
function setChampion(id) {
    var path = $('#'+id).attr('data-animation-path');
    $('.selectedChar').attr('src', path);

    localStorage.setItem('champName', $('#'+id).attr('name'));
    if (localStorage.getItem('champSelected') != '') {
        $(localStorage.getItem('champSelected')).css("border", "none");
    }

    $('#'+id).css("border", "6px solid #00008B");
    $('#'+id).css("border-collapse", "collapse");
    localStorage.setItem('champSelected', '#'+id);
    $('#hiddenSelectedChamp').val(id.substring(5));
}