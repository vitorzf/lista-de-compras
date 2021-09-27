<h3 align="center">API Lista de Compras</h3>

## 🏁 Para Começar <a name = "para-comecar"></a>

Antes de iniciar, precisamos executar algumas configurações do CodeIgniter para funcionar localmente.

### Altere os seguintes arquivos no caminho `application/config/`

#### config.php
```[26] $config['base_url'] = 'http://localhost/lista_de_compras/';```
Altere para a url definida para o seu projeto

#### database.php
```
$db['default'] = array(
		'dsn'	=> '',
		'hostname' => 'localhost',
		'username' => 'root',
		'password' => '',
		'database' => 'mercado',
		'dbdriver' => 'mysqli',
		'dbprefix' => '',
		'pconnect' => FALSE,
		'db_debug' => (ENVIRONMENT !== 'production'),
		'cache_on' => FALSE,
		'cachedir' => '',
		'char_set' => 'utf8',
		'dbcollat' => 'utf8_general_ci',
		'swap_pre' => '',
		'encrypt' => FALSE,
		'compress' => FALSE,
		'stricton' => FALSE,
		'failover' => array(),
		'save_queries' => TRUE
);
```
Alterar o hostname, username e database com os dados necessários para conexão com seu banco local<br>
O arquivo sql está no caminho `database/banco.sql`

<h3 align="center">ENDPOINTS</h3>

#### Substitua o termo {{URL}} pela url definida acima
``` 
http://localhost/mercado/api
```

#### Header das requisições
	Content-Type: application/json

----
### Adicionar item á Lista
![](https://img.shields.io/badge/POST-%7B%7BURL%7D%7D%2Fitens-brightgreen)

#### Body
```
{
 "nome": "KIT Teclado + Mouse Logitech Mk345",
 "valor": 250.00
}
```
#### Resposta Esperada
<h4>200 - OK</h4>

```
{
  "id": "1",
  "nome": "KIT Teclado + Mouse Logitech Mk345",
  "valor": "250.00"
}
```

----
### Listar Itens
![](https://img.shields.io/badge/GET-%7B%7BURL%7D%7D%2Fitens-blue)

#### Body
```
Não enviar
```
#### Resposta Esperada
<h4>200 - OK</h4>

```
{
  "itens": [
    "KIT Teclado + Mouse Logitech Mk345",
  ],
  "total_value": 250
}
```

----
### Listar Item específico
![](https://img.shields.io/badge/GET-%7B%7BURL%7D%7D%2Fitens%2F%7B%7Bid%7D%7D-blue)

#### Body
```
Não enviar
```
#### Resposta Esperada
<h4>200 - OK</h4>

```
{
  "id": "1",
  "nome": "KIT Teclado + Mouse Logitech Mk345",
  "valor": "250.00"
}
```

----
### Editar Item
![](https://img.shields.io/badge/PUT-%7B%7BURL%7D%7D%2Fitens%2F%7B%7Bid%7D%7D-orange)

#### Body
```
{
 "nome": "KIT Teclado + Mouse Sem Fio Logitech Mk345",
 "valor": 190.00
} 
```
#### Resposta Esperada
<h4>200 - OK</h4>

```
{
  "id": "1",
  "nome": "KIT Teclado + Mouse Sem Fio Logitech Mk345",
  "valor": "190.00"
}
```

----
### Excluir Item
![](https://img.shields.io/badge/DELETE-%7B%7BURL%7D%7D%2Fitens%2F%7B%7Bid%7D%7D-red)

#### Body
```
Não enviar
```
#### Resposta Esperada
<h4>200 - OK</h4>

```
No Response
```
