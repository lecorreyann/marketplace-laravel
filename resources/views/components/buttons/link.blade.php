<a @class([
    'inline-block rounded-md font-semibold shadow-sm inline-flex items-center gap-x-1.5 ' .
    (isset($class) ? ' ' . $class : ''),
    'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:outline-indigo-600' =>
        isset($type) && $type === 'primary',
    'bg-white text-gray-900 hover:bg-gray-50 focus-visible:outline-gray-900 ring-1 ring-inset ring-gray-300' =>
        !isset($type) || $type === 'secondary',
    'px-2 py-1 text-xs' => isset($size) && $size === 'xs',
    'px-2 py-1 text-sm' => isset($size) && $size === 'sm',
    'px-2.5 py-1.5 text-sm' =>
        !isset($size) || (isset($size) && $size === 'md'),
    'px-3 py-2 text-sm' => isset($size) && $size === 'lg',
    'px-3.5 py-2.5 text-sm' => isset($size) && $size === 'xl',
]) href="{{ $href }}">
    @isset($iconStart)
        {!! $iconStart !!}
    @endisset
    @isset($text)
        {{ $text }}
    @endisset
    @isset($iconEnd)
        {!! $iconEnd !!}
    @endisset
</a>
