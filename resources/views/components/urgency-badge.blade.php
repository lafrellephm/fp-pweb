@props(['urgency'])

@if($urgency === 'critical')
    <span class="badge bg-danger">Kritis</span>
@elseif($urgency === 'urgent')
    <span class="badge bg-warning text-dark">Mendesak</span>
@else
    <span class="badge bg-secondary">Normal</span>
@endif
