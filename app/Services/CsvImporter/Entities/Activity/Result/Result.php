<?php namespace App\Services\CsvImporter\Entities\Activity\Result;

use App\Services\CsvImporter\Entities\ResultCsv;

/**
 * Class Activity
 * @package App\Services\CsvImporter\Entities\Activity
 */
class Result extends ResultCsv
{
    /**
     * Activity constructor.
     * @param $rows
     * @param $organizationId
     * @param $userId
     */
    public function __construct($rows, $organizationId, $userId)
    {
        $this->csvRows        = $rows;
        $this->organizationId = $organizationId;
        $this->userId         = $userId;
        $this->rows           = $rows;
    }

    /**
     * Process the Activity Csv.
     *
     * @return $this
     */
    public function process()
    {
        foreach ($this->rows() as $row) {
            $this->initialize($row)
                 ->process()
                 ->validate()
                 ->validateUnique($this->csvRows)
                 ->keep();
        }

        return $this;
    }
}