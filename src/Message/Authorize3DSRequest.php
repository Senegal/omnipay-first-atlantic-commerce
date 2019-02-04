<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 01.02.19
 * Time: 14:09
 */

namespace Omnipay\FirstAtlanticCommerce\Message;


class Authorize3DSRequest extends AuthorizeRequest
{

    /**
     * Transaction code (flag as a authorization)
     *
     * @var int;
     */
    protected $transactionCode = 0;

    /**
     * @var string;
     */
    protected $requestName = 'Authorize3DSRequest';

    /**
     * Returns endpoint for authorize requests
     *
     * @return string Endpoint URL
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint() . '3DS';
    }

    /**
     * Return the authorize response object
     *
     * @param \SimpleXMLElement $xml Response xml object
     *
     * @return AuthorizeResponse
     */
    protected function newResponse($xml)
    {
        \Yii::warning($xml);
        return new Authorize3DSResponse($this, $xml);
    }

    /**
     * Validate and construct the data for the request
     *
     * @return array
     */
    public function getData()
    {
        $data = parent::getData();
        $data['MerchantResponseURL'] = $this->getMerchantResponseURL();
        $data['FraudDetails']['SessionId'] = \Yii::$app->request->csrfToken;
        return $data;
    }

}