<?php

namespace Httpful;

/**
 * @author Nate Good <me@nategood.com>
 */
class Http
{
    const HEAD = 'HEAD';
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';
    const PATCH = 'PATCH';
    const OPTIONS = 'OPTIONS';
    const TRACE = 'TRACE';

    /**
     * Returns array of HTTP method strings
     */
    public static function safeMethods(): array
    {
        return [
            self::HEAD,
            self::GET,
            self::OPTIONS,
            self::TRACE
        ];
    }

    public static function isSafeMethod(string $method): bool
    {
        return in_array($method, self::safeMethods());
    }

    public static function isUnsafeMethod(string $method): bool
    {
        return !in_array($method, self::safeMethods());
    }

    /**
     * @return array list of (always) idempotent HTTP methods
     */
    public static function idempotentMethods(): array
    {
        // Though it is possible to be idempotent, POST
        // is not guaranteed to be, and more often than
        // not, it is not.
        return [
            self::HEAD,
            self::GET,
            self::PUT,
            self::DELETE,
            self::OPTIONS,
            self::TRACE,
            self::PATCH
        ];
    }

    public static function isIdempotent(string $method): bool
    {
        return in_array($method, self::idempotentMethods());
    }

    public static function isNotIdempotent(string $method): bool
    {
        return !in_array($method, self::idempotentMethods());
    }

    /**
     * @deprecated Technically anything *can* have a body,
     * they just don't have semantic meaning. So say's Roy
     * http://tech.groups.yahoo.com/group/rest-discuss/message/9962
     */
    public static function canHaveBody(): array
    {
        return [
            self::POST,
            self::PUT,
            self::PATCH,
            self::OPTIONS
        ];
    }
}
