$(document).ready(function () {
    $('#example').DataTable({
        columnDefs: [
            {
                targets: 4,
                render: DataTable.render.datetime('D MMM YYYY', 'MMM D, YY', 'en'),
            },
        ],
    });
});
$(document).ready(function () {
    var table = $('#example').DataTable();
 
    $('#example tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
 
    $('#button').click(function () {
        table.row('.selected').remove().draw(false);
    });
});
$(window).scroll(function(){
    if ($(window).scrollTop() >= 450) {
        $('nav').addClass('fixed-header');
        $('nav div').addClass('visible-title');
    }
    else {
        $('nav').removeClass('fixed-header');
        $('nav div').removeClass('visible-title');
    }
});

