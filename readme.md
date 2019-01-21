# desafio-tsic

Para rodar o projeto basta clonar para a pasta do seu servidor e seguir as etapas a seguir:

1 - Editar o arquivo .env.example e renomear para .env, alterar os acessos do seu banco de dados <pre>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desafio_tsic
DB_USERNAME=root
DB_PASSWORD=</pre>


2 - Rodar o comando <pre>CREATE DATABASE desafio_tsic;</pre>

3 - Instalar o composer <pre>composer install</pre> 

4 - Gerar as chaves do Laravel <pre>php artisan key:generate</pre>

5 - Limpar o cache <pre>php artisan cache:clear</pre> 

6 - Rodar o migrate para subir as tabelas <pre>php artisan migrate</pre>

7 - Criar os seeds para testes <pre>php artisan db:seed</pre>
