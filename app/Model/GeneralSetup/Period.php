<?php

namespace App\Model\GeneralSetup;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $guarded = [];

    public function applicationModule()
    {
        return $this->belongsTo(ApplicationModule::class);
    }

    public function incompleteDuration($applicationModuleId, $applicationType)
    {
        if( $setup = $this->whereApplicationModuleId($applicationModuleId)->whereSubAppType($applicationType)
            ->whereName('Incomplete Duration')->first(['id', 'period', 'period_unit']) ) {
            return($setup->period. ' '. strtoupper($setup->period_unit) );

        }
        return ('1 MONTH');
    }

    public function incompleteCounter($applicationModuleId, $applicationType)
    {
        if( $setup = $this->whereApplicationModuleId($applicationModuleId)->whereSubAppType($applicationType)
            ->whereName('Incomplete Counter')->first(['id', 'period', 'period_unit']) ) {
            return$setup->period;

        }
        return 1;
    }

    public function noticeExpiry($applicationModuleId, $applicationType)
    {
        if( $setup = $this->whereApplicationModuleId($applicationModuleId)->whereSubAppType($applicationType)
            ->whereName('Notice Expiry')->first(['id', 'period']) ) {
            return($setup->period. ' '. strtoupper($setup->period_unit) );

        }
        return ('1 MONTH');
    }

    public function validity($applicationModuleId, $applicationType)
    {
        if( $setup = $this->whereApplicationModuleId($applicationModuleId)->whereSubAppType($applicationType)
            ->whereName('Validity')->first(['id', 'period', 'period_unit']) ) {
            return($setup->period. ' '. strtoupper($setup->period_unit) );

        }
        return ('3 YEAR');
    }

    public function validityTempLicense($applicationModuleId, $applicationType)
    {
        if( $setup = $this->whereApplicationModuleId($applicationModuleId)->whereSubAppType($applicationType)
            ->whereName('Temporary Licece Approved')->first(['id', 'period', 'period_unit']) ) {
            return($setup->period. ' '. strtoupper($setup->period_unit) );

        }
        return ('6 MONTH');
    }

    public function notifyRenewal($applicationModuleId, $applicationType)
    {
        if( $setup = $this->whereApplicationModuleId($applicationModuleId)->whereSubAppType($applicationType)
            ->whereName('Notify Renewal')->first(['id', 'period', 'period_unit']) ) {
            return($setup->period. ' '. strtoupper($setup->period_unit) );

        }
        return ('1 MONTH');
    }

    public function deleteDraft($applicationModuleId, $applicationType)
    {
        if( $setup = $this->whereApplicationModuleId($applicationModuleId)->whereSubAppType($applicationType)
            ->whereName('Delete Draft')->first(['id', 'period', 'period_unit']) ) {
            return($setup->period. ' '. strtoupper($setup->period_unit) );

        }
        return ('1 MONTH');
    }

    public function licenseApproveDuration($numberOfCount)
    {
        return ( $numberOfCount .' MONTH');
    }

    public function licenseExpiredDuration($applicationModuleId, $applicationType)
    {
        if( $setup = $this->whereApplicationModuleId($applicationModuleId)->whereSubAppType($applicationType)
            ->whereName('Notify License Expired')->first(['id', 'period', 'period_unit']) ) {
            return($setup->period. ' '. strtoupper($setup->period_unit) );

        }
        return ('2 WEEK');

    }

}