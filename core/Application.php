<?php

namespace Core;

use Throwable;
use ErrorException;

class Application
{
    /**
     * The base path of the application installation.
     *
     * @var string
     */
    protected $basePath;

    /**
     * Create a new application instance.
     *
     * @param  string|null  $basePath
     * @return void
     */
    public function __construct($basePath = null)
    {
        $this->basePath = $basePath;

        $this->registerErrorHandling();
    }

    /**
     * Set the error handling for the application.
     *
     * @return void
     */
    protected function registerErrorHandling()
    {
        error_reporting(-1);

        set_error_handler(function ($level, $message, $file = '', $line = 0) {
            if (error_reporting() & $level) {
                throw new ErrorException($message, 0, $level, $file, $line);
            }
        });

        set_exception_handler(function ($e) {
            $this->handleException($e);
        });
    }

    /**
     * Handle an uncaught exception instance.
     *
     * @param  \Throwable  $e
     * @return responseJson()
     */
    protected function handleException(Throwable $e)
    {
        echo responseJson(500, ['file' => $e->getFile(), 'line' => $e->getLine(), 'trace' => $e->getTrace()], ['title' => $e->getMessage()]);
    }
}
