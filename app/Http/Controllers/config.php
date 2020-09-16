<?php
    $travinh_db = pg_connect("host=localhost
        port=5432
        dbname=travinh_quantrac_ad
        user=postgres
        password=0888365051"
    );
    if (!$travinh_db) {
        echo "Kết nối thất bại.\n";
        exit;
    }
?>
