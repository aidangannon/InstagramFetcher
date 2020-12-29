<?php


namespace InstaFetcher\DomainModels\InstaUser;


use InstaFetcher\DomainModels\Session\FacebookGraphSessionModel;

class InstaUserModel
{
    private string $id;
    private int $followers;
    private string $handle;
    private FacebookGraphSessionModel $session;

    public function __construct(string $id, int $followers, string $handle, ?FacebookGraphSessionModel $session=null)
    {
        $this->id = $id;
        $this->followers = $followers;
        $this->handle = $handle;
        if (isset($session)){
            $this->session = $session;
        }
    }

    public function getFollowers(): int
    {
        return $this->followers;
    }

    public function getHandle(): string
    {
        return $this->handle;
    }

    public function getId(): string{
        return $this->id;
    }

    public function getSession(): FacebookGraphSessionModel
    {
        return $this->session;
    }
}