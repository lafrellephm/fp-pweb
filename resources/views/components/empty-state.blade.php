@props(['message' => 'Tidak ada data ditemukan.'])

<tr>
    <td {{ $attributes->merge(['colspan' => 1]) }} class="text-center py-5 text-muted">
        {{ $message }}
    </td>
</tr>
