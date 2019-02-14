<?php

namespace App\Repository;

class SettingRepo
{
    public function get($key)
    {
        $result = app('db')->createQueryBuilder()->select('value')
            ->from('setting')
            ->where("key = :key")
            ->setParameter('key', $key)
            ->setMaxResults(1)
            ->execute()->fetch();
        return $result['value'];
    }

    public function set($key, $value, $description = '')
    {
        if ($this->get($key)) {
            app('db')->update('setting', ['value' => $value], ['key' => $key]);
        } else {
            app('db')->insert('setting', ['key' => $key, 'value' => $value, 'description' => $description]);
        }
    }

    public function all()
    {
        return app('db')->createQueryBuilder()->select('*')
            ->from('setting')
            ->execute()->fetchAll();
    }
}