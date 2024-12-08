<?php

namespace Evolution;

use Carbon\Factory;
use Dotenv\Dotenv;
use Evolution\Services\SendService;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;

class Evolution
{
    /**
     * evolution constructor.
     */
    public function __construct(
        private string $apiKey,
        private string $baseUrl,
    ) {
        self::boot();

        Http::macro('evolution', function () use ($apiKey, $baseUrl) {
            return Http::acceptJson()
                ->baseUrl($baseUrl)
                ->withHeaders([
                    'content-type' => 'application/json',
                    'apiKey' => $apiKey,
                ]);
        });
    }

    /**
     * boot container and set aliases
     *
     * @return void
     */
    private static function boot(): void
    {
        $container = new Container();

        Facade::setFacadeApplication($container);

        $container->singleton('http', function () {
            return new Factory();
        });

        class_alias(Http::class, 'Http');
    }

    /**
     * @return SendService
     */
    public function send(string $instance): SendService
    {
        return new SendService($instance);
    }
}
