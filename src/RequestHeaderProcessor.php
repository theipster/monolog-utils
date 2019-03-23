<?php

namespace TheIpster\MonologUtils;

use Monolog\Processor\ProcessorInterface;
use Psr\Http\Message\RequestInterface;

class RequestHeaderProcessor implements ProcessorInterface
{
    /**
     * @var string
     */
    private $logExtraName;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var string
     */
    private $requestHeaderName;

    /**
     * Constructor
     *
     * @param RequestInterface $request
     * @param string $requestHeaderName
     * @param string $logExtraName
     */
    public function __construct(RequestInterface $request, $requestHeaderName, $logExtraName)
    {
        $this->logExtraName = $logExtraName;
        $this->request = $request;
        $this->requestHeaderName = $requestHeaderName;
    }

    /**
     * @inheritdoc
     */
    public function __invoke(array $record)
    {
        // Get the header value, defaulting to null.
        $logExtraValue = $this->request->hasHeader($this->requestHeaderName)
            ? $this->request->getHeaderLine($this->requestHeaderName)
            : null;

        // Add to log record.
        $record['extra'][$this->logExtraName] = $logExtraValue;

        // Done.
        return $record;
    }
}
