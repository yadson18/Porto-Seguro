<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>AverbePorto - <?= $this_->getData("Title") ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php  
			$this_->css("bootstrap.min.css");
			$this_->css("default.css");
			$this_->css("pages.css");
			$this_->css("font-awesome.min.css");

			$this_->script("jquery-3.2.1.min.js");
			$this_->script("jquery.price_format.min.js");
			$this_->script("inputMask.js");
			$this_->script("bootstrap.min.js");
			$this_->script("pages.js");
		?>
	</head>
	<body>
		<?php if(!empty($this_->getData("Logged"))): ?>
			<nav class="navbar navbar-default" id="menu">
	  			<div class="container-fluid">
		    		<div class="navbar-header">
		    			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        	<span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
				      	</button>
				      	<a class="navbar-brand" href="#">LOGO</a>
				    </div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      				<ul class="nav navbar-nav navbar-left">
					        <li><a href="/AverbePorto/index">Home</a></li>
	      				</ul>
	      				<ul class="nav navbar-nav navbar-left">
					        <li><a href="/AverbePorto/sendFile">Enviar arquivo</a></li>
	      				</ul>
	      				<ul class="nav navbar-nav navbar-right">
	        				<li>
	        					<a href="/Users/logout">
	        						Sair <i class="fa fa-sign-out" aria-hidden="true"></i>
	        					</a>
	        				</li>
	      				</ul>
	    			</div>
	  			</div>
			</nav>
		<?php endif; ?>
		<div id="content">
			<?= $this_->fetchAll() ?>
		</div>
	</body>
</html>