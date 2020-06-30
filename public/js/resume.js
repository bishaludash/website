$('.resume-section').click(function () {
    $(this).toggleClass('bg-resume-section');
    $("i", this).toggleClass("ion-minus-circled ion-plus-circled text-success");
})


$('.add-education').click(function () {
    $('.education-block').children().clone().appendTo('.append-education');
})

