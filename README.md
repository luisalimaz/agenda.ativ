
# CrudNovo

Este projeto implementa um sistema básico de CRUD (Criar, Ler, Atualizar, Excluir) com funcionalidades específicas para gerenciamento de agendamentos e usuários.

## Estrutura do Projeto

- **agenda.php**: Gerencia funcionalidades relacionadas a agendamentos.
- **agenda.txt**: Arquivo de texto auxiliar que pode conter informações ou logs.
- **cadastrar.php**: Script para cadastro de novos usuários ou itens.
- **img/**: Diretório destinado ao armazenamento de imagens utilizadas no projeto.
- **index.php**: Página principal do sistema, provavelmente o ponto de entrada.
- **logout.php**: Gerencia o encerramento de sessões de usuários.
- **usuarios.json**: Armazena informações sobre os usuários do sistema em formato JSON.

## Requisitos

- **PHP**: Para executar os scripts no servidor.
- **Servidor Web**: Como Apache ou Nginx.
- **Permissões de Arquivo**: Certifique-se de que os arquivos possam ser acessados e modificados pelo servidor.

## Configuração

1. Faça o download ou clone do repositório.
2. Extraia os arquivos em um servidor com suporte a PHP.
3. Acesse o arquivo `index.php` através do navegador para iniciar o sistema.

## Funcionalidades

- **Gerenciamento de Usuários**: Cadastro, autenticação e logout de usuários.
- **Gerenciamento de Agendamentos**: Criação e visualização de agendamentos.
- **Interface Gráfica**: Diretório `img` para suporte visual.

## Observações

- O sistema utiliza um arquivo JSON (`usuarios.json`) para armazenar informações sobre usuários.
- Certifique-se de configurar as permissões adequadas para leitura e escrita no servidor.

## Melhorias Futuras

- Integração com um banco de dados para maior robustez.
- Implementação de autenticação mais avançada.
- Adição de testes automatizados.

---
Desenvolvido com o propósito de demonstrar funcionalidades básicas de um CRUD em PHP.
