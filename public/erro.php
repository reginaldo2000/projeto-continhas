<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oops</title>
    <link rel="stylesheet" href="<?= url("/_assets/bootstrap-5.2.2-dist/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= url("/_assets/css/style.css"); ?>">
</head>

<body>
    <div class="erro">
        
        <h1>Oops!!!</h1>

        <h4><?= $titulo; ?></h4>

        <h5><?= $mensagem; ?></h5>

        <div class="mt-3">
            <a href="<?= url("/contas"); ?>" class="btn btn-success">Voltar</a>
        </div>

    </div>
</body>

</html>