<div class="container-fluid">
    <form id="form-send-file" method="POST" action="/AverbePorto/sendFile" enctype="multipart/form-data" class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-12">
        <div class="form-group">
            <input type="file" name="file" class="file" required>
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
            <button class="form-control btn btn-success input-lg">
                Enviar <i class="fa fa-upload" aria-hidden="true"></i>
            </button>
        </div>
    </form>
</div>