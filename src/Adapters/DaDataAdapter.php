<?php

namespace Adapters;

use Adapters\Interfaces\DaDataAdapterInterface;
use Dadata\DadataClient;

class DaDataAdapter implements DaDataAdapterInterface
{
   public DadataClient $dadataClient;
    public function __construct()
    {
        $this->dadataClient = new DadataClient(env('DADATA_APIKEY'), null);
    }
}