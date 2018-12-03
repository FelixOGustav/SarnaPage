$(document).ready(function () {
    $('#sidebarshowbtn').on('click', function () {
        $('#sidebar, #content, #contentcontainer').toggleClass('hidden');
    });

    if(window.innerWidth < 769){
        $('#sidebar, #content, #contentcontainer').toggleClass('hidden');
    }

});

function ToggleDynatableCol(id){
    var dyntblcol = document.getElementById(id);
    if(dyntblcol.style.display != 'none'){
        dyntblcol.style.display = 'none';
    } else {
        dyntblcol.style.display = 'auto';
    }

    $('#regtbl').dynatable({
        features: {
            paginate: false,
            search: true,
            recordCount: true,
            search: true
        }
    });
}