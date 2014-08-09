<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery-ui-1.8.16.custom.css" rel="stylesheet">
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-ui-1.8.22.custom.min.js"></script> 
<style>
    .compte td.menu {
        font-family:"MS Sans Serif";
        font-size:22px;
        font-weight:700;
        color:#CCC;
        max-width:730px;
        padding-left:20px;
        padding-top:20px;
        text-align:justify;
    }

    .compte td.td {
        background-image:url(../images/table/bg_t1.gif);
        background-repeat:repeat-x;
        padding-top:25px;
        padding-left:20px;
    }

    .compte .menu span {
        font-size:12px;
        color:#555;
        font-weight:400;
    }

    .compte .contenu {
        padding-left:20px;
        text-align:justify;
        padding-right:15px;
    }

    .compte .contenu li {
        list-style:none url(../images/puces/puce.gif) inside;
    }

    .compte .contenu span {
        font-size:.9em;
        color:#8A8A8A;
    }

    .compte .formulaire {
        border:0;
        width:730px;
    }

    .compte .intitule {
        background-color:#EEE;

        width:300px;
    }

    .compte .intitule div {
        margin-left:20px;
        font-size:.9em;
        color:#6A6A6A;
        font-weight:700;
    }

    .compte .champ {
        border:1px solid #EEE;
        background-color:#FFF;
        height:0px;
        width:430px;
    }

    .compte .champ div {
        margin-left:5px;
    }

    .compte .champ select {
        border:0;
        color:#9C2929;
        width:383px;
    }

    .compte .champ select.on {
        border:0;
        font-weight:700;
        color:#9C2929;
        width:383px;
    }

    .compte .champ input {
        border:0;
        color:#9C2929;
        height:12px;
        margin-top: 2px;
        margin-left:1px;
        margin-bottom: 4px;
        width:380px;
    }
    .compte textarea.cg {
        border:1px solid #CDDEF5;
        color:#222;
        font-weight:lighter;
        height:200px;
        width:726px;
        font-size:1.1em;
    }

    .compte .asterisque {
        background-color:#EEE;
        color:#C00;
        text-align:right;
        width:4px;
    }

    .compte .checkbox {
        width:243px;
    }
    p.info {
        background:#f8fafc url(../images/icones/PNG/info.png) 15px 50% no-repeat;
        text-align:left;
        border-top:2px solid #b5d4fe;
        color:#666;
        border-bottom:2px solid #b5d4fe;
        padding:5px 20px 5px 45px;
    }

    p.info a {
        color:#069;
        text-decoration:none;
    }

    p.info a:hover {
        color:#06F;
        text-decoration:none;
    }

    p.succes {
        background:#FCFEEC url(../images/icones/PNG/ok.png) 15px 50% no-repeat;
        text-align:left;
        border-top:2px solid #A2C76F;
        color:#58964A;
        border-bottom:2px solid #A2C76F;
        padding:5px 20px 5px 45px;
    }

    p.succes a {
        color:#A2C76F;
        text-decoration:none;
    }

    p.succes a:hover {
        color:#58964A;
        text-decoration:none; 
    }

    td#espace_horizontal {
        height:1px;
        background-color:#999;
    }

    td#espace_horizontal_gris {
        height:1px;
        background-color:#F0F0F0;
    }

    td#espace_horizontal_blanc {
        height:1px;
        background-color:#FFF;
    }

    td#espace_vertical {
        width:1px;
        background-color:#999;
    }

    td#espace_vertical_blanc {
        width:1px;
        background-color:#FFF;
    }


</style>
<script>
    $(document).ready(function() {
        $("input#nom:text").click(function() {
            $('#nom').focus();
            if ($("#nom").is(":focus")) {
                $("input#nom:text").css({
                    "font-weight": "bold",
                    "background-color": "#f5f5f5"
                });
            }
            $("#nom").focusin(function() {
                $("input#nom:text").css({
                    "font-weight": "bold",
                    "background-color": "#f5f5f5"
                });
            });
        });
        $("#nom").focusout(function() {
            $("input#nom:text").css({
                "font-weight": "normal",
                "background-color": "transparent"
            });
        });
        $("#nom").click(function() {
            $("input#nom:text").css({
                "font-weight": "bold",
                "background-color": "#f5f5f5"
            });
        });
        //tab1
        $("img#tab1").click(function() {
            $('#prenom').focus();
            if ($("#prenom").is(":focus")) {
                $("input#prenom:text").css({
                    "font-weight": "bold",
                    "background-color": "#f5f5f5"
                });
            }
            $("#prenom").focusin(function() {
                $("input#prenom:text").css({
                    "font-weight": "bold",
                    "background-color": "#f5f5f5"
                });
            });
        });
        $("#prenom").focusout(function() {
            $("input#prenom:text").css({
                "font-weight": "normal",
                "background-color": "transparent"
            });
        });
        $("#prenom").click(function() {
            $("input#prenom:text").css({
                "font-weight": "bold",
                "background-color": "#f5f5f5"
            });
        });
        //tab2
        $("img#tab2").click(function() {
            $('#tel').focus();
            if ($("#tel").is(":focus")) {
                $("input#tel:text").css({
                    "font-weight": "bold",
                    "background-color": "#f5f5f5"
                });
            }
            $("#tel").focusin(function() {
                $("input#tel:text").css({
                    "font-weight": "bold",
                    "background-color": "#f5f5f5"
                });
            });
        });
        $("#tel").focusout(function() {
            $("input#tel:text").css({
                "font-weight": "normal",
                "background-color": "transparent"
            });
        });
        $("#tel").click(function() {
            $("input#tel:text").css({
                "font-weight": "bold",
                "background-color": "#f5f5f5"
            });
        });
        //tab3
        $("img#tab3").click(function() {
            $('#email').focus();
            if ($("#email").is(":focus")) {
                $("input#email:text").css({
                    "font-weight": "bold",
                    "background-color": "#f5f5f5"
                });
            }
            $("#email").focusin(function() {
                $("input#email:text").css({
                    "font-weight": "bold",
                    "background-color": "#f5f5f5"
                });
            });
        });
        $("#email").focusout(function() {
            $("input#email:text").css({
                "font-weight": "normal",
                "background-color": "transparent"
            });
        });
        $("#email").click(function() {
            $("input#email:text").css({
                "font-weight": "bold",
                "background-color": "#f5f5f5"
            });
        });
        //tab4
        $("img#tab4").click(function() {
            $('#datecompromis').focus();
            if ($("#datecompromis").is(":focus")) {
                $("input#datecompromis:text").css({
                    "font-weight": "bold",
                    "background-color": "#f5f5f5"
                });
            }
            $("#datecompromis").focusin(function() {
                $("input#datecompromis:text").css({
                    "font-weight": "bold",
                    "background-color": "#f5f5f5"
                });
            });
        });
        $("#datecompromis").focusout(function() {
            $("input#datecompromis:text").css({
                "font-weight": "normal",
                "background-color": "transparent"
            });
        });
        $("#datecompromis").click(function() {
            $("input#datecompromis:text").css({
                "font-weight": "bold",
                "background-color": "#f5f5f5"
            });
        });
        //tab5
        $("img#tab5").click(function() {
            $('#notaire').focus();
            if ($("#notaire").is(":focus")) {
                $("input#notaire:text").css({
                    "font-weight": "bold",
                    "background-color": "#f5f5f5"
                });
            }
            $("#notaire").focusin(function() {
                $("input#notaire:text").css({
                    "font-weight": "bold",
                    "background-color": "#f5f5f5"
                });
            });
        });
        $("#notaire").focusout(function() {
            $("input#notaire:text").css({
                "font-weight": "normal",
                "background-color": "transparent"
            });
        });
        $("#notaire").click(function() {
            $("input#notaire:text").css({
                "font-weight": "bold",
                "background-color": "#f5f5f5"
            });
        });
        //tab6
        $("img#tab6").click(function() {
            $('#radipoui').focus();
        });


    });</script>
<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100%" class="compte">
    <tr>
    <!--	<td>
                    <br />
                    <% If msg<>"" Then %>
                            <p class="alert"><%= msg %></p><br />
                    <% End If %>
            </td>-->
    </tr>
    <tr>
        <td>
            <p class="info">
                <strong>Vous souhaitez retirer l'annonce Privil&egrave;ge r&eacute;f&eacute;rence <strong>BTK<?php echo $idannone; ?></strong> de la vente.</strong>

                <br />
            </p>
        </td>
    </tr>	
    <tr>
        <td>
            <br />
            <?php
            //Desactivation avec client(s) acquereur(s)
            //On affiche le formulaire de renseignement
            if (WpListCustomer::model()->clientacquereur($idannone) == true)
            {
                ?>

                <script>
                    $(document).ready(function() {
                        $(".datecompromis").datepicker({
                            inline: true
                        });
                    });
                </script>
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'form_s',
                    'htmlOptions' => array(
                        'onsubmit' => 'return false;',
                    ),
                ));
                ?>
                <input name="post" id="post" type="hidden" value="1" />
                <input name="ID" id="idanon" type="hidden" value="<?php echo $idannone; ?>" />
                <input name="idfiche" id="idfiche" type="hidden" value="<?php echo $id_fiche; ?>" />

                <table border="0" cellspacing="0" cellpadding="0" class="formulaire">
                    <tr>
                        <td id="espace_horizontal_blanc" colspan="3"></td>
                    </tr>
                    <tr>
                        <td class="intitule" width="30%">
                            <div>Nom de l'acqu&eacute;reur : </div>
                        </td>
                        <td width="4px" class="asterisque"></td>
                        <td class="champ">
                            <input name="nom" id="nom" type="text" maxlength="50"/> 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/suivant.gif" border="0" align="absmiddle" id="tab1" style="cursor:pointer;" alt="Champ suivant" />
                        </td>
                    </tr>
                    <tr>
                        <td id="espace_horizontal_blanc" colspan="3"></td>
                    </tr>
                    <tr>
                        <td class="intitule" width="30%">
                            <div>Pr&eacute;nom de l'acqu&eacute;reur
                                : </div>
                        </td>
                        <td width="4px" class="asterisque"></td>
                        <td class="champ">
                            <input name="prenom" type="text" id="prenom" maxlength="50" /> 
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/suivant.gif" border="0" align="absmiddle" id="tab2" style="cursor:pointer;" alt="Champ suivant" />
                        </td>
                    </tr>
                    <tr>
                        <td id="espace_horizontal_blanc" colspan="3"></td>
                    </tr>
                    <tr>
                        <td class="intitule" width="30%">
                            <div>T&eacute;l&eacute;phone de l'acqu&eacute;reur : </div>
                        </td>
                        <td width="4px" class="asterisque"></td>
                        <td class="champ">
                            <input name="tel" type="text" maxlength="15" id="tel" />
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/suivant.gif" border="0" align="absmiddle" id="tab3" style="cursor:pointer;" alt="Champ suivant" />
                        </td>
                    </tr>
                    <tr>
                        <td id="espace_horizontal_blanc" colspan="3"></td>
                    </tr>
                    <tr>
                        <td class="intitule" width="30%" colspan="2">
                            <div>E-mail de l'acqu&eacute;reur : </div>
                        </td>
                        <td class="champ">
                            <input name="email" type="text" id="email" maxlength="60" />
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/suivant.gif" border="0" align="absmiddle" id="tab4" style="cursor:pointer;" alt="Champ suivant" />
                        </td>
                    </tr>
                    <tr>
                        <td id="espace_horizontal_blanc" colspan="3"></td>
                    </tr>
                    <tr>
                        <td class="intitule" width="30%">
                            <div>Date du compromis : </div>
                        </td>
                        <td width="4px" class="asterisque"></td>
                        <td class="champ">
                            <input name="datecompromis" type="text" id="datecompromis" class="datecompromis" maxlength="15" style="cursor: pointer; background-image: url(<?php echo Yii::app()->theme->baseUrl; ?>/img/picker.jpg); background-position: 100% 50%; background-repeat: no-repeat;"/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/suivant.gif" border="0" align="absmiddle" id="tab5" style="cursor:pointer;" alt="Champ suivant" />
                        </td>
                    </tr>
                    <tr>
                        <td id="espace_horizontal_blanc" colspan="3"></td>
                    </tr>
                    <tr>
                        <td class="intitule" width="30%">
                            <div>Notaire(s) en charge de l'acte : </div>
                        </td>
                        <td width="4px" class="asterisque"></td>
                        <td class="champ">
                            <input name="notaire" type="text" id="notaire" maxlength="60"/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/suivant.gif" border="0" align="absmiddle" id="tab6" style="cursor:pointer;" alt="Champ suivant" /> 
                        </td>
                    </tr>
                    <tr>
                        <td id="espace_horizontal_blanc" colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">

                            <div>
                                <br />               
                                <font id="asterisque"></font> Ce client a t-il &eacute;t&eacute; envoy&eacute; par Immobilier.fr ? 
                                <br />
                                <br />
                                <input type="radio" name="radio" id="radipoui" value="1" /> OUI &nbsp;&nbsp;&nbsp;
                                <input type="radio" name="radio" id="radipoui1" value="0" /> NON <br>
                                <br />

                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td id="espace_horizontal_blanc" colspan="3"></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div align="center">

                                <br />
                                <br />

                                <input type="submit" name="Submit" value="Je stoppe la diffusion de l'annonce >>" />

                                <br />
                                <br />
                            </div>
                        </td>
                    </tr>
                </table>

                <?php $this->endWidget(); ?>



                <?php
                //Desactivation sans client(s) acquereur(s)	
            } else
            {
                ?>

                <script language="javascript">
                    function verifier(f) {
                        if (f.raison.value == "") {
                            alert("Veuillez sélectionner la raison de la désactivation.");
                            f.raison.focus();
                            return false;
                        }
                        return true;
                    }
                </script>
                <div align="center">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'form_s',
                        'htmlOptions' => array(
                            'onsubmit' => 'return false;',
                        ),
                    ));
                    ?>
                    <input name="post" id="post" type="hidden" value="2" />
                    <input name="ID" id="idanon" type="hidden" value="<?php echo $idannone; ?>" />
                    <input name="idfiche" id="idfiche" type="hidden" value="<?php echo $id_fiche; ?>" />	


                    <div id="commentaire" align="center" style="width:100%; border-top:2px #FFF dotted; color:#333333">

                        Laisser un message ci-dessous (<?php echo $id_fiche ?>).
                        <br />
                        <br />

                        <select name="raison" id="raison" style="width:300px;">
                            <option value="" selected="selected">Veuillez s&eacute;lectionner la raison de votre d&eacute;sactivation</option>
                            <option value="1">Vendu par une agence</option>
                            <option value="2">Vendu par immobilier.fr</option>
                            <option value="3">Vendu par un autre site</option>
                            <option value="4">Vendu par la presse</option>
                            <option value="5">Autre</option>
                        </select>

                        <br />
                        <br />

                        <strong>Votre message : </strong>
                        <br />
                        <textarea name="comm" id="comm" cols="80" rows="10" style="border:2px #CCC dotted; width:700px;"></textarea>

                    </div>	

                    <input type="submit" value="Je stoppe la diffusion de l'annonce >>" />
                    <?php $this->endWidget(); ?>

                </div>
            <?php } ?>

            <br />
            <br />

        </td>
    </tr>		
</table>
<script>
    $(document).ready(function() {
        $("#form_s").submit(function() {
            var p = $("#post").val();
            var idanon = $("#idanon").val();
            var fi = $("#idfiche").val();
            var nom = $("#nom").val();
            var prenom = $("#prenom").val();
            var tel = $("#tel").val();
            var email = $("#email").val();
            var datecompromis = $("#datecompromis").val();
            var notaire = $("#notaire").val();
            if ($("#radipoui1").is(":checked")) {
                var radipoui = $("#radipoui1").val();
            } else {
                var radipoui = $("#radipoui").val();
            }

            if (p == 1)
            {
                $.ajax({
                    type: 'POST',
                    url: webroot + '/bienVendu/requestbienvendu/',
                    data: {'idanon': idanon, 'p': p, 'fi': fi, 'nom': nom, 'prenom': prenom, 'tel': tel, 'email': email, 'datecompromis': datecompromis, 'notaire': notaire, 'radipoui': radipoui},
                    success: function(data) {
                        var obj = $.parseJSON(data);

                        if (obj.msg == 1) {
                            alertify.alert("Contrat privilège non valide");
                        }
                        else if (obj.msg == 2) {
                            alertify.alert("message Aucun abonnement Privilège en cours");
                        }
                        else if (obj.msg == 3) {
                            alertify.alert("Annonce déclarée en vendue par immobilier.fr");
                        }
                        else if (obj.msg == 4) {
                            alertify.alert("Une erreur est survenue pendant la d&eacute;sactivation de votre annonce (code PV1).<br /><br />Veuillez nous contacter si le probl&egrave;me persiste.");
                        }
                        else if (obj.msg == 5) {
                            alertify.alert("Une erreur est survenue pendant l\'enregistrement de vos informations (code PV4).<br /><br />Veuillez nous contacter si le probl&egrave;me persiste.");
                        }

                    }
                });
                return false;
            }
            if (p == 2)
            {
                var p = $("#post").val();
                var com = $("#comm").val();
                var rai = $("#raison").val();
                var idanon = $("#idanon").val();
                var fi = $("#idfiche").val();
                if ($("#raison").val() == "") {
                    alert("Veuillez sélectionner la raison de la désactivation.");
                    $("#raison").focus();
                    return false;
                }

                $.ajax({
                    type: 'POST',
                    url: webroot + '/bienVendu/requestbienvendu/',
                    data: {'com': com, 'p': p, 'rai': rai, 'idanon': idanon, 'fi': fi},
                    success: function(data) {
                        var obj = $.parseJSON(data);

                        if (obj.msg == 6) {
                            alertify.alert("Contrat privilège non valide");
                        }
                        else if (obj.msg == 7) {
                            alertify.alert("message Aucun abonnement Privilège en cours");
                        }
                    }
                });
                return false;
            }

        });
    });
</script>   