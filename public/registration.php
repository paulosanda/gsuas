<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar NIS</title>
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>
<div class="container">
    <h1>Cadastrar NIS</h1>
    <form method="post" action="/cadastrar">
        <table>
            <tr>
                <td>Nome:</td>
                <td><input type="text" maxlength="50" name="name" required></td>
                <td colspan="2"><input class="button" type="submit" value="Cadastrar"></td>
            </tr>
        </table>
    </form>
    <?php
    if (isset($_GET['data'])) {
        $data = json_decode(base64_decode($_GET['data']), true);
        if ($data) {
            $name = $data['name'];
            $code = $data['code'];
            echo "<p>Registro do cidadão realizado com sucesso:</p>";
            echo "<p>Nome: $name</p>";
            echo "<p>NIS: $code</p>";
        }
    }
    ?>
    <p><a href="/"><i class="fas fa-arrow-left"></i> Voltar para a página inicial</a></p>

</div>
</body>
</html>
