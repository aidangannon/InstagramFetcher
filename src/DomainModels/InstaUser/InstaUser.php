<?php


namespace InstaFetcher\DomainModels\InstaUser;


use InstaFetcher\DomainModels\Session\InstaSession;

class InstaUser
{
    private string $id;
    private InstaSession $session;

    public function __construct(string $id, InstaSession $session){
        $this->id=$id;
        $this->session=$session;
    }

    public function getId(): string{
        return $this->id;
    }

    public function getSession(): InstaSession
    {
        return $this->session;
    }
}