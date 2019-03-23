<?php

namespace TheIpster\MonologUtils;

use Psr\Http\Message\RequestInterface;

class XRequestIdProcessor extends RequestHeaderProcessor
{
    /**
     * Constructor
     *
     * @param RequestInterface $request
     * @param string $logExtraName
     */
    public function __construct(RequestInterface $request, $logExtraName = 'request_id')
    {
        parent::__construct($request, 'X-Request-ID', $logExtraName);
    }
}
