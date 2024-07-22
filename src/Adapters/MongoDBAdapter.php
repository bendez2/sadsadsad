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

namespace Adapters;

use Adapters\Interfaces\MongoDBAdapterInterface;
use InvalidArgumentException;
use MongoDB\Client;
use MongoDB\Database;

class MongoDBAdapter implements MongoDBAdapterInterface
{
    public Database $mongodbDatabase;

    private Client $client;

    public function __construct()
    {
        $uri = 'mongodb://' . env('MONGODB_USER') . ':' . env('MONGODB_PASSWORD') . '@' . env('MONGODB_HOST') . ':' . env('MONGODB_PORT') . '/';

        $this->client = new Client($uri);

        $databaseName = getenv('MONGODB_DATABASE');

        if ($databaseName === false || ! is_string($databaseName)) {
            throw new InvalidArgumentException('Environment variable MONGODB_DATABASE must be set and be a string.');
        }

        $this->mongodbDatabase = $this->client->selectDatabase($databaseName);
    }
}
