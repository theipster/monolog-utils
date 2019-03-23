<?php

namespace TheIpster\MonologUtils;

use Nyholm\Psr7\Request;
use PHPUnit\Framework\TestCase;

class RequestHeaderProcessorTest extends TestCase
{
    public function testInvokeWithEmptyStringHeaderWillInjectEmptyString()
    {
        $request = new Request('GET', 'https://domain/path/', ['X-Custom-Header' => '']);
        $processor = new RequestHeaderProcessor($request, 'X-Custom-Header', 'custom_header');
        $record = [];
        $result = $processor($record);
        $this->assertEquals('', $result['extra']['custom_header']);
    }

    public function testInvokeWithMissingHeaderWillInjectNull()
    {
        $request = new Request('GET', 'https://domain/path/', []);
        $processor = new RequestHeaderProcessor($request, 'X-Custom-Header', 'custom_header');
        $record = [];
        $result = $processor($record);
        $this->assertArrayHasKey('custom_header', $result['extra']);
        $this->assertNull($result['extra']['custom_header']);
    }

    public function testInvokeWithPopulatedHeaderWillInjectValue()
    {
        $request = new Request('GET', 'https://domain/path/', ['X-Custom-Header' => 'foo']);
        $processor = new RequestHeaderProcessor($request, 'X-Custom-Header', 'custom_header');
        $record = [];
        $result = $processor($record);
        $this->assertEquals('foo', $result['extra']['custom_header']);
    }
}
