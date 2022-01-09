<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use DataTables;

class MessageController extends Controller
{
    public function index()
    {
        return view('management.message.index');
    }

    public function messageTable()
    {
        $data = Message::latest()->get();
        return DataTables::of($data)
            ->editColumn("created_at", function($data) {
                return date('m/d/Y', strtotime($data->created_at));
            })
            ->addColumn('view', function ($data) {
                return $view = '<a href="" data-bs-toggle="modal" data-bs-target="#viewModal'.$data->id.'" ><i class="far fa-eye"></i></a>
                                <div class="modal fade" id="viewModal'.$data->id.'" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="">'.$data->subject.'</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table>
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>:</td>
                                                        <td>'.$data->name.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td>:</td>
                                                        <td>'.$data->email.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Dikirim</td>
                                                        <td>:</td>
                                                        <td>'.$data->created_at.'</td>
                                                    </tr>
                                                </table>
                                                '.$data->message.'
                                            </div>
                                        </div>
                                    </div>
                                </div>';
            })
            ->rawColumns(['view'])
            ->make(true);
    }
}
