<?php

namespace Omnipay\FirstAtlanticCommerce\Message;

use Omnipay\FirstAtlanticCommerce\Message\AbstractRequest;

/**
 * FACPG2 Transaction Status Request
 */
class StatusRequest extends AbstractRequest
{
    /**
     * @var string;
     */
    protected $requestName = 'TransactionStatusRequest';

    /**
     * Validate and construct the data for the request
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('merchantId', 'merchantPassword', 'acquirerId', 'transactionId');

        $data = [
            'AcquirerId'  => $this->getAcquirerId(),
            'MerchantId'  => $this->getMerchantId(),
            'Password'    => $this->getMerchantPassword(),
            'OrderNumber' => $this->getTransactionId()
        ];

        return $data;
    }

    /**
     * Returns endpoint for authorize requests
     *
     * @return string Endpoint URL
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint() . 'TransactionStatus';
    }

    /**
     * Return the transaction modification response object
     *
     * @param \SimpleXMLElement $xml Response xml object
     *
     * @return ResponseInterface
     */
    protected function newResponse($xml)
    {
        return new StatusResponse($this, $xml);
    }
}