<?php
class EmailEnvelope
{
    private $sender;
    private $addresses;

    private $subject;
    private $body;
    private $attachments;

    function __construct(string $sender, array $addresses, string $subject, string $body, array $attachments)
    {
        $this->sender = $sender;
        $this->addresses = $addresses;
        $this->body = $body;
        $this->subject = $subject;
        $this->attachments = $attachments;
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

    function getAttachments()
    {
        return $this->attachments;
    }
}
