<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace Common\Command;

use ClickHouseDB;
use Exception;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Context\ApplicationContext;
use Hyperf\DbConnection\Db;
use Hyperf\Kafka\Producer;
use Hyperf\Redis\Redis;
use InvalidArgumentException;
use MongoDB\Client;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPTimeoutException;
use Throwable;

#[Command]
class TestConnections extends HyperfCommand
{
    /**
     * The command.
     */
    protected ?string $name = 'checkConnection';

    public function handle(): void
    {
        $this->line('Проверка сервисов', 'info');
        $this->TestPostgresql();
        $this->TestClickHouse();
        $this->TestMongoDB();
        $this->TestRedis();
        $this->TestKafka();
        $this->TestRabbitMQ();
    }

    public function TestMongoDB(): void
    {
        $uri = 'mongodb://' . env('MONGODB_USER') . ':' . env('MONGODB_PASSWORD') . '@' . env('MONGODB_HOST') . ':' . env('MONGODB_PORT') . '/';
        $client = new Client($uri);
        try {
            $client->selectDatabase('admin')->command(['ping' => 1]);

            $this->line('connection to mongodb - ok!', 'info');
        } catch (Exception $e) {
            $this->line('connection to mongodb - error:' . $e->getMessage(), 'error');
        }
    }

    public function TestRedis(): void
    {
        try {
            $container = ApplicationContext::getContainer();

            /** @var Redis $redisInstance */
            $redisInstance = $container->get(Redis::class);

            /** @var Redis $redis */
            $redis = $redisInstance->get('default');

            $redis->set('test', 'value');

            $this->line('connection to redis - ok!', 'info');
        } catch (Exception $e) {
            $this->line('connection to redis - error:' . $e->getMessage(), 'error');
        }
    }

    public function TestKafka(): void
    {
        try {
            $container = ApplicationContext::getContainer();

            /** @var Producer $producer */
            $producer = $container->get(Producer::class);

            $v = rand(100, 999) . 'k';

            $producer->send('test', $v, 'key');

            $this->line('connection to kafka - ok!', 'info');
        } catch (Exception $e) {
            $this->line('connection to kafka - error:' . $e->getMessage(), 'error');
        }
    }

    public function TestRabbitMQ(): void
    {
        try {
            $rabbitHost = getenv('RABBITMQ_HOST');

            if ($rabbitHost === false || ! is_string($rabbitHost)) {
                throw new InvalidArgumentException('Environment variable RABBITMQ_HOST must be set and be a string.');
            }

            $rabbitPort = (int) getenv('RABBITMQ_PORT');

            $rabbitUser = getenv('RABBITMQ_USER');

            if ($rabbitUser === false || ! is_string($rabbitUser)) {
                throw new InvalidArgumentException('Environment variable RABBITMQ_USER must be set and be a string.');
            }

            $rabbitPassword = getenv('RABBITMQ_PASSWORD');

            if ($rabbitPassword === false || ! is_string($rabbitPassword)) {
                throw new InvalidArgumentException('Environment variable RABBITMQ_PASSWORD must be set and be a string.');
            }

            $connection = new AMQPStreamConnection(
                $rabbitHost,
                $rabbitPort,
                $rabbitUser,
                $rabbitPassword
            );
            $channel = $connection->channel();
            $channel->close();
            $connection->close();
            $this->line('connection to rabbitmq - ok!', 'info');
        } catch (AMQPTimeoutException $e) {
            $this->line('connection to rabbitmq - error:' . $e->getMessage(), 'error');
        }
    }

    private function TestPostgresql(): void
    {
        try {
            Db::select('SELECT 1');

            $this->line('connection to postgresql - ok!', 'info');
        } catch (Throwable $e) {
            $this->line('connection to postgresql - error:' . $e->getMessage(), 'error');
        }
    }

    private function TestClickHouse(): void
    {
        try {
            $config = [
                'host' => env('CLICKHOUSE_HOST'),
                'port' => env('CLICKHOUSE_PORT'),
                'username' => env('CLICKHOUSE_USER'),
                'password' => env('CLICKHOUSE_PASSWORD'),
                'https' => env('CLICKHOUSE_HTTPS'),
            ];

            $db = new ClickHouseDB\Client($config);
            $db->database('default');
            $db->setTimeout(1.5);
            $db->setTimeout(10);
            $db->setConnectTimeOut(5);
            $db->ping(true);

            $this->line('connection to ClickHouseDB - ok!', 'info');
        } catch (Throwable $e) {
            $this->line('connection to ClickHouseDB - error:' . $e->getMessage(), 'error');
        }
    }
}
