<?php
// admin/helpers.php

function getAllVillages(): array
{
    $base = __DIR__ . '/../villages';
    $list = [];

    if (!is_dir($base)) return $list;

    foreach (glob($base . '/*', GLOB_ONLYDIR) as $dir) {
        $village = basename($dir);
        $cfg = $dir . '/admin/config.php';
        if (file_exists($cfg)) {
            $list[$village] = $cfg;
        }
    }
    return $list;
}

function getVillageConn(string $configPath): ?object
{
    $content = file_get_contents($configPath);
    if (!preg_match('/\$db\s*=\s*["\']([^"\']+)["\']/', $content, $m)) {
        return null;
    }
    $dbName = $m[1];

    $cacheDir = __DIR__ . '/.cache';
    if (!is_dir($cacheDir)) mkdir($cacheDir, 0755, true);

    $hash = md5($configPath);
    $cachedFile = "$cacheDir/conn_$hash.php";

    if (!file_exists($cachedFile)) {
        $raw = file_get_contents($configPath);
        $code = preg_replace('/^<\?php\s*/i', '', $raw);
        $code = preg_replace('/^<\?\s*/', '', $code);

        // === FIX mysqli in namespace ===
        // Replace: new mysqli(...) → __ns_mysqli(...)
        $code = preg_replace(
            '/new\s+mysqli\s*\(\s*([^)]+)\s*\)/i',
            '__ns_mysqli($1)',
            $code
        );

        // Replace: $this->mysqli->connect_error → mysqli_connect_error()
        $code = preg_replace(
            '/\$this->mysqli->connect_error/',
            'mysqli_connect_error()',
            $code
        );

        $ns = "VillageNS_$hash";
        $wrapped = "<?php\n";
        $wrapped .= "namespace $ns;\n\n";
        $wrapped .= "function __ns_mysqli(\$server, \$user, \$pass, \$db = '') {\n";
        $wrapped .= "    return new \\mysqli(\$server, \$user, \$pass, \$db);\n";
        $wrapped .= "}\n\n";
        $wrapped .= "global \$db;\n";
        $wrapped .= "\$db = " . var_export($dbName, true) . ";\n\n";
        $wrapped .= $code . "\n";

        file_put_contents($cachedFile, $wrapped);
    }

    $ns = "VillageNS_$hash";
    $class = "$ns\\ConnDb";

    if (!class_exists($class, false)) {
        require_once $cachedFile;
    }

    if (!class_exists($class, false)) {
        return null;
    }

    $conn = new $class();
    return ($conn && isset($conn->conn) && $conn->conn) ? $conn : null;
}
