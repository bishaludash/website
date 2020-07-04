$(document).ready(function () {
    // section minimize icon toggle
    $('.resume-section').click(function () {
        $(this).toggleClass('bg-resume-section');
        $("i", this).toggleClass("ion-minus-circled ion-plus-circled text-success");
    })

    function addTinyMCE() {
        // Initialize
        tinymce.init({
            selector: '.tiny_mce',
            height: 300,
            menubar: false,
            statusbar: false,
            plugins: "lists,link",
            toolbar: 'bold underline italic |alignleft aligncenter alignright alignjustify|bullist numlist| link',
            browser_spellcheck: true,
        });
    }

    addTinyMCE();

    // Toggle and add Editor
    let edu_count = 0;
    let jobs_count = 0;

    $('.add-education').click(function () {
        edu_count += 1;
        if (edu_count > 3) {
            return false;
        }

        // Check TinyMCE is initialized or not
        if (tinyMCE.get('education[achievements][]')) {
            // add bordet top
            $('.append-education').append("<div class='seperator-style my-4'></div>");

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
        if (jobs_count > 5) {
            return false;
        }
        // Check TinyMCE is initialized or not
        if (tinyMCE.get('job[job_details][]')) {
            // add bordet top
            $('.append-jobs').append("<div class='seperator-style my-4'></div>");

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

