<form action="{{ route('todos.store') }}" class="mb-9 border-b-4 pb-4 w-11/12 m-auto border-sky-700" method="POST">
	@csrf
	<div class="flex items-center mb-2">
		<input autofocus class="w-full p-2 border rounded-l-lg text-sky-600" name="name" placeholder="Add a new task" type="text" wire:model='name'>
		<button class="bg-blue-500 text-white p-2 rounded-r-lg" type="submit" wire:click.prevent='create'>Create</button>

		@if (session('created'))
			<p class="ml-2 text-green-500">{{ session('created') }}</p>
		@endif
	</div>
</form>
