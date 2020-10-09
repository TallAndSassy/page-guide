<?php


namespace TallAndSassy\PageGuide;

abstract class GenericWrangler
{
    private static array $asrProviders = [];

    public static function wrangleMe( string $key, array $asrPackage): void {
        static::$asrProviders[$key] = $asrPackage;
    }
    
    /* Return list of packages that registered for grokking */
    public static function wranglees(): array
    {
        return static::$asrProviders;
    }
    
    public static function keyExits(string $key) : bool {
        return key_exists($key, static::$asrProviders);
    }
    
    abstract public static function getActiveKey(): ?string;
    
    
    public static function getPackage_byKey(string $key): array {
        assert(key_exists($key, static::$asrProviders));
        return static::$asrProviders[$key];
    }
    
    public static function isActive(string $key): bool {
        return static::getActiveKey() == $key;
    }
}


class PageGuideMenuWrangler extends GenericWrangler
{
    public static function getKeyFromUrl(): string {
         $url = app('request')->url(); # "http://test-jet.test/p1/p2/p3"
        $arrUrl = explode('/',$url);

        $p1 = $arrUrl[4] ?: '';
        $p2 = $arrUrl[5] ?: '';
        $key = "{$p1}_{$p2}";
        return $key;
    }
    
    /* all top menu items are keyed by first two params. Empty string if no param present */
    public static function getActiveKey(): ?string {
        if (static::keyExits(static::getKeyFromUrl())) {
            return $p2;
        } else {
            return null;
        }
    }
}
