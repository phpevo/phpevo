<?php

namespace Evolution\Services;

use Illuminate\Support\Facades\Http;

/**
 * Class SendService
 *
 * @package Evolution\Services
 */
class SendService
{
    public function __construct(
        private string $instance,
        private string $to = ''
    ) {
    }

    /**
     * set to number
     *
     * @param string $to
     * @return self
     */
    public function to(string $to): self
    {
        $this->to = $to;

        return $this;
    }

    /**
     * send text message
     *
     * @param string $message
     * @return array
     */
    public function plainText(string $message): array
    {
        $endpoint = '/message/sendText/' . $this->instance;

        $response = Http::evolution()
            ->post($endpoint, [
                'number' => $this->to,
                'text' => $message,
            ]);

        if ($response->getStatusCode()  == 201) {
            $response = json_decode($response->getBody(), true);

            return $response;
        }

        return [
            'error' => 'error',
            'message' => 'Erro ao enviar mensagem.',
        ];
    }
}
