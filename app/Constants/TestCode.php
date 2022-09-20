<?php

declare(strict_types=1);

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 */
class TestCode extends AbstractConstants
{

    /**
     * @Message("messages.params.invalid")
     */
    const TEST_PARAMS_INVALID_ERROR = 1000;

}
