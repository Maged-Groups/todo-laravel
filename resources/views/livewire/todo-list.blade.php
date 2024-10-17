<div class="w-screen max-w-5xl mx-auto dark:bg-gray-950 dark:text-sky-500 p-6 rounded-lg shadow-lg h-full overflow-hidden flex flex-col">
	<h1 class="text-2xl font-bold mb-4">Todo List ({{ count($todos) }})</h1>

	<!-- Error Message -->
	@if ($errors->any())
		<div class="bg-red-100 text-red-700 p-2 rounded mb-4">
			{{ $errors->first() }}
		</div>
	@endif

	@if (session('success'))
		<p class="ml-2 text-green-500">{{ session('success') }}</p>
	@endif

	@if (session('error'))
		<p class="ml-2 text-red-500">{{ session('error') }}</p>
	@endif

	<!-- Form -->
	@include('livewire.includes.todos.create-form')

	<!-- Search -->
	@include('livewire.includes.todos.search-box')

	<!-- Todo List -->
	<div class="overflow-auto flex-1 p-4">

		<ul>
			@foreach ($todos as $todo)
				@include('livewire.includes.todos.todo-card')
			@endforeach
		</ul>

		<div class="p-3 text-xs">
			{{ $todos->links() }}
		</div>
	</div>

</div>
