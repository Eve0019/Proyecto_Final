<input
    x-data
    x-ref="input"
    x-init="new Pikaday({ field: $refs.input, 'format': 'YYYY.MM.DD' })"
    type="text"
    {{ $attributes }}
>