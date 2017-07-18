<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>AverbePorto - <?= $this_->getData("Title") ?></title>
		<link rel="icon" type="image/x-icon" href="/webroot/images/logo-icone.jpg">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php  
			$this_->css("bootstrap.min.css");
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
		<?php if($this_->getData("Title") != "Login"): ?>
			<nav class="navbar navbar-default" id="menu">
	  			<div class="container-fluid">
		    		<div class="navbar-header">
		    			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        	<span class="sr-only">Toggle navigation</span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
				      	</button>
				      	<a class="navbar-brand" href="#">
				      		<img src="/webroot/images/logo.gif">
				      	</a>
				    </div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      				<ul class="nav navbar-nav navbar-right">
	      					<li class="visible-xs">
	        					<a href="/AverbePorto/index">
	        						<i class="fa fa-home" aria-hidden="true"></i> Home
	        					</a>
	        				</li>
	        				<li class="visible-xs">
	        					<a href="/AverbePorto/sendFile">
	        						<i class="fa fa-upload" aria-hidden="true"></i> Envio de arquivo
	        					</a>
	        				</li>
	        				<li>
	        					<a href="/Users/logout">
	        						Sair <i class="fa fa-sign-out" aria-hidden="true"></i>
	        					</a>
	        				</li>
	      				</ul>
	    			</div>
	  			</div>
			</nav>
			<nav class="col-md-2 col-sm-3 hidden-xs" id="menu-left">
	  			<div>
					<div>
	      				<ul class="nav navbar-nav navbar-left">
					        <li>
					        	<a href="/AverbePorto/index">
					        		<i class="fa fa-home" aria-hidden="true"></i> Home
					        	</a>
					        </li>
	      				</ul>
	      				<ul class="nav navbar-nav navbar-left">
					        <li>
					        	<a href="/AverbePorto/sendFile">
					        		<i class="fa fa-upload" aria-hidden="true"></i> Envio de arquivo
					        	</a>
					        </li>
	      				</ul>
	    			</div>
	  			</div>
			</nav>
		<?php endif; ?>
		<?php if($this_->getData("Title") != "Login"): ?>
			<div id="content" class="col-md-10 col-md-offset-2 col-sm-9 col-sm-offset-3 col-xs-12">
		<?php else: ?>
			<div id="content">
		<?php endif; ?>
				<?= $this_->fetchAll() ?>
			</div>
	</body>
</html>