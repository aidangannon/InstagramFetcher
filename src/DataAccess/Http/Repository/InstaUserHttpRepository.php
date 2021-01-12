<?php
declare(strict_types=1);

namespace InstaFetcher\DataAccess\Http\Repository;


use InstaFetcher\DataAccess\Http\Exception\InstaUserNotFound;
use InstaFetcher\Interfaces\DataAccess\Http\Dao\IFacebookPageDao;
use InstaFetcher\Interfaces\DataAccess\Http\Dao\IInstaUserDao;
use InstaFetcher\Interfaces\DataAccess\Repository\IInstaUserRepository;
use InstaFetcher\DomainModels\InstaUser\InstaUserModel;
use InstaFetcher\DomainModels\Session\FacebookGraphSessionModel;

/**
 * http data access implementation for instagram user
 */
class InstaUserHttpRepository implements IInstaUserRepository
{

    private FacebookGraphSessionModel $session;
    private IFacebookPageDao $pageDao;
    private IInstaUserDao $userDao;

    public function __construct(FacebookGraphSessionModel $session, IFacebookPageDao $pagesDao, IInstaUserDao $userDao)
    {
        $this->session = $session;
        $this->pageDao = $pagesDao;
        $this->userDao = $userDao;
    }

    public function getByHandle(string $handle): InstaUserModel
    {
        $token=$this->session->getToken();
        $pages = $this->pageDao->getInstaAccounts($token);

        foreach($pages->data as $page){

            if(isset($page->instaUser)){
                $user = $page->instaUser;

                if($handle===$user->username){
                    return new InstaUserModel($user->id,$user->followersCount,$user->username);
                }
            }
        }

        throw new InstaUserNotFound($handle);
    }

    public function get(string $id): InstaUserModel
    {
        $userDto = $this->userDao->getInstaInfo($id,$this->session->getToken());
        return new InstaUserModel($userDto->id,$userDto->followersCount,$userDto->username);
    }
}