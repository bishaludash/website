
'use strict';

; (function (document, window, index) {
    var inputs = document.querySelectorAll('.inputfile');
    Array.prototype.forEach.call(inputs, function (input) {
        var label = input.nextElementSibling,
            labelVal = label.innerHTML;

        input.addEventListener('change', function (e) {
            var fileName = '';
            if (this.files && this.files.length > 1)
                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
            else
                fileName = e.target.value.split('\\').pop();

            if (fileName)
                label.querySelector('span').innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        });

        // Firefox bug fix
        input.addEventListener('focus', function () { input.classList.add('has-focus'); });
        input.addEventListener('blur', function () { input.classList.remove('has-focus'); });
    });
}(document, window, 0));

$(document).ready(function () {
    $('.avatar-file').on('change', function (e) {
        // display loader
        $('.avatar-loader').removeClass('d-none');

        var url = $('#avatar-upload').attr('action');
        var method = $('#avatar-upload').attr('method')
        var token = $('input[name="_token"]').attr('value')

        var formData = new FormData();
        var files = $('#user_avatar')[0].files[0];
        formData.append("user_avatar", files);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });

        $.ajax({
            url: url,
            method: method,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // console.log(response);
                if (response.status == 'fail') {
                    $('.avatar-error').removeClass('d-none').text(response.message);
                } else {
                    $('.avatar-error').removeClass('d-none').text(response.message);
                    $(".display-avatar").removeClass('d-none').attr("src", response.image_path);

                    $('.user_avatar').attr('value', response.image_path);
                }

                // hide loader
                $('.avatar-loader').addClass('d-none');
            }
        });


    });
});