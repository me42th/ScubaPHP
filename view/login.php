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
    <form action="/?page=login&from=login" method="POST">

        <?php if (isset($data['login-msg-success'])) : ?>
            <div class="mensagem-sucesso">
                <p><?= $data['login-msg-success']; ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($data['login-msg-error'])) : ?>
            <div class="mensagem-erro">
                <p><?= $data['login-msg-error']; ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($data['errors']['email-msg-nao-validado'])): ?>
        <div class="mensagem-erro">
                <p><?= $data['errors']['email-msg-nao-validado']; ?></p>
            </div>
        <?php endif; ?>

        <label for="login">Email</label>
        <input type="text" name="person[email]" value="<?= (isset($_POST['person']['email'])) ? $_POST['person']['email'] : ''; ?>" required>

        <?php if (isset($data['errors']['email-msg-erro'])): ?>
        <span class="mensagem-erro"><?= $data['errors']['email-msg-erro']; ?></span>
        <?php endif; ?>
        
        <label for="password">Senha</label>
        <input type="password" name="person[password]" value="<?= (isset($_POST['person']['password'])) ? $_POST['person']['password'] : ''; ?>" required>
        
        <?php if (isset($data['errors']['password-msg-erro'])): ?>
        <span class="mensagem-erro"><?= $data['errors']['password-msg-erro']; ?></span>
        <?php endif; ?>
        
        <button>Entrar</button>
        <a href="./?page=register">Cadastrar Usuário</a>
        <a href="./?page=forget-password">Esqueci Minha Senha</a>
    </form>
</body>

</html>