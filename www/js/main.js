$(function(){

    $('.input-daterange').datepicker({
        locale:'cs',
        format: 'dd.mm.yyyy',
        startDate:  new Date(),
        todayHighlight: true
    });

    $('table.reservation a.place').on('click', function () {
       var id = $(this).data('place');
       $('input[name=place]').val(id);
       $('span.place-number').html(id);
    });

});

