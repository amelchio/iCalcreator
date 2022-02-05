<?php
/**
 * iCalcreator, the PHP class package managing iCal (rfc2445/rfc5445) calendar information.
 *
 * This file is a part of iCalcreator.
 *
 * @author    Kjell-Inge Gustafsson, kigkonsult <ical@kigkonsult.se>
 * @copyright 2007-2022 Kjell-Inge Gustafsson, kigkonsult, All rights reserved
 * @link      https://kigkonsult.se
 * @license   Subject matter of licence is the software iCalcreator.
 *            The above copyright, link, package and version notices,
 *            this licence notice and the invariant [rfc5545] PRODID result use
 *            as implemented and invoked in iCalcreator shall be included in
 *            all copies or substantial portions of the iCalcreator.
 *
 *            iCalcreator is free software: you can redistribute it and/or modify
 *            it under the terms of the GNU Lesser General Public License as
 *            published by the Free Software Foundation, either version 3 of
 *            the License, or (at your option) any later version.
 *
 *            iCalcreator is distributed in the hope that it will be useful,
 *            but WITHOUT ANY WARRANTY; without even the implied warranty of
 *            MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *            GNU Lesser General Public License for more details.
 *
 *            You should have received a copy of the GNU Lesser General Public License
 *            along with iCalcreator. If not, see <https://www.gnu.org/licenses/>.
 */
declare( strict_types = 1 );
namespace Kigkonsult\Icalcreator\Traits;

use Kigkonsult\Icalcreator\Util\StringFactory;
use Kigkonsult\Icalcreator\Util\Util;
use Kigkonsult\Icalcreator\Util\ParameterFactory;

/**
 * SUMMARY property functions
 *
 * @since 2.40.11 2022-01-15
 */
trait SUMMARYtrait
{
    /**
     * @var null|mixed[] component property SUMMARY value
     */
    protected ? array $summary = null;

    /**
     * Return formatted output for calendar component property summary
     *
     * @return string
     */
    public function createSummary() : string
    {
        if( empty( $this->summary )) {
            return Util::$SP0;
        }
        if( empty( $this->summary[Util::$LCvalue] )) {
            return $this->getConfig( self::ALLOWEMPTY )
                ? StringFactory::createElement( self::SUMMARY )
                : Util::$SP0;
        }
        return StringFactory::createElement(
            self::SUMMARY,
            ParameterFactory::createParams(
                $this->summary[Util::$LCparams],
                self::$ALTRPLANGARR,
                $this->getConfig( self::LANGUAGE )
            ),
            StringFactory::strrep( $this->summary[Util::$LCvalue] )
        );
    }

    /**
     * Delete calendar component property summary
     *
     * @return bool
     * @since  2.27.1 - 2018-12-15
     */
    public function deleteSummary() : bool
    {
        $this->summary = null;
        return true;
    }

    /**
     * Get calendar component property summary
     *
     * @param null|bool   $inclParam
     * @return bool|string|mixed[]
     * @since  2.27.1 - 2018-12-12
     */
    public function getSummary( ? bool $inclParam = false ) : array | bool | string
    {
        if( empty( $this->summary )) {
            return false;
        }
        return $inclParam ? $this->summary : $this->summary[Util::$LCvalue];
    }

    /**
     * Set calendar component property summary
     *
     * @param null|string   $value
     * @param null|mixed[]  $params
     * @return static
     * @since 2.29.14 2019-09-03
     */
    public function setSummary( ? string $value = null, ? array $params = [] ) : static
    {
        if( empty( $value )) {
            $this->assertEmptyValue( $value, self::SUMMARY );
            $value  = Util::$SP0;
            $params = [];
        }
        Util::assertString( $value, self::SUMMARY );
        $this->summary = [
            Util::$LCvalue  => (string) $value,
            Util::$LCparams => ParameterFactory::setParams( $params ),
        ];
        return $this;
    }
}
