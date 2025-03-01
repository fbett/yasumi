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

namespace Yasumi\tests\Japan;

use Yasumi\Holiday;
use Yasumi\tests\HolidayTestCase;

/**
 * Class for testing Health And Sports Day in Japan.
 */
class SportsDayTest extends JapanBaseTestCase implements HolidayTestCase
{
    /**
     * The name of the holiday.
     */
    public const HOLIDAY = 'sportsDay';

    /**
     * The year in which the holiday was first established.
     */
    public const ESTABLISHMENT_YEAR = 1996;

    /**
     * Tests Health And Sports Day in 2021. Health And Sports Day in 2021 is July 23th for rescheduled Olympic Games
     * after COVID-19.
     *
     * @throws \Exception
     */
    public function testSportsDayIn2021(): void
    {
        $year = 2021;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-7-23", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Health And Sports Day in 2020. Health And Sports Day in 2020 is July 24th for the Olympic Games.
     *
     * @throws \Exception
     */
    public function testSportsDayIn2020(): void
    {
        $year = 2020;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-7-24", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Health And Sports Day after 2000. Health And Sports Day was established since 1996 on October 10th. After
     * 2000 it was changed to be the second monday of October.
     *
     * @throws \Exception
     */
    public function testSportsDayAfter2000(): void
    {
        $year = $this->generateRandomYear(2001);

        // Some years the date has changed, so in this test we need to skip them.
        if (! in_array($year, [2020, 2021])) {
            $this->assertHoliday(
                self::REGION,
                self::HOLIDAY,
                $year,
                new \DateTime("second monday of october {$year}", new \DateTimeZone(self::TIMEZONE))
            );
        }
    }

    /**
     * Tests Health And Sports Day between 1996 and 2000. Health And Sports Day was established since 1996 on October
     * 10th. After 2000 it was changed to be the second monday of October.
     *
     * @throws \Exception
     */
    public function testSportsDayBetween1996And2000(): void
    {
        $year = 1997;
        $this->assertHoliday(
            self::REGION,
            self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-10", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Health And Sports Day between 1996 and 2000 substituted next working day (when Health And Sports Day falls
     * on a Sunday).
     *
     * @throws \Exception
     */
    public function testSportsDayBetween1996And2000SubstitutedNextWorkingDay(): void
    {
        $year = 1999;
        $this->assertHoliday(
            self::REGION,
            self::SUBSTITUTE_PREFIX . self::HOLIDAY,
            $year,
            new \DateTime("{$year}-10-11", new \DateTimeZone(self::TIMEZONE))
        );
    }

    /**
     * Tests Health And Sports Day before. Health And Sports Day was established since 1996 on October 10th. After
     * 2000 it was changed to be the second monday of October.
     *
     * @throws \Exception
     */
    public function testSportsDayBefore1996(): void
    {
        $this->assertNotHoliday(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(1000, self::ESTABLISHMENT_YEAR - 1)
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     * 1996-2019:Health And Sports Day.
     *
     * @throws \Exception
     */
    public function testTranslation(): void
    {
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR, 2019),
            [self::LOCALE => '体育の日']
        );
    }

    /**
     * Tests the translated name of the holiday defined in this test.
     * 2020 - :Sports Day.
     *
     * @throws \Exception
     */
    public function testTranslationFrom2020(): void
    {
        $year = 2020;
        $this->assertTranslatedHolidayName(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear($year),
            [self::LOCALE => 'スポーツの日']
        );
    }

    /**
     * Tests type of the holiday defined in this test.
     *
     * @throws \Exception
     */
    public function testHolidayType(): void
    {
        $this->assertHolidayType(
            self::REGION,
            self::HOLIDAY,
            $this->generateRandomYear(self::ESTABLISHMENT_YEAR),
            Holiday::TYPE_OFFICIAL
        );
    }
}
