@props(['label', 'icon', 'class'])

<button type="submit" name="send" value="send" class="btn {{ $class }} text-13 flex flex-middle">
    {{$icon ?? ''}}
    {{ $label }}
</button>