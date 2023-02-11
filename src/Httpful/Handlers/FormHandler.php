<?php
/**
 * Mime Type: application/x-www-urlencoded
 * @author Nathan Good <me@nategood.com>
 */

namespace Httpful\Handlers;

class FormHandler extends MimeHandlerAdapter
{
    public function parse(string $body): mixed
    {
        $parsed = [];
        parse_str($body, $parsed);

        return $parsed;
    }

    public function serialize(mixed $payload): string
    {
        return http_build_query($payload, '', '&');
    }
}
