<?php

namespace Application\UseCase;

use Adapters\Interfaces\DaDataAdapterInterface;
use Hyperf\Di\Annotation\Inject;

class GetAddress
{
    #[Inject]
    private DaDataAdapterInterface $daDataAdapter;

    public function execute(string $address): mixed
    {
       return $this->daDataAdapter->dadataClient->suggest("address", $address,20);
    }
}