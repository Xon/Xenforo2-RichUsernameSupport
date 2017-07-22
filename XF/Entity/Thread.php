<?php

namespace SV\RichUsernameSupport\XF\Entity;

class Thread extends XFCP_Thread
{
	public function getLastPostCache()
	{
		$lastPost = parent::getLastPostCache();

		$lastPost['display_style_group_id'] = $this->LastPoster->display_style_group_id;

		return $lastPost;
	}
}