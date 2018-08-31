<?php

namespace SV\RichUsernameSupport\XF\Repository;



/**
 * Extends \XF\Repository\Thread
 */
class Thread extends XFCP_Thread
{
    /**
     * @param \XF\Entity\Forum $forum
     * @param array            $limits
     * @return \XF\Finder\Thread
     */
    public function findThreadsForForumView(\XF\Entity\Forum $forum, array $limits = [])
    {
        $finder = parent::findThreadsForForumView($forum, $limits);

        $map = $finder->getHydrationMap();
        if (empty($map['LastPoster']) && empty($map['LastPost']) && empty($map['LastPosterUserStyleGroup']))
        {
            $finder->with('LastPosterUserStyleGroup');
        }

        return $finder;
    }
}