<?php
namespace senansharhan\extensions\src\Model;
/**
 * Builder class for a Album object
 * version 1
 *
 * author: Senan Sharhan
 * copyright: Senan Sharhan <senan.sharhan@hotmail.com>
 */

require __DIR__ . '/AlbumObject.php';
use senansharhan\extensions\src\Model\AlbumObject;
use sgoendoer\Sonic\Date\XSDDateTime;
use sgoendoer\Sonic\Identity\GID;
use sgoendoer\Sonic\Identity\UOID;
use sgoendoer\Sonic\Model\IllegalModelStateException;
use sgoendoer\Sonic\Model\ObjectBuilder;


class AlbumObjectBuilder extends ObjectBuilder
{

    protected $owner = NULL;
    protected $title = NULL;
    protected $thumbnailUrl = NULL;
    protected $description = NULL;
    protected $mediaItemCount = NULL;
    protected $MediaItems = array();
    protected $datetime = NULL;


    public function __construct()
    {

    }

    public static function buildFromJSON($json)
    {

        $jsonObject = json_decode($json);

        $builder = (new AlbumObjectBuilder())
            ->objectID($jsonObject->objectID)
            ->owner($jsonObject->owner)
            ->title($jsonObject->title)
            ->thumbnailUrl($jsonObject->thumbnailUrl)
            ->description($jsonObject->description)
            ->dateTime($jsonObject->datetime);

        foreach ($jsonObject->MediaItems as $MediaItem) {
            $builder->addMediaItem(MediaItemObjectBuilder::buildFromJSON(json_encode($MediaItem)));
        }

        return $builder->build();
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function owner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }

    public function thumbnailUrl($thumbnailUrl)
    {
        $this->thumbnailUrl = $thumbnailUrl;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function description($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getMediaItemCount()
    {
        return $this->mediaItemCount;
    }

    public function mediaItemCount($mediaItemCount)
    {
        $this->mediaItemCount = $mediaItemCount;
        return $this;
    }

    public function getDatetime()
    {
        return $this->datetime;
    }

    public function datetime($datetime = NULL)
    {
        if ($datetime == NULL)
            $this->datetime = XSDDateTime::getXSDDateTime();
        else
            $this->datetime = $datetime;
        return $this;
    }


    public function addMediaItem($MediaItem)
    {
        $this->MediaItems[] = $MediaItem;
        return $this;
    }

    public function MediaItems($MediaItemArray)
    {
        $this->MediaItems = $MediaItemArray;
        return $this;
    }

    public function getMediaItems()
    {
        return $this->MediaItems;
    }

    public function build()
    {

        if ($this->objectID == NULL)
            $this->objectID = UOID::createUOID();
        if ($this->datetime == NULL)
            $this->datetime = XSDDateTime::getXSDDateTime();

        if (!UOID::isValid($this->objectID))
            throw new IllegalModelStateException('Invalid objectID');
        if (!GID::isValid($this->owner))
            throw new IllegalModelStateException('Invalid owner');
        if (!XSDDateTime::validateXSDDateTime($this->datetime))
            throw new IllegalModelStateException('Invalid datetime');
        if (!is_array($this->MediaItems))
            throw new IllegalModelStateException('Invalid MediaItems value');

        $AlbumObject = new AlbumObject($this);

        return $AlbumObject;
    }
}