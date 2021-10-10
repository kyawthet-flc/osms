<?php

namespace App\Http\Controllers\GeneralSetup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GeneralSetup\DlmcDosageForm;

class DlmcDosageFormController extends Controller
{
    protected $basePath = 'enforcements.general-setups.dlmc_dosage_form.';

    public function index()
    {
        $this->data = array(
            'lists' => DlmcDosageForm::all()//->paginate(25)
        );
        return $this->viewPath('index');
    }

    public function create()
    {
        $this->data = array(
            'dlmcDosageForm' => new DlmcDosageForm
        );
        return $this->viewPath('create');
    }

    public function store(Request $request)
    {
        DlmcDosageForm::create($request->validate([
            'name' => 'required',
            'type' => 'required',
        ]));
        return redirect()->route('general_setup.dlmcDosageForms.index')->with('success', 'Successfully Created.');
    }

    public function edit(DlmcDosageForm $dlmcDosageForm)
    {
        $this->data = array(
            'dlmcDosageForm' => $dlmcDosageForm
        );
        return $this->viewPath('edit');
    }

    public function update(Request $request, DlmcDosageForm $dlmcDosageForm)
    {
        $dlmcDosageForm->update($request->validate([
            'name' => 'required',
            'type' => 'required',
        ]));
        return redirect()->route('general_setup.dlmcDosageForms.index')->with('success', 'Successfully Updated.');
    }

    public function createChildDlmcDosageForm(DlmcDosageForm $dlmcDosageForm)
    {
        $this->data = array(
            'dlmcDosageForm' => $dlmcDosageForm
        );
        return $this->viewPath('child.create');
    }

    public function storeChildDlmcDosageForm(Request $request, DlmcDosageForm $dlmcDosageForm)
    {
        $dlmcDosageForm->create([
            'parent_id' => $dlmcDosageForm->id,
            'name' => $request->name,
            'type' => $dlmcDosageForm->type,
        ]);
        return redirect()->route('general_setup.dlmcDosageForms.index')->with('success', 'Successfully Created.');
    }

    public function editChildDlmcDosageForm(DlmcDosageForm $dlmcDosageForm)
    {
        $this->data = array(
            'dlmcDosageForm' => $dlmcDosageForm
        );
        return $this->viewPath('edit');
    }

    public function updateChildDlmcDosageForm(Request $request, DlmcDosageForm $dlmcDosageForm)
    {
        $dlmcDosageForm->update($request->validate([
            'name' => 'required',
        ]));
        return redirect()->route('general_setup.dlmcDosageForms.index')->with('success', 'Successfully Updated.');
    }

    public function destroyChildDlmcDosageForm(DlmcDosageForm $dlmcDosageForm)
    {
        $dlmcDosageForm->delete();
        return redirect()->route('general_setup.dlmcDosageForms.index')->with('success', 'Successfully Deleted.');
    }

}
