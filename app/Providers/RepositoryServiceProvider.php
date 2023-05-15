<?php

namespace App\Providers;

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
use App\Repositories\TeacherReviewRepository;
use App\Interfaces\LectureRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
use App\Interfaces\VisitorRepositoryInterface;
use App\Repositories\DownloadCenterRepository;
use App\Interfaces\AttendanceRepositoryInterface;
use App\Interfaces\ExaminationRepositoryInterface;
use App\Interfaces\NoticeBoardRepositoryInterface;
use App\Interfaces\SuggestionsRepositoryInterface;
use App\Interfaces\ZoomClassesRepositoryInterface;
use App\Interfaces\TeacherReviewRepositoryInterface;
use App\Interfaces\DownloadCenterRepositoryInterface;

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
