{{-- process the ACTUAL info --}}
<div class="row">

  <div class="col-md-12">
    <p class="lead">Characters on key {{ $keyID }}</p>
    <div class="row">
      @foreach ($key_info->key->characters as $character)
            <div class="col-md-4 text-center">
                <img src='http://image.eveonline.com/Character/{{ $character->characterID }}_256.jpg' class='img-circle'>
                <hr>
                <h4>{{ $character->characterName }} <small>{{ $character->corporationName }}</small></h4>
            </div>
      @endforeach
  </div> <!-- ./row -->
</div>

<div class="row">
  <div class="col-md-12">

    {{-- key time accounts --}}
      <ul class="list-unstyled">
          <li><i class="fa fa-clock-o fa-fw"></i>This account has logged into EVE related services <b>{{ $status_info->logonCount }}</b> times</li>
          <li>
            <i class="fa fa-clock-o fa-fw"></i>
              This account has been online a total of 
              <b>{{ $status_info->logonMinutes }} minutes, {{ round(((int)$status_info->logonMinutes/60),0) }} hours or {{ round(((int)$status_info->logonMinutes/60)/24,0) }} days</b>
          </li>
        </ul>

      {{-- key activity and accessmask details --}}
      <ul class="list-unstyled">
          @if (Carbon\Carbon::parse($status_info->paidUntil)->lte(\Carbon\Carbon::now()))
            <li><i class="fa fa-times fa-fw"></i>This account is not active and expired <b>{{ Carbon\Carbon::parse($status_info->paidUntil)->diffForHumans() }}</b></li>
          @else
            <li><i class="fa fa-check fa-fw"></i>This account is active and will expire on {{ $status_info->paidUntil }} which is <b>{{ Carbon\Carbon::parse($status_info->paidUntil)->diffForHumans() }}</b></li>
          @endif

          @if( strlen($key_info->key->expires) == 0)
            <li><i class="fa fa-check fa-fw"></i>This key will <b>never</b> expire</li>
          @else
            <li><i class="fa fa-times fa-fw"></i>This key will expire on {{ $key_info->key->expires }} which is <b>{{ Carbon\Carbon::parse($key_info->key->expires)->diffForHumans() }}</b></li>
          @endif

            <li><i class="fa fa-check fa-fw"></i>This key type is <b>{{ $key_info->key->type }}</b></li>

          @if ($key_info->key->type == 'Corporation')
            @if ($key_info->key->accessMask == 67108863) {{-- full corporation api key? --}}
          <li><i class="fa fa-check fa-fw"></i>This key has a full corporation Access Mask of: <b><span id='access-mask'>{{ $key_info->key->accessMask }}</span></b></li>
        @else
          <li><i class="fa fa-check fa-fw"></i>This key has a partial corporation Access Mask of: <b><span id='access-mask'>{{ $key_info->key->accessMask }}</span></b></li>
        @endif
          @else
            @if ($key_info->key->accessMask == 268435455) {{-- full character/account api key? --}}
          <li><i class="fa fa-check fa-fw"></i>This key has a full character/account Access Mask of: <b><span id='access-mask'>{{ $key_info->key->accessMask }}</span></b></li>
        @else
          <li><i class="fa fa-check fa-fw"></i>This key has a partial character/account Access Mask of: <b><span id='access-mask'>{{ $key_info->key->accessMask }}</span></b></li>
        @endif
          @endif
      </ul>

   </div> <!-- ./col-6 -->
</div> <!-- ./row -->

{{-- check if everything is ok, and present the form to apply --}}
@if ( ($key_info->key->accessMask == 268435455) && (strlen($key_info->key->expires) == 0) && ($key_info->key->type == 'Account'))

  <div class="row">
    <div class="col-md-12">

      <h5 class="text-success pull-right"><i class="fa fa-check"></i> This key meets the FUL API key requirements for WCS.</h5>

      <div class="nav-tabs">
          <ul class="nav nav-tabs">
              <li class="active"><a href="#main_application" data-toggle="tab">I am applying with my main character</a></li>
              <li><a href="#alt_application" data-toggle="tab">I am applying with a alt</a></li>
          </ul>
          <div class="tab-content">

              <div class="tab-pane active" id="main_application">

                <br>
                    {{ Form::open(array('url' => 'apply/process', 'class' => 'form-horizontal', 'id' => 'key-form')) }}
                        <fieldset>

                          <input type="hidden" name="reference" value="{{ $application_reference }}">

                          <!-- Select Basic -->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="character_name">Character Name</label>
                            <div class="col-md-4">
                              <select id="character_name" name="character_name" class="form-control">
                                @foreach ($key_info->key->characters as $character)
                                  <option value="{{ $character->characterName }}">{{ $character->characterName }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="character_skillpoints">Skillpoints</label>  
                            <div class="col-md-4">
                            <input id="character_skillpoints" name="character_skillpoints" type="text" placeholder="Eg: 20M" class="form-control input-md">
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="character_focus">Character Focus</label>  
                            <div class="col-md-4">
                            <input id="character_focus" name="character_focus" type="text" placeholder="Eg: PVE / PVP" class="form-control input-md">
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="character_vouch">Who in WCS. can vouch for you?</label>  
                            <div class="col-md-4">
                            <input id="character_vouch" name="character_vouch" type="text" placeholder="" class="form-control input-md">
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="avg_online">Avg Online Times</label>  
                            <div class="col-md-4">
                            <input id="avg_online" name="avg_online" type="text" placeholder="Eg: 1200 to 2000 EVE" class="form-control input-md">
                            </div>
                          </div>

                          <!-- Multiple Radios -->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="radios">Are you able to use Voice Comms ie. Teamspeak 3?</label>
                            <div class="col-md-4">
                            <div class="radio">
                              <label for="radios-0">
                                <input type="radio" name="voice_communications" id="radios-0" value="yes" checked="checked">
                                Yes
                              </label>
                            </div>
                            <div class="radio">
                              <label for="radios-1">
                                <input type="radio" name="voice_communications" id="radios-1" value="no">
                                No
                              </label>
                            </div>
                            </div>
                          </div>

                          <!-- Textarea -->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="capital_information">Which Capital Ships can you fly?</label>
                            <div class="col-md-4">                     
                              <textarea class="form-control" id="capital_information" name="capital_information">Eg: Naglfar; Archon</textarea>
                            </div>
                          </div>

                          <!-- Textarea -->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="alt_names">Who are your alts?</label>
                            <div class="col-md-4">                     
                              <textarea class="form-control" id="alt_names" name="alt_names">Eg: Alt Name 1; Alt Name 2</textarea>
                            </div>
                          </div>

                          <!-- Button -->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton"></label>
                            <div class="col-md-4">
                              <button id="singlebutton" name="singlebutton" class="btn btn-default btn-block btn-lg">Apply to join WCS.</button>
                            </div>
                          </div>

                        </fieldset>
                    {{ Form::close() }}
                  <br>
              </div><!-- /.tab-pane -->

              <div class="tab-pane" id="alt_application">

                <br>
                    {{ Form::open(array('url' => 'apply/process', 'class' => 'form-horizontal', 'id' => 'key-form')) }}
                        <fieldset>

                          <input type="hidden" name="reference" value="{{ $application_reference }}">

                          <!-- Select Basic -->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="character_name">Character Name</label>
                            <div class="col-md-4">
                              <select id="character_name" name="character_name" class="form-control">
                                @foreach ($key_info->key->characters as $character)
                                  <option value="{{ $character->characterName }}">{{ $character->characterName }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="character_skillpoints">Skillpoints</label>  
                            <div class="col-md-4">
                            <input id="character_skillpoints" name="character_skillpoints" type="text" placeholder="Eg: 20M" class="form-control input-md">
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="character_focus">Character Focus</label>  
                            <div class="col-md-4">
                            <input id="character_focus" name="character_focus" type="text" placeholder="Eg: PVE / PVP" class="form-control input-md">
                            </div>
                          </div>

                          <!-- Text input-->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="character_main">Who is your main WCS.?</label>  
                            <div class="col-md-4">
                            <input id="character_main" name="character_main" type="text" placeholder="" class="form-control input-md">
                            </div>
                          </div>

                          <!-- Button -->
                          <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton"></label>
                            <div class="col-md-4">
                              <button id="singlebutton" name="singlebutton" class="btn btn-default btn-block btn-lg">Apply to join WCS.</button>
                            </div>
                          </div>

                        </fieldset>
                    {{ Form::close() }}
                  <br>
              </div><!-- /.tab-pane -->
          </div><!-- /.tab-content -->
      </div><!-- ./nav-tabs -->
    </div> <!-- ./col-md-12 -->
  </div> <!-- ./row -->
@else

  <hr>

  <h4 class="text-danger"><i class="fa fa-exclamation"></i> Sorry, the API key that you have provided does not meet the FUL API key requirements for WCS.</h4>
  <p>
    Either you have set an expiration time, did not tick all of the sections or have used a character only key instead of an account one.<br>
    Please retry with a full api key.
    <br>
    <a href="#page-top" class="btn btn-default btn-lg">Retry</a>
  </p>

@endif