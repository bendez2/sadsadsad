<?php

namespace Ports\Controller;

use Application\UseCase\GetAddress;
use Common\Constants\MessageKeys;
use Exception;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class AddressController
{
    public function getAddress(RequestInterface $request, ResponseInterface $response): \Psr\Http\Message\ResponseInterface
    {
        try {
            $address = $request->input('address');

            $result = (new GetAddress())->execute($address);

            return $response->json([MessageKeys::MESSAGE_KEY_SUCCESS => $result])->withStatus(200);
        }
        catch (Exception $ex) {
            return $response->json([MessageKeys::MESSAGE_KEY_ERROR => $ex->getMessage()])->withStatus($ex->getCode());
        }
    }
}