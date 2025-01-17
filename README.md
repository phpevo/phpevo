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
$phpevo = (new PHPEvo($apiKey, $apiBaseUrl))
    ->send($instance);
```

#### send plain text:

```php
$phpevo
    ->to($phone)
    ->plainText('PHPEvo is awesome!');
```

#### send media:

```php
$phpevo
    ->to($phone)
    ->caption('PHPEvo is awesome!')
    ->sendImage(__DIR__ . '/media/media.png');

$phpevo
    ->to($phone)
    ->sendAudio(__DIR__ . '/media/media.mp3');

$phpevo
    ->to($phone)
    ->fileName('media.pdf')
    ->sendDocument(__DIR__ . '/media/media.pdf');

$phpevo
    ->to($phone)
    ->caption('PHPEvo is awesome!')
    ->sendVideo(__DIR__ . '/media/media.mp4');
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
- check status
- Send Location
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
