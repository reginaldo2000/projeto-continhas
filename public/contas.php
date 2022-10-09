<?php

use Source\Enum\CategoriaEnum;

$this->layout("layout"); ?>

<?php include __DIR__ . "/_includes/modal-nova-conta.php"; ?>
<?php include __DIR__ . "/_includes/modal-excluir-conta.php"; ?>

<h3 class="titulo">Contas</h3>
<hr>

<?= showMessage(); ?>

<a class="btn btn-success" onclick="prepareNova();">Novo cadastro</a>

<div class="card mt-3">
    <div class="card-header">Todas as Contas</div>
    <div class="card-body">

        <form action="" method="get">
            <div class="row">
                <div class="col-lg-4 d-flex align-items-center">
                    <label for="">Categoria:</label>
                    <select name="categoria" class="form-control">
                        <option value="">TODAS</option>
                        <?php foreach (CategoriaEnum::list() as $cat) : ?>
                            <option value="<?= $cat; ?>" <?= ($cat == $categoriaSelecionada ? "selected" : "") ?>><?= $cat; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-success ml-3">Pesquisar</button>
                </div>
            </div>
        </form>

        <div class="table-responsive mt-3">
            <table class="table table-striped table-bordered" pagination="true" rows="5" max-rows="<?= count($contas); ?>" target="#tableContas">
                <thead>
                    <tr>
                        <th class="text-center">Descrição</th>
                        <th class="text-center">Categoria</th>
                        <th class="text-center">Valor</th>
                        <th class="text-center">Data</th>
                        <th class="text-center" colspan="2" style="width: 14%;">Ações</th>
                    </tr>
                </thead>
                <tbody id="tableContas">
                    <?php foreach ($contas as $c) : ?>
                        <tr class="align-middle">
                            <td><?= $c->getDescricao(); ?></td>
                            <td><?= $c->getCategoria(); ?></td>
                            <td><?= "R$ " . number_format($c->getValor(), 2, ",", "."); ?></td>
                            <td><?= $c->getData()->format("d/m/Y"); ?></td>
                            <td class="text-center">
                                <a onclick="prepareEdicao(<?= $c->getId(); ?>);" class="btn btn-primary btn-sm">Editar</a>
                            </td>
                            <td class="text-center">
                                <a onclick="prepareDelete(<?= $c->getId(); ?>);" class="btn btn-danger btn-sm">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <nav aria-label="Page navigation example" style="width: 100%;display:flex;justify-content: center;">
            <ul class="pagination"></ul>
        </nav>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">Contas por Categoria</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <?php foreach ($contasCategoria as $contaCat) : ?>
                        <tr class="align-middle">
                            <td style="width:20%;" rowspan="<?= $contaCat->tamanho; ?>"><b><?= $contaCat->nome; ?></b></td>
                            <td class="text-center" rowspan="<?= $contaCat->tamanho; ?>"><b><?= "R$ " . number_format($contaCat->totalCategoria, 2, ",", "."); ?></b></td>
                        </tr>

                        <?php foreach ($contaCat->dados as $dado) : ?>
                            <tr>
                                <td class="text-center"><?= $dado->getDescricao(); ?></td>
                                <td class="text-center"><?= "R$ " . number_format($dado->getValor(), 2, ",", "."); ?></td>
                                <td class="text-center"><?= $dado->getData()->format("d/m/Y"); ?></td>
                            </tr>
                        <?php endforeach; ?>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>


        <div class="card card-footer">
            <strong>Valor total das contas (<?= traduzMes(date("M")); ?>): <span class="text-danger"><?= "R$ " . number_format($contaCat->valorTotal, 2, ",", "."); ?></span></strong>
        </div>
    </div>
</div>