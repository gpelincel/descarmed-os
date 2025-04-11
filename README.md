# Descarmed OS

**Descarmed OS** é um sistema web para gerenciamento de ordens de serviço, desenvolvido com o framework Laravel.
Ele permite o controle eficiente de solicitações de serviços, facilitando o acompanhamento e a organização das tarefas.

## Funcionalidades

- Cadastro e gerenciamento de ordens de serviço
- Acompanhamento do status das ordens
- Interface amigável para usuários
- Controle de usuários e permissões

## Tecnologias Utilizadas

- [Laravel](https://laravel.com/) - Framework PHP
- [Tailwind CSS](https://tailwindcss.com/) - Framework CSS
- [Flowbite](https://flowbite.com) - Framework UI
- [Vite](https://vitejs.dev/) - Ferramenta de build
- [MySQL](https://www.mysql.com/) - Banco de dados

## Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/gpelincel/descarmed-os.git
   cd descarmed-os
   ```

2. Instale as dependências PHP:
   ```bash
   composer install
   ```

3. Copie o arquivo de exemplo de ambiente e configure as variáveis:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure o banco de dados no arquivo `.env`.

5. Execute as migrações:
   ```bash
   php artisan migrate
   ```

6. Instale as dependências JavaScript:
   ```bash
   npm install
   ```

7. Compile os assets:
   ```bash
   npm run dev
   ```

8. Inicie o servidor de desenvolvimento:
   ```bash
   php artisan serve
   ```

## Licença

Este projeto está licenciado sob a licença MIT.

---

Para mais detalhes, acesse o repositório oficial: [gpelincel/descarmed-os](https://github.com/gpelincel/descarmed-os)
