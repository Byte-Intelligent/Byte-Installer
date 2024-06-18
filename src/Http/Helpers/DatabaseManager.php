<?php

namespace Byteintelligent\BiInstaller\Http\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\SQLiteConnection;
use Symfony\Component\Console\Output\BufferedOutput;

class DatabaseManager
{

    public function migrateAndSeed()
    {
        try {
            Artisan::call('migrate:fresh', ['--force'=> true]);
            Artisan::call('db:seed', ['--force' => true]);
            Artisan::call('storage:link');
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), 'error');
        }
        return $this->response('Seed Complete', 'success');

    }

    /**
     * Return a formatted error messages.
     *
     * @param string $message
     * @param string $status
     * @param \Symfony\Component\Console\Output\BufferedOutput $outputLog
     * @return array
     */
    private function response($message, $status)
    {
        return [
            'status' => $status,
            'message' => $message
        ];
    }

}
