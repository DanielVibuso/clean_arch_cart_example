<?php
namespace LittleCommerce;
require_once dirname(__DIR__, 1) . '/vendor/autoload.php';

use LittleCommerce\Application\UseCases\Cart\CreateCart\CreateCartUseCase;
use LittleCommerce\Application\UseCases\Cart\CreateCart\DTO\CreateCartInputDTO;
use LittleCommerce\Application\UseCases\Item\CreateItem\CreateItemUseCase;
use LittleCommerce\Application\UseCases\Item\CreateItem\DTO\CreateItemInputDTO;
use LittleCommerce\Application\UseCases\Payment\ProcessPayment\DTO\CreditCardPaymentDTO;
use LittleCommerce\Application\UseCases\Payment\ProcessPayment\ProcessCreditCardPaymentUseCase;
use LittleCommerce\Application\UseCases\Payment\ProcessPayment\ProcessPixPaymentUseCase;
use LittleCommerce\Domain\Cart\Entity\Cart;
use LittleCommerce\Infrastructure\Repository\Cart\CartEloquentRepository;
use LittleCommerce\Infrastructure\Repository\Item\ItemEloquentRepository;

class Core {

    public  $cartRepository;
    public  $itemRepository;

    public function __construct(
    ){
        $this->cartRepository = new CartEloquentRepository([]);
        $this->itemRepository = new ItemEloquentRepository([]);
    }

    public function run() {
        // Solicitar entrada de itens em formato JSON
        $itemsJson = $this->askForItems();

        // Transformar JSON em array de itens
        $itemsArray = json_decode($itemsJson, true);
        // Criar carrinho
        $cart = $this->createCart($itemsArray);

        // Escolher método de pagamento
        $paymentMethod = $this->choosePaymentMethod();

        if ($paymentMethod === 'credit_card') {
            // Solicitar dados do cartão de crédito
            $creditCardData = $this->askForCreditCardData();

            // Processar pagamento com cartão de crédito
            $this->processCreditCardPayment($cart, $creditCardData);
        } elseif ($paymentMethod === 'pix') {
            // Processar pagamento via PIX
            $this->processPixPayment($cart);
        } else {
            echo "Método de pagamento inválido!";
        }

    }

    private function askForItems(): string
    {
        printf("\nDigite os itens em formato json válido, conforme especificado no read-me\n");

        $items = trim(fgets(STDIN));

        return $items; 
    }

    private function createCart(array $itemsArray): Cart
    {
        foreach($itemsArray as $item){

            $createCartInputDTO = new CreateItemInputDTO(...$item);
            
            (new CreateItemUseCase($createCartInputDTO, $this->itemRepository))->execute();
        }
 
        $createCartInputDTO = new CreateCartInputDTO($this->itemRepository->toArray());
        $createCartUseCase = new CreateCartUseCase($createCartInputDTO, $this->cartRepository);
        return $createCartUseCase->execute($createCartInputDTO);
    }

    private function choosePaymentMethod(): string
    {
        $options = ['pix', 'credit_card'];

        printf("\nDigite a opção desejada: pix, credit_card\n");
            
        $option = trim(fgets(STDIN));

        if (!in_array($option, $options)) {
            echo "\nOpção inválida\n";
            $this->choosePaymentMethod();
        }

        return $option;
    }

    private function askForCreditCardData(): CreditCardPaymentDTO
    {
        printf("\nDigite os dados do cartão e numero de parcelas em formato json válido, conforme especificado no read-me\n");

        $cardData = trim(fgets(STDIN));

        $card = json_decode($cardData, true);

        return new CreditCardPaymentDTO(...$card);
    }

    private function processCreditCardPayment(Cart $cart, CreditCardPaymentDTO $creditCardData): void
    {
        $processCreditCardPaymentUseCase = new ProcessCreditCardPaymentUseCase();
        $result = $processCreditCardPaymentUseCase->execute($cart, $creditCardData);

        echo "\nPagamento com cartão de crédito processado com sucesso!\n";
        echo "\n**Valores finais:\n";
        echo json_encode($result);

    }

    private function processPixPayment(Cart $cart): void
    {
        $processPixPaymentUseCase = new ProcessPixPaymentUseCase();
        $result = $processPixPaymentUseCase->execute($cart);

        echo "\nPagamento via PIX processado com sucesso!\n";
        echo "\n**Valores finais:\n";
        echo json_encode($result);
    }
}

$core = new Core();
$core->run();