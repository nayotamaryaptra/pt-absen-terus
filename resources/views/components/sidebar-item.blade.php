@props(['route', 'label', 'icon'])

@php
    $icons = [
        'home' => 'heroicon-o-home',
        'user-group' => 'heroicon-o-user-group',
        'clock' => 'heroicon-o-clock',
        'calendar-days' => 'heroicon-o-calendar-days',
        'clipboard-document-check' => 'heroicon-o-clipboard-document-check',
    ];

    $active = request()->routeIs($route);
@endphp

<a href="{{ route($route) }}"
   class="flex items-center gap-3 px-4 py-3 rounded-lg transition font-medium
          {{ $active ? 'bg-indigo-600 text-white' : 'hover:bg-gray-800 hover:text-white text-gray-300' }}">
    
    <x-dynamic-component :component="$icons[$icon]" class="w-5 h-5" />
    {{ $label }}
</a>
