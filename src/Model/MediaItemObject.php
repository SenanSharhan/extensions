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
use sgoendoer\Sonic\Model\ReferencingObject;


class MediaItemObject extends ReferencingObject
{

    const JSONLD_CONTEXT = 'http://sonic-project.net/';
    const JSONLD_TYPE = 'MediaItem';

    protected $mimetype = NULL;
    protected $type = NULL;
    protected $url = NULL;
    protected $datetime = NULL;


    public function __construct(MediaItemObjectBuilder $builder)
    {
        parent::__construct($builder->getObjectID(), $builder->getTargetID());

        $this->mimetype = $builder->getMimetype();
        $this->type = $builder->getType();
        $this->url = $builder->getUrl();
        $this->datetime = $builder->getDatetime();

    }


    public function getMimetype()
    {
        return $this->mimetype;
    }

    public function setMimetype($mimetype)
    {
        $this->mimetype = $mimetype;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
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


    public function getJSONString()
    {

        $json = '{'
            . '"@context":"' . MediaItemObject::JSONLD_CONTEXT . '",'
            . '"@type":"' . MediaItemObject::JSONLD_TYPE . '",'
            . '"objectID":"' . $this->objectID . '",'
            . '"targetID":"' . $this->targetID . '",'
            . '"mimetype":"' . $this->mimetype . '",'
            . '"type":"' . $this->type . '",'
            . '"url":"' . $this->url . '",'
            . '"datetime":"' . $this->datetime . '"'
            . '}';

        return $json;
    }
}