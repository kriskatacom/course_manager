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
    public $status = null;
    protected $listeners = ["deleted" => "handleDeleted"];

    protected $queryString = [
        'status' => ['except' => null],
    ];

    public function handleDeleted()
    {
        $this->resetPage();
        $this->dispatchBrowserEvent('flash-message', [
            'message' => __("messages.course_move_trash"),
            'type' => 'success',
            'timeout' => 3000
        ]);
    }

    public function setStatusFilter($status)
    {
        $this->status = $status;
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function restore($courseId)
    {
        $course = Course::onlyTrashed()->find($courseId);

        if ($course) {
            $course->restore();
            $course->status = 'archived';
            $course->saveQuietly();

            $this->dispatchBrowserEvent('flash-message', [
                'message' => __("messages.course_restored"),
                'type' => 'success',
                'timeout' => 6000
            ]);

            $this->resetPage();
        }
    }

    public function deletePermanently($courseId)
    {
        $course = Course::onlyTrashed()->find($courseId);

        if ($course) {
            $course->forceDelete();

            $this->dispatchBrowserEvent('flash-message', [
                'message' => __("messages.course_deleted_successfully"),
                'type' => 'success',
                'timeout' => 3000
            ]);
        }
    }

    public function render()
    {
        $query = Course::with('category');

        if ($this->status === 'deleted') {
            $query->onlyTrashed();
        } elseif ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        $courses = $query->orderBy('id', 'desc')
            ->paginate($this->perPage);

        if ($this->status === Course::STATUS_DELETED) {
            $coursesCount = Course::onlyTrashed()->count();
        } else if ($this->status) {
            $coursesCount = Course::where("status", $this->status)->count();
        } else {
            $coursesCount = Course::count();
        }

        return view('livewire.admin.courses.courses-table', [
            'courses' => $courses,
            'coursesCount' => $coursesCount,
        ]);
    }
}
