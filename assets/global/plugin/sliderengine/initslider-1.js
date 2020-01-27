jQuery(document).ready(function(){

    var scripts = document.getElementsByTagName("script");

    var jsFolder = "";

    for (var i= 0; i< scripts.length; i++)

    {

        if( scripts[i].src && scripts[i].src.match(/initslider-1\.js/i))

            jsFolder = scripts[i].src.substr(0, scripts[i].src.lastIndexOf("/") + 1);

    }

    jQuery("#amazingslider-1").amazingslider({

        jsfolder:jsFolder,

        width:1280,

        height:430,

        skinsfoldername:"",

        loadimageondemand:false,

        enabletouchswipe:false,

        fullscreen:false,

        autoplayvideo:false,

        addmargin:false,

        randomplay:false,

        isresponsive:true,

        pauseonmouseover:false,

        playvideoonclickthumb:true,

        slideinterval:5000,

        fullwidth:false,

        transitiononfirstslide:false,

        scalemode:"fill",

        loop:0,

        autoplay:true,

        navplayvideoimage:"play-32-32-0.png",

        navpreviewheight:60,

        timerheight:2,

        descriptioncssresponsive:"font-size:12px;",

        shownumbering:false,

        skin:"Classic",

        addgooglefonts:false,

        navshowplaypause:true,

        navshowplayvideo:true,

        navshowplaypausestandalonemarginx:0,

        navshowplaypausestandalonemarginy:0,

        navbuttonradius:0,

        navpreviewposition:"top",

        navradius:0,

        showshadow:false,

        navfeaturedarrowimagewidth:16,

        navpreviewwidth:120,

        googlefonts:"",

        textpositionmarginright:24,

        textautohide:true,

        navthumbnavigationarrowimagewidth:32,

        navthumbtitlehovercss:"text-decoration:underline;",

        texteffectresponsivesize:600,

        navcolor:"#999999",

        arrowwidth:0,

        texteffecteasing:"easeOutCubic",

        texteffect:"slide",

        navspacing:0,

        playvideoimage:"playvideo-64-64-0.png",

        ribbonimage:"ribbon_topleft-0.png",

        navwidth:24,

        navheight:24,

        arrowimage:"arrows-32-32-0.png",

        timeropacity:0.6,

        titlecssresponsive:"font-size:12px;",

        navthumbnavigationarrowimage:"carouselarrows-32-32-0.png",

        navshowplaypausestandalone:false,

        texteffect1:"slide",

        navpreviewbordercolor:"#ffffff",

        ribbonposition:"topleft",

        navthumbdescriptioncss:"display:block;position:relative;padding:2px 4px;text-align:left;font:normal 12px Arial,Helvetica,sans-serif;color:#333;",

        arrowstyle:"mouseover",

        navthumbtitleheight:20,

        textpositionmargintop:24,

        navswitchonmouseover:false,

        navarrowimage:"navarrows-28-28-0.png",

        arrowtop:50,

        textstyle:"static",

        playvideoimageheight:64,

        navfonthighlightcolor:"#666666",

        showbackgroundimage:false,

        navpreviewborder:4,

        navshowplaypausestandaloneheight:28,

        shadowcolor:"#aaaaaa",

        navbuttonshowbgimage:true,

        navbuttonbgimage:"navbuttonbgimage-28-28-0.png",

        navthumbnavigationarrowimageheight:32,

        textbgcss:"display:block; position:absolute; top:0px; left:0px; width:100%; height:100%; background-color:#333333; opacity:0.6; filter:alpha(opacity=60);",

        textpositiondynamic:"bottomleft",

        navpreviewarrowwidth:16,

        navdirection:"horizontal",

        navshowpreviewontouch:false,

        bottomshadowimagewidth:96,

        showtimer:false,

        playvideoimagewidth:64,

        navshowpreview:true,

        navmarginy:30,

        navmarginx:30,

        navfeaturedarrowimage:"featuredarrow-16-8-0.png",

        showribbon:false,

        navstyle:"bullets",

        textpositionmarginleft:24,

        descriptioncss:"display:block; position:relative; font:12px \"Lucida Sans Unicode\",\"Lucida Grande\",sans-serif,Arial; color:#fff; margin-top:8px;",

        navplaypauseimage:"navplaypause-28-28-0.png",

        backgroundimagetop:-10,

        timercolor:"#ffffff",

        numberingformat:"%NUM/%TOTAL ",

        navfontsize:12,

        navhighlightcolor:"#333333",

        texteffectdelay1:1000,

        navimage:"bullet-24-24-0.png",

        texteffectduration1:600,

        navshowplaypausestandaloneautohide:false,

        navbuttoncolor:"#999999",

        navshowarrow:false,

        texteffectslidedirection:"left",

        navshowfeaturedarrow:false,

        lightboxbarheight:48,

        titlecss:"display:block; position:relative; font:bold 14px \"Lucida Sans Unicode\",\"Lucida Grande\",sans-serif,Arial; color:#fff;",

        texteffectslidedistance1:120,

        navshowplaypausestandaloneposition:"bottomright",

        navshowbuttons:false,

        arrowhideonmouseleave:1000,

        navshowplaypausestandalonewidth:28,

        navfeaturedarrowimageheight:8,

        navopacity:0.8,

        backgroundimagewidth:120,

        bordercolor:"#ffffff",

        navthumbtitlewidth:120,

        texteffectseparate:false,

        arrowheight:32,

        arrowmargin:8,

        texteffectduration:600,

        bottomshadowimage:"bottomshadow-110-95-0.png",

        border:0,

        timerposition:"bottom",

        navfontcolor:"#333333",

        navthumbnavigationstyle:"arrow",

        borderradius:0,

        navbuttonhighlightcolor:"#333333",

        textpositionstatic:"bottom",

        navthumbstyle:"imageonly",

        texteffecteasing1:"easeOutCubic",

        textcss:"display:block; padding:12px; text-align:left;",

        navbordercolor:"#ffffff",

        navpreviewarrowheight:8,

        navpreviewarrowimage:"previewarrow-16-8-0.png",

        showbottomshadow:false,

        texteffectslidedistance:30,

        texteffectdelay:500,

        textpositionmarginstatic:0,

        backgroundimage:"",

        navposition:"bottomLeft",

        texteffectslidedirection1:"right",

        navborder:4,

        textformat:"Bottom bar",

        bottomshadowimagetop:95,

        texteffectresponsive:true,

        shadowsize:5,

        navthumbtitlecss:"display:block;position:relative;padding:2px 4px;text-align:left;font:bold 14px Arial,Helvetica,sans-serif;color:#333;",

        textpositionmarginbottom:24,

        ribbonmarginy:0,

        ribbonmarginx:0,

        slide: {

            duration:1000,

            easing:"easeOutCubic",

            checked:true,

            effectdirection:0

        },

        transition:"slide",

        isfullscreen:false,

        textformat: {



        }

    });

});