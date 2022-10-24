<?php

namespace App\Providers;

use App\Interfaces\DownloadCenterRepositoryInterface;
use App\Interfaces\ExaminationRepositoryInterface;
use App\Interfaces\LectureRepositoryInterface;
use App\Interfaces\NoticeBoardRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\SuggestionsRepositoryInterface;
use App\Interfaces\TeacherReviewRepositoryInterface;
use App\Interfaces\ZoomClassesRepositoryInterface;
use App\Repositories\DownloadCenterRepository;
use App\Repositories\ExaminationRepository;
use App\Repositories\LectureRepository;
use App\Repositories\NoticeBoardRepository;
use App\Repositories\StudentRepository;
use App\Repositories\SuggestionsRepository;
use App\Repositories\TeacherReviewRepository;
use App\Repositories\ZoomClassesRepository;
use Illuminate\Support\ServiceProvider;

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
