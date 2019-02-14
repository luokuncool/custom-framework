<?php

namespace App\Repository;

use DI\Annotation\Inject;
use Doctrine\DBAL\Connection;

class SettingRepo
{
    /**
     * @Inject("db")
     * @var Connection
     */
    private $db;

    public function get($key)
    {
        $result = $this->db->createQueryBuilder()->select('value')
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
            $this->db->update('setting', ['value' => $value], ['key' => $key]);
        } else {
            $this->db->insert('setting', ['key' => $key, 'value' => $value, 'description' => $description]);
        }
    }

    public function all()
    {
        return $this->db->createQueryBuilder()->select('*')
            ->from('setting')
            ->execute()->fetchAll();
    }
}