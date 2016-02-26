<?php namespace App\Migration\Migrator;

use App\Migration\Entities\PublishToRegister;
use App\Models\Activity\Activity as ActivityModel;
use Illuminate\Database\DatabaseManager;
use App\Migration\Migrator\Contract\MigratorContract;

class PublishToRegisterMigrator implements MigratorContract
{
    /**
     * @var PublishToRegister
     */
    protected $publishToRegister;

    /**
     * @var ActivityModel
     */
    protected $activityModel;

    /**
     * PublishToRegisterMigrator constructor.
     * @param PublishToRegisterMigrator $publishToRegister
     * @param ActivityModel $activityModel
     */
    public function __construct(PublishToRegister $publishToRegister, ActivityModel $activityModel)
    {
        $this->publishToRegister = $publishToRegister;
        $this->activityModel     = $activityModel;
    }

    /**
     * Migrate data from old system into the new one.
     * @param $accountIds
     * @return string
     */
    public function migrate(array $accountIds)
    {
        // TODO: Implement migrate() method.
        $filenameArray         = [];
        $db                    = app()->make(DatabaseManager::class);
        $activityPublishedInfo = $db->table('activity_published')
                                    ->select('filename')
                                    ->get();

        foreach ($activityPublishedInfo as $eachActivityPublishedInfo) {
            $filenameArray[] = $eachActivityPublishedInfo->filename;
        }

        $PublishInfo = $this->publishToRegister->getData($filenameArray);
        foreach ($PublishInfo as $publishedActivityIdCollection) {
            if (!empty($publishedActivityIdCollection)) {
                foreach ($publishedActivityIdCollection as $publishedActivityId) {
                    $activityData = $this->activityModel->findOrFail($publishedActivityId);
                    if ($activityData) {
                        $activityData->published_to_registry = 1;
                        if (!$activityData->save()) {
                            return 'error in updating publish_to_register';
                        }
                    } else {
                        return "no activity updated";
                    }
                }
            }
        }

        $db->commit();
        return "publish_to_register_field updated";
    }
}