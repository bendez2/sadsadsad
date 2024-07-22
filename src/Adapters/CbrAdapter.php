<?php

namespace Adapters;

use Adapters\Exceptions\CbrAdaterException;
use Adapters\Interfaces\CbrAdapterInterface;
use Application\DTO\BankDTO;
use Common\Constants\ErrorCode;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Hyperf\Contract\TranslatorInterface;
use Hyperf\Di\Annotation\Inject;
use SimpleXMLElement;

class CbrAdapter implements CbrAdapterInterface
{
    #[Inject]
    private TranslatorInterface $translator;
    private string $uri;

    public function __construct()
    {
        $this->uri = env('OPENDATA_URI');
    }

    /**
     * @param string $bic
     * @return BankDTO
     * @throws CbrAdaterException
     */
    public function getByBic(string $bic): BankDTO
    {
        $soapRequest = '<?xml version="1.0" encoding="utf-8"?>
                            <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                              <soap:Body>
                                <BicToIntCode xmlns="http://web.cbr.ru/">
                                  <BicCode>' . $bic . '</BicCode>
                                </BicToIntCode>
                              </soap:Body>
                            </soap:Envelope>
                            ';

        $client = new Client([
            'base_uri' => $this->uri . '/CreditInfoWebServ/CreditOrgInfo.asmx?WSDL',
        ]);

        try {
            $response = $client->request('POST', '', [
                'headers' => [
                    'Content-Type' => 'text/xml; charset=utf-8',
                    'SOAPAction' => 'http://web.cbr.ru/BicToIntCode',
                ],
                'body' => $soapRequest,
            ]);

            $body = $response->getBody()->getContents();

            $xml = new SimpleXMLElement($body);
            $namespaces = $xml->getNamespaces(true);
            $internalCode = $xml->children($namespaces['soap'])->Body->children($namespaces[''])->BicToIntCodeResponse->BicToIntCodeResult;

            $xml = '<?xml version="1.0" encoding="utf-8"?>
                    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
                      <soap:Body>
                        <CreditInfoByIntCodeXML xmlns="http://web.cbr.ru/">
                          <InternalCode>' . $internalCode . '</InternalCode>
                        </CreditInfoByIntCodeXML>
                      </soap:Body>
                    </soap:Envelope>';

            $response = $client->request('POST', '', [
                'headers' => [
                    'Content-Type' => 'text/xml; charset=utf-8',
                    'SOAPAction' => 'http://web.cbr.ru/CreditInfoByIntCodeXML',
                ],
                'body' => $xml,
            ]);
            $xml = $response->getBody()->getContents();

            $xmlObject = simplexml_load_string($xml);

            $xmlObject->registerXPathNamespace('soap', 'http://schemas.xmlsoap.org/soap/envelope/');
            $xmlObject->registerXPathNamespace('cbr', 'http://web.cbr.ru/');

            $nameShort = $xmlObject->xpath('//CreditOrgInfo/CO/OrgName')[0];
            $nameFull = $xmlObject->xpath('//CreditOrgInfo/CO/OrgFullName')[0];
            $bic = $xmlObject->xpath('//CreditOrgInfo/CO/BIC')[0];

            return new BankDTO(
                bic: $bic,
                name: $nameFull
            );
        } catch (GuzzleException $exception) {
            throw match ($exception->getCode()) {
                404 => new CbrAdaterException($this->translator->trans('messages.cbrException.notFound'), ErrorCode::SERVER_NOT_FOUND),
                default => new CbrAdaterException($this->translator->trans('messages.cbrException.serverError'), ErrorCode::SERVER_ERROR)
            };
        } catch (\Exception $exception) {
            throw new CbrAdaterException($this->translator->trans('messages.cbrException.errorParsing'), ErrorCode::SERVER_ERROR);
        }
    }

    public function getAll(): array
    {
        $client = new Client();

        try {
            $response = $client->request('GET', $this->uri . '/scripts/XML_bic.asp');

            $xmlContent = $response->getBody()->getContents();

            $xmlObject = simplexml_load_string($xmlContent);

            $banks = [];
            foreach ($xmlObject->Record as $record) {
                $banks[] = new BankDTO(
                    bic: (string) $record->Bic,
                    name: (string) $record->ShortName
                );
            }

            return $banks;
        }
        catch (GuzzleException $exception) {
            throw match ($exception->getCode()) {
                404 => new CbrAdaterException($this->translator->trans('messages.cbrException.notFound'), ErrorCode::SERVER_NOT_FOUND),
                default => new CbrAdaterException($this->translator->trans('messages.cbrException.serverError'), ErrorCode::SERVER_ERROR)
            };
        }

    }
}