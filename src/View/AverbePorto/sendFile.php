<div class="container-fluid">
    <form method="POST" action="/AverbePorto/sendFile" enctype="multipart/form-data" class="col-md-4 col-md-offset-4" style="margin-top: 50px;">
        <div class="form-group">
            <input type="file" name="file" class="file">
            <div class="input-group col-xs-12">
                <span class="input-group-addon">
                    <i class="fa fa-file-o" aria-hidden="true"></i>
                </span>
                <input type="text" class="form-control" disabled placeholder="Selecione um arquivo">
                <span class="input-group-btn">
                    <button class="browse btn btn-primary" type="button">
                        <i class="fa fa-folder-open-o" aria-hidden="true"></i> Buscar
                    </button>
                </span>
            </div>
        </div>
        <div class="form-group">
            <button class="form-control btn btn-success">Enviar</button>
        </div>
    </form>
</div>