<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Ask;
use App\Mail\AnswerEmail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $answer = new Answer();
        $answer->user = $request->user;
        $answer->ask_id = $request->ask_id;
        $answer->content = $request->content;
        Ask::find($request->ask_id)->update(['status' => 1]);
        $answer->save();
        $this->answerEmail($request->ask_id);

        return redirect('/client/ask')->with('status','Đã tư vấn thành công');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ask = Ask::find($id);

        return view('admin.ask_answer.answer')->with(compact('ask'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function answerEmail($id){
       
        $ask = Ask::find($id);
        
        $email = $ask->email;
        
        $askContent = $ask->content;

        $answers = Answer::where('ask_id',$id)->latest()->get();
        
        foreach($answers as $answer){
            
            $answerContent = $answer->content;
            $user = $answer->user;
            break;
        }

         
        $data = [
            'subject' => 'Bác sĩ tư vấn',
            'askContent'    => $askContent,
            'answerContent'    => $answerContent,
            'user'   => $user,
            'email'   => $email
        ];
        
            Mail::to($email)->send(new AnswerEmail($data));
            // return response()->json(['Great check your mail box!']);
        

    }
    public function comeback(){
        return redirect('/admin/ask_answer');

    }
}
