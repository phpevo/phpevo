<?php

namespace PHPEvo\Services\Models;

/**
 * Class ContactMessage
 */
class ContactMessage
{
    /**
     * ContactMessage constructor.
     *
     * @param  string  $phoneNumber  Phone number stylized (+55 31 9 9999-9999)
     * @param  string  $wuid  Phone number non-stylized with country code (553198296801)
     * @param  string|null  $email  Contact email address
     * @param  string|null  $fullName  Contact full name
     * @param  string|null  $organization  Organization name for the contact
     * @param  string|null  $url  Page URL
     */
    public function __construct(
        public string $phoneNumber,
        public string $wuid,
        public ?string $email = null,
        public ?string $fullName = null,
        public ?string $organization = null,
        public ?string $url = null,
    ) {
    }
}
