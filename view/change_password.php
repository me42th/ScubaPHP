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
    <a href="./">
        <h1>Scuba<span>PHP</span></h1>
    </a>
    <form action="./?page=change-password&from=change-password" method="post">

        <?php if (isset($data['success']['success-msg'])) : ?>
            <div class="mensagem-sucesso">
                <p><?= $data['success']['success-msg']; ?></p>
            </div>
        <?php endif; ?>

        <p>Alterar Senha</p>
        <label for="senha">Senha</label>
        <input type="password" name="person[password]">

        <?php if (isset($data['errors']['password-lenght-msg-erro'])) : ?>
            <span class="mensagem-erro"><?= $data['errors']['password-lenght-msg-erro']; ?></span>
        <?php endif; ?>

        <label for="repita-senha">Repita Senha</label>
        <input type="password" name="person[password-confirm]">

        <?php if (isset($data['errors']['password-confirm-msg-erro'])) : ?>
            <span class="mensagem-erro"><?= $data['errors']['password-confirm-msg-erro']; ?></span>
        <?php endif; ?>

        <input type="hidden" id="token" name="token" value="<?= (isset($data['token'])) ? $data['token'] : ''; ?>">
        <input type="submit" value="Salvar">
    </form>
</body>

</html>