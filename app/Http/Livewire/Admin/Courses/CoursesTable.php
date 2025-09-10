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
        session()->flash("success", "Курсът беше изтрит успешно!");
        $this->resetPage();
        $this->emit("flash", "Курсът беше изтрит успешно!", "success");
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

        return view("livewire.admin.courses.courses-table", [
            "courses" => $courses,
        ]);
    }
}
