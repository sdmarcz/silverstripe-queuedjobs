<?php

namespace Symbiote\QueuedJobs\Tests\QueuedJobsTest;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;
use SilverStripe\Dev\TestOnly;

/**
 * Logger for recording messages for later retrieval
 */
class QueuedJobsTest_Handler extends AbstractProcessingHandler implements TestOnly
{
    public function __construct()
    {
        // It's important that we call parent::__contruct() here in case we construct
        // this class passing in the QueuedJobsHandler::__construct() parameters:
        // (QueuedJob $job, QueuedJobDescriptor $jobDescriptor)
        // This is because AbstractProcessingHandlers construtor in AbstractHandler::__construct()
        // has a totally different signature:
        // (int|string|Level $level = Level::Debug, bool $bubble = true)
        parent::__construct();
    }

    /**
     * Messages
     *
     * @var array
     */
    protected $messages = array();

    /**
     * Get all messages
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    public function clear()
    {
        $this->messages = array();
    }

    protected function write(LogRecord $record): void
    {
        $this->messages[] = $record->message;
    }
}
