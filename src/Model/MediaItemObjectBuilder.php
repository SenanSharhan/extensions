<?php
namespace senansharhan\extensions\src\Model;

/**
 * Builder class for a Album object
 * version 1
 *
 * author: Senan Sharhan
 * copyright: Senan Sharhan <senan.sharhan@hotmail.com>
 */

require __DIR__ . '/MediaItemObject.php';
use senansharhan\extensions\src\Model\MediaItemObject;
use sgoendoer\Sonic\Date\XSDDateTime;
use sgoendoer\Sonic\Identity\UOID;
use sgoendoer\Sonic\Model\IllegalModelStateException;
use sgoendoer\Sonic\Model\ReferencingObjectBuilder;


class MediaItemObjectBuilder extends ReferencingObjectBuilder
{

    protected $mimetype = NULL;
    protected $type = NULL;
    protected $url = NULL;
    protected $datetime = NULL;

    public function __construct()
    {

    }

    public static function buildFromJSON($json)
    {
        // TODO parse and verify json
        $jsonObject = json_decode($json);

        return (new MediaItemObjectBuilder())
            ->objectID($jsonObject->objectID)
            ->targetID($jsonObject->targetID)
            ->mimetype($jsonObject->mimetype)
            ->type($jsonObject->type)
            ->url($jsonObject->url)
            ->datetime($jsonObject->datetime)
            ->build();
    }


    public function getMimetype()
    {
        return $this->mimetype;
    }

    public function mimetype($mimetype)
    {
        $this->mimetype = $mimetype;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function type($type)
    {
        $this->type = $type;
        return $this;
    }


    public function getUrl()
    {
        return $this->url;
    }

    public function url($url)
    {
        $this->url = $url;
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

    public function build()
    {

        if ($this->objectID == NULL)
            $this->objectID = UOID::createUOID();
        if ($this->datetime == NULL)
            $this->datetime = XSDDateTime::getXSDDateTime();

        if (!UOID::isValid($this->objectID))
            throw new IllegalModelStateException('Invalid objectID');
        if (!UOID::isValid($this->targetID))
            throw new IllegalModelStateException('Invalid targetID');
        if (!XSDDateTime::validateXSDDateTime($this->datetime))
            throw new IllegalModelStateException('Invalid datePublished');

        $MediaItemObject = new MediaItemObject($this);

        return $MediaItemObject;
    }
}