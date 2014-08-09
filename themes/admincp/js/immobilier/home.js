$(document).ready(function() {
    if ($("#WpUserMeta_landline").val().length == 10) {
        $("#WpUserMeta_landline").val(str_split_phone($("#WpUserMeta_landline").val(), 2, '.'));
    }
    if ($("#WpUserMeta_mobile_phone").val().length == 10) {
        $("#WpUserMeta_mobile_phone").val(str_split_phone($("#WpUserMeta_mobile_phone").val(), 2, '.'));
    }
    if ($("#WpUserMeta_mobile_myfax").val().length == 10) {
        $("#WpUserMeta_mobile_myfax").val(str_split_phone($("#WpUserMeta_mobile_myfax").val(), 2, '.'));
    }

    $(window).resize(function() {
        $("#iframeSame").width($("#breadcrumb").width() + 30);
    });

    $(".immobilier-ul a").live('mouseover', function() {
        $(this).find('span').removeClass('arrow_right_co').addClass('arrow_out_co');
    }).live('mouseout', function() {
        $(this).find('span').removeClass('arrow_out_co').addClass('arrow_right_co');
    });
    //$(".fancybox-img").fancybox();

    $(".btn-modifier").live('click', function() {
        var type = $("#container-category").attr('data-type');
        if (type == 'hidden') {
            $("#container-category").attr('data-type', 'show');
            $(this).html('Annuler');
            $("#container-category").slideDown(500);
        } else {
            $("#container-category").attr('data-type', 'hidden');
            $(this).html('Modifier	');
            $("#container-category").slideUp(500);
        }
    });

    /* Load hết tất cả sub category khi có sự khiện chọn category cha */
    $(".checkbox-category").live('change', function() {
        $("#btn-save-category").show();
        var group = "input:checkbox[data-group='" + $(this).data("group") + "']";
        if ($(this).is(":checked")) {
            $(group).prop("checked", false);
            $(this).prop("checked", true);
            if ($(this).data('parent') == 0) {
                $(group).parent().parent().find('.box-sub-category').remove();
                getSubCategory($(this).val(), $(this), objCategoryId);
                var el = $("#label-category");
                ScrollToTop(el, function() {
                    el.focus()
                });
            }
        } else {
            $(this).prop("checked", false);
            $(group).parent().parent().find('.box-sub-category').remove();
        }
    });

    /* Load tất cả list SubLesOption  Gọi phương thức loadSubLesOptions($(".btn-getSubLesOption")); trong view*/
    $(".btn-getSubLesOption").click(function() {
        var _this = $(this);
        if (_this.attr('data-type') == 'hidden') {
            _this.attr('data-type', 'show');
            $("#container-list-lesoption").slideDown(500);
        } else {
            _this.attr('data-type', 'hidden');
            $("#container-list-lesoption").slideUp(500);
        }
        return false;
    });
    /*Load ville cho property*/
    justOneRequest.registerEvent($('input#property_postal_code'), 1000, 2);
    /*Load ville cho user*/
    justOneRequest.registerEvent($('input#my_postal_code'), 1000, 1);
    /* Cập nhật category cho property*/
    $("#btn-save-category").live('click', function() {
        error = true;
        $("#saveCategoryForm #container-category input.checkbox-category-parent").each(function() {
            if ($(this).is(":checked")) {
                error = false;
            }
        });
        if (error) {
            var htmlError1 = '<b>Veuillez vérifier les champs suivants :</b><br />';
            htmlError1 += 'Veuillez cocher au moins un type de bien avant de valider la modification' + '<br />';
            alertify.set({labels: {
                    ok: "Fermer",
                }});
            alertify.alert(htmlError1);
            return false;
        }
        var msg = 'Etes-vous certain de vouloir modifier le type de bien, votre annonce sera modifiée en conséquence. <br />';
        msg += 'Veuillez confirmer votre choix en cliquant sur le bouton OK.';

        alertify.set({labels: {
                ok: "OK",
                cancel: "Cancel"
            }});
        alertify.confirm(msg, function(e) {
            if (e) {
                $("form#saveCategoryForm").submit();
            } else {
                return false;
            }
        });
    });

    /* Cập nhật thông tin post*/
    $("form#savePropertyFrom").submit(function() {
        var _form = $(this);
        $.ajax({
            url: _form.attr('action'),
            type: 'POST',
            data: _form.serialize(),
            beforeSend: function() {
                var error = false;
                _form.find("input").removeClass('error');
                var htmlError = '<b>Veuillez vérifier les champs suivants :</b><br />';
                $(_form.find(".isRequired").each(function(x, y) {
                    var labelF = $(y).attr('data-original-title');
                    if ($(y).attr('type') == 'text') {
                        if ($(y).val() == '') {
                            error = true;
                            $(y).addClass('error');
                            htmlError += 'Merci de saisir une valeur dans le champ "' + labelF + '".' + '<br />';
                        }
                    } else {
                        if ($(y).val() == 0) {
                            error = true;
                            $(y).addClass('error');
                            htmlError += 'Merci de séléctionner votre "' + labelF + '".' + '<br />';
                        }
                    }
                }));

                if (_form.find("#WpUserMeta_first_name").val() == '') {
                    error = true;
                    _form.find("#WpUserMeta_first_name").addClass('error');
                    htmlError += '<b>Nom</b> : veuillez saisir une valeur dans ce champ.' + '<br />';
                }

                if (error) {
                    if (_form.find(".isRequired").hasClass('error')) {
                        _form.find(".isRequired.error").get(0).focus();
                    }
                    alertify.set({labels: {ok: "Fermer"}});
                    alertify.alert(htmlError);
                    return false;
                }
                if (_form.find("#Property_description").val().length < 20) {
                    _form.find("#Property_description").focus();
                    alertify.set({labels: {ok: "Fermer"}});
                    alertify.alert("Merci de saisir un minimum de 20 caractères dans le champ \"Descriptif de l'annonce\".");
                    return false;
                }
                showloadPage();
                _form.find('button[type="submit"]').attr('disabled', true);
            },
            success: function(res) {
                _form.find('button[type="submit"]').removeAttr('disabled');
                if (!res.error) {
                    window.location.href = webroot + '/?property_id=' + res.property;
                } else {
                    hideLoadPage();

                    $('#property_villes').html('ssssss');
                    errorNot();
                }
            }
        });
        return false;
    });

    /* Cập nhật thông tin userProfile*/
    $("#saveUserForm").submit(function() {
        var _form = $(this);
        $.ajax({
            type: 'POST',
            url: webroot + '/home/saveUserProfile',
            data: _form.serialize(),
            beforeSend: function() {
                var error = false;
                _form.find("input").removeClass('error');
                var htmlError = '<b>Veuillez vérifier les champs suivants :</b><br />';
                if (_form.find("#WpUserMeta_first_name").val() == '') {
                    error = true;
                    _form.find("#WpUserMeta_first_name").addClass('error');
                    htmlError += '<b>Nom</b> : veuillez saisir une valeur dans ce champ.' + '<br />';
                }
                if (_form.find("#WpUserMeta_last_name").val() == '') {
                    error = true;
                    _form.find("#WpUserMeta_last_name").addClass('error');
                    htmlError += '<b>Prénom</b> : veuillez saisir une valeur dans ce champ.' + '<br />';
                }
                if (_form.find("#WpUserMeta_email").val() == '') {
                    error = true;
                    _form.find("#WpUserMeta_email").addClass('error');
                    htmlError += '<b>Email</b> : veuillez saisir une valeur dans ce champ.' + '<br />';
                } else if (validateEmail(_form.find("#WpUserMeta_email").val()) === false) {
                    error = true;
                    _form.find("#WpUserMeta_email").addClass('error');
                    htmlError += '<b>Email</b> : veuillez saisir une adresse email correcte.' + '<br />';
                }
                if (error) {
                    _form.find(".error").get(0).focus();
                    alertify.set({labels: {ok: "Fermer"}});
                    alertify.alert(htmlError);
                    return false;
                }
                showloadPage();
                _form.find('button[type="submit"]').attr('disabled', true);
            },
            success: function(res) {
                _form.find('button[type="submit"]').removeAttr('disabled');
                if (!res.error) {
                    window.location.href = webroot + '/?property_id=' + res.property_id;
                } else {
                    hideLoadPage();
                    errorNot();
                }
            }
        });
        return false;
    });

    /* Cập nhật thông tin Enegy*/
    $("#saveEnegyForm").submit(function() {
        var _form = $(this);
        $.ajax({
            type: 'POST',
            url: _form.attr('action'),
            data: _form.serialize(),
            beforeSend: function() {
                var NRJtext = _form.find("#WpEnegy_dpeNRJ").val();
                var NRJse = _form.find("#WpEnegy_dpeNRJselect").val();

                var GEStext = _form.find("#WpEnegy_dpeNRJ").val();
                var GESse = _form.find("#WpEnegy_dpeGESselect").val();
                if ((NRJtext == '' && NRJse == '') && (GEStext == '' && GESse == '')) {
                    alertify.set({labels: {ok: "Fermer"}});
                    alertify.alert("Veuillez saisir une valeur pour votre consommation Ã©nergÃ©tique et/ou vos Ã©missions de gaz Ã effet de serre");
                    return false;
                }
                _form.find('button[type="submit"]').attr('disabled', true);
                showloadPage();
            },
            success: function(res) {
                _form.find('button[type="submit"]').removeAttr('disabled');
                if (!res.error) {
                    window.location.href = webroot + '/?property_id=' + res.property_id;
                } else {
                    hideLoadPage();
                    errorNot();
                }
            }
        });
        return false;
    });

    /* Cập nhật thông tin user*/
    $("#saveMemberForm").submit(function() {
        var _form = $(this);
        $.ajax({
            type: 'POST',
            url: _form.attr('action'),
            data: _form.serialize(),
            beforeSend: function() {
                _form.find('button[type="submit"]').attr('disabled', true);
                showloadPage();
            },
            success: function(res) {
                _form.find('button[type="submit"]').removeAttr('disabled');
                if (!res.error) {
                    window.location.href = webroot + '/?property_id=' + res.property_id;
                } else {
                    hideLoadPage();
                    setError(res.errors, _form);
                }
            }
        });
        return false;
    });

    /* Comment post property*/
    $("#commentPropertyForm").submit(function() {
        var _form = $(this);
        $.ajax({
            type: 'POST',
            url: _form.attr('action'),
            data: _form.serialize(),
            beforeSend: function() {
                _form.find("#WpPostPropertyComment_comment").removeClass('error');
                if (_form.find('#WpPostPropertyComment_comment').val().length < 5) {
                    _form.find("#WpPostPropertyComment_comment").addClass('error').focus();
                    var html = "<b>Veuillez vérifier les champs suivants :</b><br />";
                    html += 'Veuillez saisir plus de 5 caractères dans votre commentaire';
                    alertify.set({labels: {ok: "Fermer"}});
                    alertify.alert(html);
                    return false;
                }
                _form.find('button[type="submit"]').attr('disabled', true);
                showloadPage();
            },
            success: function(res) {
                _form.find('button[type="submit"]').removeAttr('disabled');
                window.location.href = webroot + '/?property_id=' + res.property_id;
            }
        });
        return false;
    });
    /* Comment User*/
    $("#userCommentForm").submit(function() {
        var _form = $(this);
        $.ajax({
            type: 'POST',
            url: _form.attr('action'),
            data: _form.serialize(),
            beforeSend: function() {
                _form.find("#WpUserComment_comment").removeClass('error');
                if (_form.find('#WpUserComment_comment').val().length < 5) {
                    _form.find("#WpUserComment_comment").addClass('error').focus();
                    var html = "<b>Veuillez vérifier les champs suivants :</b><br />";
                    html += 'Veuillez saisir plus de 5 caractères dans votre commentaire';
                    alertify.set({labels: {ok: "Fermer"}});
                    alertify.alert(html);
                    return false;
                }
                _form.find('button[type="submit"]').attr('disabled', true);
                showloadPage();
            },
            success: function(res) {
                _form.find('button[type="submit"]').removeAttr('disabled');
                window.location.href = webroot + '/?property_id=' + res.property_id;
            }
        });
        return false;
    });

    /* Validate Email*/
    $(".btn-setvalidate").live('click', function() {
        var _this = $(this);
        var isValidate = _this.attr('rel');
        var userId = _this.attr('uuid');
        $.ajax({
            type: 'POST',
            url: webroot + '/common/validateEmail',
            data: {'user_id': userId, 'isValidate': isValidate},
            beforeSend: function() {
                if (isValidate == 99) {
                    _this.parent().find('span.label').html('A VERIF');
                    _this.parent().find('span.time').remove();
                    _this.parent().find('span.label').removeClass('label-success').addClass('label-important');
                    var buttonHtml = '<button type="button" uuid="' + userId + '" rel="1" class="btn btn-small btn-success btn-setvalidate">VALIDE</button>';
                    buttonHtml += '<button type="button" uuid="' + userId + '" rel="0" class="btn btn-small btn-danger btn-setvalidate">BAD</button>';
                    buttonHtml += '<button type="button" uuid="' + userId + '" rel="0" class="btn btn-small btn-inverse btn-setvalidate">BlackList</button>';
                    $(buttonHtml).insertAfter(_this);
                    _this.remove();
                } else {
                    var label = _this.parent().find('span.label');
                    if (isValidate == 1) {
                        _this.parent().find('span.label').html('OK');
                        _this.parent().find('span.label').removeClass('label-important').addClass('label-success');
                    } else {
                        _this.parent().find('span.label').html('BAD');
                        _this.parent().find('span.label').removeClass('label-success').addClass('label-important');
                    }
                    var buttonHtml = '<button type="button" uuid="' + userId + '" rel="99" class="btn btn-small btn-danger btn-setvalidate">MODIFIER</button>';
                    buttonHtml += '<span class="time">' + date('m/d/Y H:s:i A') + '</span>';
                    _this.parent().find('button').remove();
                    $(buttonHtml).insertAfter(label);
                }
            },
            success: function(res) {
                if (res.error) {
                    errorNot();
                }
            }
        });
        return false;
    });

    /* Cập nhật lại ngày đăng của postproperty*/
    $("#UpdateDateCreatedProperty").click(function() {
        var property_id = $(this).attr('rel');
        var date = $(this).attr('date');
        alertify.set({labels: {
                ok: "OK",
                cancel: "Cancel"
            }});
        alertify.prompt("<b>Commentaire</b>", function(e, str) {
            if (e) {
                if (str == '') {
                    alert('Vous devez entrer un commentaire.');
                    return false;
                } else {
                    $.post(webroot + '/common/updateDateCreatedProperty', {'comment': str, 'property_id': property_id, 'date': date}, function(res) {
                        if (res.error) {
                            alert('error');
                            window.location.reload();
                        } else {
                            $("#dateCreatedProperty").html(res.date);
                            $("#dateCompareProperty").html(0);
                        }
                    });
                }
            } else {

            }
        }, "");
    });
    /* các sự kiện show box of box right in homepage*/
    $(".acquereursForm-modal").fancybox({
        width: '800px',
        height: '667px',
        autoSize: false,
    });
});
/* Phương thức dùng để detect spam keyup*/
var justOneRequest = (function($) {
    var objLast = null;
    var intTimeout = null;
    var isFirstRequest = true;
    return {
        registerEvent: function(groupLink, timeout, type) {
            justOneRequest.isFirstRequest = true;
            groupLink.live('keyup', function(event) {
                if (justOneRequest.isFirstRequest) {
                    justOneRequest.setObj(this);
                    clearTimeout(justOneRequest.getTimeout());
                    justOneRequest.setTimeout(setTimeout(function() {
                        load_ville_code(groupLink, type);
                    }, timeout));
                    event.stopImmediatePropagation();
                    return false;
                } else {
                    justOneRequest.isFirstRequest = true;
                }
            });
        },
        setObj: function(obj) {
            this.objLast = obj;
        },
        setTimeout: function(timeout) {
            this.intTimeout = timeout;
        },
        getTimeout: function() {
            return this.intTimeout;
        }
    }
})(jQuery);
function load_ville_code(groupLink, type) {
    var code = groupLink.val();
    if (type == 2) {
        $.ajax({
            type: 'POST',
            url: webroot + '/common/getVilles',
            data: {'code': code},
            beforeSend: function() {
                $("#loading-villes").show();
            },
            success: function(data) {
                $("#loading-villes").hide();
                var obj = $.parseJSON(data);
                $("#property_villes .property_villes_value").remove();
                $("#property_villes").removeAttr('disabled');
                for (var i = 0; i < obj.msg.length; i++) {
                    $("#property_villes").append('<option class="property_villes_title" value="' + obj.msg[i].cp + '_' + obj.msg[i].nom + '">' + obj.msg[i].nom + '(' + obj.msg[i].cp + ')</option>');
                }
            }
        });
        return false;
    } else
    {
        $.ajax({
            type: 'POST',
            url: webroot + '/common/getVilles',
            data: {'code': code},
            beforeSend: function() {
                $("#loading-villes-user").show();
            },
            success: function(data) {
                $("#loading-villes-user").hide();
                var obj = $.parseJSON(data);
                $("#user_villes .user_villes_title").remove();
                $("#user_villes").removeAttr('disabled');
                for (var i = 0; i < obj.msg.length; i++) {
                    $("#user_villes").append('<option class="user_villes_title" value="' + obj.msg[i].cp + '_' + obj.msg[i].nom + '">' + obj.msg[i].nom + '(' + obj.msg[i].cp + ')</option>');
                }
            }
        });
        return false;
    }
}
