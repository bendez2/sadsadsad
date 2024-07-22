<?php

namespace Ports\Controller;

use Adapters\CbrAdapter;
use Application\UseCase\Organizations\GetOrganizationByInn;
use Common\Constants\MessageKeys;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class OrganizationController extends AbstractController
{
    public function getByInn(RequestInterface $request, ResponseInterface $response): \Psr\Http\Message\ResponseInterface
    {
        try {
            $inn = $request->route('inn');

            $result = (new GetOrganizationByInn())->execute($inn);

            return $response->json([MessageKeys::MESSAGE_KEY_SUCCESS => $result])->withStatus(200);
        } catch (\Exception $exception) {
            return $response->json([MessageKeys::MESSAGE_KEY_ERROR => $exception->getMessage()])->withStatus($exception->getCode());
        }
    }
}