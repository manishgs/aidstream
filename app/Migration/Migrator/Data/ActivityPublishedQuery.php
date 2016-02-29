<?php namespace App\Migration\Migrator\Data;


use App\Migration\ActivityData;


class ActivityPublishedQuery extends Query
{

    public function __construct(ActivityData $activityData)
    {
        $this->activityData = $activityData;
    }

    public function executeFor(array $accountIds)
    {
        $this->initDBConnection();
        $data = [];

        foreach ($accountIds as $accountId) {
            if ($organization = getOrganizationFor($accountId)) {
                $data[] = $this->getData($organization->id, $accountId);
            }
        }
        return $data;
    }

    public function getData($organizationId, $accountId)
    {
        $activityPublished = [];

        //fetch published activity
        $activityPublishedData = $this->connection->table('published')
                                                  ->select('*')
                                                  ->where('publishing_org_id', '=', $accountId)
                                                  ->get();

        foreach ($activityPublishedData as $data) {
            $activityPublished[$data->filename] = [
                'filename'              => $data->filename,
                'published_to_register' => $data->pushed_to_registry,
                'organization_id'       => $accountId,
            ];
        }
        return $activityPublished;
    }


}