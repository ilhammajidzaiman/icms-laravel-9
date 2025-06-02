<div class="table-responsive">
    <table {{ $attributes->merge(['class' => 'table table-hover']) }}>
        {{ $slot }}
    </table>
</div>
