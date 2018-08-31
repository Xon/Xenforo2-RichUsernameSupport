<?php

namespace SV\RichUsernameSupport\XF\Entity;

use SV\RichUsernameSupport\Entity\UserStyleGroup;
use XF\Mvc\Entity\Structure;

/**
 * @property UserStyleGroup LastPosterUserStyleGroup
 */
class Thread extends XFCP_Thread
{
    public function getLastPostCache()
    {
        $lastPost = parent::getLastPostCache();

        // avoid extra SQL query

        if (isset($this->_relations['LastPosterUserStyleGroup']))
        {
            $lastPost['display_style_group_id'] = $this->LastPosterUserStyleGroup->display_style_group_id;
        }
        else if (isset($this->_relations['LastPoster']))
        {
            $lastPost['display_style_group_id'] = $this->LastPoster->display_style_group_id;
        }
        else if (isset($this->_relations['LastPost']))
        {
            $lastPost['display_style_group_id'] = $this->LastPost->User->display_style_group_id;
        }

        return $lastPost;
    }

    /**
     * @param Structure $structure
     *
     * @return Structure
     */
    public static function getStructure(Structure $structure)
    {
        $structure = parent::getStructure($structure);

        $structure->relations['LastPosterUserStyleGroup'] = [
            'entity' => 'SV\RichUsernameSupport:UserStyleGroup',
            'type' => self::TO_ONE,
            'conditions' => [['user_id','=','$last_post_user_id']],
            'primary'    => true
        ];

        return $structure;
    }
}