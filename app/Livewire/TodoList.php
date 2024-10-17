<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;
// use Livewire\WithPagination;

class TodoList extends Component
{
    // use WithPagination;

    #[Rule('required|min:3|max:50')]
    public $name;

    public $search = '';

    public $to_delete = null;

    public $in_edit_mode = [
        'id' => null,
        'name' => ''
    ];


    public function rules()
    {
        return [
            'in_edit_mode.id' => 'required|exists:todos,id',
            'in_edit_mode.name' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'in_edit_mode.id.required' => 'To do is not correct!',
            'in_edit_mode.name.required' => 'Name is required',
            'in_edit_mode.name.min' => 'Name should be at least 3 characters',
        ];
    }

    function create()
    {
        $validated = $this->validateOnly('name', ['name' => 'min:1'], ['name.min' => 'Min 11']);
        // $validated = $this->validate(['name' => 'min:10'], ['name.min' => 'Not Good']);

        if (Todo::create($validated))
            session()->flash('created', 'created');

        $this->reset('name');

        // dd('Create');
    }

    function completed(Todo $todo)
    {
        $todo->completed = !$todo->completed;

        if ($todo->save())
            return session()->flash('success', 'Status updated Success');

        return session()->flash('error', 'Status not updated');
    }

    function confirm_delete($todo)
    {
        $this->to_delete = (object) $todo;
    }

    function confirm_cancel()
    {
        $this->to_delete = null;
    }

    function delete()
    {
        $todo = Todo::find($this->to_delete->id);

        $this->confirm_cancel();

        if ($todo && $todo->delete())
            return  session()->flash('success', 'Deleted Successfully');

        return session()->flash('error', 'Cannot delete item.');
    }

    function set_edit_mode(Todo $todo)
    {
        $this->in_edit_mode = [
            'id' => $todo->id,
            'name' => $todo->name
        ];
    }

    function cancel_update()
    {
        $this->in_edit_mode = null;
    }

    function update()
    {

        $validated = $this->validateOnly('in_edit_mode.name');

        $todo = Todo::find($this->in_edit_mode['id']);

        $todo->name = $validated['in_edit_mode']['name'];

        if ($todo && $todo->save()) {
            $this->in_edit_mode = null;
            return session()->flash('success', 'Updated Successfully');
        }

        return session()->flash('error', 'Cannot update item.');
    }

    public function render()
    {
        return view('livewire.todo-list', ['todos' => Todo::whereLike('name', "%{$this->search}%")->latest()->paginate(100)]);
    }
}
