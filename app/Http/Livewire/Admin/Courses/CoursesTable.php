<?php

namespace App\Http\Livewire\Admin\Courses;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CoursesTable extends Component
{
    use WithPagination;
    protected $paginationTheme = "tailwind";

    public $search = "";
    public $perPage = 10;
    protected $listeners = ["deleted" => "handleDeleted"];

    public function handleDeleted()
    {
        $this->resetPage();
        $this->dispatchBrowserEvent('flash-message', [
            'message' => __("messages.course_move_trash"),
            'type' => 'success',
            'timeout' => 3000
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Course::with("category")
            ->orderBy("id", "desc");

        if ($this->search) {
            $query->where(function ($q) {
                $q->where("title", "like", "%{$this->search}%")
                  ->orWhere("description", "like", "%{$this->search}%");
            });
        }

        $courses = $query->paginate($this->perPage);
        $coursesCount = Course::count();

        return view("livewire.admin.courses.courses-table", [
            "courses" => $courses,
            "coursesCount" => $coursesCount,
        ]);
    }
}
