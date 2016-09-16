<?php namespace App\Services\CsvImporter;

use Exception;
use Maatwebsite\Excel\Excel;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Services\CsvImporter\Queue\Contracts\ProcessorInterface;

/**
 * Class ImportManager
 * @package App\Services\CsvImporter
 */
class ImportManager
{
    /**
     * @var Excel
     */
    protected $excel;

    /**
     * @var ProcessorInterface
     */
    protected $processor;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * ImportManager constructor.
     * @param Excel              $excel
     * @param ProcessorInterface $processor
     * @param LoggerInterface    $logger
     */
    public function __construct(Excel $excel, ProcessorInterface $processor, LoggerInterface $logger)
    {
        $this->excel     = $excel;
        $this->processor = $processor;
        $this->logger    = $logger;
    }

    /**
     * Process the uploaded CSV file.
     * @param UploadedFile $file
     * @return bool|null
     */
    public function process(UploadedFile $file)
    {
        try {
            $csv = $this->excel->load($file)->toArray();

            $csvProcessor = new CsvProcessor($csv);
            $csvProcessor->handle();

//            if ($this->processor->isCorrectCsv($csv)) {
//                $this->processor->pushIntoQueue($csv);
//            }

            return true;
        } catch (Exception $exception) {
            $this->logger->error(
                $exception->getMessage(),
                [
                    'user'  => auth()->user()->getNameAttribute(),
                    'trace' => $exception->getTraceAsString()
                ]
            );

            return $exception->getMessage();
        }
    }
}
