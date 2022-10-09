<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contas - Reginaldo</title>
    <link rel="stylesheet" href="<?= url("/_assets/bootstrap-5.2.2-dist/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= url("/_assets/css/style.css"); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= url("/_assets/icon/favicon.ico"); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= url("/_assets/icon/money-icone.png"); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= url("/_assets/icon/money-icone.png"); ?>">
</head>

<body style="background-color: #e9e9e9;">
    <div class="container-fluid">
        <section class="app">
            <?= $this->section("content"); ?>
        </section>
    </div>

    <script src="<?= url("/_assets/js/jquery.js"); ?>"></script>
    <script src="<?= url("/_assets/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js"); ?>"></script>
    <script src="<?= url("/_assets/js/table-pagination.js"); ?>"></script>
    <script src="<?= url("/_assets/js/funcoes.js"); ?>"></script>
</body>

</html>