<?php

require __DIR__ . '/vendor/autoload.php';

use Roman\Fsm\ClosureTransition as CT;
use Roman\Fsm\Contracts\Stateful;
use Roman\Fsm\FSM;
use Roman\Fsm\Graph;
use Roman\Fsm\Order;

$graph = new Graph([
    'new' => [],
    'canceled' => [
        'new' => new CT(function (Stateful $order) {

            // Просто отменяем
            $order->setState('canceled');
        }),
        'processing' => new CT(function (Stateful $order) {
            echo " // Уведомить кладовщика, что нужно прекратить сборку этого заказа\n";
            $order->setState('canceled');
        }),
    ],
    'confirmed' => [
        'new' => new CT(function (Stateful $order) {
            echo "// Уведомить кладовщика, что поступил новый заказ\n";
            $order->setState('confirmed');
        }),
    ],
    'rejected' => [
        'new' => new CT(function (Stateful $order) {
            // TODO: Context
            // Причина отказа
            $order->setState('rejected');
        }),
    ],
    'processing' => [
        'confirmed' => new CT(function (Stateful $order) {
            $order->setState('processing');
        }),
    ],
    'shipping' => [
        'processing' => new CT(function (Stateful $order) {
            echo " // Уведомить кладовщика, что нужно прекратить сборку этого заказа\n";
            $order->setState('shipping');
        })
    ],
    'completed' => [
        'shipping' => new CT(function (Stateful $order) {
            // dasda
            $order->setState('completed');
        })
    ]
]);

$fsm = new FSM($graph);

$object = new Order();


$object->setState('processing');

$state = 'shipping';

try {
    $fsm->transit(object: $object, state: $state);

} catch (Exception $e) {
    echo $e->getMessage();
}









