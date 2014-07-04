<?php
/**
 * This file is part of Vegas package
 *
 * @author Arkadiusz Ostrycharz <arkadiusz.ostrycharz@gmail.com>
 * @copyright Amsterdam Standard Sp. Z o.o.
 * @homepage http://vegas-cmf.github.io
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace User\Models;

use Auth\Models\BaseUser;

class User extends BaseUser
{
    const WIDGET_INVESTIGATIONS_LIMIT = 3;

    public function beforeCreate() 
    {
        parent::beforeCreate();
        $this->generateSlug($this->email);
    }

    public function getSource()
    {
        return 'vegas_users';
    }

    public function getFirstLastName() 
    {
        return sprintf('%s %s', $this->first_name, $this->last_name);
    }

    public function getAvatar($width = null, $height = null)
    {
        if (!empty($this->files)) {
            $files = $this->getFiles();
            
            if ($width && $height) {
                $filePath = $files[0]->getThumbnailPath($width, $height);
                if (file_exists($filePath)) {
                    $fileUrl = $files[0]->getThumbnailUrl($width, $height);
                } else {
                    $fileUrl = $files[0]->getUrl();
                }
            } else {
                $fileUrl = $files[0]->getUrl();
            }
            
            return $fileUrl;
        }
        
        return '/assets/themes/main/img/noimage.png';
    }
    
    public function getSkillsArray()
    {
        return $this->getDividedBySemicolon($this->skills);
    }
    
    public function getInterestsArray()
    {
        return $this->getDividedBySemicolon($this->interests);
    }
    
    private function getDividedBySemicolon($data)
    {
        $dataArray = explode(';',$data);
        $filteredData = array();
        
        foreach ($dataArray As $value) {
            $filteredValue = trim(strip_tags($value));
            
            if (!empty($filteredValue)) {
                $filteredData[] = $filteredValue;
            }
        }
        
        return $filteredData;
    }

    public function findForSearch($keyword, $limit=null) 
    {
        return $this->find([
            'conditions' => [
                '$or' => [
                    ['first_name' => new \MongoRegex("/.*{$keyword}.*/i")],
                    ['last_name' => new \MongoRegex("/.*{$keyword}.*/i")],
                    ['email' => new \MongoRegex("/.*{$keyword}.*/i")]
                ]
            ],
           'limit' => (int)$limit
        ]);
    }
} 
