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
$phpevo = (new PHPEvo($apiKey, $apiBaseUrl))
    ->instance();
```

#### create instance

```php
$phpevo
    ->setName('phpevo-instance')
    ->create();
```

#### get instances

```php
$phpevo->getInstances();
```

#### create instance

```php
$phpevo
    ->setName('phpevo-instance')
    ->connect();
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
/* image */
$phpevo
    ->to($phone)
    ->caption('PHPEvo is awesome!')
    ->sendImage(__DIR__ . '/media/media.png');

/* audio */
$phpevo
    ->to($phone)
    ->sendAudio(__DIR__ . '/media/media.mp3');

/* documents */
$phpevo
    ->to($phone)
    ->fileName('media.pdf')
    ->sendDocument(__DIR__ . '/media/media.pdf');
```

## Roadmap

#### Instances

- Create Instance
- Fetch Instances
- Instance Connect
- Restart Instance
- Connection State
- Logout Instance
- Delete Instance
- Set Presence

#### Send

- Check status
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
