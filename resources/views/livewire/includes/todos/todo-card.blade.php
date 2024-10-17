<li class="overflow-auto flex flex-col gap-4 justify-between p-2 border-s-8 mb-8 dark:bg-gray-900 border-s-sky-900 shadow-md" wire:key={{ $todo->id }}>

	<div class="flex gap-4 justify-end">

		<button type="button" wire:click='set_edit_mode({{ $todo }})'>
			<i class="fa fa-pencil"></i>
		</button>

		<form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
			@csrf
			@method('DELETE')

			<button class="text-red-500" type="button" wire:click='confirm_delete({{ $todo }})'>
				<i class="fa fa-trash"></i>
			</button>
		</form>

	</div>
	<div class="flex gap-2 whitespace-nowrap">
		<input @if ($todo->completed) checked @endif type="checkbox" wire:click="completed({{ $todo }})">

		@if ($in_edit_mode && $in_edit_mode['id'] === $todo->id)
			<div class="flex w-full mb-2">
				<input autofocus class="w-full p-2 border rounded-l-lg text-sky-600" name="name" placeholder="Updatea a task" type="text" wire:model="in_edit_mode.name">
				<button class="bg-blue-500 text-white p-2" type="button" wire:click='update'>
					<i class="fa fa-check"></i>
				</button>

				<button class="bg-red-500 text-white p-2 rounded-r-lg" type="button" wire:click='cancel_update'>
					<i class="fa fa-close"></i>
				</button>

				@if (session('created'))
					<p class="ml-2 text-green-500">{{ session('created') }}</p>
				@endif
			</div>
		@else
			<span class="font-bold">{{ $todo->name }}</span>
		@endif

	</div>

	{{-- Confirm Deletion --}}
	@isset($to_delete)
		@include('livewire.includes.todos.delete-modal')
	@endisset
</li>
