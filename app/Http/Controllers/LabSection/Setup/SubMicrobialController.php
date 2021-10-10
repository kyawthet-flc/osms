<?php

namespace App\Http\Controllers\LabSection\Setup;

use App\Http\Controllers\Controller;
use App\Model\LabSection\Microbial;
use App\Model\LabSection\SubMicrobial;
use Illuminate\Http\Request;
use Mpdf\Tag\Sub;

class SubMicrobialController extends Controller
{
    protected $basePath = 'lab-sections.setups.microbial.';
    public function index(Microbial $microbial)
    {
        $this->data = [
            'lists' => $microbial->subItem()->paginate(20),
            'data' => $microbial
        ];
        return $this->viewPath('sub_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Microbial $microbial)
    {
        $this->data = [
            'route' => route('lab_section.setup.store_sub',['microbial' => $microbial]),
            'method' => 'post',
            'microbial' => $microbial,
            'sub_microbial' => new SubMicrobial()
        ];

        return $this->viewPath('_sub_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Microbial $microbial, SubMicrobial $subMicrobial = null)
    {
        $request->validate(['name' => 'required']);
        if($subMicrobial) {
            $store = $microbial->subItem()->whereId($subMicrobial->id)->update(['name' => $request->name ]);
        }else {
            $store = $microbial->subItem()->create(['name' => $request->name ]);
        }

        if($store) {
            return redirect(route('lab_section.setup.sub_index', ['microbial' => $microbial]))->with('success', 'Successfully stored');
        }else {
            return redirect(route('lab_section.setup.sub_index', ['microbial' => $microbial]))->with('error', 'Something went wrong');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Microbial $microbial, SubMicrobial $subMicrobial)
    {
        $this->data = [
            'sub_microbial' => $subMicrobial,
            'microbial' => $microbial,
            'route' => route('lab_section.setup.store_sub', ['microbial' => $microbial , 'sub_microbial' => $subMicrobial]),
            'method' => 'post',
        ];
        return $this->viewPath('_sub_form');
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
    public function destroy(SubMicrobial $subMicrobial)
    {
        if($subMicrobial->delete()){
            return redirect()->back()->with('success', 'Successfully deleted');
        }else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
