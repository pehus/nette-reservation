$(function(){

var sd = new Date(), ed = new Date();
    $('input[name=date_from]').datepicker({
        format: 'dd.mm.yyyy',
        defaultDate: sd, 
        maxDate: ed
    });
    
    $('input[name=date_to]').datepicker({
        format: 'dd.mm.yyyy',
        defaultDate: sd, 
        maxDate: ed
    });

    $('table.reservation a.place').on('click', function () {
       var id = $(this).data('place');
       $('input[name=place]').val(id);
    });

});

