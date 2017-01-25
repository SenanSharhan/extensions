<?php namespace senansharhan\extensions\src\Api;

use sgoendoer\Sonic\Request\OutgoingRequest;
use sgoendoer\Sonic\Api\AbstractRequestBuilder;
use senansharhan\extensions\src\Model\AlbumObject;

/**
 * Builder class for a Album request
 * version 1
 *
 * author: Senan Sharhan
 * copyright: Senan Sharhan <senan.sharhan@hotmail.com>
 */
class AlbumRequestBuilder extends AbstractRequestBuilder
{
    const RESOURCE_NAME_ALBUM = 'ALBUM';

    public function createGETAlbums()
    {
        $this->request = new OutgoingRequest();

        $this->request->setServer($this->getDomainFromProfileLocation($this->targetSocialRecord->getProfileLocation()));
        $this->request->setPath($this->getPathFromProfileLocation($this->targetSocialRecord->getProfileLocation()) . $this->targetSocialRecord->getGlobalID() . '/' . self::RESOURCE_NAME_ALBUM );
        $this->request->setRequestMethod('GET');

        return $this;
    }

/*    public function createGETLike($likeUOID)
    {
        $this->request = new OutgoingRequest();

        $this->request->setServer($this->getDomainFromProfileLocation($this->targetSocialRecord->getProfileLocation()));
        $this->request->setPath($this->getPathFromProfileLocation($this->targetSocialRecord->getProfileLocation()) . $this->targetSocialRecord->getGlobalID() . '/' . self::RESOURCE_NAME_LIKE . '/' . $likeUOID);
        $this->request->setRequestMethod('GET');

        return $this;
    }*/
}

?>