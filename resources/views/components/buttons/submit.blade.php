<x-buttons.base type="{{ isset($type) ? $type : 'button' }}" class="{{ isset($class) ? $class : '' }}"
    size="{{ isset($size) ? $size : '' }}" text="{{ $text }}"
    icon-start="{{ isset($iconStart) ? $iconStart : '' }}" icon-end="{{ isset($iconEnd) ? $iconEnd : '' }}" />
