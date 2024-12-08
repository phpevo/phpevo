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

send plain text:

```php
$message = $evolution
    ->send($instance)
    ->to('5599999999999')
    ->plainText('Evolution SDK Running...');

print_r($message);
```

## Roadmap

#### Send

- Send Images
- Send Documents
- Send Audio
- Check status

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
