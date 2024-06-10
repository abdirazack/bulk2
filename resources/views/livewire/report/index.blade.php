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
        var params = document.getElementById('params').value;
        var additionalFields = document.getElementById('additional-fields');
        var generateBtn = document.getElementById('generateBtn');

        additionalFields.innerHTML = ''; // Clear any existing fields

        if (params === '1' || params === '2' || params === '3') {
            // Create Start Date field
            var startDateLabel = document.createElement('label');
            startDateLabel.innerHTML = 'Start Date:';
            startDateLabel.className = 'block text-sm font-medium text-gray-700';

            var startDateInput = document.createElement('input');
            startDateInput.type = 'date';
            startDateInput.name = 'start_date';
            startDateInput.id = 'start_date'; // Set an ID for easier access
            startDateInput.className = 'input input-bordered w-full mt-1';
            startDateInput.setAttribute('wire:model', 'start_date');

            // Create End Date field
            var endDateLabel = document.createElement('label');
            endDateLabel.innerHTML = 'End Date:';
            endDateLabel.className = 'block text-sm font-medium text-gray-700';

            var endDateInput = document.createElement('input');
            endDateInput.type = 'date';
            endDateInput.name = 'end_date';
            endDateInput.id = 'end_date'; // Set an ID for easier access
            endDateInput.className = 'input input-bordered w-full mt-1';
            endDateInput.setAttribute('wire:model', 'end_date');



            var filterSelect = document.createElement('select');
            filterSelect.name = 'filter';
            filterSelect.id = 'filter'; // Set an ID for easier access
            filterSelect.className = 'select select-bordered w-full mt-1';
            filterSelect.setAttribute('wire:model', 'filter');
   

       

            if(params === '1' || params === '2') {
                            // Create Filter selector
            var filterLabel = document.createElement('label');
            filterLabel.innerHTML = 'Filter:';
            filterLabel.className = 'block text-sm font-medium text-gray-700';
                     // Add options to the select

            var option1 = document.createElement('option');
            option1.value = 'option1';
            option1.innerHTML = 'Option 1';
            option1.setAttribute('wire:model', 'filter');
                var option2 = document.createElement('option');
            option2.value = 'option2';
            option2.innerHTML = 'Option 2';
            option2.setAttribute('wire:model', 'filter');
   

            filterSelect.appendChild(option1);
            filterSelect.appendChild(option2);
            additionalFields.appendChild(filterSelect);
            
            generateBtn.style.display = 'block';
            }
   

     

            additionalFields.appendChild(startDateLabel);
            additionalFields.appendChild(startDateInput);
            additionalFields.appendChild(endDateLabel);
            additionalFields.appendChild(endDateInput);
            additionalFields.appendChild(filterLabel);
 

            generateBtn.style.display = 'block';
        } else {
            generateBtn.style.display = 'none';
        }
    }


</script>
