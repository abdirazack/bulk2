@props([
    'name',
    'options' => [],
])

<div x-data="select()" @click.away="isOpen = false">
    <input type="text" x-model="search" x-ref="input" @focus="isOpen = true">
    <ul x-show="isOpen">
        <template x-for="option in filteredOptions" :key="option.value">
            <li x-text="option.text" @click="selectOption(option)"></li>
        </template>
    </ul>
    <select name="{{ $name }}" x-ref="select">
        @foreach ($options as $option)
            <option value="{{ $option['value'] }}">{{ $option['value'] }}</option>
        @endforeach
    </select>
</div>

<script>
    function select() {
        return {
            isOpen: false,
            search: '',
            options: @json($options),
            filteredOptions: [],
            init: function () {
                this.filteredOptions = [...this.options];
            },
            search: function(evt) {
                const searchKeyword = evt.target.value.toLowerCase();
                this.filteredOptions = this.options.filter(option => option.text.toLowerCase().includes(searchKeyword));
            },
            selectOption: function(option) {
                this.$refs.select.value = option.value;
                this.$refs.input.value = option.text;
                this.isOpen = false;
            },
        }
    }
</script>
