var myMoov;
var nextStop = -1;
var spf = 0.04;
var playingInterval;
var maxInt=9999999;

$(document).ready(init);

function init() {
    videojs('myMoov').ready(function () {
        myMoov = this;
        addPresentationButtons();
        addEvents();
        setPresentationProgress();
    });
}
function addPresentationButtons(){
    var btnPrevious = myMoov.controlBar.addChild('button', {text: "Previous"});
    btnPrevious.addClass("btn-previous");
    btnPrevious.on("click", gotoPreviousPoint);

    var btnNext = myMoov.controlBar.addChild('button', {text: "Next"});
    btnNext.addClass("btn-next");
    btnNext.on("click", gotoNextPoint);

    $(".vjs-live-controls").hide();

    var t = $('<div><span id="presentation-progress">1 / 1</span></div>');
    $(t).addClass("vjs-time-controls vjs-control vjs-presentation-progress");
    $(".vjs-control-bar").append(t);

    var container =  $('<div id="controls-container"></div>');
    $(".vjs-control-bar").append(container);

    $("#controls-container").append($(".btn-previous"));
    $("#controls-container").append($(".vjs-presentation-progress"));
    //$("#controls-container").append($(".vjs-play-control"));
    $("#controls-container").append($(".btn-next"));
    $(".vjs-play-control").hide();
}
function gotoPreviousPoint() {
    myMoov.pause();
    myMoov.currentTime(getPreviousPoint(myMoov.currentTime()));
    setPresentationProgress();
}

function gotoNextPoint() {
    if(myMoov.paused()){
        myMoov.play();
    }else{
        var point = getNextPoint(myMoov.currentTime());
        if(point == maxInt)$("#presentation-progress").text((presentationPoints.length + 2) + " / " + (presentationPoints.length + 2));
        myMoov.currentTime(point);
    }
    setPresentationProgress();
}
function addEvents(){
    myMoov.on("play", function () {
        nextStop = getNextPoint(myMoov.currentTime());
        playingInterval = setInterval(function () {
            if (nextStop != -1 && roundDecimal(myMoov.currentTime()) >= nextStop) {
                myMoov.pause();
                myMoov.currentTime(roundDecimal(nextStop));
                setPresentationProgress();
            }
        }, 5);
        setPresentationProgress();
    });

    myMoov.on("pause", function () {
        $('.vjs-loading-spinner').remove();
        clearInterval(playingInterval);
    });

    myMoov.on("ended", function () {
        $("#presentation-progress").text((presentationPoints.length + 2) + " / " + (presentationPoints.length + 2));
    });

    myMoov.on("seeked", function () {
        setPresentationProgress();
    });

    window.document.onkeydown = function(event){
        if(event.keyCode == 33 || event.keyCode == 38 || event.keyCode == 37){
            event.preventDefault();
            event.stopPropagation();
            gotoPreviousPoint();
        }else if(event.keyCode == 34 || event.keyCode == 40 || event.keyCode == 39){
            event.preventDefault();
            event.stopPropagation();
            gotoNextPoint();
        }else if(event.keyCode == 13 || event.keyCode == 32){
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            event.stopPropagation();
            if(myMoov.paused()){
                myMoov.play();
            }else{
                myMoov.pause();
            }
        }
    };

    //myMoov.on('error', function() {
        //myMoov.src({ src: "data/videos/moov.mp4", type: "video/flv" });
    //});
}
function getNextPoint(t) {
    var time = maxInt;
    for (var i = 0; i < presentationPoints.length; i++) {
        if (presentationPoints[i].time > roundDecimal(t)) {
            time = presentationPoints[i].time;
            break;
        }
    }
    return time;
}

function getPreviousPoint(t) {
    var time = 0;
    for (var i = presentationPoints.length - 1; i >= 0; i--) {
        if (presentationPoints[i].time < roundDecimal(t)) {
            time = presentationPoints[i].time;
            break;
        }
    }
    return time;
}

function roundDecimal(num) {
    return Math.round(num * 100) / 100;
}

function setPresentationProgress(){
    $("#presentation-progress").text(getCurrentPresentationPoint() + " / " + (presentationPoints.length + 2));
}

function getCurrentPresentationPoint(){
    var point=1;
    for (var i = 0; i < presentationPoints.length; i++) {
        if (presentationPoints[i].time <= roundDecimal(myMoov.currentTime())) {
            point++;
        }else if(presentationPoints[i].time > roundDecimal(myMoov.currentTime())){
            break;
        }
    }
    return point;
}