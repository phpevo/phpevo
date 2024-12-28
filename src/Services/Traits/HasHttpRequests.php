<?php

namespace PHPEvo\Services\Traits;

/**
 * Trait HasHttpRequests
 *
 * @package PHPEvo\Services\Traits
 */
trait HasHttpRequests
{
    /**
     * send GET request
     *
     * @param string $url
     * @param array $options
     * @return array
     */
    protected function get(string $url, array $options = []): array
    {
        try {
            $response = $this->client->get($url, $options);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * send POST request
     *
     * @param string $url
     * @param array $options
     * @return array
     */
    protected function post(string $url, array $options = []): array
    {
        try {
            $response = $this->client->post($url, [
                'json' => $options,
            ]);

            if ($response->getStatusCode()  == 201) {
                return json_decode($response->getBody()->getContents(), true);
            }

            return [
                'error' => true,
                'message' => 'error',
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}
