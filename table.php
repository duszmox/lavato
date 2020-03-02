<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
<div class='container'>
    <div class='hero-unit'>
        <h1>Bootstrap Sortable</h1>
    </div>
    <table class='table table-bordered table-striped sortable'>
        <thead>
            <tr>
                <th style="width: 20%; vertical-align: middle;" rowspan="2" class='az' data-defaultsign="nospan" data-defaultsort="asc"><i class="fa fa-map-marker fa-fw"></i>Name</th>
                <th colspan="4" data-mainsort="3" style="text-align: center;">Results</th>
                <th data-defaultsort="disabled"></th>
            </tr>
            <tr>
                <th style="width: 20%" colspan="2" data-mainsort="1" data-firstsort="desc">Round 1</th>
                <th style="width: 20%">Round 2</th>
                <th style="width: 20%">Total</th>
                <th style="width: 20%" data-defaultsign="month">Date</th>
            </tr>
        </thead>
        <tbody> </tbody>
    </table>
    <table class='table table-bordered table-striped sortable'>
        <thead>
            <tr>
                <th style="width: 20%; vertical-align: middle;" rowspan="2" class='az' data-defaultsign="nospan" data-defaultsort="asc"><i class="fa fa-map-marker fa-fw"></i>Name</th>
                <th colspan="4" data-mainsort="3" style="text-align: center;">Results</th>
                <th data-defaultsort="disabled"></th>
            </tr>
            <tr>
                <th style="width: 20%" colspan="2" data-mainsort="1" data-firstsort="desc">Round 1</th>
                <th style="width: 20%">Round 2</th>
                <th style="width: 20%">Total</th>
                <th style="width: 20%" data-defaultsign="month">Date</th>
            </tr>
        </thead>
        <tbody> </tbody>
    </table>
    <div class='well'> <button type='button' class='btn btn-primary add-row' data-sort="true">Add Row (use last sort)</button> <button type='button' class='btn btn-primary add-row'>Add Row (use default sort)</button> </div>
    <div class='well'> <button type='button' class='btn btn-primary change-sort' data-custom="true">Set custom sorting</button> <button type='button' class='btn btn-primary change-sort'>Reset built-in sorting</button> </div>
    <div class="well"> <span class="groupbox">Options</span>
        <div class="well" style="margin-top: 10px"> <span class="groupbox">Event</span>
            <div class="checkbox"> <label> <input type="checkbox" checked="checked" id="event" />Hook on 'sorted' event </label> </div>
        </div>
        <div class="well"> <span class="groupbox">Sorting sign</span>
            <div class="radio"> <label> <input type="radio" name="sign" id="default" value="" checked>Default (points towards larger value) </label> </div>
            <div class="radio"> <label> <input type="radio" name="sign" id="reversed" value="reversed">Reversed (points towards smaller value) </label> </div>
            <div class="radio"> <label> <input type="radio" name="sign" id="az" value="az">a..z </label> </div>
            <div class="radio"> <label> <input type="radio" name="sign" id="AZ" value="AZ">A..Z </label> </div>
            <div class="radio"> <label> <input type="radio" name="sign" id="19" value="_19">1..9 </label> </div>
            <div class="radio"> <label> <input type="radio" name="sign" id="month" value="month">jan..dec </label> </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.2/moment.min.js"></script>