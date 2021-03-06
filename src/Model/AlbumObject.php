<?php
namespace senansharhan\extensions\src\Model;

/**
 * Builder class for a Album object
 * version 1
 *
 * author: Senan Sharhan
 * copyright: Senan Sharhan <senan.sharhan@hotmail.com>
 */

use sgoendoer\Sonic\Date\XSDDateTime;
use sgoendoer\Sonic\Model\Object;


class AlbumObject extends Object
{

    const JSONLD_CONTEXT = 'http://sonic-project.net/';
    const JSONLD_TYPE = 'Album';

    protected $owner = NULL;
    protected $title = NULL;
    protected $thumbnailUrl = NULL;
    protected $description = NULL;
    protected $mediaItemCount = NULL;
    protected $MediaItems = array();
    protected $datetime = NULL;

    public function __construct(AlbumObjectBuilder $builder)
    {
        parent::__construct($builder->getObjectID());

        $this->owner = $builder->getOwner();
        $this->title = $builder->getTitle();
        $this->thumbnailUrl = $builder->getThumbnailUrl();
        $this->description = $builder->getDescription();
        $this->mediaItemCount = $builder->getMediaItemCount();
        $this->addMediaItemArray($builder->getMediaItems());
        $this->datetime = $builder->getDatetime();

    }


    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }

    public function setThumbnailUrl($thumbnailUrl)
    {
        $this->thumbnailUrl = $thumbnailUrl;
        return $this;
    }


    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getMediaItemCount()
    {
        return $this->mediaItemCount;
    }

    public function setMediaItemCount($mediaItemCount)
    {
        $this->mediaItemCount = $mediaItemCount;
        return $this;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }

    public function setDatetime($datetime = NULL)
    {
        if ($datetime == NULL)
            $this->datetime = XSDDateTime::getXSDDateTime();
        else
            $this->datetime = $datetime;
        return $this;
    }

    public function addMediaItemArray($MediaItemArray)
    {
        $this->MediaItems = array_merge($this->MediaItems, $MediaItemArray);
    }

    public function addMediaItem(MediaItemObject $MediaItem)
    {
        $this->MediaItems[] = $MediaItem;
    }

    public function getMediaItems()
    {
        return $this->MediaItems;
    }


    public function getJSONString()
    {

        $json = '{'
            . '"@context":"' . AlbumObject::JSONLD_CONTEXT . '",'
            . '"@type":"' . AlbumObject::JSONLD_TYPE . '",'
            . '"objectID":"' . $this->objectID . '",'
            . '"owner":"' . $this->owner . '",'
            . '"title":"' . $this->title . '",'
            . '"thumbnailUrl":"' . $this->thumbnailUrl . '",'
            . '"description":"' . $this->description . '",'
            . '"mediaItemCount":"' . $this->mediaItemCount . '",'
            . '"datetime":"' . $this->datetime . '",'
            . '"MediaItems":[';

        foreach ($this->MediaItems as $mediaItem) {
            $json .= $mediaItem->getJSONString();
            if ($mediaItem !== end($this->MediaItems)) $json .= ',';
        }
        $json .= ']}';

        return $json;
    }

}