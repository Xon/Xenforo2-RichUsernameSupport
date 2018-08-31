<?php

namespace SV\RichUsernameSupport\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

/**
 * COLUMNS
 * @property int display_style_group_id
 *
 * RELATIONS
 * @property \XF\Entity\User User
 */
class UserStyleGroup extends Entity
{
    /**
     * @param Structure $structure
     * @return Structure
     */
    public static function getStructure(Structure $structure)
    {
        $structure->table = 'xf_user';
        $structure->shortName = 'SV\RichUsernameSupport:UserStyleGroup';
        $structure->primaryKey = 'user_id';
        $structure->columns = [
            'user_id'           => ['type' => self::UINT, 'required' => true],
            'display_style_group_id' => ['type' => self::UINT, 'required' => true],
        ];
        $structure->relations = [
            'User'     => [
                'entity'     => 'XF:User',
                'type'       => self::TO_ONE,
                'conditions' => 'user_id',
                'primary'    => true
            ],
        ];

        return $structure;
    }
}