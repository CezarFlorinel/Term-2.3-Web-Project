<?php
namespace App\Models\Custom_Pages;

class CustomPage implements \JsonSerializable
{
    public int $customPageID;
    public string $content;
    public string $timeStamp;
    public string $title;

    public function __construct(int $customPageID, string $content, string $timeStamp, string $title)
    {
        $this->customPageID = $customPageID;
        $this->content = $content;
        $this->timeStamp = $timeStamp;
        $this->title = $title;
    }
    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}