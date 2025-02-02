<?php

namespace PHPEvo\Services\Enums;

enum ValidEvents: string
{
    case APPLICATION_STARTUP       = 'APPLICATION_STARTUP';
    case QRCODE_UPDATED            = 'QRCODE_UPDATED';
    case MESSAGES_SET              = 'MESSAGES_SET';
    case MESSAGES_UPSERT           = 'MESSAGES_UPSERT';
    case MESSAGES_UPDATE           = 'MESSAGES_UPDATE';
    case MESSAGES_DELETE           = 'MESSAGES_DELETE';
    case SEND_MESSAGE              = 'SEND_MESSAGE';
    case CONTACTS_SET              = 'CONTACTS_SET';
    case CONTACTS_UPSERT           = 'CONTACTS_UPSERT';
    case CONTACTS_UPDATE           = 'CONTACTS_UPDATE';
    case PRESENCE_UPDATE           = 'PRESENCE_UPDATE';
    case CHATS_SET                 = 'CHATS_SET';
    case CHATS_UPSERT              = 'CHATS_UPSERT';
    case CHATS_UPDATE              = 'CHATS_UPDATE';
    case CHATS_DELETE              = 'CHATS_DELETE';
    case GROUPS_UPSERT             = 'GROUPS_UPSERT';
    case GROUP_UPDATE              = 'GROUP_UPDATE';
    case GROUP_PARTICIPANTS_UPDATE = 'GROUP_PARTICIPANTS_UPDATE';
    case CONNECTION_UPDATE         = 'CONNECTION_UPDATE';
    case CALL                      = 'CALL';
    case NEW_JWT_TOKEN             = 'NEW_JWT_TOKEN';

    public static function toArray(): array
    {
        return [
            self::APPLICATION_STARTUP->value,
            self::QRCODE_UPDATED->value,
            self::MESSAGES_SET->value,
            self::MESSAGES_UPSERT->value,
            self::MESSAGES_UPDATE->value,
            self::MESSAGES_DELETE->value,
            self::SEND_MESSAGE->value,
            self::CONTACTS_SET->value,
            self::CONTACTS_UPSERT->value,
            self::CONTACTS_UPDATE->value,
            self::PRESENCE_UPDATE->value,
            self::CHATS_SET->value,
            self::CHATS_UPSERT->value,
            self::CHATS_UPDATE->value,
            self::CHATS_DELETE->value,
            self::GROUPS_UPSERT->value,
            self::GROUP_UPDATE->value,
            self::GROUP_PARTICIPANTS_UPDATE->value,
            self::CONNECTION_UPDATE->value,
            self::CALL->value,
            self::NEW_JWT_TOKEN->value,
        ];
    }

    public static function isValidEvent(string $event): bool
    {
        return in_array($event, self::toArray());
    }
}
