<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar NIS</title>
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="container">
    <h1>Pesquisar NIS</h1>
    <form method="post" action="/pesquisar-nis" class="form-table">
        <table>
            <tr>
                <td>NIS</td>
                <td><input type="text" maxlength="50" name="nis" required></td>
                <td><button type="submit" class="button btn-search"><i class="fas fa-search"></i> Pesquisar</button></td>
            </tr>
        </table>
    </form>
    <?php
    if (isset($_GET['data'])) {
        $data = json_decode(base64_decode($_GET['data']), true);
        if ($data) {
            if (isset($data['not_found']) && $data['not_found']) {
                echo "<p>Cidadão não encontrado</p>";
            } else {
                $name = $data['name'];
                $code = $data['code'];
                echo "<p>Dados do cidadão:</p>";
                echo "<p>Nome: $name</p>";
                echo "<p>NIS: $code</p>";
            }
        }
    }
    ?>
    <p><a href="/" class="link-back"><i class="fas fa-arrow-left"></i> Voltar para a página inicial</a></p>
</div>
</body>
</html>
