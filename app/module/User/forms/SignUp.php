<?php
/**
 * This file is part of Vegas package
 *
 * @author Arkadiusz Ostrycharz <arkadiusz.ostrycharz@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage https://bitbucket.org/amsdard/vegas-phalcon
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace User\Forms;

use Vegas\Forms\Form,
    Phalcon\Forms\Element\Password,
    Phalcon\Forms\Element\Text,
    Vegas\Forms\Element\Cloneable,
    Phalcon\Validation\Validator\Email as EmailValidator,
    Phalcon\Validation\Validator\PresenceOf,
    Vegas\Forms\Element\Upload;
    
class SignUp extends Form
{
    public function initialize()
    {
        $config = $this->di->get('config');
        
        $email = new Text('email');
        $email->addValidator(new PresenceOf());
        $email->addValidator(new EmailValidator());
        $email->setAttribute('placeholder', 'john@onderzoeksraad.nl');
        $email->setAttribute('class', 'col-xs-12');
        $email->setLabel($this->i18n->_('Email'));
        $this->add($email);
        
        $password = new Password('raw_password');
        $password->addValidator(new PresenceOf());
        $password->setLabel($this->i18n->_('Password'));
        $password->setAttribute('class', 'col-xs-12');
        $this->add($password);

        $rePassword = new Password('repassword');
        $rePassword->addValidator(new PresenceOf());
        $rePassword->setLabel($this->i18n->_('Re-type Password'));
        $rePassword->setAttribute('class', 'col-xs-12');
        $this->add($rePassword);

    }
}
