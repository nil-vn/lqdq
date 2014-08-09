<!-- javascript-->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery-ui-1.8.16.custom.min.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.ui.touch-punch.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/bootstrap.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/prettify.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.sparkline.min.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.nicescroll.min.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/accordion.jquery.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/smart-wizard.jquery.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/vaidation.jquery.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery-dynamic-form.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/fullcalendar.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/raty.jquery.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.noty.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.cleditor.min.js"></script> 
<!--
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/data-table.jquery.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/TableTools.min.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/ColVis.min.js"></script> 
-->
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/elfinder/elfinder.min.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/chosen.jquery.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/uniform.jquery.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.tagsinput.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.colorbox-min.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/check-all.jquery.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/inputmask.jquery.js"></script> 
<script src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/plupupload/jquery.plupload.queue/jquery.plupload.queue.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/excanvas.min.js"></script> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/custom-script.js"></script> 
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/library/localTimeFromUTC.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/common.js"></script>
<script  src="<?php echo Yii::app()->theme->baseUrl; ?>/js/formjs/form.js"></script>
<!-- html5.js for IE less than 9 --> 
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--> 
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/respond.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/ios-orientationchange-fix.js"></script>

<script>
	$(document).ready(function(){
		$.datepicker.regional['fr'] = {
	        clearText: 'Effacer', clearStatus: '',
	        closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
	        prevText: '<Préc', prevStatus: 'Voir le mois précédent',
	        nextText: 'Suiv>', nextStatus: 'Voir le mois suivant',
	        currentText: 'Courant', currentStatus: 'Voir le mois courant',
	        monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
	            'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
	        monthNamesShort: ['Janvier','Février','Mars','Avril','Mai','Juin',
	            'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
	        monthStatus: 'Voir un autre mois', yearStatus: 'Voir un autre année',
	        weekHeader: 'Sm', weekStatus: '',
	        dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
	        dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
	        dayNamesMin: ['D','L','M','M','J','V','S'],
	        dayStatus: 'Utiliser DD comme premier jour de la semaine', dateStatus: 'Choisir le DD, MM d',
	        dateFormat: 'dd/mm/yy', firstDay: 0,
	        initStatus: 'Choisir la date', isRTL: false};
	        
	    $.datepicker.setDefaults($.datepicker.regional['fr']);
	    $('#datePickerEnegy').datepicker({
	        changeMonth: true,
	        changeYear: true,
	        maxDate: 0,
	        dateFormat: 'dd/mm/yy',
	        showAnim: 'explode',
	        duration: 800
	    });
	});

</script>