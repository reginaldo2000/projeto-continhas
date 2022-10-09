<div class="modal fade" tabindex="-1" id="modal-nova-conta">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nova Conta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formConta" action="<?= url("/conta/cadastrar"); ?>" method="post" autocomplete="off">

                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <label for="">Descrição:</label>
                            <input type="text" name="descricao" class="form-control" required>
                        </div>

                        <div class="col-lg-6">
                            <label for="">Categoria:</label>
                            <select name="categoria" class="form-control">
                                <?php foreach ($categorias as $cat) : ?>
                                    <option value="<?= $cat; ?>"><?= $cat; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label for="">Valor:</label>
                            <input type="text" name="valor" class="form-control" required>
                        </div>

                        <div class="col-lg-6">
                            <label for="">Data:</label>
                            <input type="date" name="data" class="form-control" value="<?= date("Y-m-d"); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btn-conta" class="btn btn-success">Cadastrar</button>
                </div>
            </form>

        </div>
    </div>
</div>