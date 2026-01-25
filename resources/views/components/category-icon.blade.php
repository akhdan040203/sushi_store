@props(['slug' => '', 'size' => '20'])

@php
$icons = [
    'sushi' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/><circle cx="12" cy="12" r="9" stroke-width="1.5" fill="none"/>',
    
    'rolls' => '<circle cx="12" cy="12" r="9" stroke-width="1.5" fill="none"/><circle cx="12" cy="12" r="5" stroke-width="1.5" fill="none"/><circle cx="12" cy="12" r="2" stroke-width="1.5"/>',
    
    'sets' => '<rect x="3" y="3" width="7" height="7" rx="1" stroke-width="1.5" fill="none"/><rect x="14" y="3" width="7" height="7" rx="1" stroke-width="1.5" fill="none"/><rect x="3" y="14" width="7" height="7" rx="1" stroke-width="1.5" fill="none"/><rect x="14" y="14" width="7" height="7" rx="1" stroke-width="1.5" fill="none"/>',
    
    'soups' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 11h16M5 11v5a4 4 0 004 4h6a4 4 0 004-4v-5M8 11V7a4 4 0 018 0v4"/><path stroke-linecap="round" stroke-width="1.5" d="M8 4c0-1 .5-2 2-2M12 4c0-1 .5-2 2-2"/>',
    
    'drinks' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 2h8l-1 5H9L8 2zM9 7h6v10a2 2 0 01-2 2h-2a2 2 0 01-2-2V7z"/><line x1="12" y1="19" x2="12" y2="22" stroke-width="1.5"/><line x1="9" y1="22" x2="15" y2="22" stroke-width="1.5"/>',
    
    'appetizers' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2v6m0 0l3-3m-3 3L9 5M5 12h14M7 12v8h10v-8"/>',
    
    'desserts' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v2M5.5 8.5l1.5 1.5M18.5 8.5l-1.5 1.5M4 15h16M6 15v4a2 2 0 002 2h8a2 2 0 002-2v-4M9 12a3 3 0 016 0"/>',
    
    'default' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>',
];

$svgPath = $icons[$slug] ?? $icons['default'];
@endphp

<svg 
    width="{{ $size }}" 
    height="{{ $size }}" 
    viewBox="0 0 24 24" 
    fill="none" 
    stroke="currentColor" 
    {{ $attributes }}
>
    {!! $svgPath !!}
</svg>
