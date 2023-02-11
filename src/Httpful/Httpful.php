<?php

namespace Httpful;

use Httpful\Handlers\MimeHandlerAdapter;

class Httpful
{
    const VERSION = '0.4.0';

    /** @var array<string, MimeHandlerAdapter> */
    private static array $mimeRegistrar = [];
    private static ?MimeHandlerAdapter $default = null;

    public static function register(string $mimeType, MimeHandlerAdapter $handler): void
    {
        self::$mimeRegistrar[$mimeType] = $handler;
    }

    public static function get(?string $mimeType = null): MimeHandlerAdapter
    {
        if (isset(self::$mimeRegistrar[$mimeType])) {
            return self::$mimeRegistrar[$mimeType];
        }

        if (empty(self::$default)) {
            self::$default = new MimeHandlerAdapter();
        }

        return self::$default;
    }

    /**
     * Check if this particular Mime Type
     * has a parser registered for it.
     */
    public static function hasParserRegistered(string $mimeType): bool
    {
        return isset(self::$mimeRegistrar[$mimeType]);
    }
}
