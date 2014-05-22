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
    Vegas\Forms\Element\Birthdaypicker,
    Vegas\Forms\Element\Datepicker,
    Phalcon\Forms\Element\Password,
    Phalcon\Forms\Element\Select,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\TextArea,
    Vegas\Forms\Element\Cloneable,
    Vegas\Forms\Element\RichTextArea,
    Phalcon\Validation\Validator\Email as EmailValidator,
    Phalcon\Validation\Validator\PresenceOf,
    Vegas\Validation\Validator\Phone,
    Vegas\Validation\Validator\Url,
    Vegas\Forms\Element\Upload;
    
class User extends Form
{
    public function initialize()
    {
        $config = $this->di->get('config');

        $avatar = new Upload('avatar');
        $avatar->setMode(Upload::MODE_SINGLE);
        $avatar->setPreviewSize(array('width' => '184', 'height' => '184'));
        $avatar->setUploadUrl($config['user']['uploadUrl']);
        $avatar->setButtonLabels(array('add' => '<i class="fa fa-pencil"></i> '.$this->i18n->_('Change')));
        $avatar->setLabel($this->i18n->_('Profile Photo'));
        $avatar->setAssetsManager($this->assets);
        $avatar->setAutoUpload(true);
        $this->add($avatar);
        
        $mail = new Text('email');
        $mail->addValidator(new PresenceOf());     
        $mail->addValidator(new EmailValidator());
        $mail->setAttribute('placeholder', 'john@onderzoeksraad.nl');
        $mail->setAttribute('class', 'col-xs-12');
        $mail->setLabel($this->i18n->_('Email'));
        $this->add($mail);
        
        $password = new Password('raw_password');
        $password->setLabel($this->i18n->_('Password'));
        $password->setAttribute('class', 'col-xs-12');
        $this->add($password);
        
        $firstname = new Text('first_name');
        $firstname->addValidator(new PresenceOf());
        $firstname->setLabel($this->i18n->_('First name'));
        $firstname->setAttribute('class', 'col-xs-12');
        $this->add($firstname);
        
        $lastname = new Text('last_name');
        $lastname->addValidator(new PresenceOf());
        $lastname->setLabel($this->i18n->_('Last name'));
        $lastname->setAttribute('class', 'col-xs-12');
        $this->add($lastname);

        $group = new Select('group_id');
        $group->setOptions(array('' => ''));
        $group->setLabel($this->i18n->_('Group'));
        $this->add($group);
        
        $mobile = new Text('mobile');
        $mobile->setAttribute('placeholder', '0612345678');
        $mobile->setAttribute('class','col-xs-12');
        $mobile->addValidator(new Phone());
        $mobile->setLabel($this->i18n->_('Mobile phone'));
        $this->add($mobile);
        
        $phone = new Text('phone_internal');
        $phone->setAttribute('placeholder', '020 123 456 67');
        $phone->setAttribute('class','col-xs-12');
        $phone->addValidator(new Phone());
        $phone->setLabel($this->i18n->_('Internal phone'));
        $this->add($phone);

        $date = new Birthdaypicker('date_of_birth');
        $date->setLabel($this->i18n->_('Date of birth'));
        $date->setAssetsManager($this->assets);
        $date->setAttribute('class', 'col-xs-12');
        $date->setAttribute('placeholder', '1986-10-22');
        $this->add($date);

        $position = new Text('position');
        $position->setAttribute('placeholder', 'Onderzoeker');
        $position->setAttribute('class', 'col-xs-12');
        $position->setLabel($this->i18n->_('Position'));
        $this->add($position);

        $department = new Text('department');
        $department->setAttribute('placeholder', 'Afdeling');
        $department->setAttribute('class', 'col-xs-12');
        $department->setLabel($this->i18n->_('Afdeling'));
        $this->add($department);
        
        $residency = new Text('residency');
        $residency->setAttribute('placeholder', 'Amsterdam');
        $residency->setAttribute('class','col-xs-12');
        $residency->setLabel($this->i18n->_('Residsency'));
        $this->add($residency);   
        
        $twitter = new Text('twitter');
        $twitter->setAttribute('class', 'col-xs-11');
        $twitter->setAttribute('placeholder', 'Typ hier uw twitter URL');
        $twitter->addValidator(new Url());
        $twitter->setLabel($this->i18n->_('Twitter'));
        $this->add($twitter);   
        
        $linkedin = new Text('linkedin');
        $linkedin->setAttribute('class', 'col-xs-11');
        $linkedin->setAttribute('placeholder', 'Typ hier uw linkeding URL');
        $linkedin->addValidator(new Url());
        $linkedin->setLabel($this->i18n->_('LinkedIn'));
        $this->add($linkedin);   

        $startDate = new Datepicker('start_date');
        $startDate->setLabel('Vanaf');
        $startDate->setAttribute('class', 'w152');
        $startDate->setAttribute('placeholder', '01-2012');
        $startDate->setAssetsManager($this->assets);
        
        $finishDate = new Datepicker('finish_date');
        $finishDate->setLabel('Tot');
        $finishDate->setAttribute('class', 'w152');
        $finishDate->setAttribute('placeholder', '04-2012');
        $finishDate->setAssetsManager($this->assets); 

        $name = new Text('name');
        $name->setAttribute('placeholder', 'Name');
        $name->setLabel('BEDRIJF + FUNCTIE');
        $name->setAttribute('class', 'span489');

        $education = new Cloneable('education');
        $education->setAssetsManager($this->assets);
        $education->setBaseElements(array(
            $startDate,
            $finishDate,
            $name->setAttribute('placeholder','CSI University - Social Management')
        ));
        $education->setLabel($this->i18n->_('Education'));
        $this->add($education);   

        $name = clone $name;

        $experience = new Cloneable('experience');
        $experience->setAssetsManager($this->assets);
        $experience->setBaseElements(array(
            $startDate,
            $finishDate,
            $name->setAttribute('placeholder', 'Onderzoeksraad voor Veiligheid - Onderzoeker')
        ));
        $experience->setLabel($this->i18n->_('Experience'));
        $this->add($experience);

        $name = clone $name;

        $courses = new Cloneable('courses');
        $courses->setBaseElements(array(
            $startDate,
            $finishDate,
            $name->setAttribute('placeholder', 'Hogeschool van Amsterdam - Commerciele economie')
        ));
        $courses->setAssetsManager($this->assets);
        $courses->setLabel($this->i18n->_('Courses'));
        $this->add($courses);

        $skills = new TextArea('skills');
        $skills->setLabel($this->i18n->_('Skills'));
        $this->add($skills);
        
        $info = new RichTextArea('personal_info');
        $info->setAssetsManager($this->assets);
        $info->setLabel($this->i18n->_('Personal information'));
        $this->add($info);

        $interests = new TextArea('interests');
        $interests->setLabel($this->i18n->_('Interests'));
        $this->add($interests);
    }
}
