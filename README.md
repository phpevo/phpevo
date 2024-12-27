# PHPEvo

## Using PHPEvo

installing package:

```bash
composer require phpevo/phpevo
```

load Evolution class:

```php
$phpevo = new PHPEvo($apiKey, $apiBaseUrl);
```

## Resouces

#### send plain text:

```php
$phpevo
    ->send($instanceName)
    ->to($phone)
    ->plainText($message);
```

#### send media:

```php
/* image */
$phpevo
    ->send($instance)
    ->to($phone)
    ->media(__DIR__ . '/media/media.png', MediaTypeEnum::IMAGE);

/* audio */
$audio = $phpevo
    ->send($instance)
    ->to($phone)
    ->media(__DIR__ . '/media/media.m4a', MediaTypeEnum::AUDIO);

/* vídeo */
$phpevo
    ->send($instance)
    ->to($phone)
    ->caption('Video - Evolution SDK Running...')
    ->media(__DIR__ . '/media/media.mp4', MediaTypeEnum::VIDEO);

/* documents */
$phpevo
    ->send($instance)
    ->to($phone)
    ->fileName('media.pdf')
    ->media(__DIR__ . '/media/media.pdf', MediaTypeEnum::DOCUMENT);
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
