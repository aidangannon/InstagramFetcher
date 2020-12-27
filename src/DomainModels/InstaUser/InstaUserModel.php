<?php


namespace InstaFetcher\DomainModels\InstaUser;


use InstaFetcher\DomainModels\Session\FacebookGraphSessionModel;

class InstaUserModel
{
    private string $id;
    private FacebookGraphSessionModel $session;

    public function __construct(string $id, FacebookGraphSessionModel $session){
        $this->id=$id;
        $this->session=$session;
    }

    public function getId(): string{
        return $this->id;
    }

    public function getSession(): FacebookGraphSessionModel
    {
        return $this->session;
    }
}