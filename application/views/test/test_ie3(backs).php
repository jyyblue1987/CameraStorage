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
        <section>
        <h1>MediaElement.js</h1>

        <h2><em>audio/video</em> unification library</h2>

        <p><em>MediaElement</em> is a wrapper that mimics the native HTML5 MediaElement syntax (get/set) as a renderer that
            can handle media from HTML5, YouTube, Vimeo, Soundcloud, Flash, Facebook, and other libraries.</p>

        <p><em>MediaElementPlayer</em> is built off of MediaElement and creates a fully featured player on top of the
            unified syntax from MediaElement.</p>
        </section>

        <section>
            <h3>Global Options</h3>
            
        </section>

        <br>
        <div class="players" id="player1-container">

            <h3>Video Player</h3>

            <div class="media-wrapper">
                <video id="player1" width="640" height="360" style="max-width:100%;" preload="none">
                    <source src="http://clips.vorwaerts-gmbh.de/big_buck_bunny.mp4" type="video/mp4">
                    <track srclang="en" label="English" kind="subtitles" src="mediaelement.vtt">
                    <track srclang="en" kind="chapters" src="chapters.vtt">
                </video>
            </div>
            <br>
            <div>
                <label>Sources <select name="sources">
                    <option value="https://media.w3.org/2010/05/sintel/trailer.mp4">MP4</option>
                    <option value="https://upload.wikimedia.org/wikipedia/commons/2/22/Volcano_Lava_Sample.webm">WebM</option>
                    <!--<option value="rtmp://184.72.239.149/vod/BigBuckBunny_115k.mov">RTMP</option>-->
                    <!--<option value="rtmp://firehose.cul.columbia.edu:1935/vod/mp4:sample.mp4">RTMP</option>-->
                    <option value="http://www.streambox.fr/playlists/test_001/stream.m3u8">HLS</option>
                    <!--<option value="http://dash.edgesuite.net/envivio/EnvivioDash3/manifest.mpd">M(PEG)-DASH</option>-->
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

        <br>
        <hr>

        <div class="players" id="player2-container">

            <h3>Audio Player</h3>

            <p>By default, time handle element is hidden, but in this demo the following styles were added to display it just for audio:</p>

            <pre><code>
        #player2-container .mejs__time-buffering, #player2-container .mejs__time-current,
        #player2-container .mejs__time-handle, #player2-container .mejs__time-loaded,
        #player2-container .mejs__time-marker, #player2-container .mejs__time-total {
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
            </code></pre>

            <div class="media-wrapper">
                <audio id="player2" preload="none" controls style="max-width:100%;">
                    <source src="http://www.largesound.com/ashborytour/sound/AshboryBYU.mp3" type="audio/mp3">
                </audio>
            </div>
            <br>
            <div>
                <label>Sources <select name="sources">
                    <option value="http://www.largesound.com/ashborytour/sound/AshboryBYU.mp3">MP3</option>
                    <option value="http://www.vorbis.com/music/Hydrate-Kenny_Beltrey.ogg">OGG</option>
                    <option value="http://db3.indexcom.com/bucket/ram/00/05/64k/05.m3u8">HLS</option>
                    <!--<option value="rtmp://s3b78u0kbtx79q.cloudfront.net/cfx/st/mp3:fake_empire-cbr">RTMP (MP3)</option>-->
                    <option value="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/282715465&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true">SoundCloud</option>
                </select>
                </label>
            </div>
            <br>
            <div class="player-info">
                <h4>Player information</h4>
                <div id="player2-rendername">
                    <p><strong>Source</strong>: <span class="src"><a href="http://www.largesound.com/ashborytour/sound/AshboryBYU.mp3" target="_blank">http://www.largesound.com/ashborytour/sound/AshboryBYU.mp3</a></span></p>
                    <p><strong>Renderer</strong>: <span class="renderer">html5</span></p>
                    <p class="error"></p>
                </div>
            </div>

        </div>
    </div>

    <script src="assets/plugins/mediaelement/build/jquery.js"></script>

    <script src="assets/plugins/mediaelement/build/mediaelement-and-player.js"></script>
    <script src="assets/plugins/mediaelement/demo/demo.js"></script>
</body>
</html>
