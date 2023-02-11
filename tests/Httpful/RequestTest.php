<?php
/**
 * @author nick fox <quixand gmail com>
 */

declare(strict_types=1);

namespace Tests\Httpful;

use Httpful\Exception\ConnectionErrorException;
use Httpful\Request;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{

    /**
     * @author Nick Fox
     */
    #[Test]
    public function throws_exception_on_invalid_url()
    {
        $this->expectException(ConnectionErrorException::class);
        Request::get('unavailable.url')->whenError(function($error) {})->send();
    }
}
