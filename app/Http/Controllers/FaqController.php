<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Faq;
use App\Repositories\Faq\FaqRepository;
use App\Support\Faq\FaqStatus;

class FaqController extends Controller
{   
/**
     * @var FaqRepository
     */
    private $faqs;

    /**
     * FaqController constructor.
     * @param FaqRepository $faqs
     */
    public function __construct(FaqRepository $faqs)
    {
        $this->middleware('auth');
        $this->faqs = $faqs;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faqs = $this->faqs->paginate_search(10, $request->search);
        if ( $request->ajax() ) {
            if (count($faqs)) {
                return response()->json([
                    'success' => true,
                    'view' => view('faqs.list', compact('faqs'))->render(),
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => trans('app.no_records_found')
                ]);
            }
        }

        return view('faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        $status = ['' => trans('app.selected_item')] + FaqStatus::lists();

        return response()->json([
            'success' => true,
            'view' => view('faqs.create-edit', compact('status','edit'))->render()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'question' => $request->question,
            'answer' => $request->answer,
            'status' => $request->status,
            'created_by' => Auth::id(),
        ];
        $faq = $this->faqs->create($data);
        if ( $faq ) {

            return response()->json([
                'success' => true,
                'message' => trans('app.faq_created')
            ]);
        } else {
            
            return response()->json([
                'success' => false,
                'message' => trans('app.error_again')
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ( $faq = $this->faqs->find($id) ) {
            return response()->json([
                'success' => true,
                'view' => view('faqs.show', compact('faq'))->render()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('app.no_record_found')
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = true;
        $status = FaqStatus::lists();
        if ( $faq = $this->faqs->find($id) ) {
            return response()->json([
                'success' => true,
                'view' => view('faqs.create-edit', compact('faq','edit','status'))->render()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => trans('app.no_record_found')
            ]);
        }
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
        $faq = $this->faqs->update(
            $id, 
            $request->only('question', 'answer', 'status')
        );
        if ( $faq ) {

            return response()->json([
                'success' => true,
                'message' => trans('app.faq_updated')
            ]);
        } else {
            
            return response()->json([
                'success' => false,
                'message' => trans('app.error_again')
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( $this->faqs->delete($id) ) {
            return response()->json([
                'success' => true,
                'message' => trans('app.faq_deleted')
            ]);
        } else {
            return response()->json([
                'success'=> false,
                'message' => trans('app.error_again')
            ]);
        }
    }
}
