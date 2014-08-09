<script>
	$(document).ready(function(){
		alertify.set({ labels : { ok: "OK"} });
		alertify.alert("<?php echo $mesg;?>",function(e){
			window.location.href= webroot;
		});
	});
</script>