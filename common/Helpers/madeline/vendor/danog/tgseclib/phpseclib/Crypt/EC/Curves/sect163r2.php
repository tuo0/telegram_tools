<?php

/**
 * sect163r2
 *
 * PHP version 5 and 7
 *
 * @category  Crypt
 * @package   EC
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2017 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://pear.php.net/package/Math_BigInteger
 */
namespace tgseclib\Crypt\EC\Curves;

use tgseclib\Crypt\EC\BaseCurves\Binary;
use tgseclib\Math\BigInteger;
class sect163r2 extends Binary
{
    public function __construct()
    {
        $this->setModulo(163, 7, 6, 3, 0);
        $this->setCoefficients('000000000000000000000000000000000000000001', '020A601907B8C953CA1481EB10512F78744A3205FD');
        $this->setBasePoint('03F0EBA16286A2D57EA0991168D4994637E8343E36', '00D51FBC6C71A0094FA2CDD545B11C5C0C797324F1');
        $this->setOrder(new BigInteger('040000000000000000000292FE77E70C12A4234C33', 16));
    }
}