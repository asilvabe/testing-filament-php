<div class="flex flex-col place-items-center">
    <div class="p-6 rounded-lg shadow-lg bg-white w-full mt-24">
        <form wire:submit.prevent="update">
            {{ $this->form }}

            <div class="flex space-x-2 mt-5">
                <button
                    type="submit"
                    class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                >
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
