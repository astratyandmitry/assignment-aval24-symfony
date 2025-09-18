<?php

declare(strict_types=1);

namespace App\Domain\Client\Exception;

use DomainException;

final class ClientAlreadyExistsException extends DomainException {}
