<?php get_header(); ?>

<div id='index' class="index">
  <div class='iframe-content'>
    <div id="player"></div>
  </div>
</div>

<script src="http://www.youtube.com/player_api"></script>
<script>
  var player;
  function onYouTubePlayerAPIReady() {
    player = new YT.Player('player', {
      playerVars: {
        'autoplay': 1,
        'controls': 0,
        'showinfo': 0,
        'autohide': 1,
        'loop': 1,
        'playlist': 'n4JFXi9lOJ8',
        'wmode':'opaque' },
      videoId: 'n4JFXi9lOJ8',
      events: {
        'onReady': onPlayerReady}
    });
   }

   function onPlayerReady(event) {
     event.target.mute();
   }
</script>

<?php get_footer(); ?>
