<?php

namespace Ports\Controller;

use Application\UseCase\Banks\GetBankByBic;
use Application\UseCase\Banks\UploadAllBanks;
use Common\Constants\MessageKeys;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class BankController extends AbstractController
{
    public function getByBic(RequestInterface $request, ResponseInterface $response): \Psr\Http\Message\ResponseInterface
    {
        try {
            $bic = $request->route('bic');

            $result = (new GetBankByBic())->execute($bic);

            return $response->json([MessageKeys::MESSAGE_KEY_SUCCESS => $result])->withStatus(200);
        } catch (\Exception $exception) {
            return $response->json([MessageKeys::MESSAGE_KEY_ERROR => $exception->getMessage()])->withStatus($exception->getCode());
        }
    }

    public function uploadAll(RequestInterface $request, ResponseInterface $response): \Psr\Http\Message\ResponseInterface
    {
        try {
            $result = (new UploadAllBanks())->execute();

            return $response->json([MessageKeys::MESSAGE_KEY_SUCCESS => $result])->withStatus(200);
        } catch (\Exception $exception) {
            return $response->json([MessageKeys::MESSAGE_KEY_ERROR => $exception->getMessage()])->withStatus($exception->getCode());
        }
    }
}