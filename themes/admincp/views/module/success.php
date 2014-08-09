<script>
	$(document).ready(function(){
		alertify.set({ labels : { ok: "OK"} });
		alertify.alert("<?php echo $mesg;?>",function(e){
			$.fancybox.close();
			window.parent.location.href= webroot+"/?property_id=<?php echo $id;?>";
		});
	});
</script>