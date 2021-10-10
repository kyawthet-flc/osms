<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(ApplicationModuleSeeder::class);
        $this->call(FeeSeeder::class);
        $this->call(BankSeeder::class);

        $this->call(CountrySeeder::class);
        $this->call(DivisionSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(TownshipSeeder::class);
        $this->call(DocumentSeeder::class);
        $this->call(PermissionUserSeeder::class);
        //$this->call(ProductSetup::class);
        $this->call(PeriodSeeder::class);

        $this->call(ProductTypeSeeder::class);

        $this->call(UnitSeeder::class);
        $this->call(TypeOfProcedureSeeder::class);
        $this->call(OnetimePurposeSeeder::class);
        $this->call(RouteOfAdministrationSeeder::class);
        $this->call(AdministrationUnitSeeder::class);

        $this->call(DosageFormSeeder::class);
        $this->call(dlmcDosageFormSeeder::class);
        $this->call(MeasurementUnitSeeder::class);

        $this->call(DispensingModalitySeeder::class);
        $this->call(PrimaryContainerSeeder::class);
        $this->call(StorageConditionSeeder::class);


        $this->call(ClassificationOfProdcutSeeder::class);
        $this->call(DistributionLimitationSeeder::class);
        $this->call(AnalyticalMethodSeeder::class);
        $this->call(TypeOfAuthorizationSeeder::class);
        // $this->call(TypeOfProcedureCategorySeeder::class);
        // $this->call(TypeOfProcedureStatusSeeder::class);
        // $this->call(TypeOfProcedureStepSeeder::class);
        $this->call(CauseSeeder::class);
        $this->call(LabFeeSeeder::class);
        $this->call(ClassificationAtcSeeder::class);
        $this->call(SubstanceSeeder::class);

    }
}
