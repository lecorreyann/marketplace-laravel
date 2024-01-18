<svg
  xmlns="http://www.w3.org/2000/svg"
  id="flag-icons-{{ $countryCode }}"
  viewBox="0 0 640 480"
  @class([
    $attributes->has('class') ??  null => $attributes->get('class'),
    "w-4 h-4" => $attributes->missing('class'),
  ])>
  @include('components.flags.'. $countryCode)
</svg>
