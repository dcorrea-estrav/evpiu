<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use App\Utils\Util;
use Illuminate\View\View;

class BackupController extends Controller
{
    protected $commonUtil;

    public function __construct(Util $commonUtil)
    {
        $this->commonUtil = $commonUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        if (!auth()->user()->can('backup')) {
            abort(403, 'Unauthorized action.');
        }

        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        $files = $disk->files('EVPIU');

        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace('EVPIU'. '/', '', $f),
                    'file_size' => $disk->size($f),
                    'last_modified' => $disk->lastModified($f),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

        $cron_job_command = $this->commonUtil->getCronJobCommand();

        return view("Backup.index")
            ->with(compact('backups', 'cron_job_command'));
    }

    /**
     * Create a resource.
     *
     * @return RedirectResponse
     */
    public function create()
    {
        if (!auth()->user()->can('backup')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            // start the backup process
            Artisan::call('backup:run');
            $output = Artisan::output();

            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);

            $output = ['success' => 1,
                'msg' => __('Backup creado con exito!')
            ];
        } catch (\Exception $e) {
            $output = ['success' => 0,
                'msg' => $e->getMessage()
            ];
        }

        return back()->with('status', $output);
    }

    /*
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        if (!auth()->user()->can('backup')) {
            abort(403, 'Accion no autorizada.');
        }

        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "El archivo de backup no existe.");
        }
    }

    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        if (!auth()->user()->can('backup')) {
            abort(403, 'Accion no autorizada.');
        }

        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);
            return redirect()->back();
        } else {
            abort(404, "El archivo de backup no existe.");
        }
    }




}
