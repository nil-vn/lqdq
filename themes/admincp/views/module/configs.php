<style>
    .form-horizontal .controls {margin-left: 234px;}
    .form-horizontal .control-label {width: 215px;}
</style>
<div class="row">
    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo-admin.gif" />
    <div class="nonboxy-widget">
        <div class="widget-head">
            <h5> <span class="color-icons"></span> CONFIGURATION GENERALE</h5>
        </div>
        <div class="widget-content">
            <div class="widget-box">
                <form class="form-horizontal well" id="ConfigsForm">
                    <fieldset>

                        <div class="control-group">
                            <label class="control-label" for="my_postal_code">Gestion des types de bien :</label>
                            <div class="controls">
                                <button class="btn" type="button" onclick="window.location.href = '<?php echo PIUrl::createUrl('/module/configAjouter'); ?>'">Ajouter</button>
                                <button class="btn" type="button">Modifier</button>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Gestion des offres promotionnelles :</label>
                            <div class="controls">
                                <button href="<?php echo PIUrl::createUrl('/module/configOfferVisu'); ?>" class="btn BTNVisualiser" type="button">Visualiser</button>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="WpUserMeta_landline">Gestion des templates emails : </label>
                            <div class="controls">
                                <button class="btn" onclick="window.open('<?php echo PIUrl::createUrl('/suivi_clientele'); ?>', '_blank')" type="button">Templates emails</button>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="WpUserMeta_mobile_phone">Gestion des démarchages NEW : </label>
                            <div class="controls">
                                <button onclick="window.location.href = '<?php echo PIUrl::createUrl('/module/configMailingVisu'); ?>'" class="btn" type="button">Gestion des démarchages</button>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="WpUserMeta_mobile_phone">Configuration e-mail : </label>
                            <div class="controls">
                                <button onclick="window.location.href = '<?php echo PIUrl::createUrl('/configCronEmail/index'); ?>'" class="btn" type="button">Configuration</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("html").niceScroll({cursorcolor: "#bbb", cursorwidth: "7px"});
        $(".BTNVisualiser").click(function() {
            window.parent.$.fancybox.close();
            window.parent.$.fancybox.open({
                type: 'iframe',
                width: 950,
                href: $(this).attr('href')
            });
        });
    });
</script>