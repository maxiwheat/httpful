<?php

namespace Httpful;

/**
 * @author Nate Good <me@nategood.com>
 */
class Bootstrap
{
    public static bool $registered = false;

    public static function init(): void
    {
        self::registerHandlers();
    }

    /**
     * Register default mime handlers. Is idempotent.
     */
    public static function registerHandlers(): void
    {
        if (self::$registered === true) {
            return;
        }

        // TODO: check a conf file to load from that instead of hardcoding into the library?
        $handlers = [
            \Httpful\Mime::JSON => new \Httpful\Handlers\JsonHandler(),
            \Httpful\Mime::XML  => new \Httpful\Handlers\XmlHandler(),
            \Httpful\Mime::FORM => new \Httpful\Handlers\FormHandler(),
            \Httpful\Mime::CSV  => new \Httpful\Handlers\CsvHandler(),
        ];

        foreach ($handlers as $mime => $handler) {
            // Don't overwrite if the handler has already been registered
            if (Httpful::hasParserRegistered($mime))
                continue;
            Httpful::register($mime, $handler);
        }

        self::$registered = true;
    }
}
