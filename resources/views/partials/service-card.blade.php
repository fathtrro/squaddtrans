{{--
    Partial: partials/service-card.blade.php
    Props : $icon, $title, $description, $features (array), $price, $unit, $featured (bool)
--}}
@php $featured = $featured ?? false; @endphp

<div class="{{ $featured
    ? 'bg-gray-900 border-gray-900 shadow-2xl'
    : 'bg-white border-slate-100 card-shadow' }}
    p-10 rounded-3xl border relative overflow-hidden group">

    {{-- Decorative blob --}}
    <div class="absolute top-0 right-0 w-32 h-32 {{ $featured ? 'bg-yellow-600/10' : 'bg-yellow-600/5 group-hover:scale-150 transition-all' }} rounded-bl-full -mr-10 -mt-10"></div>

    {{-- Icon --}}
    <div class="w-16 h-16 {{ $featured ? 'bg-yellow-600' : 'bg-yellow-600/10' }} rounded-2xl flex items-center justify-center mb-8">
        <i class="fa-solid {{ $icon }} {{ $featured ? 'text-white' : 'text-yellow-600' }} text-3xl"></i>
    </div>

    {{-- Title & Description --}}
    <h3 class="text-2xl font-bold mb-4 {{ $featured ? 'text-white' : '' }}">{{ $title }}</h3>
    <p class="mb-6 {{ $featured ? 'text-slate-400' : 'text-slate-500' }}">{{ $description }}</p>

    {{-- Features --}}
    <ul class="space-y-3 mb-8">
        @foreach ($features as $feature)
            <li class="flex items-center gap-2 text-sm font-medium {{ $featured ? 'text-slate-300' : 'text-slate-700' }}">
                <i class="fa-solid fa-circle-check text-yellow-600 text-sm"></i>
                {{ $feature }}
            </li>
        @endforeach
    </ul>

    {{-- Price --}}
    <div class="pt-6 border-t {{ $featured ? 'border-white/10' : 'border-slate-100' }}">
        <p class="text-xs {{ $featured ? 'text-slate-500' : 'text-slate-400' }} font-bold uppercase mb-1">Mulai Dari</p>
        <p class="text-2xl font-extrabold {{ $featured ? 'text-yellow-500' : 'text-gray-900' }}">
            {{ $price }} <span class="text-sm font-normal {{ $featured ? 'text-slate-500' : 'text-slate-400' }}">{{ $unit }}</span>
        </p>
    </div>

</div>
