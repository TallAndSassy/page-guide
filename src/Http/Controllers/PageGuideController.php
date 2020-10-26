<?php


namespace TallAndSassy\PageGuide\Http\Controllers;

class PageGuideController
{
    private static bool $isInited = false;
    private static bool $isBackPage;
    private static bool $isAdminPage;
    private static bool $isMePage;

    private static function initCache(): void
    {
        $firstSubDir = explode('/', request()->getPathInfo())[1];
        static::$isBackPage = in_array($firstSubDir, ['user', 'teams', 'me', 'admin']);
        static::$isAdminPage = $firstSubDir == 'admin';
        static::$isMePage = in_array($firstSubDir, ['user', 'teams', 'me']);
        static::$isInited = true;
        #dd([__FILE__,__LINE__,$firstSubDir, get_class_vars(PageGuideController::class)]);
    }

    public static function isBackPage(): bool
    {
        if (! static::$isInited) {
            static::initCache();
        }

        return static::$isBackPage;
    }
    public static function isAdminPage(): bool
    {
        if (! static::$isInited) {
            static::initCache();
        }

        return static::$isAdminPage;
    }
    public static function isMePage(): bool
    {
        if (! static::$isInited) {
            static::initCache();
        }

        return static::$isMePage;
    }
}
