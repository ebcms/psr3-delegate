<?php declare (strict_types = 1);

namespace Ebcms;

use Psr\Log\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Psr\Log\LogLevel;

class LoggerDelegate implements LoggerInterface
{
    use LoggerTrait;

    /**
     * @var LoggerInterface[] $loggers
     */
    protected $loggers = [];

    public function addLogger(LoggerInterface $logger)
    {
        $this->loggers[] = $logger;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     *
     * @return void
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function log($level, $message, array $context = array())
    {
        if (!in_array($level, [
            LogLevel::EMERGENCY,
            LogLevel::ALERT,
            LogLevel::CRITICAL,
            LogLevel::ERROR,
            LogLevel::WARNING,
            LogLevel::NOTICE,
            LogLevel::INFO,
            LogLevel::DEBUG])
        ) {
            throw new InvalidArgumentException('Unsupported log level:' . $level);
        }

        foreach ($this->loggers as $logger) {
            $logger->log($level, $message, $context);
        }
    }
}
