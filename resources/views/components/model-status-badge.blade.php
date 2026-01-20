@props(['status'])

@php
    $colors = [
        'disetujui' => 'bg-emerald-100 text-emerald-800',
        'selesai' => 'bg-emerald-100 text-emerald-800', // Treat selesai same as disetujui for color
        'ditolak' => 'bg-red-100 text-red-800',
        'proses' => 'bg-blue-100 text-blue-800',
        'menunggu' => 'bg-yellow-100 text-yellow-800', // Additional common status
    ];

    $defaultColor = 'bg-slate-100 text-slate-700';
    $statusKey = strtolower($status);
    $classes = $colors[$statusKey] ?? $defaultColor;
@endphp

<span {{ $attributes->merge(['class' => "px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full $classes"]) }}>
    {{ ucfirst($status) }}
</span>
