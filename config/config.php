<?php
/**
 * configure
 * @author yuuki.takezawa<yuuki.takezawa@comnect.jp.net>
 * @license http://opensource.org/licenses/MIT MIT
 */
return [

    // annotation file cache directory, and field injection cache  file only)
    'cache.path' => __DIR__ . "/../tmp",

    // @Component, @Scope annotation scan target directory
    'scan.target.path' => __DIR__ . "/../",

    // doctrine/annotation cache driver("file", "apc", "simple"(no cache))
    'annotation.cache.driver' => 'file',
];
