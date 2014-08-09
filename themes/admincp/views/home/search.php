<div class="row" style="margin:0 auto">
	<div class="span12" style="width:95%;float:none; margin:0 auto;">
		<div class="nonboxy-widget">
			<div class="widget-head">
				<h5 class="pull-left"> Recherche ACQ</h5> <div class="btn-group pull-right">
				</div>
			</div>
			<?php
				$param = "";
				if(isset($_GET['profile'])){
					$param.= '?profile='.$_GET['profile'];
					if(isset($_GET['like'])){
						$param.= '&like=1';
					}
					$param.= '&frame';
				}
			?>
			<iframe style="border:2px #ccc solid;width:100%;height:300px;border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;border-collapse: separate;" frameborder="0" src="<?php echo PIUrl::createUrl('/home/searchAcq/').$param;?>"></iframe>
		</div>
	</div>
</div>

<div class="row" style="margin:0 auto">
	<div class="span12" style="width:95%;float:none;margin:0 auto;">
		<div class="nonboxy-widget">
			<div class="widget-head">
				<h5 class="pull-left"> Recherche Annonce</h5> <div class="btn-group pull-right">
				</div>
			</div>
			<iframe style="border:2px #ccc solid;width:100%;height:300px;border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;border-collapse: separate;" frameborder="0" src="<?php echo PIUrl::createUrl('/home/searchAnnonce/').$param;?>"></iframe>
		</div>
	</div>
</div>