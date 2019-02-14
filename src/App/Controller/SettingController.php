<?php


namespace App\Controller;


use App\Repository\SettingRepo;
use DI\Annotation\Inject;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SettingController
{
    /**
     * @Inject()
     * @var SettingRepo
     */
    private $settingRepo;

    public function set($params)
    {
        $this->settingRepo->set($params['key'], $params['value']);
        return new Response("Set \"{$params['key']}\" value to \"{$params['value']}\"");
    }

    public function get($params)
    {
        return new Response(app(SettingRepo::class)->get($params['key']));
    }

    public function all()
    {
        return new JsonResponse($this->settingRepo->all());
    }
}