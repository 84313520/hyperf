<?php


namespace App\Common;


use GuzzleHttp\Client;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Di\Annotation\Inject;
use GuzzleHttp\Psr7\Response;
use Hyperf\Utils\Codec\Json;

class HttpClient
{
    protected $client;

    /**
     * @Inject
     * @var RequestInterface $incomingRequest
     */
    protected $incomingRequest;

    protected $debug = true;

    public function __construct($config = [])
    {
        $this->client = new Client($config);
    }

    public function request($method, $uri = '', array $options = [])
    {
        if ($this->incomingRequest->parsedData !== null) {
            $tracingHeaders = [];
            if ($this->incomingRequest->hasHeader('X_REQUEST_ID')) {
                $tracingHeaders['x-request-id'] = $this->incomingRequest->header('X_REQUEST_ID');
            }
            if ($this->incomingRequest->hasHeader('X_B3_TRACEID')) {
                $tracingHeaders['x-b3-traceid'] = $this->incomingRequest->header('X_B3_TRACEID');
            }
            if ($this->incomingRequest->hasHeader('X_B3_SPANID')) {
                $tracingHeaders['x-b3-spanid'] = $this->incomingRequest->header('X_B3_SPANID');
            }
            if ($this->incomingRequest->hasHeader('X_B3_PARENTSPANID')) {
                $tracingHeaders['x-b3-parentspanid'] = $this->incomingRequest->header('X_B3_PARENTSPANID');
            }
            if ($this->incomingRequest->hasHeader('X_B3_SAMPLED')) {
                $tracingHeaders['x-b3-sampled'] = $this->incomingRequest->header('X_B3_SAMPLED');
            }
            if ($this->incomingRequest->hasHeader('X_B3_FLAGS')) {
                $tracingHeaders['x-b3-flags'] = $this->incomingRequest->header('X_B3_FLAGS');
            }
            if ($this->incomingRequest->hasHeader('X_OT_SPAN_CONTEXT')) {
                $tracingHeaders['x-ot-span-context'] = $this->incomingRequest->header('X_OT_SPAN_CONTEXT');
            }
            //注入tracing headers
            if (isset($options['headers'])) {
                $options['headers'] = array_merge($tracingHeaders, $options['headers']);
            } else {
                $options['headers'] = $tracingHeaders;
            }
        }
        if (! isset($options['timeout'])) {
            $options['timeout'] = 10;
        }
        if (! isset($options['http_errors'])) {
            $options['http_errors'] = false;
        }
        $startTime = microtime(true);
        $response = $this->client->request($method, $uri, $options);
        $endTime = microtime(true);
        if ($this->debug) {
            $this->log($method, $uri, $options, $response, ['start_time' => $startTime,'end_time' => $endTime]);
        }
        return $response;
    }

    public function get($uri, array $options = [])
    {
        return $this->request("GET", $uri, $options);
    }

    public function post($uri, array $options = [])
    {
        return $this->request("POST", $uri, $options);
    }

    public function delete($uri, array $options = [])
    {
        return $this->request("DELETE", $uri, $options);
    }

    public function enableDebug()
    {
        $this->debug = true;
    }

    public function disableDebug()
    {
        $this->debug = false;
    }

    protected function injectTracingHeaders($request,$headers = [])
    {

    }

    protected function log($method, $uri, $options, Response $response, $timeLine)
    {
        $responseContent = $response->getBody()->getContents();
        $response->getBody()->rewind();//使用getContents读取内容后，需要rewind将临时流中的指针指向头部，否则第二次调用是
        $timeLine['cost_seconds'] = $timeLine['end_time'] - $timeLine['start_time'];
        $data = [
            'log_time' => date('Y-m-d H:i:s'),
            'method' => $method,
            'uri' => $uri,
            'options' => $options,
            'response_status_code' => $response->getStatusCode(),
            'response_headers' => $response->getHeaders(),
            'response_content' => $responseContent,
            'time_line' => $timeLine
        ];
        $content = Json::encode($data);
        logger('outcome_request','outcome_request')->info($content);
    }
}