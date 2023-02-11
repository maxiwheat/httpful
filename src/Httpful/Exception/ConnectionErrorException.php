<?php

declare(strict_types=1);

namespace Httpful\Exception;

use Exception;

class ConnectionErrorException extends Exception
{
    private int $curlErrorNumber;

    private string $curlErrorString;

    public function getCurlErrorNumber(): int
    {
        return $this->curlErrorNumber;
    }

    public function setCurlErrorNumber(int $curlErrorNumber): self
    {
        $this->curlErrorNumber = $curlErrorNumber;

        return $this;
    }

    public function getCurlErrorString(): string
    {
        return $this->curlErrorString;
    }

    public function setCurlErrorString(string $curlErrorString): self
    {
        $this->curlErrorString = $curlErrorString;

        return $this;
    }
}
