<?php

use App\Http\Controllers\Controller;
use App\Usecase\UserUsecase;

class ProfileController extends Controller
{
    public function __construct(
        protected UserUsecase $usecase
    ) {}
}
