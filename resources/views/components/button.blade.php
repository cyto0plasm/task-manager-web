@props([
    'text' => 'Button',
    'type' => 'button',
    'bgColor' => 'bg-[#6b3eea]',
    'hoverColor' => 'hover:bg-[#6935f7]',
    'activeColor' => 'active:bg-[#6335e0]',
    'textColor' => 'text-white',
])

<button type="{{ $type }}"
    {{ $attributes->merge(['class' => "$bgColor $textColor $hoverColor $activeColor font-semibold text-[1.2rem] px-3 py-1 rounded-lg active:scale-[1.01] shadow-md active:shadow-lg transition-all duration-150"]) }}>
    {{ $text }}
</button>
{{-- uage examples --}}
{{-- <x-button text="Create Task" type="submit" /> --}}

{{-- Green variant --}}
{{-- <x-button text="Save Changes" bgColor="bg-[#10b981]" hoverColor="hover:bg-[#059669]" activeColor="active:bg-[#047857]" /> --}}

{{-- Red variant --}}
{{-- <x-button text="Delete Item" bgColor="bg-[#ef4444]" hoverColor="hover:bg-[#dc2626]" activeColor="active:bg-[#b91c1c]" /> --}}
