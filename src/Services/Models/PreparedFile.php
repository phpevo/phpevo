<?php

namespace PHPEvo\Services\Models;

class PreparedFile
{
    public function __construct(
        public string $fileName,
        public string $content,
        public string $mimeType
    ) {
    }
}
