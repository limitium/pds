$(document).ready(function() {
    var commenting, showStar, stars, voting;
    commenting = false;
    $("#form_comment").submit(function() {
        var button, form, loader, values;
        if (!commenting) {
            commenting = true;
            button = $("#form_comment button");
            loader = $("#form_comment .ajax-loader");
            button.addClass("disabled");
            values = {};
            form = $(this);
            $.each(form.serializeArray(), function(i, field) {
                return values[field.name] = field.value;
            });
            loader.css("visibility", "visible");
            $.post(form.attr("action"), values, function(html) {
                commenting = false;
                button.removeClass("disabled");
                $("#comment_message").val("");
                loader.css("visibility", "hidden");
                return form.before(html);
            });
        }
        return false;
    });
    showStar = function() {
        return $(".meta .icon-star").css({
            display: "inline-block"
        });
    };
    stars = $(".star-rating li a");
    if (stars.length) {
        voting = false;
        $(".star-rating li a").click(function() {
            var form, loader, values;
            if (!voting) {
                voting = true;
                loader = $(".meta .ajax-loader");
                form = $("#form_vote");
                values = {};
                loader.css("visibility", "visible");
                $.each(form.serializeArray(), function(i, field) {
                    return values[field.name] = field.value;
                });
                values["vote[value]"] = $(this).html();
                $.post(form.attr("action"), values, function(rating) {
                    voting = false;
                    loader.css("visibility", "hidden");
                    $(".rating-value").html(rating);
                    $(".meta .star-rating").hide();
                    return showStar();
                });
            }
            return false;
        });
    } else {
        showStar();
    }
    $(".add-page").click(function() {
        var pages;
        pages = $("#story_Pages");
        pages.append(pages.attr("data-prototype").split("$$name$$").join(pages.children().length));
        return false;
    });
    $(document).delegate(".story-page-header", "click", function() {
        var pageData;
        pageData = $(this).siblings(".story-page-data");
        if (pageData.is(":visible")) {
            pageData.slideUp();
        } else {
            pageData.slideDown();
        }
        return false;
    });
    $("#myCarousel").carousel({
        interval: 10000000
    }).carousel("next");
    $("#story_date").datepicker({
        changeMonth: true,
        changeYear: true
    });
    return true;
});