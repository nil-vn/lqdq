<!--<div class="row error-wrap">
	<div class="span3">
		<div class="errorcode">
			<span>404</span>
		</div>
	</div>
	<div class="span5">
		<div class="error-title">
			<span>Uh oh!</span>
		</div>
		<div>
			<h3 class="error-message"><span><a href="<?php echo PIUrl::createUrl('/');?>">Référence annonce introuvable !.</a></h3>
		</div>
	</div>
</div>-->
<script>
	$(document).ready(function(){
		alertify.set({ labels : { ok: "OK"} });
		alertify.alert("Référence annonce introuvable !",function(e){
			window.location.href= webroot;
		});
	});
</script>