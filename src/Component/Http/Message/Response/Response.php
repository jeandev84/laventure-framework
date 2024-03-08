<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Response;

use Laventure\Component\Http\Message\Message;
use Laventure\Component\Http\Message\Response\Body\ResponseBody;
use Laventure\Component\Http\Message\Response\Utils\ResponseHeaders;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Stringable;

/**
 * Response
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Response
*/
class Response extends Message implements ResponseInterface, Stringable
{
    /**
     * @var int
    */
    protected int $statusCode;



    /**
     * @var string
    */
    protected string $reasonPhrase = '';




    /**
     * @param string|null $content
     * @param int $status
     * @param array $headers
    */
    public function __construct(string $content = null, int $status = 200, array $headers = [])
    {
        parent::__construct();
        $this->withStatus($status)
             ->withHeaders($headers)
             ->withBody($this->makeBody($content));
    }




    /**
     * @param string $content
     * @return $this
    */
    public function setContent(string $content): static
    {
        $this->getBody()->write($content);

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }



    /**
     * @inheritDoc
    */
    public function withStatus(int $code, string $reasonPhrase = ''): static
    {
        $this->statusCode   = $code;
        $this->reasonPhrase = $reasonPhrase;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }




    /**
     * @return string
    */
    public function getContent(): string
    {
        return strval($this->getBody());
    }





    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return $this->getContent();
    }




    /**
     * @return void
    */
    public function send(): void
    {
        ob_start();
        $this->sendHeaders();
        $this->sendContent();
        ob_end_flush();
    }




    /**
     * @return void
    */
    protected function sendResponseCode(): void
    {
        if ($this->reasonPhrase) {
            header(sprintf('%s %s %s', $this->version, $this->statusCode, $this->reasonPhrase));
        } else {
            http_response_code($this->statusCode);
        }
    }


    /**
     * @return void
    */
    protected function sendHeaders(): void
    {
        // send status message
        $this->sendResponseCode();

        // send others headers
        foreach ($this->getHeaders() as $name => $values) {
            header(sprintf('%s: %s', $name, join(", ", $values)));
        }
    }




    /**
     * @return void
    */
    protected function sendContent(): void
    {
        echo $this->getContent();
    }




    /**
     * @param $content
     * @return ResponseBody
    */
    private function makeBody($content): ResponseBody
    {
        $responseBody = new ResponseBody();

        if ($content) {
            $responseBody->write($content);
        }

        return $responseBody;
    }
}
