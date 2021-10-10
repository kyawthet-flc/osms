<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\{DosageForm,AtcCode,TherapeuticClass,Formulation,Otc,
    PrimaryContainer,AdministrationUnit,RouteOfAdministration,Substance};
class ProductSetup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // dosage forms
       /*  $data = ['CAPSULE','CRYSTAL','DISC','DOUCHE','DRESSING','ELIXIR','EMULSION','ENEMA'];
        foreach ($data as $name) {
            DosageForm::create([ 'name' => $name]);
        } */

        // atc codes
        $data = ['A01A', 'A01', 'A02', 'A03', 'A04', 'B01A', 'B01', 'B02',' B03', 'C0A1', 'C01', 'C03'];
        foreach($data as $name) {
            AtcCode::create(['name' => $name]);
        }

        // therapeutic class
        $data = ['Analgesics', 'Antibiotic', 'Anticoagulant'];
        foreach($data as $name) {
            TherapeuticClass::create(['name' => $name]);
        }

        // formulation
        $data = ['Tablets', 'Enteric Coated Tablets'];
        foreach($data as $name) {
            Formulation::create(['name' => $name]);
        }

        // otc
        $data = ['suppositories', 'liquids', 'drops', 'Tylenol'];
        foreach($data as $name) {
            Otc::create(['name' => $name]);
        }

        // primary container
        /* $data = ['Ampoules', 'Containers'];
        foreach($data as $name) {
            PrimaryContainer::create(['name' => $name]);
        } */

        // Route of administration
        /* $data = ['Oral route', 'Injection', 'Sublingual and buccal', 'Rectal', 'Vaginal', 'Ocular ', 'Otic', 'Nasal'];
        foreach($data as $name) {
            RouteOfAdministration::create(['name' => $name]);
        } */

        // Substances
        Substance::create([
            'name' => 'barium white',
            'req_ba_be_status' => 'active',
            'admitted_status' => 'active',
            'cas_no' => '2324',
            'source_name' => 'Chemical',
            'reason' => 'Fair',
            'product_type_id' => 1,
            'preferred_term' => 'DSN',
            'controlled_sus' => 'Fair',
            'status' => 'active',
            'user_id' => 1
        ]);

        Substance::create([
            'name' => 'benzol',
            'req_ba_be_status' => 'active',
            'admitted_status' => 'active',
            'cas_no' => '2324',
            'source_name' => 'Chemical',
            'reason' => 'Fair',
            'product_type_id' => 1,
            'preferred_term' => 'DSN',
            'controlled_sus' => 'Fair',
            'status' => 'active',
            'user_id' => 1
        ]);

        // AdministrationUnit::create(['name' => 'unit 1']);

    }
}
