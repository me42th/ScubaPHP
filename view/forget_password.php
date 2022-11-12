<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./resource/style.css">
    <title>Registre</title>
</head>
<body>
    <a href="./"><h1>Scuba<span>PHP</span></h1></a>
    <form action="./?page=forget-password&from=forget-password" method="post">
        <p>Alterar Senha</p>

        <?php if (isset($data['success']['msg-success'])): ?>
            <div class="mensagem-sucesso">
                <p><?= $data['success']['msg-success']; ?></p>
            </div>
        <?php else: ?>
            <label for="email">E-mail</label>
            <input type="email" required name="person[email]" value="<?= (isset($_POST['person']['email'])) ? $_POST['person']['email'] : ''; ?>">

            <?php if (isset($data['errors']['msg-error'])): ?>
            <span class="mensagem-erro"><?= $data['errors']['msg-error']; ?></span>
            <?php endif; ?>
            
            <input type="submit" value="Solicitar">
        <?php endif; ?>

    </form>
</body>
</html>
