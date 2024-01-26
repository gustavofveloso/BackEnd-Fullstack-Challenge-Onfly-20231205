# Fullstack Challenge - Onfly 20231205

Projeto: Backend: Gestão de Despesas

Descrição: API do projeto Gestão de Despesas, teste prático do processo seletivo da Onfly.

## Tecnologias e Frameworks
    - Laravel
    - Sail
    - MySQL
    - Mailpit
    - Horizon
    - Swagger

## Instruções de Utilização

Realize o clone do repositório.
Para começar, é necessário ter o serviço do Docker rodando na máquina.
Após startar o docker, crie o arquivo .env com as informações contidas em .env.example.
Em seguida, execute o comando:
```
./vendor/bin/sail up -d
```
Por padrão, os comandos Sail são invocados usando o script "./vendor/bin/sail" que está incluso nas aplicações laravel. Porém, podemos adicionar o seguinte apelido conforme o código abaixo a fim de tornar esta tarefa menos repetitiva, contudo, seguiremos neste passo a passo utilizando o comando default.
```
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```
Feito isso, o projeto estará rodando perfeitamente.

Para rodarmos os testes, iremos executar o comando:
```
./vendor/bin/sail test
```

Para checarmos o horizon, a url é: [http://localhost/horizon].
Para conferirmos o swagger, [http://localhost/api/documentation]
Para acessarmos o mailpit, [http://localhost:8025]

## Diário de Bordo

- Inserção da extensão .log no '.gitignore'.
- Inserção do arquivo .phpunit.result.cache no '.gitignore'.
- Inserção do caminho Src/Core no autoload dentro do composer.json

Após inicializar o projeto, comecei pela construção das entidades a fim de implementar as regras de negócio do sistema de maneira desacoplada do framework.

Criado o primeiro teste unitário para a entidade "Expense", e para classe correspondente, inseri os métodos mágicos dentro de uma trait pensando em possíveis reaproveitamentos no futuro.

Na trait, optei por estourar uma exception personalizada a fim de obter mais controle sobre os processos.

Criação da camada de repository.

- Finalizada a construção das entidades, iniciei a construção dos casos de uso.

Resolvi dar uma pausa na construção dos testes e focar na implementação das funcionalidades para poder garantir a entrega.

>  This is a challenge by [Coodesh](https://coodesh.com/)