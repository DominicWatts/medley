<?php

namespace App\ApiEntity;

class ApiTrack
{
    public $name;
    public $url;
    public $created_at;
    public $tags;

    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->url = $data['url'];
        $this->created_at = $data['createdAt'];
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at): DateTime
    {
        $this->created_at = $created_at;
    }

    public function getUrl(): String
    {
        return $this->url;
    }

    public function setUrl(String $url)
    {
        $this->url = $url;
    }

    public function getName(): String
    {
        return $this->name;
    }

    public function setName(String $name)
    {
        $this->name = $name;
    }

    public function hasTags()
    {
        return (bool) $this->tags;
    }

    public function setTags(array $tags)
    {
        $this->tags = $tags;
    }

    public function getTags()
    {
        return $this->tags;
    }
}
