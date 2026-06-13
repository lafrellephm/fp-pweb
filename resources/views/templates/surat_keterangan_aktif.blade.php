<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Aktif Ã¢â‚¬â€ Organisasi PWEB</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #1A2744;
            background: #fff;
        }

        .letter-container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 40px 60px;
        }

        /* Letterhead */
        .letterhead {
            text-align: center;
            padding-bottom: 16px;
            margin-bottom: 16px;
        }

        hr.letterhead-rule {
            border: 0;
            border-top: 3px solid #1A2744;
            margin-bottom: 32px;
        }

        .letterhead h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1A2744;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .letterhead p {
            font-size: 12px;
            color: #4E5967;
        }

        /* Letter metadata */
        .letter-meta {
            margin-bottom: 32px;
        }

        .letter-meta table {
            width: auto;
        }

        .letter-meta td {
            padding: 2px 8px 2px 0;
            font-size: 14px;
            vertical-align: top;
        }

        .letter-meta td:first-child {
            font-weight: 500;
            white-space: nowrap;
        }

        /* Title */
        .letter-title {
            text-align: center;
            margin-bottom: 8px;
        }

        .letter-title h2 {
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            text-decoration: underline;
            letter-spacing: 1px;
        }

        .letter-number-center {
            text-align: center;
            font-size: 14px;
            margin-bottom: 32px;
            color: #4E5967;
        }

        /* Body */
        .letter-body {
            margin-bottom: 40px;
            text-align: justify;
        }

        .letter-body p {
            margin-bottom: 16px;
            font-size: 14px;
            line-height: 1.8;
        }

        /* Signatory */
        .signatory {
            margin-top: 48px;
            text-align: right;
        }

        .signatory .location-date {
            font-size: 14px;
            margin-bottom: 8px;
        }

        .signatory .role {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 64px;
        }

        .signatory .name {
            font-size: 14px;
            font-weight: 700;
            text-decoration: underline;
        }

        /* Print button */
        .print-actions {
            text-align: center;
            margin-top: 48px;
        }

        .btn-print {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #066FD1;
            color: #FFFFFF;
            border: none;
            padding: 10px 24px;
            font-size: 14px;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            border-radius: 6px;
            cursor: pointer;
            height: 40px;
            box-shadow: rgba(0, 0, 0, 0.04) 0px 10px 15px -3px, rgba(0, 0, 0, 0.02) 0px 4px 6px -2px;
            transition: background-color 0.15s ease;
        }

        .btn-print:hover {
            background-color: #0557B8;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: #fff;
            }

            .letter-container {
                padding: 0;
                max-width: 100%;
            }

            @page {
                size: A4;
                margin: 2.5cm;
            }
        }
    </style>
</head>
<body>
    <div class="letter-container">
        {{-- Letterhead --}}
        <div class="letterhead">
            <h2>Organisasi PWEB</h2>
            <p>Sistem Manajemen Surat & Disposisi</p>
        </div>
        <hr class="letterhead-rule">

        {{-- Letter Title --}}
        <div class="letter-title">
            <h2>Surat Keterangan Aktif</h2>
        </div>
        <div class="letter-number-center">
            Nomor: {{ $letter->letter_number ?? '-' }}<br>
            Tanggal: {{ $letter->letter_date ? $letter->letter_date->translatedFormat('d F Y') : '-' }}
        </div>

        {{-- Body --}}
        <div class="letter-body">
            <p>Yang bertanda tangan di bawah ini, Admin Organisasi PWEB, dengan ini menerangkan bahwa:</p>

            <table class="mb-3 ms-4">
                <tr>
                    <td style="padding: 4px 12px 4px 0; font-weight: 500; width: 120px;">Nama</td>
                    <td style="padding: 4px 8px;">:</td>
                    <td style="padding: 4px 0;">{{ $letter->related_name }}</td>
                </tr>
            </table>

            <p>Adalah benar merupakan anggota aktif Organisasi PWEB yang terdaftar dan tercatat secara resmi dalam keanggotaan organisasi. Yang bersangkutan telah menjalankan tugas dan tanggung jawabnya dengan baik selama menjadi anggota aktif organisasi.</p>

            <p>Surat keterangan aktif ini diberikan untuk keperluan: <strong>{{ $letter->purpose }}</strong>.</p>

            <p>Surat keterangan ini ditujukan kepada <strong>{{ $letter->addressed_to }}</strong> untuk dapat dipergunakan sebagaimana mestinya.</p>

            <p>Demikian surat keterangan ini dibuat dengan sebenarnya dan dapat dipertanggungjawabkan.</p>
        </div>

        {{-- Signatory --}}
        <div class="signatory">
            <div class="location-date">
                Surabaya, {{ $letter->letter_date ? $letter->letter_date->translatedFormat('d F Y') : now()->translatedFormat('d F Y') }}
            </div>
            <div class="role">Admin Organisasi PWEB</div>
            <div class="name">{{ $admin->name ?? 'Kepala Organisasi/Departemen' }}</div>
        </div>

        {{-- Print Button --}}
        <div class="print-actions no-print">
            <button class="btn-print" onclick="window.print()">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                    <rect x="6" y="14" width="12" height="8"></rect>
                </svg>
                Cetak Surat
            </button>
        </div>
    </div>
</body>
</html>
