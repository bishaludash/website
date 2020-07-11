$(document).ready(function () {

    // resume selected section, toggle minimize icon toggle
    $('.resume-section').click(function () {
        $(this).toggleClass('bg-resume-section');
        $("i", this).toggleClass("ion-minus-circled ion-plus-circled text-success");
    })

    // Toggle collapse all section 
    setTimeout(function () {
        $('.toggle-collapse').removeClass('disabled')
    }, 2000)


    // Toggle collapse all section 
    $('.toggle-collapse').click(function () {
        let action = $(this).text();
        if (action === "Collapse All") {
            $('.collapse').removeClass('show');
            $(".ion-minus-circled").addClass("ion-plus-circled text-success").removeClass('ion-minus-circled');
            $(this).text('Expand All');
        } else {
            $('.collapse').addClass('show');
            $(".ion-plus-circled").addClass("ion-minus-circled").removeClass('ion-plus-circled text-success');
            $(this).text('Collapse All');
        }
    })


    // TimyMce
    function addTinyMCE() {
        // Initialize
        tinymce.init({
            selector: '.tiny_mce',
            height: 300,
            menubar: false,
            statusbar: false,
            plugins: "lists",
            toolbar: 'bold underline italic |alignleft aligncenter alignright alignjustify|bullist numlist',
            browser_spellcheck: true,
        });
    }

    addTinyMCE();

    // Toggle and add Editor
    let edu_count = 0;
    let jobs_count = 0;

    $('.add-education').click(function () {
        edu_count += 1;
        if (edu_count > 4) {
            return false;
        }

        // Check TinyMCE is initialized or not
        if (tinyMCE.get('education[achievements][]')) {
            // add bordet top
            $('.append-education').append("<div class='seperator-style my-4'></div>");
            $('.append-education').append(`<div class='btn btn-danger btn-sm mb-4 '># ${edu_count + 1}</div>`);

            // Remove TinyMCE instance, clone the education element and add tinymce class
            tinymce.remove('.tiny_mce');
            var ele = $('.education-block').children().clone()
            ele.find('textarea').attr("class", "tiny_mce");

            // update to new error message class, remove the old
            ele.find('.education_school_name_0').addClass(`d-none education_school_name_${jobs_count}`).removeClass('education_school_name_0');
            ele.find('.education_school_location_0').addClass(`d-none education_school_location_${jobs_count}`).removeClass('education_school_location_0');

            // empty input fields
            ele.find("input[type=text],input[type=month], textarea").val("");
            ele.clone().appendTo('.append-education')

            addTinyMCE();
        }
    });


    $('.add-jobs').click(function () {
        jobs_count += 1;
        if (jobs_count > 4) {
            return false;
        }

        // Check TinyMCE is initialized or not
        if (tinyMCE.get('job[job_details][]')) {
            // add bordet top
            $('.append-jobs').append("<div class='seperator-style my-4'></div>");
            $('.append-jobs').append(`<div class='btn btn-danger btn-sm mb-4 '># ${jobs_count + 1}</div>`);

            // Remove TinyMCE instance, clone the education element and add tinymce class
            tinymce.remove('.tiny_mce');
            var ele = $('.jobs-block').children().clone()
            ele.find('textarea').attr("class", "tiny_mce");

            // update to new error message class, remove the old
            ele.find('.job_title_0').addClass(`d-none job_title_${jobs_count}`).removeClass('job_title_0');
            ele.find('.job_employer_0').addClass(`d-none job_employer_${jobs_count}`).removeClass('job_employer_0');

            // empty input fields
            ele.find("input[type=text],input[type=date], textarea").val("");
            ele.clone().appendTo('.append-jobs')

            addTinyMCE();
        }
    });

    // Handle ajax requests
    $('.resume-builder-form').submit(function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var current_form = $(this);
        var request_data = {};

        // transform the form data into required json object
        transformData(request_data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': request_data._token
            }
        });

        $.ajax({
            type: "POST",
            url: url,
            data: JSON.stringify(request_data),
            contentType: "json",
            success: function (response) {
                console.log(response);
                $('.validation_error').addClass('d-none');
                if (response.status === 'pass') {

                }
                if (response.status === 'fail') {
                    for (var key in response.errors) {
                        var error_message = response.errors[key];
                        if (key.includes('.')) {
                            key = key.replace(/\./g, '_');
                            console.log(key);
                        }
                        $(`.${key}`).removeClass('d-none').text(error_message);
                    }
                }
                return false;
            }
        })

    });



    function transformData(request_data) {
        request_data.first_name = $("input[name='first_name']").val();
        request_data.last_name = $("input[name='last_name']").val();
        request_data._token = $("input[name='_token']").val();
        request_data.city = $("input[name='city']").val();
        request_data.state_province = $("input[name='state_province']").val();
        request_data.phone = $("input[name='phone']").val();
        request_data.zip = $("input[name='zip']").val();
        request_data.email = $("input[name='email']").val();
        request_data.skills = tinyMCE.get("skills").getContent();
        request_data.user_summary = tinyMCE.get("user_summary").getContent();

        request_data.job = {
            "title": getFormInput('job[title][]'),
            "employer": getFormInput('job[employer][]'),
            "city": getFormInput('job[city][]'),
            "start_date": getFormInput('job[start_date][]'),
            "end_date": getFormInput('job[end_date][]'),
            "job_details": getFormInput('job[job_details][]')

        }

        request_data.education = {
            "school_name": getFormInput('education[school_name][]'),
            "school_location": getFormInput('education[school_location][]'),
            "degree": getFormInput('education[degree][]'),
            "field_of_study": getFormInput('education[field_of_study][]'),
            "start_year": getFormInput('education[start_year][]'),
            "end_year": getFormInput('education[end_year][]'),
            "achievements": getFormInput('education[achievements][]'),

        }
    }

    function getFormInput(field) {
        let res = $(`input[name='${field}']`).map(function () {
            return this.value;
        }).get();
        return res;
    }

});

