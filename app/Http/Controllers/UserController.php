<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
class UserController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }
}
