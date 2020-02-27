<?php
class EmailEnvelope
{
    private $sender;
    private $addresses;

    private $subject;
    private $body;

    function __construct(string $sender, array $addresses, string $subject, string $body)
    {
        $this->sender = $sender;
        $this->addresses = $addresses;
        $this->body = $body;
        $this->subject = $subject;
    }

    function getSender()
    {
        return $this->sender;
    }

    function getAddresses()
    {
        return $this->addresses;
    }

    function getSubject()
    {
        return $this->subject;
    }

    function getBody()
    {
        return $this->body;
    }
}
