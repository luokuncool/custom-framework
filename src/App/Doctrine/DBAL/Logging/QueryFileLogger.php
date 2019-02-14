<?php


namespace App\Doctrine\DBAL\Logging;


use DI\Annotation\Inject;
use Doctrine\DBAL\Logging\SQLLogger;
use Monolog\Logger;

class QueryFileLogger implements SQLLogger
{
    /**
     * @Inject("logger")
     * @var Logger
     */
    private $logger;

    /**
     * If Debug Stack is enabled (log queries) or not.
     *
     * @var boolean
     */
    public $enabled = true;

    /**
     * @var float|null
     */
    public $start = null;

    /**
     * @var array
     */
    public $currentQuery = [];

    /**
     * {@inheritdoc}
     */
    public function startQuery($sql, array $params = null, array $types = null)
    {
        if ($this->enabled) {
            $this->start = microtime(true);
            $this->currentQuery = array('sql' => $sql, 'params' => $params, 'types' => $types, 'executionMS' => 0);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function stopQuery()
    {
        if ($this->enabled) {
            $this->currentQuery['executionMS'] = microtime(true) - $this->start;
            $this->logger->debug('', $this->currentQuery);
            $this->currentQuery = [];
        }
    }
}