<?php
/**
 * This file is part of Vegas package
 *
 * @author Slawomir Zytko <slawomir.zytko@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace User\Services\Exception;

use Vegas\Exception as VegasException;

/**
 * Class InvalidFormException
 * @package User\Services\Exception
 */
class InvalidFormException extends VegasException
{
    protected $message = 'Form contains errors';

    protected $errors = array();

    public function __construct(\Vegas\Forms\Form $form)
    {
        $this->errors = \Vegas\Extensions\Forms\ErrorFormatter::renderErrors($form);
    }

    public function getErrors()
    {
        return $this->errors;
    }
} 