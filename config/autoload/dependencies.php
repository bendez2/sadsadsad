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

use Adapters\CbrAdapter;
use Adapters\DaDataAdapter;
use Adapters\Interfaces\CbrAdapterInterface;
use Adapters\Interfaces\DaDataAdapterInterface;
use Adapters\Interfaces\MongoDBAdapterInterface;
use Adapters\MongoDBAdapter;
use Application\Repositories\BankRepository;
use Application\Repositories\OrganizationRepository;
use Domain\BankRepositoryInterface;
use Domain\OrganizationRepositoryInterface;

return [
    MongoDBAdapterInterface::class => MongoDBAdapter::class,
    DaDataAdapterInterface::class => DaDataAdapter::class,
    OrganizationRepositoryInterface::class => OrganizationRepository::class,
    BankRepositoryInterface::class => BankRepository::class,
    CbrAdapterInterface::class => CbrAdapter::class,
];
