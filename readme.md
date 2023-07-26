## Teste GSUAS

### Cenário:
O NIS (Número de Identificação Social) é um identificador único atribuído pela Caixa
Econômica Federal aos cidadãos. Composto por 11 dígitos, é utilizado para realizar o
pagamento de benefícios sociais, assim como chave de identificação nas Políticas
Públicas, emissão de documentos, dentre outras utilidades.

### Desafio:
Crie uma aplicação contendo um formulário para cadastrar cidadãos. O formulário deve
conter um único campo para informar o nome do cidadão. Ao ser cadastrado, um
número NIS deve ser gerado automaticamente, atribuído a esta pessoa e então exibido
na tela junto de uma mensagem de sucesso. Deve ser possível também pesquisar os
registros já existentes através do número NIS. Caso o NIS informado já esteja
cadastrado, a aplicação deve exibir o nome do cidadão e seu numero NIS. Caso não
esteja, deve exibir “Cidadão não encontrado”. Lembre-se de criar um README
contendo as instruções necessárias para executarmos a aplicação.

### Composer
Rode o composer install

### Docker 
Para rodar a aplicação </br>
<code>docker-compose up -d</code>

### Banco de dados

Para identificar o container do banco de dados use </br> 
<code>docker ps</code>

Verifique o ID do container do MySQL e entre: </br>
<code>docker exec -it <id do container> bash</code>

Entre no MySQL</br>
<code>mysql -u root -p</code></br>
O password é o 123.

<code>use database</code>

Para criar a tabela necessária para esta aplicação:</br>
<code>create table persons (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50), nis VARCHAR(11));
</code>

### Para rodar os testes</br>
<code>./vendor/bin/pest</code>


Paulo Sanda
Backend Engineer



