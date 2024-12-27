# Evolution API SDK - PHP

## Using Evolution SDK PHP

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

- Send Image

```php
$phpevo = (new Evolution($apiKey, $apiBaseUrl))
    ->send($instance)
    ->to($phone);

/* image */
$phpevo
    ->caption($caption)
    ->fileName($fileName)
    ->media($filePath, MediaTypeEnum::IMAGE);

/* audio */
$phpevo
    ->fileName($audioFileName)
    ->media($audioFilePath, MediaTypeEnum::AUDIO);

/* video */
$phpevo
    ->caption($caption)
    ->fileName($videoFileName)
    ->media($videoFilePath, MediaTypeEnum::VIDEO);

/* document */
$phpevo
    ->caption($caption)
    ->fileName($documentFileName)
    ->media($documentFilePath, MediaTypeEnum::DOCUMENT);
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
