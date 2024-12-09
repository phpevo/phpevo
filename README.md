# Evolution API SDK - PHP

## Using Evolution SDK PHP

installing package:

```bash
composer require mariolucasdev/evolution-sdk
```

load Evolution class:

```php
$evolution = new Evolution($apiKey, $apiBaseUrl);
```

## Resouces

#### send plain text:

```php
$message = $evolution
    ->send($instance)
    ->to('5599999999999')
    ->plainText('Evolution SDK Running...');

print_r($message);
```

#### send media:

- Send Image

```php
$evolution = (new Evolution($apiKey, $apiBaseUrl))
    ->send($instance)
    ->to($phone);

/* image */
$image = $evolution
    ->caption('Image - Evolution SDK Running...')
    ->fileName('media.png')
    ->media('./media/media.png', MediaTypeEnum::IMAGE);

print_r($image);

/* audio */
$audio = $evolution
    ->fileName('media.mp3')
    ->media('http://webaudioapi.com/samples/audio-tag/chrono.mp3', MediaTypeEnum::AUDIO);

print_r($audio);

/* video */
$video = $evolution
    ->caption('Video - Evolution SDK Running...')
    ->fileName('media.mp4')
    ->media('./media/media.mp4', MediaTypeEnum::VIDEO);

print_r($video);

/* document */
$document = $evolution
    ->caption('Document - Evolution SDK Running...')
    ->fileName('media.pdf')
    ->media('./media/media.pdf', MediaTypeEnum::DOCUMENT);

print_r($document);
```

## Roadmap

#### Send

- Check status
- Send Location
- Send List
- Send Buttons

#### Instances

- Create Instance
- Fetch Instances
- Instance Connect
- Restart Instance
- Connection State
- Logout Instance
- Delete Instance
- Set Presence

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
