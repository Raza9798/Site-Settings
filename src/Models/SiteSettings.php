<?php

namespace Intelrx\Sitesettings\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intelrx\Sitesettings\SiteConfig;
use Illuminate\Support\Facades\Http;

class SiteSettings extends Model
{
    use HasFactory;
    protected $table = 'site_settings';
    protected $fillable = ['key', 'value'];

    public static function boot()
    {
        parent::boot();

        self::saved(function ($model) {
            SiteSettings::manageSiteConfig();
        });

        self::updated(function ($model) {
            SiteSettings::manageSiteConfig();
        });
    }

    public static function manageSiteConfig(): void
    {
        $config = [];

        $config   = SiteConfig::list();
        $config[] = SiteSettings::envArray();

        $json = json_encode($config, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . '/SiteConfig.json', $json);
        SiteSettings::syncFile();
    }

    public static function envArray(): array
    {
        $filePath = base_path('.env');
        $envArray = [];

        if (file_exists($filePath)) {
            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }

                list($key, $value) = array_pad(explode('=', $line, 2), 2, null);
                $envArray[trim($key)] = trim($value);
            }
        }
        return $envArray;
    }

    public static function syncFile()
    {
        try {
            $configArray = json_decode(file_get_contents(__DIR__ . '/../AppConfig.json'), true);
            $url = 'http://127.0.0.1:7000/api/store';
            $formData = [
                'filename' => $configArray[0]['name'] . "_" . Carbon::now()->format("m-d-y h-m-s A") . ".json",
                'file' => fopen(__DIR__ . '/SiteConfig.json', 'r'),
            ];

            $response = Http::asMultipart()->post($url, $formData);

            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $response->json(),
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to make POST request',
                    'error' => $response->body(),
                ], $response->status());
            }
        } catch (\Exception $e) { }
    }
}
