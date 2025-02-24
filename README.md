# PHPEvo

## Using PHPEvo

installing package:

```bash
composer require phpevo/phpevo
```

load Evolution class:

# Resouces

## Instances

```php
$phpevo = (new PHPEvo($apiKey, $apiBaseUrl))->instance;

$phpevo->setName('phpevo');
```

#### create instance

```php
/**
 * @return array with key qrcode with base64 image
 */
$phpevo->create();
```

#### get instances

```php
/**
 * @return array with all instances
 */
$phpevo->getAll();
```

#### connect instance

```php
/**
 * @return array with key qrcode with base64 image
 */
$phpevo->connect();
```

#### connection state

```php
/**
 * @return array with state key
 */
$phpevo->getState();
```

#### disconnect instance

```php
/**
 * @return bool
 */
$phpevo->disconnect();
```

##### destroy instance

```php
/**
 * @return bool
 */
$phpevo->destroy();
```

## Media

```php
$phpevo = (new PHPEvo($apiKey, $apiBaseUrl))->send;

$phpevo
    ->instance($instance)
    ->to($phone);
```

#### send text:

```php
/**
 * @return array
 */
$phpevo->text($message, $params);
```

#### send media:

```php
/**
 * @return array
 */
$phpevo->sendImage($imagePath);

/**
 * @return array
 */
$phpevo->sendAudio($audioPath);

/**
 * @return array
 */
$phpevo->sendDocument($documentPath);

/**
 * @return array
 */
$phpevo->sendVideo($videoPath);

/**
 * @return array
 */
$phpevo->sendContact(new ContactMessage($phone, $nonStylizedPhone), $options);

/**
 * @return array
 */
$phpevo->sendLocation(new LocationMessage($lat, $long, $address), $options);

/**
 * @return array
 */
$phpevo->sendReaction(new ReactionMessage($key, '🧬'));

/**
 * @return array
 */
$phpevo->sendPoll(new PollMessage($title, $selectableCount, $values), $options);
```

## Events

### WebSockets

```php
$phpevo = (new PHPEvo($apiKey, $apiBaseUrl))->websocket;

$phpevo->instance($instance);
```

#### Set WebSockets:

```php
/**
 * @param bool $enabled
 * @param array $events (See [all valid events](./src/Services/Enums/ValidEvents.php))
 * @return array
 */
$phpevo->set($enabled, $events);
```

#### Get WebSockets:

```php
/**
 * @return array
 */
$phpevo->find();
```


### SQS
```php
$phpevo = (new PHPEvo($apiKey, $apiBaseUrl))->sqs;

$phpevo->instance($instance);
```

#### Set SQS:

```php
/**
 * @param bool $enabled
 * @param array $events (See [all valid events](./src/Services/Enums/ValidEvents.php))
 * @return array
 */
$phpevo->set($enabled, $events);
```

#### Get SQS:

```php
/**
 * @return array
 */
$phpevo->find();
```

### RabbitMQ

```php
$phpevo = (new PHPEvo($apiKey, $apiBaseUrl))->rabbit;

$phpevo->instance($instance);
```

#### Set RabbitMQ:

```php
/**
 * @param bool $enabled
 * @param array $events (See [all valid events](./src/Services/Enums/ValidEvents.php))
 * @return array
 */
$phpevo->set($enabled, $events);
```

#### Get RabbitMQ:

```php
/**
 * @return array
 */
$phpevo->find();
```

## Roadmap

#### Instances

- ✅ Create Instance
- ✅ Fetch Instances
- ✅ Instance Connect
- ✅ Connection State
- ✅ Logout Instance
- ✅ Delete Instance
- Restart Instance
- Set Presence

#### Send

- ✅ Send plain text
- ✅ Send image
- ✅ Send document
- ✅ Send audio
- ✅ Send video
- ✅ Send reaction
- ✅ Send Location
- ✅ Send Contact
- ✅ Send Poll
- check status
- Send List
- Send Buttons

## 🌟 Contribuindo

Contribuições são muito bem-vindas!
Para começar:

- Faça um fork do projeto.
- Crie uma branch para sua feature (git checkout -b feature/new-feature).
- Faça commit das alterações (git commit -m 'feat: added a new feature').
- Envie sua branch (git push origin feature/new-feature).
- Abra um pull request para análise.

## 📄 Licença

Este projeto está licenciado sob a MIT License. Consulte o arquivo LICENSE para mais detalhes.

## 🤝 Contato

💻 GitHub: mariolucasdev

📧 Email: mariolucasdev@gmail.com

## ☕ Buy me a coffee

[![Sponsor me](https://img.shields.io/badge/Sponsor%20me-%E2%9D%A4-red)](https://github.com/sponsors/mariolucasdev)
