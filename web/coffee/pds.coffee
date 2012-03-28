$(document).ready ->
  commenting = false
  $("#form_comment").submit ->
    unless commenting
      commenting = true
      button = $("#form_comment button")
      loader = $("#form_comment .ajax-loader")
      button.addClass "disabled"
      values = {}
      form = $(this)
      $.each form.serializeArray(), (i, field) ->
        values[field.name] = field.value

      loader.css "visibility", "visible"
      $.post form.attr("action"), values, (html) ->
        commenting = false
        button.removeClass "disabled"
        $("#comment_message").val ""
        loader.css "visibility", "hidden"
        form.before html
    false

  showStar = -> $(".meta .icon-star").css display:"inline-block"
  stars = $(".star-rating li a")
  if stars.length
    voting = false
    $(".star-rating li a").click ->
      unless voting
        voting = true
        loader = $(".meta .ajax-loader")
        form = $("#form_vote")
        values = {}
        loader.css "visibility", "visible"
        $.each form.serializeArray(), (i, field) ->
          values[field.name] = field.value

        values["vote[value]"] = $(this).html()
        $.post form.attr("action"), values, (rating) ->
          voting = false
          loader.css "visibility", "hidden"
          $(".rating-value").html rating
          $(".meta .star-rating").hide()
          showStar()
      false
  else
    showStar()


  setLineno = (page, lineno) ->
    page.attr("data-page", lineno)
    buttons = $("button",page)

    if lineno <= 2
      title = if lineno == 1 then "Write summary" else "Create Story"
      buttons.hide()
    else
      title = "Create story " + (lineno-1)
      buttons.show()

    $(".page-number", page).html title
    $($("input", page)[0]).val lineno

  refreshLineno = ->
    $("#story_Pages li").each (i, li) ->
      setLineno($(@), i + 1)

  reorderPages= ->
    newOrder = []

    $("#story_Pages li").each (i, li) ->
      newOrder[parseInt($(li).attr("data-page"))] = li

    cont = $("#story_Pages")
    for page in newOrder
      cont.append(page)

  refreshLineno()

  $(document).delegate ".story-page-header .page-number", "click", ->
    pageData = $(@).parent().siblings(".story-page-data")
    if pageData.is(":visible") then pageData.slideUp() else pageData.slideDown()

  $(document).delegate ".story-page-header .page-delete", "click", ->
    $(@).parents("li").slideUp ->
      $(@).remove()
      refreshLineno()
    false

  changePosition = (page, delta) ->
    curLineno = parseInt(page.attr("data-page"))
    toLineno = curLineno + delta

    return if (delta == -1 and curLineno == 1) or ( delta == 1 and curLineno == page.siblings().length + 1)

    setLineno($("li[data-page=" + toLineno + "]"), curLineno)
    setLineno(page, toLineno)
    reorderPages()

  $(document).delegate ".story-page-header .page-up", "click", ->
    changePosition($(@).parents("li"), -1)
    false

  $(document).delegate ".story-page-header .page-down", "click", ->
    changePosition($(@).parents("li"), +1)
    false

  addEditor = (id) ->
    textarea = $("#"+id)
    placeholder = textarea.attr "placeholder"

    new nicEditor().panelInstance id

    if placeholder
      edEl = textarea.siblings().children(".niceditor-elm").focus ->
        text = edEl.html()
        if text == textarea.attr "placeholder"
          edEl.html ""
      .blur ->
        !edEl.html() and edEl.html textarea.attr "placeholder"
      .html placeholder

  $(".add-page").click ->
    #@todo: do something with place holders page
    placeholder = $($("#story_Pages textarea")[1]).attr "placeholder"
    $($("#story_Pages textarea")[1]).attr "placeholder", ""
    if $($("#story_Pages .niceditor-elm")[1]).html() == placeholder
      $($("#story_Pages .niceditor-elm")[1]).html ""

    pages = $("#story_Pages")
    pages.append pages.attr("data-prototype").split("$$name$$").join(pages.children().length)
    addEditor "story_Pages_"+(pages.children().length-1)+"_body"
    refreshLineno()
    false


  $(".add-video").click ->
    $("#video-upload").modal()
    false

  $("#video-upload button").click ->
    progress = $("#video-upload .progress").css display: "block"
    progressHelp = $("#video-upload .progress-help").css display: "block"
    bar = progress.children().css width: "0%";
    progress.removeClass("progress-info").addClass "progress-success"
    progressHelp.html "Uploading..."
    $("#video-upload form").ajaxSubmit
      uploadProgress: (e, position, total, percent)->
        if percent > 98
          percent = 100
          progressHelp.html "Sending to youtube..."
          progress.removeClass("progress-success").addClass "progress-info"
        bar.css width: percent + "%"
      success: (data)->
        console.log arguments
        progress.css display: "none"
        progressHelp.css display: "none"

        data = $.parseJSON data
        console.log data
        $(".videos").append '<li data-player="'+data.player+'"><a href="'+data.url+'"><img src="'+data.thumbnail+'"/></a></li>'
        $("#video-upload").modal "hide"
    false

  $("#story_Pages textarea").each ->
    addEditor @.id

  $(".publish-request").click ->
    button = $(@)
    button.hide().siblings().removeClass("status-blocked").removeClass("status-unpublished").addClass("status-moderated").html("Moderated")
    $.post button.attr("data-url"), (ok) ->
      if ok
        console.log ok
    false

  $("#myCarousel").carousel(interval: if $(".tags-cloud").length>0 then 10000 else 32600000).carousel "next"

  $("#story_date").datepicker(changeMonth:true, changeYear:true)


