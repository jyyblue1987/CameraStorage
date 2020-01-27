<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<base href="<?php echo base_url();?>">
    <title>video3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="assets/plugins/mediaelement/build/mediaelementplayer.min.css">

    <style>

        #container {
            padding: 0 20px 50px;
        }
        .error {
            color: red;
        }
        a {
            word-wrap: break-word;
        }

        #player2-container .mejs__time-buffering, #player2-container .mejs__time-current, #player2-container .mejs__time-handle,
        #player2-container .mejs__time-loaded, #player2-container .mejs__time-marker, #player2-container .mejs__time-total {
            height: 2px;
        }

        #player2-container .mejs__time-total {
            margin-top: 9px;
        }
        #player2-container .mejs__time-handle {
            left: -10px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ffffff;
            top: -5px;
            cursor: pointer;
            display: block;
            position: absolute;
            z-index: 1;
            border: none;
        }

    </style>
</head>


<body>

    <div id="container">
        <div class="players" id="player1-container">

            <h3>Video Player</h3>

            <div class="media-wrapper">
                <video id="player1" width="640" height="360" style="max-width:100%;" preload="none">
                    <source src="http://www.streambox.fr/playlists/test_001/stream.m3u8" type="video/mp4">
                </video>
            </div>
            <br>
            <div>
                <label>Sources <select name="sources">
                    <option value="https://media.w3.org/2010/05/sintel/trailer.mp4">MP4</option>
                    <option value="https://upload.wikimedia.org/wikipedia/commons/2/22/Volcano_Lava_Sample.webm">WebM</option>
                    <option value="http://www.streambox.fr/playlists/test_001/stream.m3u8">HLS</option>
                    <option value="http://www.bok.net/dash/tears_of_steel/cleartext/stream.mpd">M(PEG)-DASH</option>
                    <option value="http://la2.indexcom.com/me/flv/guqin.flv">FLV</option>
                    <option value="http://www.dailymotion.com/embed/video/x2lzodk">DailyMotion</option>
                    <option value="https://www.youtube.com/watch?v=twYp6W6vt2U">YouTube</option>
                    <option value="https://player.vimeo.com/video/108018156?title=0&amp;byline=0&amp;portrait=0&amp;badge=0">Vimeo</option>
                    <option value="https://www.facebook.com/johndyer/videos/10107816243681884/">Facebook</option>
                </select>
                </label>
            </div>
            <br>
            <div class="player-info">
                <h4>Player information</h4>
                <div id="player1-rendername">
                    <p><strong>Source</strong>: <span class="src"><a href="https://media.w3.org/2010/05/sintel/trailer.mp4" target="_blank">https://media.w3.org/2010/05/sintel/trailer.mp4</a></span></p>
                    <p><strong>Renderer</strong>: <span class="renderer">html5</span></p>
                    <p class="error"></p>
                </div>
            </div>
        </div>
        
    </div>

    <script src="assets/plugins/mediaelement/build/jquery.js"></script>
    <script src="assets/plugins/mediaelement/build/mediaelement-and-player.js"></script>
<script>
$(document).ready(function () {
	$('video')[0].player.setSrc('http://www.streambox.fr/playlists/test_001/stream.m3u8');
	$('video')[0].player.play();
});
</script>

<script>

$('video').mediaelementplayer({
	success: function(media, node, player) {
		//$('#' + node.id + '-mode').html('mode: ' + media.pluginType);
	}
});

</script>
</body>


</html>
