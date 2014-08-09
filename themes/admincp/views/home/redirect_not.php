<script>
	$(document).ready(function(){
		alertify.set({ labels : { ok: "OK"} });
		alertify.alert("Pas de Client inscrit pour cette information !",function(e){
			window.location.href = webroot;
		});
	});
</script>