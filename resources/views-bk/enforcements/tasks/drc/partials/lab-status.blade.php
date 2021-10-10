@if( is_null($labStatus) || $labStatus === 'to_request' )
    <span class="text-primary"><i class="fa fa-circle-o" aria-hidden="true"></i> Not Requested</span>
@elseif( $labStatus === 'requested' )
    <span class="text-info"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> Requested</span>
@elseif( in_array($labStatus,['checked', 'rechecked']) )
    <span class="text-info"><i class="fa fa-thermometer-empty" aria-hidden="true"></i> At Lab</span>
@elseif( $labStatus === 'received' )
    <span class="text-info"><i class="fa fa-bell-o" aria-hidden="true"></i> Received</span>
@elseif( $labStatus === 'passed' )
    <span class="text-success"><i class="fa fa-check" aria-hidden="true"></i> Passed</span>
@elseif(  $labStatus === 'failed' )
    <span class="text-danger"><i class="fa fa-times" aria-hidden="true"></i> Failed</span>
@endif