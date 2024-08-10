# README

Este pequeno projeto simula um carrinho de compras que permite adicionar itens com seus respectivos dados e quantidades, e em seguida selecionar o meio de pagamento. Atualmente, estão disponíveis dois meios de pagamento: PIX, que implica em um desconto de 10% do valor total do carrinho, e cartão de crédito à vista (1x), que também implica em desconto de 10%, ou parcelado com juros de 1% ao mês.

O foco do projeto está na aplicação das regras de negócio, portanto foi desenvolvido utilizando-se de abordagens da arquitetura limpa (Clean Architecture), com o uso de alguns padrões de projeto como DTOs e Repository para simular uma camada de persistência.

O projeto conta com testes unitários utilizando o PHPUnit.

## Como executar o projeto

Para executar o projeto no modo interativo, siga as instruções abaixo:

1. Certifique-se de ter o Docker e o docker compose instalado em sua máquina.
2. Navegue até a raiz do projeto no terminal.
3. Execute o seguinte comando:

```docker-compose run --rm app```

4. O console solicitará que informe os itens e seus dados. Siga o exemplo abaixo:

5. Exemplo de entrada de itens:
```[{"id":"1", "name":"achocolatado", "price":"10", "count":2}, {"id":"2", "name":"apresuntado", "price":"5", "count":3}]```

6. Após inserir os itens, pressione "Enter". 
7. Em seguida, o console solicitará a forma de pagamento: PIX ou credit_card. Escolha uma das opções e pressione "Enter".
8. Se a opção escolhida for credit_card, será solicitado os dados do cartão, que devem ser enviados. No final, informe a quantidade de parcelas. não deve-se quebrar linha com enter, apenas cole o json de exemplo como está ou modificado com novos valores.

```{"cardholderName":"Fulano Ipsum", "cardNumber":"0000-0000-0000-0000", "expirationDate":"12/25", "cvv":"777", "installments":"1"}```

9. Uma vez finalizado, o projeto exibirá o valor final com base nas regras definidas e concluirá a execução.

## Como executar os testes

Para executar os testes do projeto, execute o seguinte comando:

```docker-compose run --rm test```

Feito isso o projeto rodará os testes e removerá o container para não "poluir" toda vez que rodar novamente.

TODO: put it on an API and make the asaas or other payment service integration.
