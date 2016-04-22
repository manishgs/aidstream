<?php namespace App\Core\Log;

use App\Services\ActivityLog\ActivityManager;
use Illuminate\Log\Writer;

/**
 * Class AsWriter
 * @package App\Core\Log
 */
class AsWriter extends Writer
{
    /**
     * User Activity Log
     * @param       $action
     * @param array $param
     * @return
     */
    public function activity($action, array $param = [])
    {
        $activity = app(ActivityManager::class);

        return $activity->save($action, $param);
    }

    /**
     * adds url and session to logs
     * @param string $message
     * @param array  $context
     */
    public function error($message, array $context = [])
    {
        $context['url']     = request()->url();
        $context['session'] = session()->all();
        parent::error($message, $context);
    }


}