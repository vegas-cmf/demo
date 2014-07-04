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

namespace Vegas\Extensions\Forms;

class ErrorFormatter
{
    public static function renderErrors(\Vegas\Forms\Form $form)
    {
        $errorsMessages = array();

        $errors = $form->getMessages();

        foreach ($errors as $error) {
            $formElement = $form->get($error->getField());
            $errorsMessages[$formElement->getLabel()] = $error->getMessage();
        }

        return $errorsMessages;
    }
} 