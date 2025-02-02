<?php

namespace PHPEvo\Services\Enums;

enum PresenceTypeEnum: string
{
    case COMPOSING = 'composing';

    /**
     * @return array<string>
     */
    public static function toArray(): array
    {
        return [
            self::COMPOSING->value,
        ];
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::toArray(), true);
    }
}
