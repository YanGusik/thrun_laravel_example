<?php

namespace App\Handlers;

use App\Messages\OrderCreateMessage;
use App\Messages\SendEmailMessage;
use Thrun\Laravel\Rpc\RpcPublisher;
use Thrun\Worker\Acknowledger;

class OrderCreateHandler
{
    public function __construct(public RpcPublisher $rpcPublisher)
    {
    }

    public function __invoke(OrderCreateMessage $message, Acknowledger $acknowledger)
    {
        echo "[Order dispatch event] $message->orderId\n";
        $this->rpcPublisher->emit('order.create', ['id' => $message->orderId]);
        $acknowledger->ack();
    }
}
