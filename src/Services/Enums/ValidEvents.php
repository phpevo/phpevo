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
            self::APPLICATION_STARTUP,
            self::QRCODE_UPDATED,
            self::MESSAGES_SET,
            self::MESSAGES_UPSERT,
            self::MESSAGES_UPDATE,
            self::MESSAGES_DELETE,
            self::SEND_MESSAGE,
            self::CONTACTS_SET,
            self::CONTACTS_UPSERT,
            self::CONTACTS_UPDATE,
            self::PRESENCE_UPDATE,
            self::CHATS_SET,
            self::CHATS_UPSERT,
            self::CHATS_UPDATE,
            self::CHATS_DELETE,
            self::GROUPS_UPSERT,
            self::GROUP_UPDATE,
            self::GROUP_PARTICIPANTS_UPDATE,
            self::CONNECTION_UPDATE,
            self::CALL,
            self::NEW_JWT_TOKEN,
        ];
    }

    public static function isValidEvent(string $event): bool
    {
        return in_array($event, self::toArray());
    }
}
