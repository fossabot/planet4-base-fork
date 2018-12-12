<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('check YouTube video renders');

$slug = $I->generateRandomSlug();

$videoTitle = 'Test Video';
$videoId = 'wNN-Yl-SBTM';

$I->havePageInDatabase([
	'post_name' => $slug,
	'post_status' => 'publish',
	'post_content' => $I->generateShortcode('shortcake_media_video', [
		'video_title' => $videoTitle,
		'youtube_id'  => $videoId
	])
]);

$I->amOnPage('/' . $slug);

$I->see($videoTitle, '.video-block h2');
$I->seeElement('.video-block .video-section iframe', [
	'src' => 'https://www.youtube.com/embed/' . $videoId . '?autoplay=0&rel=0'
]);
