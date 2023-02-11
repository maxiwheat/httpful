<?php

/**
 * Handlers are used to parse and serialize payloads for specific mime types.
 * You can register a custom handler via the register method.
 * You can also override a default parser in this way.
 */

namespace Httpful\Handlers;

class MimeHandlerAdapter
{
    public function __construct(array $args = [])
    {
        $this->init($args);
    }

    public function init(array $args): void
    {
    }

    public function parse(string $body): mixed
    {
        return $body;
    }

    public function serialize($payload): string
    {
        return (string) $payload;
    }

    protected function stripBom(string $body): string
    {
        if (str_starts_with($body, "\xef\xbb\xbf")) { // UTF-8
            $body = substr($body, 3);
        } else if (str_starts_with($body, "\xff\xfe\x00\x00") || str_starts_with($body, "\x00\x00\xfe\xff")) { // UTF-32
            $body = substr($body, 4);
        } else if (str_starts_with($body, "\xff\xfe") || str_starts_with($body, "\xfe\xff")) { // UTF-16
            $body = substr($body, 2);
        }

        return $body;
    }
}
