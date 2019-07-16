$(function(){
    $(document).on('click','.ajax-modal',function (e) {
        e.preventDefault();
        url = $(this).attr('data-url');
        title = $(this).attr('data-title');
        $('.ajax-form-model').modal();
        $('.modal .modal-title').html(title);
        $('.ajax-form-model .panel-body').load(url);
        $('.ajax-load-image').addClass('d-none');
    });

});