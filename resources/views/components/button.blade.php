<button
  type="{{ $type ?? 'button' }}"
  @class([
    "rounded-md bg-indigo-600 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600",
    "px-2 py-1 text-xs" => $attributes->get('size') === 'xs',
    "px-2 py-1 text-sm" => $attributes->get('size') === 'sm',
    "px-2.5 py-1.5 text-sm" => !$attributes->get('size') || $attributes->get('size') === 'md',
    "px-3 py-2 text-sm" => $attributes->get('size') === 'lg',
    "px-3.5 py-2.5 text-sm" => $attributes->get('size') === 'xl',
    $attributes->get('class') ??  null => $attributes->get('class'),
  ])
>
  {{ $slot }}
</button>
