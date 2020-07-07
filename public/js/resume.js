$(document).ready(function () {

    // resume section minimize icon toggle
    $('.resume-section').click(function () {
        $(this).toggleClass('bg-resume-section');
        $("i", this).toggleClass("ion-minus-circled ion-plus-circled text-success");
    })

    // Toggle collapse all section 
    setTimeout(function () {
        $('.toggle-collapse').removeClass('disabled')
    }, 2000)


    $('.toggle-collapse').click(function () {
        $('.collapse').toggleClass('show')
        $("i").toggleClass("ion-minus-circled ion-plus-circled text-success");
        $(this).text(function (i, text) {
            return text === "Collapse All" ? "Expand All" : "Collapse All";
        });
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

            // Remove instance by id
            tinymce.remove('.tiny_mce');
            var ele = $('.education-block').children().clone()
            ele.find('textarea').attr("class", "tiny_mce");

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

            // Remove instance by id
            tinymce.remove('.tiny_mce');
            var ele = $('.jobs-block').children().clone()
            ele.find('textarea').attr("class", "tiny_mce");

            // empty input fields
            ele.find("input[type=text],input[type=date], textarea").val("");
            ele.clone().appendTo('.append-jobs')

            addTinyMCE();
        }
    });
});

