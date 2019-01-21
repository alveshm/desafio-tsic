# desafio-tsic

Para rodar o projeto basta clonar para a pasta do seu servidor e seguir as etapas a seguir:

1 - Editar o arquivo .env e colocar o acessos do seu banco de dados
2 - Rodar o comando CREATE DATABASE desafio_tsic;
3 - composer install -- Instalar o composer
4 - php artisan key:generate  -- Gerar as chaves do Laravel
5 - php artisan cache:clear -- Limpar o cache
6 - php artisan migrate -- Rodar o migrate para subir as tabelas
