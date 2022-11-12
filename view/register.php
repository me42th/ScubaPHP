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
    <a href="./?page=login"><h1>Scuba<span>PHP</span></h1></a>
    <form action="/?page=register&from=register" method="POST">
        <p>Cadastre Um Novo Usuário</p>
        <!--<div class="mensagem-sucesso">
            <p>Mensagem de Sucesso</p>
        </div>-->
        <label for="nome">Nome</label>
        <input type="text" name="person[name]" value="<?= (isset($_POST['person']['name'])) ? $_POST['person']['name'] : ''; ?>" required>

        <?php if (isset($data['name-msg-erro'])): ?>
        <span class="mensagem-erro"><?= $data['name-msg-erro']; ?></span>
        <?php endif; ?>

        <label for="email">E-mail</label>
        <input type="email" name="person[email]" value="<?= (isset($_POST['person']['email'])) ? $_POST['person']['email'] : ''; ?>" required>

        <?php if (isset($data['email-msg-erro'])): ?>
        <span class="mensagem-erro"><?= $data['email-msg-erro']; ?></span>
        <?php endif; ?>

        <label for="senha">Senha</label>
        <input type="password" name="person[password]" value="<?= (isset($_POST['person']['password'])) ? $_POST['person']['password'] : ''; ?>" required>

        <?php if (isset($data['password-lenght-msg-erro'])): ?>
        <span class="mensagem-erro"><?= $data['password-lenght-msg-erro']; ?></span>
        <?php endif; ?>
        
        <label for="repita-senha">Repita Senha</label>
        <input type="password" name="person[password-confirm]" value="<?= (isset($_POST['person']['password-confirm'])) ? $_POST['person']['password-confirm'] : ''; ?>" required>

        <?php if (isset($data['password-confirm-msg-erro'])): ?>
        <span class="mensagem-erro"><?= $data['password-confirm-msg-erro']; ?></span>
        <?php endif; ?>

        <input type="submit" value="Salvar">

    </form>
</body>
</html>