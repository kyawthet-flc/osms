<?php

namespace App\Http\Controllers\GeneralSetup;

use App\Http\Controllers\Controller;
use App\Model\GeneralSetup\{
    Document,
    ApplicationModule
};
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    protected $basePath = 'enforcements.general-setups.documents.';

    protected $mimes = array(
        'pdf' => 'mimes:pdf',
        'video' => 'mimetypes:video/*,video/x-m4v,video/mp4,video/x-m4v,video/x-matroska',
        'image' => 'mimes:jpeg,png,jpg'
    );
    
    public function index()
    {
        $this->data = array(
            'lists' => Document::get(['*'])
        );
        return $this->viewPath('index');
    }

    public function create()
    {
        $this->data = array(
            'document' => new Document,
            'applicationModules' => ApplicationModule::pluck('name', 'id')->toArray(),
            'fileSizes' => array(1, 5, 10, 15, 20 , 30),
            'routeUrl' => route('general_setup.documents.store'),
            'methodName' => 'post'
        ); 
        return $this->viewPath('form');
    }

    public function store(Request $request)
    {
        Document::create( 
           $this->parameters($request->all()) + 
           ['file_code' => (new Document)->generateCode()] 
        );
        return redirect()->route('general_setup.documents.index')->with('success', 'Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\GeneralSetup\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\GeneralSetup\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $this->data = array(
            'document' => $document,
            'applicationModules' => ApplicationModule::pluck('name', 'id')->toArray(),
            'fileSizes' => array(1, 5, 10, 15, 20 , 30),
            'routeUrl' => route('general_setup.documents.update', $document),
            'methodName' => 'put'
        );
        return $this->viewPath('form');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\GeneralSetup\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $document->update( $this->parameters($request->all()) );
        return redirect()->route('general_setup.documents.index')->with('success', 'Successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\GeneralSetup\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }

    public function parameters($params)
    {

        return [
            "application_module_id" => $params['application_module_id'],
            'sub_type' => $params['sub_type'],
            'group_name' => $params['group_name'],
            'addition_filter' => $params['addition_filter'],
            "file_name" => $params["file_name"],
            "require" => $params['require'],
            "require_if" => isset($params['toggleRequireIf'])? $params['require_if']: NULL,
            "min_size" => $params['min_size'],
            "max_size" => $params["max_size"],
            "file_type" => $params['file_type'],
            "mimes" => $this->mimes[$params['mimes']],
            "uploadable_file_count" => $params['uploadable_file_count']?? 1,
            "status" => $params['status']
        ];
    }
}