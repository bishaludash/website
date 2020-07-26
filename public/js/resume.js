$(document).ready(function () {

    // Toggle collapse/Expand selected section, toggle minimize icon toggle
    $('.resume-section').click(function () {
        $(this).toggleClass('bg-resume-section');
        $("i", this).toggleClass("ion-minus-circled ion-plus-circled text-success");
    })

    // collapse/Expand button timeout 
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
        if (edu_count >= 4) {
            return false;
        }
        edu_count += 1;

        // Check TinyMCE is initialized or not
        if (tinyMCE.get('school[achievements][]')) {
            // add bordet top
            $('.append-education').append(`<div class='seperator-style my-4 sep-edu-${edu_count}'></div>`);
            $('.append-education').append(`<span class='btn btn-danger btn-sm mb-4 dblock-edu' data-eduBlock='edu-${edu_count}' 
            data-eduSep='sep-edu-${edu_count}'>Delete this block</span>`);

            // Remove TinyMCE instance, clone the education element and add tinymce class
            tinymce.remove('.tiny_mce');
            var ele = $('.education-block').children().clone()
            ele.find('textarea').attr("class", "tiny_mce");

            // update to new error message class, remove the old
            ele.find('.school_name_0').removeClass('school_name_0').addClass(`d-none school_name_${edu_count}`);
            ele.find('.school_location_0').removeClass('school_location_0').addClass(`d-none school_location_${edu_count}`);
            ele.find('.school_degree_0').removeClass('school_degree_0').addClass(`d-none school_degree_${edu_count}`);
            ele.find('.school_field_of_study_0').removeClass('school_field_of_study_0').addClass(`d-none school_field_of_study_${edu_count}`);
            ele.find('.school_start_year_0').removeClass('school_start_year_0').addClass(`d-none school_start_year_${edu_count}`);
            ele.find('.school_end_year_0').removeClass('school_end_year_0').addClass(`d-none school_end_year_${edu_count}`);

            // empty input fields
            ele.find("input[type=text],input[type=month], textarea").val("");
            $('.append-education').append(`<div class='edu-${edu_count}'>`);
            ele.clone().appendTo(`.append-education .edu-${edu_count}`);

            addTinyMCE();
        }
    });


    $('.add-jobs').click(function () {
        if (jobs_count >= 4) {
            return false;
        }
        jobs_count += 1;

        // Check TinyMCE is initialized or not
        if (tinyMCE.get('job[job_details][]')) {
            // add bordet top
            $('.append-jobs').append(`<div class='seperator-style my-4 sep-job-${jobs_count}'></div>`);
            $('.append-jobs').append(`<span class='btn btn-danger btn-sm mb-4 dblock-job' data-jobBlock='job-${jobs_count}' 
            data-jobSep='sep-job-${jobs_count}'>Delete this block</span>`);

            // Remove TinyMCE instance, clone the education element and add tinymce class
            tinymce.remove('.tiny_mce');
            var ele = $('.jobs-block').children().clone()
            ele.find('textarea').attr("class", "tiny_mce");

            // update to new error message class, remove the old
            ele.find('.job_title_0').addClass(`d-none job_title_${jobs_count}`).removeClass('job_title_0');
            ele.find('.job_employer_0').addClass(`d-none job_employer_${jobs_count}`).removeClass('job_employer_0');

            // update disable job_end date
            ele.find('#endDateCheck0').attr('id', `endDateCheck${jobs_count}`);
            ele.find('.custom-control-label').attr('for', `endDateCheck${jobs_count}`);

            // empty input fields
            ele.find("input[type=text],input[type=date], textarea").val("");
            $('.append-jobs').append(`<div class='job-${jobs_count}'>`);
            ele.clone().appendTo(`.append-jobs .job-${jobs_count}`)

            addTinyMCE();
        }
    });

    // toggle job end date | Enable or disable
    // You need to use event delegation for supporting dynamic elements.
    $(document).on('click', '.custom-control-label', function () {
        $(this).parent().parent().find('.form-control').attr('disabled', function (index, attr = false) {
            return attr == false ? true : false;
        }).val(null);
    });

    // Delete the added Education block
    $(document).on('click', '.dblock-edu', function () {
        // get Edu block to be deleted 
        let bid = $(this).attr('data-eduBlock');
        $(`.${bid}`).remove();

        // get Edu seperator block to be deleted
        let sid = $(this).attr('data-eduSep');
        $(`.${sid}`).remove();

        $(this).remove();
        edu_count -= 1;
    });

    // Delete the added Job block
    $(document).on('click', '.dblock-job', function () {
        // get job block to be deleted 
        let bid = $(this).attr('data-jobBlock');
        $(`.${bid}`).remove();

        // get job seperator block to be deleted
        let sid = $(this).attr('data-jobSep');
        $(`.${sid}`).remove();

        $(this).remove();
        jobs_count -= 1;
    })

    // edit resume, delete education/jobs logic
    $(document).on('click', '.delModal', function () {
        let title = $(this).attr('data-title');
        let url = $(this).attr('data-url');
        let itemName = $(this).attr('data-displayname');

        // change modal data
        $('.modal-title').text(title);
        $('.modal-body-item').text(itemName);

        $('.commit-action').click(function () {
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    console.log(response);
                    location.reload(true);
                }
            })
        })
    })


    // close alert
    $(document).on('click', '.close-alert', function () {
        $('.alert-box').removeClass('visible').addClass('invisible');
        $('.flash-message').text('');
    });


    // Handle ajax requests
    var sections = {
        "personal info": ['email', 'first_name', 'last_name', 'phone'],
        "work experience": ['job.title.0', 'job.employer.0',
            'job.title.1', 'job.employer.1',
            'job.title.2', 'job.employer.2',
            'job.title.3', 'job.employer.3'
        ],
        "education": ['school.name.0', 'school.location.0', 'school.degree.0',
            'school.field_of_study.0', 'school.end_year.0', 'school.start_year.0'
        ],
        'skills': ['skills'],
        'summary': ['user_summary'],
    }

    $(document).on('submit', '.resume-builder-form', function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var request_data = {};

        // transform the form data into required json object
        transformData(request_data);
        // console.log(JSON.stringify(request_data));
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
                var request_data = {};
                console.log(response);
                $('.validation_error').addClass('d-none');
                if (response.status === 'pass') {
                    window.location = response.url;

                }
                if (response.status === 'fail') {
                    // error keys comes from ajax response
                    let errorKeys = Object.keys(response.errors);
                    let validate_message = "Validation failed in section : ";

                    for (let secKey in sections) {
                        let sectionItem = sections[secKey];

                        for (let i = 0; i < errorKeys.length; i++) {
                            if (sectionItem.includes(errorKeys[i])) {
                                validate_message += secKey + ", ";
                                break;
                            }
                        }
                    }

                    $('.alert-box').removeClass('invisible').addClass('visible');
                    $('.flash-message').css('textTransform', 'capitalize').text(validate_message);
                    for (var key in response.errors) {
                        var error_message = response.errors[key];
                        if (key.includes('.')) {
                            key = key.replace(/\./g, '_');
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
            "job_details": getFormTextarea('job[job_details][]')
        }

        request_data.school = {
            "name": getFormInput('school[name][]'),
            "location": getFormInput('school[location][]'),
            "degree": getFormInput('school[degree][]'),
            "field_of_study": getFormInput('school[field_of_study][]'),
            "start_year": getFormInput('school[start_year][]'),
            "end_year": getFormInput('school[end_year][]'),
            "achievements": getFormTextarea('school[achievements][]'),
        }
    }

    function getFormInput(field) {
        let res = $(`input[name='${field}']`).map(function () {
            return this.value;
        }).get();
        return res;
    }

    function getFormTextarea(field) {

        let res = $(`textarea[name='${field}']`).map(function () {
            return this.value;
        }).get();
        return res;
    }

});

