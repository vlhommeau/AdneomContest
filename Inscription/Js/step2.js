$(document).ready(function() {
    localStorage.setItem('champSelected', '');
});
function setChampion(id) {
    var champ = $('#'+id);
    var path = champ.attr('data-animation-path');
    $('.selectedChar').attr('src', path);

    localStorage.setItem('champName', champ.attr('name'));
    if (localStorage.getItem('champSelected') != '') {
        $(localStorage.getItem('champSelected')).css("border", "none");
    }

    champ.css("border", "6px solid #00008B");
    champ.css("border-collapse", "collapse");
    localStorage.setItem('champSelected', '#'+id);

    $('#idSelectedChamp').val(id.substring(5));
    $('#nameSelectedChamp').val(champ.attr('name'));
}