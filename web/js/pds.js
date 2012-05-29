$(document).ready(function() {
    var addEditor, changePosition, commenting, moderate, refreshLineno, reorderPages, setLineno, showStar, stars, voting;
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
    setLineno = function(page, lineno) {
        var buttons, title;
        page.attr("data-page", lineno);
        buttons = $("button", page);
        if (lineno <= 2) {
            title = lineno === 1 ? "Write summary" : "Create Story";
            buttons.hide();
        } else {
            title = "Create story " + (lineno - 1);
            buttons.show();
        }
        $(".page-number", page).html(title);
        return $($("input", page)[0]).val(lineno);
    };
    refreshLineno = function() {
        return $("#story_Pages li").each(function(i, li) {
            return setLineno($(this), i + 1);
        });
    };
    reorderPages = function() {
        var cont, newOrder, page, _i, _len, _results;
        newOrder = [];
        $("#story_Pages li").each(function(i, li) {
            return newOrder[parseInt($(li).attr("data-page"))] = li;
        });
        cont = $("#story_Pages");
        _results = [];
        for (_i = 0, _len = newOrder.length; _i < _len; _i++) {
            page = newOrder[_i];
            _results.push(cont.append(page));
        }
        return _results;
    };
    refreshLineno();
    $(document).delegate(".story-page-header .page-number", "click", function() {
        var pageData;
        pageData = $(this).parent().siblings(".story-page-data");
        if (pageData.is(":visible")) {
            return pageData.slideUp();
        } else {
            return pageData.slideDown();
        }
    });
    $(document).delegate(".story-page-header .page-delete", "click", function() {
        $(this).parents("li").slideUp(function() {
            $(this).remove();
            return refreshLineno();
        });
        return false;
    });
    changePosition = function(page, delta) {
        var curLineno, toLineno;
        curLineno = parseInt(page.attr("data-page"));
        toLineno = curLineno + delta;
        if ((delta === -1 && curLineno === 1) || (delta === 1 && curLineno === page.siblings().length + 1)) {
            return;
        }
        setLineno($("li[data-page=" + toLineno + "]"), curLineno);
        setLineno(page, toLineno);
        return reorderPages();
    };
    $(document).delegate(".story-page-header .page-up", "click", function() {
        changePosition($(this).parents("li"), -1);
        return false;
    });
    $(document).delegate(".story-page-header .page-down", "click", function() {
        changePosition($(this).parents("li"), +1);
        return false;
    });
    addEditor = function(id) {
        var edEl, placeholder, textarea;
        textarea = $("#" + id);
        placeholder = textarea.attr("placeholder");
        new nicEditor({
            fullPanel: true
        }).panelInstance(id);
        if (placeholder) {
            return edEl = textarea.siblings().children(".niceditor-elm").focus(function() {
                var text;
                text = edEl.html();
                if (text === textarea.attr("placeholder")) {
                    return edEl.html("");
                }
            }).blur(function() {
                    return !edEl.html() && edEl.html(textarea.attr("placeholder"));
                }).html(placeholder);
        }
    };
    $(".add-page").click(function() {
        var pages, placeholder;
        placeholder = $($("#story_Pages textarea")[1]).attr("placeholder");
        $($("#story_Pages textarea")[1]).attr("placeholder", "");
        if ($($("#story_Pages .niceditor-elm")[1]).html() === placeholder) {
            $($("#story_Pages .niceditor-elm")[1]).html("");
        }
        pages = $("#story_Pages");
        pages.append(pages.attr("data-prototype").split("$$name$$").join(pages.children().length));
        addEditor("story_Pages_" + (pages.children().length - 1) + "_body");
        refreshLineno();
        return false;
    });
    $(".add-video").click(function() {
        $("#video-upload").modal();
        return false;
    });
    $("#video-upload button").click(function() {
        var bar, progress, progressHelp;
        progress = $("#video-upload .progress").css({
            display: "block"
        });
        progressHelp = $("#video-upload .progress-help").css({
            display: "block"
        });
        bar = progress.children().css({
            width: "0%"
        });
        progress.removeClass("progress-info").addClass("progress-success");
        progressHelp.html("Uploading...");
        $("#video-upload form").ajaxSubmit({
            uploadProgress: function(e, position, total, percent) {
                if (percent > 98) {
                    percent = 100;
                    progressHelp.html("Sending to youtube...");
                    progress.removeClass("progress-success").addClass("progress-info");
                }
                return bar.css({
                    width: percent + "%"
                });
            },
            success: function(data) {
                progress.css({
                    display: "none"
                });
                progressHelp.css({
                    display: "none"
                });
                try {
                    data = $.parseJSON(data);
                    $(".videos").append('<li data-player="' + data.player + '"><a href="' + data.url + '"><img src="' + data.thumbnail + '"/></a></li>');
                    return $("#video-upload").modal("hide");
                } catch (error) {
                    alert("Upload error!");
                    console.log(data);
                    return console.log(error);
                }
            }
        });
        return false;
    });
    $("#story_Pages textarea").each(function() {
        return addEditor(this.id);
    });
    $(".publish-request").click(function() {
        var button;
        button = $(this);
        button.addClass("disabled").attr("disabled", "disabled");
        button.hide().siblings().removeClass("status-blocked").removeClass("status-unpublished").addClass("status-moderated").html("Moderated");
        $.post(button.attr("data-url"), function(ok) {
            if (ok) {
                return console.log(ok);
            }
        });
        return false;
    });
    $(".teller-request").click(function() {
        var button;
        button = $(this);
        button.addClass("disabled").attr("disabled", "disabled");
        button.hide().siblings().removeClass("hide");
        $.post(button.attr("data-url"), function(ok) {
            if (ok) {
                return console.log(ok);
            }
        });
        return false;
    });
    moderate = function(button, status) {
        button.addClass("disabled").attr("disabled", "disabled");
        return $.post(button.attr("data-url"), function(ok) {
            if (ok) {
                console.log(ok);
                button.parents("tr").remove();
            }
            return false;
        });
    };
    $("button.block").click(function() {
        return moderate($(this), 4);
    });
    $("button.publish").click(function() {
        return moderate($(this), 2);
    });
    $("button.promote").click(function() {
        return moderate($(this), 1);
    });
    $("button.decline").click(function() {
        return moderate($(this), 0);
    });
    $("#myCarousel").carousel({
        interval: $(".tags-cloud").length > 0 ? 10000 : 32600000
    }).carousel("next");
    return $("#story_date").datepicker({
        changeMonth: true,
        changeYear: true
    });
});