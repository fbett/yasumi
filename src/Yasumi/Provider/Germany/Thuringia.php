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

namespace Yasumi\Provider\Germany;

use Yasumi\Exception\UnknownLocaleException;
use Yasumi\Holiday;
use Yasumi\Provider\DateTimeZoneFactory;
use Yasumi\Provider\Germany;

/**
 * Provider for all holidays in Thuringia (Germany).
 *
 * The Free State of Thuringia is a federal state of Germany, located in the central part of the country. It has an area
 * of 16,171 square kilometres (6,244 sq mi) and 2.29 million inhabitants, making it the sixth-smallest by area and the
 * fifth-smallest by population of Germany's sixteen states. Most of Thuringia is within the watershed of the Saale, a
 * left tributary of the Elbe. Its capital is Erfurt.
 *
 * @see https://en.wikipedia.org/wiki/Thuringia
 */
class Thuringia extends Germany
{
    /**
     * Code to identify this Holiday Provider. Typically, this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'DE-TH';

    /**
     * Initialize holidays for Thuringia (Germany).
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        // Add custom Christian holidays
        $this->calculateReformationDay();

        // Other holidays
        $this->calculateWorldChildrensDay();
    }

    /**
     * For the German state of Thuringia, Reformation Day was celebrated since 1517.
     * Note: In 2017 all German states will celebrate Reformation Day for its 500th anniversary.
     *
     * @throws \InvalidArgumentException
     * @throws UnknownLocaleException
     * @throws \Exception
     */
    protected function calculateReformationDay(): void
    {
        if ($this->year < 1517) {
            return;
        }

        $this->addHoliday($this->reformationDay($this->year, $this->timezone, $this->locale));
    }

    /**
     * For the German state of Thuringia, World Children's Day is celebrated since 2019.
     *
     * @throws \Exception
     */
    protected function calculateWorldChildrensDay(): void
    {
        if ($this->year < 2019) {
            return;
        }

        $this->addHoliday(new Holiday(
            'worldChildrensDay',
            ['de' => 'Weltkindertag'],
            new \DateTimeImmutable(sprintf('%d-09-20', $this->year), DateTimeZoneFactory::getDateTimeZone($this->timezone)),
            $this->locale,
            Holiday::TYPE_OFFICIAL
        ));
    }
}
