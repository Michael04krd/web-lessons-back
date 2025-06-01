$(document).ready(function() {

    $(".b-accordion div:first").addClass("active");
    $(".b-accordion h3:first").addClass("active-acc-text");
    $(".b-accordion p:not(:first)").hide();

    $(".b-accordion h3").click(function() {
        $(this).parent("div").parent("div").
        siblings("div").removeClass("active");
        $(this).parent("div").parent("div").toggleClass("active");

        $(this).parent("div").next("p").slideToggle("slow");
        $(this).parent("div").parent("div").siblings("div")
            .children("p:visible").slideUp("slow");

        $(this).toggleClass("active-acc-text");
        $(this).parent("div").parent("div").siblings("div")
            .children("div").children("h3").removeClass("active-acc-text");

    });
});