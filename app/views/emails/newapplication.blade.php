<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<b>A New Application was received!</b>

		@if (isset($application_content['character_main']))
			<b>This is a alt application</b>

			<div>
				<ul>
				  <li><b>Name: </b> {{ $application_content['character_name'] }}</li>
				  <li><b>Skill Points: </b> {{ $application_content['character_skillpoints'] }}</li>
				  <li><b>Focus: </b> {{ $application_content['character_focus'] }}</li>
				  <li><b>Current WCS. Main: </b> {{ $application_content['character_main'] }}</li>
				</ul>
			</div>

		@else
			<b>This is a main application</b>

			<div>
				<ul>
				  <li><b>Name: </b> {{ $application_content['character_name'] }}</li>
				  <li><b>Skill Points: </b> {{ $application_content['character_skillpoints'] }}</li>
				  <li><b>Focus: </b> {{ $application_content['character_focus'] }}</li>
				  <li><b>WCS. Character that can vouch: </b> {{ $application_content['character_vouch'] }}</li>
				  <li><b>Online Times: </b> {{ $application_content['avg_online'] }}</li>
				  <li><b>Voice Comms: </b> {{ $application_content['voice_communications'] }}</li>
				  <li><b>Capital Information: </b> {{ $application_content['capital_information'] }}</li>
				  <li><b>Alts: </b> {{ $application_content['alt_names'] }}</li>
				</ul>
			</div>
		@endif

		<p>--<br>WCS. Recruitment</p>
	</body>
</html>
