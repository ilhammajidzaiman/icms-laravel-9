@error($name)
    <div {{ $attributes->merge(['class' => 'invalid-feedback mt-2']) }}>
        {{ $message }}
    </div>
@enderror
