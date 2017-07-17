<div class="container-fluid">
	<div id="presentation-box" class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
		<h3 class="text-capitalize" id="title">
			Bem-Vindo <?= strtolower($this_->getData('User')['name']) ?>
		</h3>
		<div>
			<h4 id="sub-title" class="text-center">Sistema AverbePorto</h4>
			<div class="col-md-10 col-md-offset-1">
				<h4>Envio de arquivo</h4>
				<ol id="presentation-body">
				  <li>Clique em <b>Envio de arquivo</b> no menu lateral.</li>
				  <li>Na página de <b>Envio de arquivo</b>, clique em <b>Buscar</b>.</li>
				  <li>
				  	Selecione o arquivo <abbr title="Documento de dados organizados hierarquicamente">XML</abbr> ou <abbr title="Arquivo comprimido">ZIP</abbr> com os dados necessários.
				  </li>
				  <li>Clique em <b>Enviar</b>.</li>
				</ol>
			</div>
		</div>
	</div>
</div>