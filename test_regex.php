<?php
$c = file_get_contents('resources/views/user/dashboard.blade.php');
$c = preg_replace('/(@if\(\$letter->letter_type === \'recommendation\'\)\s+)[^@]+?(?=\s*@)/i', '${1}Rekomendasi', $c);
$c = preg_replace('/(@elseif\(\$letter->letter_type === \'active_certificate\'\)\s+)[^@]+?(?=\s*@)/i', '${1}Keterangan Aktif', $c);
$c = preg_replace('/(@elseif\(\$letter->letter_type === \'assignment\'\)\s+)[^@]+?(?=\s*@)/i', '${1}Surat Tugas', $c);
echo substr($c, strpos($c, "@if(\$letter->letter_type === 'recommendation')"), 200);
