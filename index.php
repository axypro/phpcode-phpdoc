<?php
/**
 * Analysis of phpdoc blocks
 *
 * @package axy\phpcode\phpdoc
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 * @license https://raw.github.com/axypro/phpcode-phpdoc/master/LICENSE MIT
 * @link https://github.com/axypro/phpcode-phpdoc repository
 * @uses PHP5.4+
 */

namespace axy\phpcode\phpdoc;

if (!is_file(__DIR__.'/vendor/autoload.php')) {
    throw new \LogicException('Please: composer install');
}

require_once(__DIR__.'/vendor/autoload.php');
