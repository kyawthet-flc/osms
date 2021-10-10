<?php

use Illuminate\Support\Facades\Route;
use App\Model\Task\Drc\DrcApplication;

/* $lists = \Schema::getColumnListing('diac_incompletes');

foreach($lists as $list) {
    echo $list . '<br/>';

}
die; */

// $text = '{"CompanyName":"ZEAL & ZEST COMPANY LIMITED","CompanyNameMM":null,"CompanyId":"a0f87cd1-221e-48e2-be86-a1af4d647eee","CorporationName":null,"CorporationNameMM":null,"IncorporationRegNo":null,"Incorporation":null,"IsForeignCompany":"No","CompanyRegistrationNumber":"115549499","CompanyRegistrationDate":"2019-01-22","Currency":"MMK","CapitalAmount":"10000","MICPermitNo":null,"CompanyType":"Private Company Limited by Shares","Status":"Registered","IsSmallCompany":"Yes","Directors":[{"Name":"DAW MI MI KYAING","FormerName":null,"Nationality":"Myanmar","NRC":"12\/MABANA(N)076573","OtherNationality":null,"Gender":"Female","DateOfBirth":"1970-02-22","PhoneNumber":"09-5026980","Email":"Yahmoan.yho@gmail.com","StreetNumberAndStreetName":"Padamyar Street","UnitLevel":"No(46)","QuarterCityTownship":"Compound of Thanlyin Bridge, Tharketa Township","StateRegion":"Yangon","Country":"Myanmar","Postcode":null,"OfficerId":"b5f9ce57-7cf5-41dd-b355-0404eb8e8fd1"},{"Name":"DAW YAHMOAN OO","FormerName":null,"Nationality":"Myanmar","NRC":"12\/THAKATA(N)189986","OtherNationality":null,"Gender":"Female","DateOfBirth":"1992-04-11","PhoneNumber":"09-5091337","Email":"Yahmoanoo@gmail.com","StreetNumberAndStreetName":"Padamyar Street","UnitLevel":"No(46)","QuarterCityTownship":"Compound of Thanlyin Bridge, Tharketa Township","StateRegion":"Yangon","Country":"Myanmar","Postcode":null,"OfficerId":"cbf83e31-eeef-4372-9523-1d77d8f67ca6"},{"Name":"U AUNG MYO TUN","FormerName":null,"Nationality":"Myanmar","NRC":"7\/AHPHANA(N)085535","OtherNationality":null,"Gender":"Male","DateOfBirth":"1990-07-27","PhoneNumber":"09-43210097","Email":"Aungmyo10097@icloud.com","StreetNumberAndStreetName":"Padamyar Street","UnitLevel":"No(46)","QuarterCityTownship":"Compound of Thanlyin Bridge, Tharketa Township","StateRegion":"Yangon","Country":"Myanmar","Postcode":null,"OfficerId":"f4b45676-3760-4cce-9948-3f999e54be42"},{"Name":"U THEIN HTIKE","FormerName":null,"Nationality":"Myanmar","NRC":"12\/MABANA(N)042951","OtherNationality":null,"Gender":"Male","DateOfBirth":"1966-09-23","PhoneNumber":"09-422452338","Email":"utheinhtikeuth66@mail.ru","StreetNumberAndStreetName":"Padamyar Street","UnitLevel":"No(46)","QuarterCityTownship":"Compound of Thanlyin Bridge, Tharketa Township","StateRegion":"Yangon","Country":"Myanmar","Postcode":null,"OfficerId":"8857f98e-e358-4b4d-a2e1-59b5ffbe4b60"},{"Name":"U HTET AUNG HLAING","FormerName":null,"Nationality":"Myanmar","NRC":"12\/THAKATA(N)191655","OtherNationality":null,"Gender":"Male","DateOfBirth":"1998-01-07","PhoneNumber":"09-5080754","Email":"Followyourdream9991@gmail.com","StreetNumberAndStreetName":"Padamyar Street","UnitLevel":"No(46)","QuarterCityTownship":"Compound of Thanlyin Bridge,Tharketa Township","StateRegion":"Yangon","Country":"Myanmar","Postcode":null,"OfficerId":"36e60cda-8712-4018-86dc-cd31be0c9c24"}],"IndividualMembers":[{"Name":"U HTET AUNG HLAING","FormerName":null,"Nationality":"Myanmar","NRC":"12\/THAKATA(N)191655","Gender":"Male","DateOfBirth":"1998-01-07","StreetNumberAndStreetName":"Padamyar Street","UnitLevel":"No(46)","QuarterCityTownship":"Compound of Thanlyin Bridge, Tharketa Township","StateRegion":"Yangon","Country":"Myanmar","Postcode":null,"OfficerId":"122f4627-523b-4f41-83cb-15a4a9d6bfd9","Shares":[{"TotalShares":200,"IssueClass":"ORD","IssueSeries":null,"AmountPaid":20000000,"AmountUnpaid":0},{"TotalShares":800,"IssueClass":"ORD","IssueSeries":null,"AmountPaid":80000000,"AmountUnpaid":0}]},{"Name":"U AUNG MYO TUN","FormerName":null,"Nationality":"Myanmar","NRC":"7\/AHPHANA(N)085535","Gender":"Male","DateOfBirth":"1990-07-27","StreetNumberAndStreetName":"Padamyar Street","UnitLevel":"No(46)","QuarterCityTownship":"Compound of Thanlyin Bridge, Tharketa Township","StateRegion":"Yangon","Country":"Myanmar","Postcode":null,"OfficerId":"3da0e188-c8b9-407f-a1e8-23761dd1fc23","Shares":[{"TotalShares":200,"IssueClass":"ORD","IssueSeries":null,"AmountPaid":20000000,"AmountUnpaid":0},{"TotalShares":800,"IssueClass":"ORD","IssueSeries":null,"AmountPaid":80000000,"AmountUnpaid":0}]},{"Name":"DAW YAHMOAN OO","FormerName":null,"Nationality":"Myanmar","NRC":"12\/THAKATA(N)189986","Gender":"Female","DateOfBirth":"1992-04-11","StreetNumberAndStreetName":"Padamyar Street","UnitLevel":"No(46)","QuarterCityTownship":"Compound of Thanlyin Bridge, Tharketa Township","StateRegion":"Yangon","Country":"Myanmar","Postcode":null,"OfficerId":"0fe510f9-7161-4142-ad97-2bca53fc0573","Shares":[{"TotalShares":200,"IssueClass":"ORD","IssueSeries":null,"AmountPaid":20000000,"AmountUnpaid":0},{"TotalShares":800,"IssueClass":"ORD","IssueSeries":null,"AmountPaid":80000000,"AmountUnpaid":0}]},{"Name":"U THEIN HTIKE","FormerName":null,"Nationality":"Myanmar","NRC":"12\/MABANA(N)042951","Gender":"Male","DateOfBirth":"1966-09-23","StreetNumberAndStreetName":"Padamyar Street","UnitLevel":"No(46)","QuarterCityTownship":"Compound of Thanlyin Bridge, Tharketa Township","StateRegion":"Yangon","Country":"Myanmar","Postcode":null,"OfficerId":"61dc65b3-4c16-48e7-a5cc-bea2c9f60ba7","Shares":[{"TotalShares":200,"IssueClass":"ORD","IssueSeries":null,"AmountPaid":20000000,"AmountUnpaid":0},{"TotalShares":800,"IssueClass":"ORD","IssueSeries":null,"AmountPaid":80000000,"AmountUnpaid":0}]},{"Name":"DAW MI MI KYAING","FormerName":null,"Nationality":"Myanmar","NRC":"12\/MABANA(N)076573","Gender":"Female","DateOfBirth":"1970-02-22","StreetNumberAndStreetName":"Padamyar Street","UnitLevel":"No(46)","QuarterCityTownship":"Compound of Thanlyin Bridge, Tharketa Township","StateRegion":"Yangon","Country":"Myanmar","Postcode":null,"OfficerId":"8211651c-cb69-4704-8a1b-d406a2e2a8e0","Shares":[{"TotalShares":200,"IssueClass":"ORD","IssueSeries":null,"AmountPaid":20000000,"AmountUnpaid":0},{"TotalShares":5800,"IssueClass":"ORD","IssueSeries":null,"AmountPaid":580000000,"AmountUnpaid":0}]}],"CorporateMembers":[],"AuthorizedOfficers":[],"Addressess":[{"StreetNumberAndStreetName":null,"UnitLevel":null,"QuarterCityTownship":null,"StateRegion":null,"PostCode":null,"Country":"Myanmar","AddressTypeId":3,"AddressId":"aa2611fa-ace4-4440-bcca-18d3ad6ded56"},{"StreetNumberAndStreetName":"Compound of Thardu ,Lay Daungkan Road","UnitLevel":"No(3\/B)","QuarterCityTownship":"Thingungyun Township","StateRegion":"Yangon Region","PostCode":null,"Country":"Myanmar","AddressTypeId":5,"AddressId":"e9add0b7-f1e2-4b83-9e73-4b34fef607e6"}],"Shares":[{"TotalShares":10000,"IssueClass":"ORD","IssueSeries":null,"AmountPaid":1000000000,"AmountUnpaid":0}],"PrincipalActivities":[{"ActivityTypeId":42,"Activity":"42 - Civil engineering","ActivityId":"5d23dc39-3e4d-4f07-80b9-88675b10da10"},{"ActivityTypeId":43,"Activity":"43 - Specialized construction activities","ActivityId":"8b20cf33-22a7-48f1-9c4f-cc22a4072b68"},{"ActivityTypeId":42,"Activity":"42 - Civil engineering","ActivityId":"c0a55f51-efe0-4955-bab6-ea501f6fc703"}]}';

// dd( json_decode($text) );
// dd( bcrypt('fda@u53R') );

/*R
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// cache()->forget('permissions');
// cache()->forget('roles');
// dd( cache('permissions'), cache('roles'));
// $drcApp = DrcApplication::find(1);
// $certiTemplate = new App\Templates\DrcLocal\Certificate($drcApp);
// $certificateFileId = $certiTemplate->save();

/* use App\Model\Task\Diac\DiacApplication;

use App\Notifications\Diac\{
    AutoCancel,
    Approval,
    Incomplete,
    Rejection
};
Route::get('testJob', function(){
    $delay = now()->addMinutes(1);
    $diacApplication = DiacApplication::find(1);
    $diacApplication->frontendUser->notify( (new Approval($diacApplication, 'Approval', 'This is approved.')) );
   
});
 */
Route::get('/', 'HomeController@redirectToLogin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('changePassword', 'HomeController@changePassword')->name('change_password');
Route::post('storeChangedPassword', 'HomeController@storeChangedPassword')->name('store_change_password');


// Manual Certificate
Route::get('diac/certificate/{diacApplication}', 'Task\ManualGenerationController@diacCertificate')->name('diac_certificate');
