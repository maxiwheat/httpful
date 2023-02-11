<?php
/**
 * Mime Type: application/json
 * @author Nathan Good <me@nategood.com>
 */

namespace Httpful\Handlers;

use Httpful\Exception\JsonParseException;
use Httpful\Exception\SerializeException;

class JsonHandler extends MimeHandlerAdapter
{
    private bool $decode_as_array = false;

    public function init(array $args): void
    {
        $this->decode_as_array = !!(array_key_exists('decode_as_array', $args) ? $args['decode_as_array'] : false);
    }

    public function parse(string $body): mixed
    {
        $body = $this->stripBom($body);
        if (empty($body)) {
            return null;
        }

        $parsed = json_decode($body, $this->decode_as_array);

        if (is_null($parsed) && strtolower($body) !== 'null') {
            throw new JsonParseException('Unable to parse response as JSON: ' . json_last_error_msg());
        }

        return $parsed;
    }

    public function serialize(mixed $payload): string
    {
        $serialized_payload = json_encode($payload);
        if ($serialized_payload === false) {
            throw new SerializeException('Unable to serialize payload to JSON: ' . json_last_error_msg());
        }

        return $serialized_payload;
    }
}
