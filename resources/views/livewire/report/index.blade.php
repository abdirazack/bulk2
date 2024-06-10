<x-slot name="header">
    <h2 class="font-semibold text-xl leading-tight">
        {{ __('Report') }}
    </h2>
</x-slot>

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="mt-6">
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="font-semibold text-xl mb-4">Report Params</h2>
            <div class="grid grid-cols-3 gap-4">
                <!-- Report Type Dropdown -->
                <div>
                    <label for="params" class="block text-sm font-medium text-gray-700">Select Report Type</label>
                    <select name="params" id="params" class="select select-bordered w-full mt-1" onchange="showFields()"> 
                        <option value="">Select an option</option>
                        <option value="1">Payment</option>
                        <option value="2">Transactions</option>
                        <option value="3">Wallet Balances</option>
                    </select>
                </div>
                <!-- Additional Fields -->
                <div class="col-span-2" id="additional-fields"></div>
            </div>
            <button id="generateBtn" class="btn btn-primary w-full mt-4" wire:click="generateReport" style="display: none;">Generate</button>
        </div>
    </div>
</div>

<script>
    function showFields() {
        const params = document.getElementById('params').value;
        const additionalFields = document.getElementById('additional-fields');
        const generateBtn = document.getElementById('generateBtn');

        additionalFields.innerHTML = ''; // Clear any existing fields

        if (params === '1' || params === '2' || params === '3') {
            createField('Start Date:', 'start_date', 'date', additionalFields);
            createField('End Date:', 'end_date', 'date', additionalFields);

            if (params === '1' || params === '2') {
                createFilterSelect(additionalFields);
            }

            generateBtn.style.display = 'block';
        } else {
            generateBtn.style.display = 'none';
        }
    }

    function createField(labelText, id, type, container) {
        const label = document.createElement('label');
        label.innerHTML = labelText;
        label.className = 'block text-sm font-medium text-gray-700';

        const input = document.createElement('input');
        input.type = type;
        input.name = id;
        input.id = id;
        input.className = 'input input-bordered w-full mt-1';
        input.setAttribute('wire:model', id);

        container.appendChild(label);
        container.appendChild(input);
    }

    function createFilterSelect(container) {
        const filterLabel = document.createElement('label');
        filterLabel.innerHTML = 'Filter:';
        filterLabel.className = 'block text-sm font-medium text-gray-700';

        const filterSelect = document.createElement('select');
        filterSelect.name = 'filter';
        filterSelect.id = 'filter';
        filterSelect.className = 'select select-bordered w-full mt-1';
        filterSelect.setAttribute('wire:model', 'filter');

        const options = [
            { value: 'option1', text: 'Option 1' },
            { value: 'option2', text: 'Option 2' }
        ];

        options.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option.value;
            opt.innerHTML = option.text;
            filterSelect.appendChild(opt);
        });

        container.appendChild(filterLabel);
        container.appendChild(filterSelect);
    }
</script>
