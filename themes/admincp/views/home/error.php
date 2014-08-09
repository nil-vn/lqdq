<div class="container error-page-cntainer">
	<div class="row">
		<!--404 with error message show area start here-->
		<div class="span8">
			<div class="leftSide">
				<div class="errorCode">
					<?php echo $error['code'] ?>
				</div>
				<div class="bubble">
					<h3><span>Oops!</span><?php echo $error['message']; ?></h3>
					<h4>We are sorry</h4>
					<p>
						We are sorry but the page you are looking for does not okie. :(
					</p>
				</div>
			</div>
		</div>
		<!--404 with error message show area end here-->
		<!--Right side sugestions area start here-->
		<div class="span4">
			<div class="rightSide">
				<h3><span>Lost?</span> We suggest...</h3>
				<ol>
					<li>Checking the web address for typos.</li>
					<li>Visiting the <a href="<?php echo PIUrl::createUrl('/');?>">home</a> page.</li>
				</ol>
				
			</div>
		</div>
		<!--Right side sugestions end start here-->
	</div>
</div>