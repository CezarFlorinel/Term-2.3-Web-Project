<?php
namespace App\Models\History_event;

class HistoryPracticalInformation implements \JsonSerializable
{
    public int $informationID;
    public string $question;
    public string $answer;

    public function __construct(int $informationID, string $question, string $answer)
    {
        $this->informationID = $informationID;
        $this->question = $question;
        $this->answer = $answer;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }


}