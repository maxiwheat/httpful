<?php
/**
 * Mime Type: text/csv
 * @author Raja Kapur <rajak@twistedthrottle.com>
 */

namespace Httpful\Handlers;

use Exception;

class CsvHandler extends MimeHandlerAdapter
{
    public function parse(string $body): mixed
    {
        if (empty($body)) {
            return null;
        }

        $parsed = [];
        $fp = fopen('data://text/plain;base64,' . base64_encode($body), 'r');
        if ($fp === false) {
            throw new Exception("Unable to open file");
        }

        while (($r = fgetcsv($fp)) !== false) {
            $parsed[] = $r;
        }

        if (empty($parsed)) {
            throw new Exception("Unable to parse response as CSV");
        }

        return $parsed;
    }

    public function serialize($payload): string
    {
        $fp = fopen('php://temp/maxmemory:' . (6 * 1024 * 1024), 'r+');
        if ($fp === false) {
            throw new Exception("Unable to open file");
        }

        $i = 0;
        foreach ($payload as $fields) {
            if ($i++ == 0) {
                fputcsv($fp, array_keys($fields));
            }

            fputcsv($fp, $fields);
        }

        rewind($fp);

        $data = stream_get_contents($fp);
        if ($data === false) {
            throw new Exception("Unable to read data from file");
        }

        fclose($fp);

        return $data;
    }
}
