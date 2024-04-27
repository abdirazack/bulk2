<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn bg-red-600']) }}>
    {{ $slot }}
</button>
