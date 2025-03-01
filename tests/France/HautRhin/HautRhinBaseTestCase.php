<?php

declare(strict_types = 1);

/**
 * This file is part of the 'Yasumi' package.
 *
 * The easy PHP Library for calculating holidays.
 *
 * Copyright (c) 2015 - 2024 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me at sachatelgenhof dot com>
 */

namespace Yasumi\tests\France\HautRhin;

use Yasumi\tests\France\FranceBaseTestCase;
use Yasumi\tests\YasumiBase;

/**
 * Base class for test cases of the Haut-Rhin (France) holiday provider.
 */
abstract class HautRhinBaseTestCase extends FranceBaseTestCase
{
    use YasumiBase;

    /** Name of the region (e.g. country / state) to be tested. */
    public const REGION = 'France/HautRhin';

    /** Timezone in which this provider has holidays defined. */
    public const TIMEZONE = 'Europe/Paris';

    /** Locale that is considered common for this provider. */
    public const LOCALE = 'fr_FR';
}
