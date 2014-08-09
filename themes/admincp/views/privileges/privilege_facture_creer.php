<style>

    // Block level inputs
    .input-block-level {
        display: block;
        width: 100%;
        min-height: 28px;        // Make inputs at least the height of their button counterpart

    }
    .giua{text-align: center;}
    button {background-color:#FFF; border:0px #ADADAD dotted; font-weight:bold; text-align:center; border:1px solid #dedede; border-top:1px solid #eee; border-left:1px solid #eee; color:#565656; margin: auto;margin:0 auto;}
    #vebutton{ border: 1px #FFBD69 solid; padding: 4px 4px 4px 4px; border-radius: 5px;}
    #acquereur_genre{margin-left: 480px;}
</style>
<!-- Nav tabs -->
<label style=" text-align: center;"><strong>CREATION FACTURE PRIVILEGE ANNONCE BTK<?php echo $property_id; ?></strong></label>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'factureForm',
    'htmlOptions' => array(
        'onsubmit' => 'return false;',
    ),
        ));
?>
<input name="post" id="post" type="hidden" value="1">
<input name="id" id="propertyid" type="hidden" value="<?php echo $property_id; ?>">	

<div id="tabs">

    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#home" role="tab" data-toggle="tab">CLIENT VENDEUR</a></li>
        <li><a href="#profile" role="tab" data-toggle="tab">CLIENT ACQUEREUR</a></li>
        <li><a href="#messages" role="tab" data-toggle="tab">FACTURATION</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane fade in active" id="home">
            <p>
                <label class="giua" for="client_prenom">Prénom client</label>
                <input name="client_prenom" id="client_prenom" type="text" maxlength="100"
                       class="input-block-level"
                       value="<?php echo $f_name; ?>">
                <label class="giua" for="client_nom">Nom du client:</label>			
                <input name="client_nom" id="client_nom" type="text" maxlength="100"
                       class="input-block-level" 
                       value="<?php echo $l_name; ?>">

                <label class="giua" for="client_adresse1">Adresse</label>			
                <input name="client_adresse1" id="client_adresse1" type="text" maxlength="100" 
                       class="input-block-level"
                       value="<?php echo $f_name; ?><?php echo $a_dress; ?>">

                <label class="giua" for="client_adresse2">Compl&eacute;ment d'adresse</label>			
                <input name="client_adresse2" id="client_adresse2" type="text" maxlength="100"
                       class="input-block-level" 
                       value="<?php echo $additionaladdress; ?>">

                <label class="giua" for="client_cp">Code Postal</label>			
                <input name="client_cp" id="client_cp" type="text" size="5" maxlength="5" 
                       class="input-block-level"
                       value="<?php echo $cp; ?>">

                <label class="giua" for="client_ville">Ville</label> 
                <input name="client_ville" id="client_ville" type="text" maxlength="100" 
                       class="input-block-level"
                       value="<?php echo $ville; ?>">
            </p>	
        </div>
        <div class="tab-pane fade" id="profile">
            <p>
                <label style=" text-align: center;" for="acquereur_genre">Genre</label>			
                <select id="acquereur_genre" name="acquereur_genre" class="select ui-widget-content ui-corner-all">
                    <option value="" selected></option>
                    <option value="Mr">Mr</option>
                    <option value="Mme">Mme</option>
                    <option value="Mlle">Mlle</option>
                    <option value="Mme, Mr">Mme, Mr</option>
                </select>
                <br><br>

                <label class="giua" for="acquereur_prenom">Prénom Acquéreur</label>			
                <input id="acquereur_prenom" name="acquereur_prenom" type="text" maxlength="100"
                       class="input-block-level" 
                       value="<?php echo $prenom_acq; ?>">

                <label class="giua" for="acquereur_nom">Nom Acquéreur</label>			
                <input id="acquereur_nom" name="acquereur_nom" type="text" maxlength="100" 
                       class="input-block-level"
                       style="text-transform:uppercase"
                       value="<?php echo $nom_acq; ?>">
            </p>	
        </div>
        <div class="tab-pane fade" id="messages">
            <p>
                <label class="giua" for="prix_vente">Prix de vente en &euro; (ex: 160000)</label>			
                <input id="prix_vente" name="prix_vente" type="text" maxlength="10" 
                       class="input-block-level"
                       value="<?php echo $pri; ?>">


                <label class="giua" for="commission">Commission en % (ex: <?php echo $commi; ?>)</label>			
                <input id="commission" name="commission" type="text" maxlength="3" 
                       class="input-block-level"
                       value="<?php echo $commi; ?>" >

                <label class="giua" for="remise">Remise en &euro;</label>			
                <input id="remise" name="remise" type="text" maxlength="10" 
                       class="input-block-level"
                       value="0">

                <label class="giua" for="honoraire">Honoraire Total</label>			
                <input id="honoraire" name="honoraire" type="text" maxlength="10" 
                       class="input-block-level"
                       value=""
                       disabled>
            </p>
        </div>
    </div>
</div>
<br>
<br>
<div style="width:380px; margin-left: 400px;">
    <input  hidden="checkbox" type="checkbox" id="courriel" name="courriel" checked><label style="cursor: pointer;"  id="vebutton" class="giua" for="courriel"><span class="ui-icon ui-icon-mail-closed" style="float:left; margin:0 7px 0 0; color: #ADADAD;  "></span><strong>Cliquer ici pour envoyer la facture par courriel au comptable</strong></label>
    <button id="creer" class="btn btn-default" style="margin-left: 130px;">Créer la facture</button>
</div>
<?php $this->endWidget(); ?>
<script>
    $(function() {

        //Boutons
        $("#courriel").button();
        $("#creer").button({
            icons: {
                primary: "ui-icon-disk"
            }
        }).bind('click', function() {
            $.validerForm();
        });

    });
    $(document).ready(function()
    {
        // The DOM (document object model) is constructed
        // We will initialize and run our plugin here
        $('#remise').change(function() {
            $.calculHonoraire();
        });
        $('#commission').change(function() {
            $.calculHonoraire();
        });
        $('#prix_vente').change(function() {
            $.calculHonoraire();
        });

        // Calcul des honoraires des le chargement
        $.calculHonoraire();
    });
    $.calculHonoraire = function()
    {
        var prixvente = $("#prix_vente").val().replace(',', '.'),
                commission = $("#commission").val().replace(',', '.'),
                remise = $("#remise").val().replace(',', '.');

        //console.log(parseFloat(prixvente));
        //console.log(parseFloat(commission));
        //console.log(parseFloat(remise));
        var honoraire = parseFloat(prixvente) * (parseFloat(commission) / 100) - parseFloat(remise);
        //console.log(honoraire);
        $("#honoraire").attr('value', honoraire.toString().replace('.', ','));

    };
    $.validerForm = function()
    {
        var errmsg = "Veuillez remplir ou corriger les champs en surbrillance suivants:\n";
        var err = false;

        var cnom = $("#client_nom"),
                ag = $("#acquereur_genre"),
                anom = $("#acquereur_nom"),
                prixvente = $("#prix_vente"),
                commission = $("#commission"),
                remise = $("#remise");

        // Ts les champs
        var allFields = $([]).add(cnom).add(ag).add(anom).add(prixvente).add(commission).add(remise);
        allFields.removeClass("ui-state-error");

        if (cnom.val().length <= 2) {
            errmsg = errmsg + "\n- Nom client vendeur";
            cnom.addClass("ui-state-error");
            err = true;
        }
        if (ag.val().length < 2) {
            errmsg = errmsg + "\n- Genre client acquéreur";
            ag.addClass("ui-state-error");
            err = true;
        }
        if (anom.val().length <= 2) {
            errmsg = errmsg + "\n- Nom client acquéreur";
            anom.addClass("ui-state-error");
            err = true;
        }
        if (prixvente.val().length < 1) {
            errmsg = errmsg + "\n- Prix de vente";
            prixvente.addClass("ui-state-error");
            err = true;
        }
        if (commission.val().length < 1) {
            errmsg = errmsg + "\n- Commission";
            commission.addClass("ui-state-error");
            err = true;
        }
        if (remise.val().length < 1) {
            errmsg = errmsg + "\n- Remise";
            remise.addClass("ui-state-error");
            err = true;
        }

        if (err)
            alert(errmsg);
        else
        {
            $(document).ready(function() {
                $("#factureForm").submit(function() {
                    var post = $("#post").val();
                    var propertyid = $("#propertyid").val();
                    var prix_vente = $("#prix_vente").val();
                    var commission = $("#commission").val();
                    var remise = $("#remise").val();

                    var client_prenom = $("#client_prenom").val();
                    var client_nom = $("#client_nom").val();
                    var client_adresse1 = $("#client_adresse1").val();
                    var client_adresse2 = $("#client_adresse2").val();
                    var client_cp = $("#client_cp").val();
                    var client_ville = $("#client_ville").val();

                    var acquereur_genre = $("#acquereur_genre").val();
                    var acquereur_prenom = $("#acquereur_prenom").val();
                    var acquereur_nom = $("#acquereur_nom").val();

                    var honoraire = $("#honoraire").val();
                    var courriel = $("#courriel").val();

                    $.ajax({
                        type: 'POST',
                        url: webroot + '/privileges/request_facture_creer/',
                        data: {'client_prenom': client_prenom, 'client_nom': client_nom, 'client_adresse1': client_adresse1, 'client_adresse2': client_adresse2, 'client_cp': client_cp, 'client_ville': client_ville, 'acquereur_genre': acquereur_genre, 'acquereur_prenom': acquereur_prenom, 'acquereur_nom': acquereur_nom, 'honoraire': honoraire, 'post': post, 'propertyid': propertyid, 'prix_vente': prix_vente, 'commission': commission, 'remise': remise, 'courriel': courriel},
                        success: function(data) {
                            var obj = $.parseJSON(data);

                            if (obj.msg == 1) {
                                //window.location.href = webroot + "/privileges/privilege_vendu_immo/" + propertyid;
                                window.location.href = webroot + "/compta/privilege_facture_sauvegarder_pdf/" + propertyid;
                                //window.location.href = webroot + "/privileges/privilege_vendu_immo/" + propertyid;

                            }
                            
                        }
                    });
                    return false;

                });
            });
        }
    };

</script>