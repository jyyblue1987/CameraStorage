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
            <div class="media-wrapper">
                <video id="player1" width="640" height="360" style="max-width:100%;" preload="none">
                    <source src="http://www.streambox.fr/playlists/test_001/stream.m3u8" type="video/mp4">
                </video>
            </div>
        </div>
        
    </div>

    <script src="assets/plugins/mediaelement/build/jquery.js"></script>
    <script src="assets/plugins/mediaelement/build/mediaelement-and-player.js"></script>
<script>
$(document).ready(function () {
	$('video')[0].player.setSrc('<?='http://myonlinecameras.com/data/user-1/client-2/camera 62/capture1-.m3u8'?>');
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
