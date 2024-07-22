<?php

namespace Adapters\Consumers;

use Hyperf\Amqp\Result;
use Hyperf\AsyncQueue\Process\ConsumerProcess;
use Hyperf\Process\Annotation\Process;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Container\ContainerInterface;

//#[Process(name: "async-queue")]
class AsyncQueueConsumer extends ConsumerProcess
{
}