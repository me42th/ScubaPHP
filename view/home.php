<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./resource/style.css">
    <title>Login</title>
</head>
<body>
    <h1>Scuba<span>PHP</span></h1>
    <div class="info">
        <div class="imagemPerfil">
            <img src="./resource/elephant.png">
        </div>
        <div class="dados">
            <div class="info-dados">
                <p>Nome do Usuário: <?= $data['user']['name']; ?></p>
                <p>Email do Usuário: <?= $data['user']['email']; ?></p>
            </div>
            <div class="delete">
                <a href="./?page=logout&from=home">
                    <img src="./resource/exit-outline.svg">
                </a>
                <a href="./?page=delete-account&from=home">
                    <img src="./resource/trash-outline.svg">
                </a>
            </div>
        </div>
    </div>

</body>
</html>
