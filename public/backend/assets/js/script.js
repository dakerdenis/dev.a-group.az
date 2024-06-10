function fmSetLinkDropify(url) {
    document.querySelector('.dropify').dataset.defaultFile = url;
    resetPreview('.dropify', url, 'rkasd');
}

function resetPreview(id, src, fname = '') {
    let input = $(id);
    let wrapper = input.closest('.dropify-wrapper');
    let preview = wrapper.find('.dropify-preview');
    let filename = wrapper.find('.dropify-filename-inner');
    let render = wrapper.find('.dropify-render').html('');
    console.log(wrapper.find('.url'))
    wrapper.prev('.url').val(src);
    wrapper.removeClass('has-error').addClass('has-preview');
    filename.html(fname);

    render.append($('<img />').attr('src', src).css('max-height', input.data('height') || ''));
    preview.fadeIn();
}


(function ($) {
    "use strict";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', function (e) {
        var outside_space = $(".outside");
        if (!outside_space.is(e.target) &&
            outside_space.has(e.target).length === 0) {
            $(".menu-to-be-close").removeClass("d-block");
            $('.menu-to-be-close').css('display', 'none');
        }
    })
    /*----------------------------------------
     passward show hide
     ----------------------------------------*/
    $('.show-hide').show();
    $('.show-hide span').addClass('show');

    $('.show-hide span').click(function () {
        if ($(this).hasClass('show')) {
            $('input[name="login[password]"]').attr('type', 'text');
            $(this).removeClass('show');
        } else {
            $('input[name="login[password]"]').attr('type', 'password');
            $(this).addClass('show');
        }
    });
    $('form button[type="submit"]').on('click', function () {
        $('.show-hide span').addClass('show');
        $('.show-hide').parent().find('input[name="login[password]"]').attr('type', 'password');
    });

    /*=====================
      02. Background Image js
      ==========================*/
    $(".bg-center").parent().addClass('b-center');
    $(".bg-img-cover").parent().addClass('bg-size');
    $('.bg-img-cover').each(function () {
        var el = $(this),
            src = el.attr('src'),
            parent = el.parent();
        parent.css({
            'background-image': 'url(' + src + ')',
            'background-size': 'cover',
            'background-position': 'center',
            'display': 'block'
        });
        el.hide();
    });

    $(".mega-menu-container").css("display", "none");
    $(".header-search").click(function () {
        $(".search-full").addClass("open");
    });
    $(".close-search").click(function () {
        $(".search-full").removeClass("open");
        $("body").removeClass("offcanvas");
    });
    $(".mobile-toggle").click(function () {
        $(".nav-menus").toggleClass("open");
    });
    $(".mobile-toggle-left").click(function () {
        $(".left-header").toggleClass("open");
    });
    $(".bookmark-search").click(function () {
        $(".form-control-search").toggleClass("open");
    })
    $(".filter-toggle").click(function () {
        $(".product-sidebar").toggleClass("open");
    });
    $(".toggle-data").click(function () {
        $(".product-wrapper").toggleClass("sidebaron");
    });
    $(".form-control-search input").keyup(function (e) {
        if (e.target.value) {
            $(".page-wrapper").addClass("offcanvas-bookmark");
        } else {
            $(".page-wrapper").removeClass("offcanvas-bookmark");
        }
    });
    $(".search-full input").keyup(function (e) {
        console.log(e.target.value);
        if (e.target.value) {
            $("body").addClass("offcanvas");
        } else {
            $("body").removeClass("offcanvas");
        }
    });

    $('body').keydown(function (e) {
        if (e.keyCode == 27) {
            $('.search-full input').val('');
            $('.form-control-search input').val('');
            $('.page-wrapper').removeClass('offcanvas-bookmark');
            $('.search-full').removeClass('open');
            $('.search-form .form-control-search').removeClass('open');
            $("body").removeClass("offcanvas");
        }
    });


})(jQuery);

$('.loader-wrapper').fadeOut('slow', function () {
    $(this).remove();
});

$(window).on('scroll', function () {
    if ($(this).scrollTop() > 600) {
        $('.tap-top').fadeIn();
    } else {
        $('.tap-top').fadeOut();
    }
});


$('.tap-top').click(function () {
    $("html, body").animate({
        scrollTop: 0
    }, 600);
    return false;
});

function toggleFullScreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
            document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
}

(function ($, window, document, undefined) {
    "use strict";
    var $ripple = $(".js-ripple");
    $ripple.on("click.ui.ripple", function (e) {
        var $this = $(this);
        var $offset = $this.parent().offset();
        var $circle = $this.find(".c-ripple__circle");
        var x = e.pageX - $offset.left;
        var y = e.pageY - $offset.top;
        $circle.css({
            top: y + "px",
            left: x + "px"
        });
        $this.addClass("is-active");
    });
    $ripple.on(
        "animationend webkitAnimationEnd oanimationend MSAnimationEnd",
        function (e) {
            $(this).removeClass("is-active");
        });


})(jQuery, window, document);


// active link

$(".chat-menu-icons .toogle-bar").click(function () {
    $(".chat-menu").toggleClass("show");
});


// Language
var tnum = 'en';

$(document).ready(function () {
    $('[data-record-action=delete]').on('click', function (event) {
        let recordName = $(this).data('record-name');
        $('.recordName').text(recordName);
        $('#deleteRecord').attr('action', $(this).data('record-delete-url'));
    });

    if ($('.activation').length) {
        $('.activation').on('click', function (event) {
            let active = $(this).is(':checked') ? 1 : 0;
            $.ajax({
                type: "POST",
                url: $(this).data('record-url'),
                data: {active},
                success: data => {
                },
            });
        });
    }
});


$(".mobile-title svg").click(function () {
    $(".header-mega").toggleClass("d-block");
});

$(".onhover-dropdown").on("click", function () {
    $(this).children('.onhover-show-div').toggleClass("active");
});

function showLoader() {
    $('#loader-overlay').css('display', 'flex');
}

function hideLoader() {
    $('#loader-overlay').hide();
}

function setHandlerDropify(instance) {
    instance.on('click', function (event) {
        event.preventDefault();
        let _self = this;
        window.fmSetLink = function (url) {
            document.querySelector('#' + $(_self).attr('id')).dataset.defaultFile = url;
            resetPreview('#' + $(_self).attr('id'), url, 'rkasd');
        }
        window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
    });
    instance.on('dropify.beforeClear', function (event, element) {
        let fileId = $(this).data('file-id');
        $(this).closest('.form-group').find('#deleteImages').val(fileId);
    });
}

$(document).ready(function () {

    if ($('.datetime-picker').length) {
        $(".datetime-picker").flatpickr({
            enableTime: true,
            time_24hr: true,
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            }
        });
    }

    if ($('.editor-cke').length) {
        CKEDITOR.timestamp = 'something_randssom';
        $('.editor-cke').each(function (index, element) {
            CKEDITOR.replace($(element).attr('id'));
        });
    }

    if ($('.editor-cke-low').length) {
        CKEDITOR.timestamp = 'something_randssom';
        $('.editor-cke-low').each(function (index, element) {
            CKEDITOR.replace($(element).attr('id'), { height: 100 });
        });
    }

    if ($('.dropify').length) {
        let drEvent = $('.dropify').dropify();
        setHandlerDropify(drEvent);
    }

    if ($('.dropify_preview').length) {
        let drEvent = $('.dropify_preview').dropify();
        drEvent.on('dropify.beforeClear', function (event, element) {
            $(this).closest('.form-group').find('.deleteImages').val(1);
        });
    }

    $('#add_images').on('change', function (event) {
        let ajaxData = new FormData();
        let input = this;
        ajaxData.append('action', $("#addImages").data('link'));
        $.each($("input[type=file]"), function (i, obj) {
            $.each(obj.files, function (j, file) {
                ajaxData.append('photo[' + j + ']', file);
            })
        });
        showLoader();
        $.ajax({
            url: $("#addImages").data('link'),
            type: "POST",
            data: ajaxData,
            processData: false,
            contentType: false,
            success: function (data, textStatus, jqXHR) {
                $('#images').append(data);
                $(input).val('');
                hideLoader();
            },
        });
    });

    $('.add-product-offer').on('click', function (event) {
        showLoader();
        $.ajax({
            url: $(this).data('link'),
            type: "GET",
            processData: false,
            contentType: false,
            success: function (data, textStatus, jqXHR) {
                $(data).insertBefore('.add-product-offer');
                $('.product-offers').find('.js-example-basic-single').select2();
                hideLoader();
            },
        });
    });

    if ($('#images').length) {
        dragula([document.querySelector('#images')]);
    }

    $('body').on('click', '.remove-row', function () {
        let id = $(this).data('id');
        $('#row-' + id).remove();
        let input = document.createElement('input');
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "delete_images[]");
        input.setAttribute("value", id);
        document.querySelector('.delete_images').appendChild(input);
    });

    if ($(".js-example-basic-single").length) {
        $(".js-example-basic-single").select2();
    }
    if ($(".js-example-placeholder-multiple-with-icons").length) {
        function formatText (icon) {
            return $('<span><i class="fas ' + $(icon.element).data('icon') + '"></i> ' + icon.text + '</span>');
        };

        $('.js-example-placeholder-multiple-with-icons').select2({
            templateSelection: formatText,
            templateResult: formatText
        });
    }
    if ($(".js-example-placeholder-multiple-with-colors").length) {
        function formatText (element) {
            console.log(element);
            return $('<span style="border-radius: 50%; display: inline-block; width: 20px; height: 20px; background-color: ' + $(element.element).data('hex') + '"></span><span> ' + element.text + '</span>');
        };

        $('.js-example-placeholder-multiple-with-colors').select2({
            templateSelection: formatText,
            templateResult: formatText
        });
    }
    if ($(".js-example-placeholder-multiple").length) {
        $('.js-example-placeholder-multiple').select2();
    }

    if ($('#add_select_image_line').length) {
        $('.typeahead').typeahead(null, {
            name: 'best-pictures',
            highlight: true,
            display: 'display',
            source: bestPictures
        });

        $('.typeahead').bind('typeahead:select', function (ev, suggestion) {
            console.log($(this).closest('.form-group').find('.hidden-value'));
            $(this).closest('.form-group').find('.hidden-value').val(suggestion.value);
        });
        $('#add_select_image_line').on('click', function () {
            let link = $(this).data('link');
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    $('#featured_images').append(data);
                    console.log($('.typeahead:last'));
                    $('.typeahead:last').typeahead(null, {
                        name: 'best-pictures',
                        highlight: true,
                        display: 'display',
                        source: bestPictures
                    });

                    $('.typeahead:last').bind('typeahead:select', function (ev, suggestion) {
                        console.log($(this).closest('.form-group').find('.hidden-value'));
                        $(this).closest('.form-group').find('.hidden-value').val(suggestion.value);
                    });
                },
            });
        });

        $('body').on('click', '.remove-additional_info', function () {
            let id = $(this).data('id');
            console.log(id);
            $('#additional_info-' + id).remove();
        });
        dragula([document.querySelector('#featured_images')]);
    }

if ($('.typeahead').length) {
    $('.typeahead').typeahead(null, {
        name: 'best-pictures',
        highlight: true,
        display: 'display',
        source: bestPictures
    });

    $('.typeahead').bind('typeahead:select', function (ev, suggestion) {
        console.log($(this).closest('.form-group').find('.hidden-value'));
        $(this).closest('.form-group').find('.hidden-value').val(suggestion.value);
    });
}

    if ($('#add_select_block_line').length) {
        $('.typeahead').typeahead(null, {
            name: 'best-pictures',
            highlight: true,
            display: 'display',
            source: bestPictures
        });

        $('.typeahead').bind('typeahead:select', function (ev, suggestion) {
            console.log($(this).closest('.form-group').find('.hidden-value'));
            $(this).closest('.form-group').find('.hidden-value').val(suggestion.value);
        });
        $('#add_select_block_line').on('click', function () {
            let link = $(this).data('link');
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    $('#blocks').append(data);
                    console.log($('.typeahead:last'));
                    $('.typeahead:last').typeahead(null, {
                        name: 'best-pictures',
                        highlight: true,
                        display: 'display',
                        source: bestPictures
                    });

                    $('.typeahead:last').bind('typeahead:select', function (ev, suggestion) {
                        console.log($(this).closest('.form-group').find('.hidden-value'));
                        $(this).closest('.form-group').find('.hidden-value').val(suggestion.value);
                    });
                },
            });
        });

        $('body').on('click', '.remove-additional_info', function () {
            let id = $(this).data('id');
            console.log(id);
            $('#block-' + id).remove();
        });
        dragula([document.querySelector('#blocks')]);
    }

    if ($('#add_slide').length) {
        $('#add_slide').on('click', function () {
            showLoader();
            let link = $(this).data('link');
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    $('#slides').append(data);
                    if ($('.dropify').length) {
                        let drEvent = $('.dropify').dropify();
                        setHandlerDropify(drEvent);
                    }
                    hideLoader();
                },
            });
        });

        $('body').on('click', '.remove-additional_info', function () {
            let id = $(this).data('id');
            $('#slide-' + id).remove();
            let input = document.createElement('input');
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "delete_slides[]");
            input.setAttribute("value", id);
            document.querySelector('.delete-slides').appendChild(input);
        });
        dragula([document.querySelector('#slides')], {
          moves: function (el, container, handle) {
            return handle.classList.contains('handle');
          }
        });
    }

    if ($('#add_youtube_tag').length) {
        $('#add_youtube_tag').on('click', function () {
            let link = $(this).data('link');
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    $('#youtube_tags').append(data);
                },
            });
        });
        $('body').on('click', '.remove-youtube-tag', function () {
            let id = $(this).data('id');
            console.log(id);
            $('#youtube-tag-' + id).remove();
        });
        dragula([document.querySelector('#youtube_tags')]);
    }

    $('body').on('click', '.remove-document', function (event) {
        let id = $(this).data('id');
        $('#row-' + id).remove();
        let input = document.createElement('input');
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "delete_documents[]");
        input.setAttribute("value", id);
        document.querySelector('#documents').appendChild(input);
    });

    $('body').on('click', '.remove-block', function (event) {
        let id = $(this).data('id');
        $('#row-' + id).remove();
        let input = document.createElement('input');
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "delete_blocks[]");
        input.setAttribute("value", id);
        document.querySelector('.deleted-blocks').appendChild(input);
    });

    $('body').on('click', '.remove-block-offer', function (event) {
        let id = $(this).data('id');
        $('#row-' + id).remove();
        let input = document.createElement('input');
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "delete_offers[]");
        input.setAttribute("value", id);
        document.querySelector('#offers-block').appendChild(input);
    });

    $('body').on('click', '.remove-team', function (event) {
        let id = $(this).data('id');
        $('#team-' + id).remove();
        let input = document.createElement('input');
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "delete_team_member[]");
        input.setAttribute("value", id);
        document.querySelector('.deleted-blocks').appendChild(input);
    });

    if ($('#add_document').length) {
        $('#add_document').on('click', function () {
            let link = $(this).data('link');
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    $('#documents').append(data);
                },
            });
        });
        dragula([document.querySelector('#documents')]);
    }

    if ($('#add_related').length) {
        $('#add_related').on('click', function () {
            let link = $(this).data('link');
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    let row_id = $(data).attr('id');
                    $('#related').append(data);
                    if ($('.dropify').length) {
                        let drEvent = $('.dropify').dropify();
                        setHandlerDropify(drEvent);
                    }
                    if ($('#'+row_id).find('.editor-cke').length) {
                        CKEDITOR.timestamp = 'something_randssom';
                        $('#'+row_id).find('.editor-cke').each(function (index, element) {
                            CKEDITOR.replace($(element).attr('id'));
                        });
                    }
                    hideLoader();
                },
            });
        });
        dragula([document.querySelector('#related')]);
    }

    if ($('#add_team').length) {
        $('#add_team').on('click', function () {
            let link = $(this).data('link');
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    let row_id = $(data).attr('id');
                    $('#team_content').append(data);
                    if ($('.dropify').length) {
                        let drEvent = $('.dropify').dropify();
                        setHandlerDropify(drEvent);
                    }
                    if ($('#'+row_id).find('.editor-cke').length) {
                        CKEDITOR.timestamp = 'something_randssom';
                        $('#'+row_id).find('.editor-cke').each(function (index, element) {
                            CKEDITOR.replace($(element).attr('id'));
                        });
                    }
                    hideLoader();
                },
            });
        });
        dragula([document.querySelector('#related')]);
    }

    if ($('#add_link').length) {
        $('#add_link').on('click', function () {
            let link = $(this).data('link');
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    $('#links').append(data);
                },
            });
        });
        $('body').on('click', '.remove-link', function (event) {
            let id = $(this).data('id');
            $('#row-link-' + id).remove();
        });
        dragula([document.querySelector('#links')]);
    }

    if ($('#add_repeatable').length) {
        $('#add_repeatable').on('click', function () {
            let link = $(this).data('link');
            let type = $(this).data('type');
            let query = '';
            if ($(this).data('link-translation')) query = 'with_link_translations=true&'
            $.ajax({
                type: "POST",
                url: link + '?' + query,
                data: {type},
                success: data => {
                    $('#repeatables').append(data);
                    if ($('.dropify').length) {
                        let drEvent = $('.dropify').dropify();
                        setHandlerDropify(drEvent);
                    }
                },
            });
        });
        $('body').on('click', '.remove-part', function () {
            let id = $(this).data('id');
            $('#part-' + id).remove();
            let input = document.createElement('input');
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "delete_repeatables[]");
            input.setAttribute("value", id);
            document.querySelector('#repeatables').appendChild(input);
        });
        dragula([document.querySelector('#repeatables')]);
    }

    if ($('#add_repeatable-s').length) {
        $('#add_repeatable-s').on('click', function () {
            let link = $(this).data('link');
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    $('#repeatables-s').append(data);
                    if ($('.dropify').length) {
                        let drEvent = $('.dropify').dropify();
                        setHandlerDropify(drEvent);
                    }
                },
            });
        });
        $('body').on('click', '.remove-part-s', function () {
            let id = $(this).data('id');
            $('#part-s-' + id).remove();
            let input = document.createElement('input');
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "delete_stat[]");
            input.setAttribute("value", id);
            document.querySelector('#repeatables-s').appendChild(input);
        });
        dragula([document.querySelector('#repeatables-s')]);
    }

  $('body').on('click', '.add_descripion-p', function () {
    let link = $(this).data('link');
    let statId = $(this).data('stat-id');
    let btn = this;
    $.ajax({
      type: "POST",
      url: link,
      data: {statId},
      success: data => {
        console.log($(btn));
        $(btn).parent().parent().prev().find('.repeatables-p').append(data);
      },
    });
  });
  $('body').on('click', '.remove-part-i', function () {
    let id = $(this).data('id');
    $('#part-i-' + id).remove();
    let input = document.createElement('input');
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "delete_stat_info[]");
    input.setAttribute("value", id);
    document.querySelector('#delete_stat_info').appendChild(input);
  });

    if ($('#add_descripion').length) {
        $('#add_descripion').on('click', function () {
            let link = $(this).data('link');
            let type = $(this).data('type');
            $.ajax({
                type: "POST",
                url: link,
                data: {type},
                success: data => {
                    $('#repeatables').append(data);
                },
            });
        });
        $('body').on('click', '.remove-part', function () {
            let id = $(this).data('id');
            $('#part-' + id).remove();
            let input = document.createElement('input');
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "delete_descriptions[]");
            input.setAttribute("value", id);
            document.querySelector('#repeatables').appendChild(input);
        });
        dragula([document.querySelector('#repeatables')]);
    }

    if ($('#add_descripionText').length) {
        $('#add_descripionText').on('click', function () {
            let link = $(this).data('link');
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    let row_id = $(data).attr('id');
                    $('#repeatables35').append(data);

                  if ($('.dropify').length) {
                    let drEvent = $('.dropify').dropify();
                    setHandlerDropify(drEvent);
                  }
                },
            });
        });

        $('body').on('click', '.remove-partTextIns', function () {
            let id = $(this).data('id');
            $('#ins-' + id).remove();
            let input = document.createElement('input');
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "delete_insuranceBlocks[]");
            input.setAttribute("value", id);
            document.querySelector('#repeatables35').appendChild(input);
        });
        dragula([document.querySelector('#repeatables35')]);
    }

    if ($('#add_descripionFAQ').length) {
        $('#add_descripionFAQ').on('click', function () {
            let link = $(this).data('link');
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    let row_id = $(data).attr('id');
                    $('#repeatablesFAQ').append(data);

                  if ($('.dropify').length) {
                    let drEvent = $('.dropify').dropify();
                    setHandlerDropify(drEvent);
                  }
                },
            });
        });

        $('body').on('click', '.remove-part-faq', function () {
            let id = $(this).data('id');
            $('#part-faq-' + id).remove();
            let input = document.createElement('input');
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "delete_faqs[]");
            input.setAttribute("value", id);
            document.querySelector('#repeatablesFAQ').appendChild(input);
        });
        dragula([document.querySelector('#repeatablesFAQ')]);
    }

        $('body').on('click', '.repeatables-feature-lines', function () {
            let link = $(this).data('link');
            let _sefl = this;
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    let row_id = $(data).attr('id');
                    $(_sefl).parent().parent().parent().find('.class-repaatables-line').append(data);

                  if ($('#'+row_id).find('.editor-cke-low').length) {
                    CKEDITOR.timestamp = 'something_randssom';
                    $('#'+row_id).find('.editor-cke-low').each(function (index, element) {
                      let editor = CKEDITOR.replace($(element).attr('id'), {height: 100});
                      console.log(editor);
                    });
                  }
                },
            });
        });


  $('body').on('click', '.remove-part-line', function () {
    let id = $(this).data('id');
    $('#line-part-' + id).remove();
    let input = document.createElement('input');
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "delete_feature_lines[]");
    input.setAttribute("value", id);
    document.querySelector('#repeatables2').appendChild(input);
  });

    let blocksRepeatable = $('.class-repaatables-line');
    if (blocksRepeatable.length) {
        blocksRepeatable.each(function (index, element) {
          dragula([$(element).get(0)]);
        });
    }

        $('body').on('click', '.add-slide-link', function () {
            let link = $(this).data('link');
            let _self = this;
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    let row_id = $(data).attr('id');
                    $(_self).parent().parent().parent().find('.slide-links').append(data);
                },
            });
        });

    let slideLines = $('.slide-links');
    if (slideLines.length) {
      slideLines.each(function (index, element) {
          console.log($(element).get(0));
          dragula([$(element).get(0)]);
        });
    }


  $('body').on('click', '.remove-slide-link', function () {
    let id = $(this).data('id');
    $('#part-slide-' + id).remove();
    let input = document.createElement('input');
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "delete_links[]");
    input.setAttribute("value", id);
    document.querySelector('#delete-lines').appendChild(input);
  });


        $('body').on('click', '.remove-partText', function () {
            let id = $(this).data('id');
            $('#textrow-' + id).remove();
            let input = document.createElement('input');
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "delete_descriptions[]");
            input.setAttribute("value", id);
            document.querySelector('#repeatables35').appendChild(input);
        });

    if ($('#add_descripion2').length) {
        $('#add_descripion2').on('click', function () {
            let link = $(this).data('link');
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    $('#repeatables2').append(data);
                },
            });
        });
        $('body').on('click', '.remove-part-feature', function () {
            let id = $(this).data('id');
            $('#part-feature-' + id).remove();
            let input = document.createElement('input');
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "delete_features[]");
            input.setAttribute("value", id);
            document.querySelector('#repeatables2').appendChild(input);
        });
      dragula([document.querySelector('#repeatables2')], {
        moves: function (el, container, handle) {
          return handle.classList.contains('handle');
        }
      });
    }

    if ($('#add-specification').length) {
        $('#add-specification').on('click', function () {
            let link = $(this).data('link');
            $.ajax({
                type: "POST",
                url: link,
                data: {},
                success: data => {
                    $('#repeatables3').append(data);
                },
            });
        });
        $('body').on('click', '.remove-part', function () {
            let id = $(this).data('id');
            $('#part-' + id).remove();
            let input = document.createElement('input');
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "delete_descriptions[]");
            input.setAttribute("value", id);
            document.querySelector('#repeatables3').appendChild(input);
        });
        dragula([document.querySelector('#repeatables3')]);
    }

    if ($('#add_author').length) {
        $('#add_author').on('click', function () {
            let link = $(this).data('link');
            $.ajax({
                type: "GET",
                url: link,
                data: {},
                success: data => {
                    $('#authors').append(data);
                    if ($(".js-example-basic-single").length) {
                        $(".js-example-basic-single").select2();
                    }
                },
            });
        });
        // $('body').on('click', '.remove-link', function (event) {
        //     let id = $(this).data('id');
        //     $('#row-link-' + id).remove();
        // });
        dragula([document.querySelector('#authors')]);
    }

    if ($('.dropify_class').length) {
        let drEventClass = $('.dropify_class').dropify();
        drEventClass.on('dropify.beforeClear', function (event, element) {
            $(this).closest('.form-group').find('.deleteImages').val($(this).data('file-id'));
        });
    }
    if ($('.sortable').length) {
        let sortable = dragula([document.querySelector('.sortable')]);
        sortable.on('drop', function (element, target, source, sibling) {

        });
    }
    if ($('#dragTree').length) {
        'use strict';
        $.jstree.plugins.noclose = function () {
            this.close_node = $.noop;
        };
        var tree_custom = {
            init: function () {
                $('#dragTree').on('move_node.jstree', function (e, data) {
                    // console.log(e);
                    $('#dragTree').jstree('open_all');
                    let node = data.node.li_attr['data-record-id'];
                    let node_elem = $('body li[data-record-id="' + node + '"]');
                    let prev_elem = $(node_elem).prev();
                    let next_elem = $(node_elem).next();
                    let parent_elem = $(node_elem).parents('li');
                    let prev = null;
                    let next = null;
                    let parent = null;
                    if ($(prev_elem).length) {
                        prev = $(prev_elem).data('record-id');
                    }
                    if ($(next_elem).length) {
                        next = $(next_elem).data('record-id');
                    }
                    if ($(parent_elem).length) {
                        parent = $(parent_elem).data('record-id');
                    }
                    data = {prev, next, node, parent};
                    $.ajax({
                        type: "POST",
                        url: $('#dragTree').data('reorder-action'),
                        data: data,
                        success: data => console.log(data),
                    });
                }).on('loaded.jstree', function () {
                    $('#dragTree').jstree('open_all');
                }).jstree({
                    'core': {
                        'check_callback': true,
                        'themes': {
                            'responsive': false
                        }
                    },
                    'types': {
                        'default': {
                            'icon': 'icofont icofont-folder  font-theme'
                        },
                        'file': {
                            'icon': 'icofont icofont-file-alt font-dark'
                        }
                    },
                    'plugins': ["noclose", 'types', 'dnd']
                })
            }
        };
        tree_custom.init();
    }

  if ($('.dragTree').length) {
    'use strict';
    $.jstree.plugins.noclose = function () {
      this.close_node = $.noop;
    };
    $('.dragTree').each(function (index, element) {
      console.log(element);
      var tree_custom = {
        init: function () {
          $(element).on('move_node.jstree', function (e, data) {
            // console.log(e);
            $(element).jstree('open_all');
            let node = data.node.li_attr['data-record-id'];
            let node_elem = $('body li[data-record-id="' + node + '"]');
            let prev_elem = $(node_elem).prev();
            let next_elem = $(node_elem).next();
            let parent_elem = $(node_elem).parents('li');
            let prev = null;
            let next = null;
            let parent = null;
            if ($(prev_elem).length) {
              prev = $(prev_elem).data('record-id');
            }
            if ($(next_elem).length) {
              next = $(next_elem).data('record-id');
            }
            if ($(parent_elem).length) {
              parent = $(parent_elem).data('record-id');
            }
            data = {prev, next, node, parent};
            $.ajax({
              type: "POST",
              url: $(element).data('reorder-action'),
              data: data,
              success: data => console.log(data),
            });
          }).on('loaded.jstree', function () {
            $(element).jstree('open_all');
          }).jstree({
            'core': {
              'check_callback': true,
              'themes': {
                'responsive': false
              }
            },
            'types': {
              'default': {
                'icon': 'icofont icofont-folder  font-theme'
              },
              'file': {
                'icon': 'icofont icofont-file-alt font-dark'
              }
            },
            'plugins': ["noclose", 'types', 'dnd']
          })
        }
      };
      tree_custom.init();
    });
  }


    $(".mode").on("click", function () {
        $('.mode i').toggleClass("fa-moon-o").toggleClass("fa-lightbulb-o");
        $('body').toggleClass("dark-only");
        let link = $(this).data('link');
        $.ajax({
            type: "GET",
            url: link,
            data: {},
            success: data => {

            },
        });
    });

    $('#title').on('change', function () {
        let title = $(this).val();
        let slug_input = $('#slug');
        if (!$(slug_input).val()) {
            $(slug_input).val(slugify(title).toLowerCase());
        }
    });

    $('body').on('click', '.thumb .fa-trash', function () {
        let form = $(this).closest('form');
        if ($(form).get(0).querySelectorAll('.uploaded-images .thumb').length === 1) {
            return false;
        }
        let thumb = $(this).closest('.thumb');
        if ($(thumb).hasClass('uploaded')) {
            let input = document.createElement('input');
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "delete_images[]");
            input.setAttribute("value", $(thumb).find('.image-file').val());
            document.querySelector('.deleted-images').appendChild(input);
        }
        $(thumb).remove();
    });

    if (document.getElementById('district_id')) {
        let city_id = document.getElementById('city_id');
        let district_id = document.getElementById('district_id');
        if (city_id.value in mappedDistricts) {
            let districts = mappedDistricts[city_id.value];
            removeOptions(district_id);
            Object.entries(districts).forEach(function (district) {
                let newOption = new Option(district[1], district[0], district_id.dataset.selected === district[0], district_id.dataset.selected === district[0]);
                district_id.add(newOption);
            });
            $(district_id).trigger('change');
        }
    }

});

let dropArea = document.getElementById('drop-area');

if (dropArea) {
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false)
    });

    function preventDefaults(e) {
        e.preventDefault()
        e.stopPropagation()
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false)
    });
    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false)
    });

    function highlight(e) {
        dropArea.classList.add('highlight');

    }

    function unhighlight(e) {
        dropArea.classList.remove('highlight')
    }

    dropArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        let dt = e.dataTransfer;
        let files = dt.files;
        handleFiles(files)
    }

    function handleFiles(files) {
        files = [...files];
        files.forEach(previewFile);
    }

    function previewFile(file) {
        let reader = new FileReader()
        reader.readAsDataURL(file)
        reader.onloadend = function () {
            let template = $.parseHTML('<div class="col-lg-3 col-md-4 col-xs-6 thumb">\n' +
                '<input type="file" class="image-file hidden"/> \n' +
                '<div class="thumbnail" >\n' +
                '<img class="img-thumbnail" src="" alt="">\n' +
                '</div>\n' +
                '<i class="fas fa-trash mt-2" style="color: red; cursor: pointer"></i>\n'+
                '</div>');
            $(template).find('a').attr('data-image', reader.result);
            $(template).find('img').attr('src', reader.result);
            let file_input = $(template).find('.image-file').get()[0];
            file_input.setAttribute('name', 'images[' + Math.random().toString(36).substr(2, 14) + '][file]');
            let list = new DataTransfer();
            list.items.add(file);
            file_input.files = list.files;
            $('.uploaded-images').append(template);
        }
    }
}

if (document.querySelector('.uploaded-images')) {
    dragula([document.querySelector('.uploaded-images')]);
}

function removeOptions(selectElement) {
    var i, L = selectElement.options.length - 1;
    for (i = L; i >= 0; i--) {
        selectElement.remove(i);
    }
}

if (document.getElementById('city_id')) {
    let city_id = document.getElementById('city_id');
    let district_id = document.getElementById('district_id');
    $('#city_id').on('select2:select', function (e) {
        if (city_id.value in mappedDistricts) {
            let districts = mappedDistricts[city_id.value];
            removeOptions(district_id);
            Object.entries(districts).forEach(function (district) {
                let newOption = new Option(district[1], district[0]);
                district_id.add(newOption);
            });
            $(district_id).trigger('change');
        } else {
            removeOptions(district_id);
        }
    });
}

if (document.getElementById('map')) {
    let marker;
    function placeMarkerAndPanTo(latLng, map, pan = false) {
        if (marker) {
            marker.setMap(null);
        }
        marker = new google.maps.Marker({
            position: latLng,
            draggable: true
        });

        if (pan) {
            map.panTo(latLng);
        }
        marker.setMap(map);
        document.getElementById('latitude').value = latLng.lat();
        document.getElementById('longitude').value = latLng.lng();
        marker.addListener("dragend", () => {
            document.getElementById('latitude').value = marker.getPosition().lat();
            document.getElementById('longitude').value = marker.getPosition().lng();
        });
    }

    function initAutocomplete() {
        let lat = parseFloat(document.getElementById('latitude').value  ? document.getElementById('latitude').value : '40.4093');
        let lng = parseFloat(document.getElementById('longitude').value ? document.getElementById('longitude').value : '49.8671');
        const map = new google.maps.Map(document.getElementById("map"), {
            center: {lat: lat, lng: lng},
            zoom: 13,
            scrollwheel: true,
            mapTypeId: "roadmap",
            mapTypeControl: false,
            componentRestrictions: {country: 'AZ'},
            streetViewControl: false,
        });

        if (document.getElementById('latitude').value && document.getElementById('longitude').value) {
            marker = new google.maps.Marker({
                position: {lat: lat, lng: lng},
                draggable: true
            });

            marker.setMap(map);
        }

        map.addListener("click", (e) => {
            placeMarkerAndPanTo(e.latLng, map);
        });

        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        map.addListener("bounds_changed", () => {
            searchBox.setBounds(map.getBounds());
        });

        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }
            placeMarkerAndPanTo(places[0].geometry.location, map, true);
        });
    }

    window.initAutocomplete = initAutocomplete;
}


if (document.getElementById('primary_category_id')) {
    const primary_category_id = document.getElementById('primary_category_id');
    $(primary_category_id).on('select2:select', function (e) {
          if(primary_category_id.value) {
              let category = primary_category_id.value;
              $.ajax({
                  type: "POST",
                  url: primary_category_id.dataset.link,
                  data: { category },
                  success: function (response) {
                      let data = response.data;
                      $('#attributes').html(data);
                      $('#attributes').find('select').each(function (index, item) {
                          $(item).select2();
                      });
                  },
              });
              $(primary_category_id).trigger('change');
          } else {
              $('#attributes').html('');
          }
    });
}

if (document.getElementById('setPromotion')) {
    const form = document.getElementById('setPromotion');
    $('.set-promotion').on('click', function (e) {
       form.action = $(this).data('link');
       form.submit();
    });
    $('.remove-promotion').on('click', function (e) {
       form.action = $(this).data('link');
       $(form).find('input[name="_method"]').val('DELETE');
       form.submit();
    });
}

if (document.getElementById('status')) {
    let status = document.getElementById('status');
    $(status).on('select2:select', function (e) {
        if(status.value === status.dataset.activeStatus) {
            if (!document.getElementById('expires_at').value) {
                document.getElementById('expires_at').value = moment().add(30, 'days').format('YYYY-MM-DD HH:mm:ss');
            }
        }
    });
}

$('#send-message').on('click', function (e) {
    let url = $(this).data('url');
    $.ajax({
        type: "POST",
        url: url,
        data: {message: $('#message').val()},
        success: function (response) {
            $('#message').val('');
            $('#messages').append(response.html);
        }
    })
});
