<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Curl;

/**
 * CurlResponse
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Curl
*/
class CurlResponse
{
    /**
     * @var CurlRequest
    */
    protected CurlRequest $request;



    /**
     * @param CurlRequest $request
    */
    public function __construct(CurlRequest $request)
    {
        $this->request = $request;
    }





    /**
     * @return string
    */
    public function getBody(): string
    {
        return strval($this->request->exec());
    }






    /**
     * @return int
    */
    public function getStatusCode(): int
    {
        return intval($this->request->info(CURLINFO_HTTP_CODE));
    }







    /**
     * @return array
    */
    public function getHeaders(): array
    {
        $this->request->setOptions([
            CURLOPT_HEADER => true,
            CURLOPT_NOBODY => true
        ]);

        $response   = $this->request->exec();
        $headerRows = explode(PHP_EOL, $response);
        $headerRows = array_filter($headerRows, 'trim');
        return $this->filterHeaders($headerRows);
    }





    /**
     * @param array $headerRows
     *
     * @return array
    */
    private function filterHeaders(array $headerRows): array
    {
        $headers = [];

        foreach ($headerRows as $header) {
            $position = stripos($header, ':');
            if($position !== false) {
                [$name, $value] = explode(':', $header, 2);
                $headers[$name] = trim($value);
            }
        }

        return $headers;
    }
}
