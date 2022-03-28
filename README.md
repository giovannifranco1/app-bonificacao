# App Bonificação

## Configuração do projeto
```
composer install
```
Depois rode
```
composer update
```
### Configuração de Ambiente
```
cp .env.example .env
```

### Inicialização


Inicie o mysql e depois rode
```
php artisan migrate --seed
```

# App Bonificacao

### Tecnologias

- Backend: Laravel, Php 8
- Frontend: Laravel - Blade 

### Como executar

- Requisitos:
  - Php8
  - Mysql
  - Composer

Clone o projeto em seu dispositivo, Abra o terminal e execute `php artisan serve`,
a aplicação irá rodar no endereço: `http://localhost:8000`
