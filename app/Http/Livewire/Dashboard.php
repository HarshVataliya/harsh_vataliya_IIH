<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Http\Livewire\Traits\WithPerPagePagination;

class Dashboard extends Component
{
    use WithPerPagePagination;

    public $showEditModal = false;
    public $showModalTitle;
    public Student $editing;
    public $students;

    protected $listeners = ['refresh' => 'render'];

    public function create(){
        Log::info("create");
        $this->showModalTitle = "Add Student Details";
        $this->showEditModal = true;
    }

    public function edit(Student $student){
        Log::info("edit");
        $this->showModalTitle = "Edit Student Details";
        $this->showEditModal = true;
    }

    public function save()
    {
        Log::info("save 1");
        Log::info($this->editing);
        $validated = $this->validate();
        $validated = $validated['editing'];
        Log::info("save 2");
        Log::info($this->editing);

        $updated = null;

        // Update or Create
        if($this->editing->id) {
            $updated = Student::find($this->editing->id);
            $updated->update($validated);
        } else {
            $updated = Student::create($validated);
            $updated->save();
        }

        $this->showEditModal = false;
    }

    public function onDelete(Student $student) {
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            // 'description' => "You want to delete : $student->title",
            'description' => "You want to delete : ",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'delete',
            'params'      => $student->id,
        ]);
    }

    public function delete(Student $student) {
        $student->delete();
        $this->refreshQuestionnaire();
        $this->notification()->success(
            $title = 'Student Deleted',
            $description = 'Student was successfully deleted'
        );
    }

    public function rules() {
        return [
            "editing.first_name" => [
                'required',
                'min:3',
                'max:100'
            ],
            "editing.last_name" => [
                'required',
                'min:3',
                'max:100'
            ],
            "editing.dob" => [
                'required',
            ],
            "editing.gender" => [
                'required',
            ],
            // "editing.marks" => [
            //     'required',
            // ],
        ];
    }

    public function mount() {
        $this->editing = Student::make();
    }

    private function resetForm()
    {
        // $this->first_name = '';
        // $this->last_name = '';
        // $this->date_of_birth = '';
    }

    public function render()
    {
        $query = Student::query();
        $students = $this->applyPagination($query);
        Log::info($students);
        return view('livewire.dashboard',[
            'students' => $students,
        ]);
    }
}
