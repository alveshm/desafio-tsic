# desafio-tsic

Desafio realizado com a linguagem de progração PHP, utilizando a framework Laravel na versão 5.7, bootstrap para os componentes e o gulp como task runner.


Para rodar o projeto basta clonar para a pasta do seu servidor e seguir as etapas a seguir:

1 - Editar o arquivo .env.example e renomear para .env, alterar os acessos do seu banco de dados <pre>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desafio_tsic
DB_USERNAME=root
DB_PASSWORD=</pre>


2 - No MySql rodar o comando <pre>CREATE DATABASE desafio_tsic;</pre>

3 - Instalar o composer <pre>composer install</pre> 

4 - Gerar as chaves do Laravel <pre>php artisan key:generate</pre>

5 - Limpar o cache <pre>php artisan cache:clear</pre> 

6 - Rodar o migrate para subir as tabelas <pre>php artisan migrate</pre>

7 - Criar os seeds para testes <pre>php artisan db:seed</pre>

8 - Rodar o comando <pre>php artisan serve</pre>

9 - Criar a trigger para alimentar o campo de quantidade de vendas, executando o seguinte comando no banco de dados: <pre> USE `desafio_tsic`;

DELIMITER $$
USE `desafio_tsic`$$
CREATE
DEFINER=`root`@`localhost`
TRIGGER `desafio_tsic`.`atualiza_total_vendas`
AFTER INSERT ON `desafio_tsic`.`items`
FOR EACH ROW
BEGIN
    UPDATE documentos
       SET docu_tota = docu_tota + 1
	 WHERE documentos.id = NEW.item_docu;
END$$


DELIMITER ; </pre>
