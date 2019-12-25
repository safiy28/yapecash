<?php


namespace App\Facades\Logger;

use App\Models\Setting;
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LogWriter {
    protected $logger;
    protected $logPath;
    protected $logLevel;

    public function __construct() {
        // Create the logger
        $this->logger = new Logger('frontend_logger');

        $this->logPath = '/var/log/frontend';
        $request =  strpos(\Request::url(),'api') ? 'api' : 'admin';

        $this->logPath .= '/'.env('APP_ENV').'/'.$request.'.log';

        $this->logLevel = config('app.log_level');

        $logStreamHandler = new StreamHandler($this->logPath, $this->logLevel);

        $logFormat = "[%datetime%] [%level_name%] %message% %context% %extra%\n";

        $lineFormatter = new LineFormatter($logFormat);

        $lineFormatter->ignoreEmptyContextAndExtra();

        $logStreamHandler->setFormatter($lineFormatter);
        // push handlers
        $this->logger->pushHandler($logStreamHandler);
    }

    public function formatMessage($message, $methodPath = null){
        if(is_null($methodPath)){
            return $message;
        }
        return "[$methodPath] $message";
    }

    public function emergency($message, $methodPath = null, array $data = []){
        $message = $this->formatMessage($message, $methodPath);
        $this->logger->emergency($message, $data);
    }

    public function alert($message, $methodPath = null, array $data = []){
        $message = $this->formatMessage($message, $methodPath);
        $this->logger->alert($message, $data);
    }

    public function critical($message, $methodPath = null, array $data = []){
        $message = $this->formatMessage($message, $methodPath);
        $this->logger->critical($message, $data);
    }

    public function error($message, $methodPath = null, array $data = []){
        $message = $this->formatMessage($message, $methodPath);
        $this->logger->error($message, $data);
    }

    public function warning($message, $methodPath = null, array $data = []){
        $message = $this->formatMessage($message, $methodPath);
        $this->logger->warning($message, $data);
    }

    public function notice($message, $methodPath = null, array $data = []){
        $message = $this->formatMessage($message, $methodPath);
        $this->logger->notice($message, $data);
    }

    public function info($message, $methodPath = null, array $data = []){
        $message = $this->formatMessage($message, $methodPath);
        $this->logger->info($message, $data);
    }

    public function debug($message, $methodPath = null, array $data = []){
        $message = $this->formatMessage($message, $methodPath);
        $this->logger->debug($message, $data);
    }

    public function success($message, $methodPath = null, array $data = []){
        $logger = new Logger('backend_logger');


        $logStreamHandler = new StreamHandler($this->logPath, $this->logLevel);

        $logFormat = "[%datetime%] %message% %context% %extra%\n";

        $lineFormatter = new LineFormatter($logFormat);

        $lineFormatter->ignoreEmptyContextAndExtra();

        $logStreamHandler->setFormatter($lineFormatter);

        $logger->pushHandler($logStreamHandler);

        $message = $this->formatMessage($message, $methodPath);

        $logger->info("[SUCCESS] ".$message, $data);
    }

    function getLine(\Exception $e) {
        return exceptionLine($e, null, true);
    }


}