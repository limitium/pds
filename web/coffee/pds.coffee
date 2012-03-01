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

  showStar = -> $(".meta .icon-star").css display: "inline-block"
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
  else
    showStar()


  setLineno = (page, lineno) ->
    page.attr("data-page", lineno)
    $(".page-number", page).html lineno
    $($("input", page)[0]).val lineno

  refreshLineno = ->
    $("#story_Pages li").each (i, li)->
      setLineno($(@), i + 1)

  reorderPages= ->
    newOrder = []

    $("#story_Pages li").each (i, li)->
      newOrder[parseInt($(li).attr("data-page"))] = li

    cont = $("#story_Pages")
    for page in newOrder
      cont.append(page)

  refreshLineno()

  $(document).delegate ".story-page-header .page-number", "click", ->
    pageData = $(@).parent().siblings(".story-page-data")
    if pageData.is(":visible") then pageData.slideUp() else pageData.slideDown()

  $(document).delegate ".story-page-header .page-delete", "click", ->
    $(@).parents("li").slideUp(->
      $(@).remove()
      refreshLineno()
    )
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

  $(".add-page").click ->
    pages = $("#story_Pages")
    pages.append pages.attr("data-prototype").split("$$name$$").join(pages.children().length)
    refreshLineno()
    false


  $("#myCarousel").carousel(interval: 10000000).carousel "next"

  $("#story_date").datepicker(changeMonth: true, changeYear: true)


