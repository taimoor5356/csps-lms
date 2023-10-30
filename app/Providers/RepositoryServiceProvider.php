<?php

namespace App\Providers;

use App\Interfaces\AlumniRepositoryInterface;
use App\Repositories\LectureRepository;
use App\Repositories\StudentRepository;
use App\Repositories\TeacherRepository;
use App\Repositories\VisitorRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\AttendanceRepository;
use App\Repositories\ExaminationRepository;
use App\Repositories\NoticeBoardRepository;
use App\Repositories\SuggestionsRepository;
use App\Repositories\ZoomClassesRepository;
use App\Repositories\MockScheduleRepository;
use App\Repositories\TeacherReviewRepository;
use App\Interfaces\FacultyRepositoryInterface;
use App\Interfaces\LectureRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
use App\Interfaces\VisitorRepositoryInterface;
use App\Repositories\DownloadCenterRepository;
use App\Repositories\LectureScheduleRepository;
use App\Repositories\RegisteredYearsRepository;
use App\Repositories\RevisionClassesRepository;
use App\Interfaces\AttendanceRepositoryInterface;
use App\Repositories\RegisteredBatchesRepository;
use App\Interfaces\ExaminationRepositoryInterface;
use App\Interfaces\NoticeBoardRepositoryInterface;
use App\Interfaces\SuggestionsRepositoryInterface;
use App\Interfaces\ZoomClassesRepositoryInterface;
use App\Interfaces\MockScheduleRepositoryInterface;
use App\Interfaces\TeacherReviewRepositoryInterface;
use App\Interfaces\DownloadCenterRepositoryInterface;
use App\Interfaces\LectureScheduleRepositoryInterface;
use App\Interfaces\RegisteredYearsRepositoryInterface;
use App\Interfaces\RevisionClassesRepositoryInterface;
use App\Interfaces\RegisteredBatchesRepositoryInterface;
use App\Repositories\AlumniRepository;
use App\Repositories\FacultyRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(LectureRepositoryInterface::class, LectureRepository::class);
        $this->app->bind(NoticeBoardRepositoryInterface::class, NoticeBoardRepository::class);
        $this->app->bind(ExaminationRepositoryInterface::class, ExaminationRepository::class);
        $this->app->bind(ZoomClassesRepositoryInterface::class, ZoomClassesRepository::class);
        $this->app->bind(DownloadCenterRepositoryInterface::class, DownloadCenterRepository::class);
        $this->app->bind(TeacherReviewRepositoryInterface::class, TeacherReviewRepository::class);
        $this->app->bind(SuggestionsRepositoryInterface::class, SuggestionsRepository::class);
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class); 
        $this->app->bind(AttendanceRepositoryInterface::class, AttendanceRepository::class); 
        $this->app->bind(VisitorRepositoryInterface::class, VisitorRepository::class); 
        $this->app->bind(RegisteredYearsRepositoryInterface::class, RegisteredYearsRepository::class); 
        $this->app->bind(RegisteredBatchesRepositoryInterface::class, RegisteredBatchesRepository::class); 
        $this->app->bind(MockScheduleRepositoryInterface::class, MockScheduleRepository::class); 
        $this->app->bind(RevisionClassesRepositoryInterface::class, RevisionClassesRepository::class); 
        $this->app->bind(LectureScheduleRepositoryInterface::class, LectureScheduleRepository::class); 
        $this->app->bind(FacultyRepositoryInterface::class, FacultyRepository::class); 
        $this->app->bind(AlumniRepositoryInterface::class, AlumniRepository::class); 
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
