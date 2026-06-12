<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('resources/views'));
foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        $c = file_get_contents($file);
        $o = $c;
        
        $c = preg_replace('/(@if\(\$letter->letter_type === \'recommendation\'\)\s+)[^@]+?(?=\s*@)/i', '${1}Rekomendasi', $c);
        $c = preg_replace('/(@elseif\(\$letter->letter_type === \'active_certificate\'\)\s+)[^@]+?(?=\s*@)/i', '${1}Keterangan Aktif', $c);
        $c = preg_replace('/(@elseif\(\$letter->letter_type === \'assignment\'\)\s+)[^@]+?(?=\s*@)/i', '${1}Surat Tugas', $c);
        
        $c = str_replace('>Surat Rekomendasi</option>', '>Rekomendasi</option>', $c);
        $c = str_replace('>Keterangan Anggota Aktif</option>', '>Keterangan Aktif</option>', $c);
        $c = str_replace('>Recommendation</option>', '>Rekomendasi</option>', $c);
        $c = str_replace('>Active Certificate</option>', '>Keterangan Aktif</option>', $c);
        $c = str_replace('>Assignment</option>', '>Surat Tugas</option>', $c);

        if ($c !== $o) {
            file_put_contents($file, $c);
            echo "Updated $file\n";
        }
    }
}
