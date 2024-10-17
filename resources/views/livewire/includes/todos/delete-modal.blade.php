{{-- TailwindCSS delete-modal --}}

<div class="fixed flex">
	<div aria-hidden="true" class="fixed inset-0 z-50 overflow-y-auto">
		<div class="flex items-center justify-center min-h-screen bg-gray-500 bg-opacity-75">
			<div class="w-full max-w-md p-6 bg-white rounded-lg text-center">
				<!-- Delete confirmation message -->
				<p class="text-lg font-medium text-gray-900">Are you sure you want to delete this to do item?</p>
				<small>{{ $to_delete->name }}</small>

				<!-- Delete button -->
				<div class="mt-6">
					<button class="w-full px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700" type="submit" wire:click="delete">Delete</button>
				</div>

				<!-- Cancel button -->
				<button class="mt-6 w-full px-4 py-3 text-gray-900 rounded-lg hover:bg-gray-100" wire:click='confirm_cancel'>Cancel</button>

				<!-- Close button -->

			</div>

		</div>
	</div>
</div>
